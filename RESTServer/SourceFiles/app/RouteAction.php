<?php
if(isset($_GET['action'])){
    if($_GET['action'] == "read"){
        header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once 'RestServerDB.php';
include_once '../employees.php';
$database = new Database();

$db = $database->getConnection();
$items = new Employee($db);
$records = $items->getEmployees();
$itemCount = $records->num_rows;
//echo json_encode($itemCount);
if($itemCount > 0){
$employeeArr = array();
//$employeeArr["body"] = array();
//$employeeArr["itemCount"] = $itemCount;
while ($row = $records->fetch_assoc())
{
array_push($employeeArr, $row);
}
echo json_encode($employeeArr);
}
else{
http_response_code(404);
echo json_encode(
array("message" => "No record found.")
);
}
    }
    if($_GET['action'] == "create"){
        header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once 'RestServerDB.php';
include_once '../employees.php';
$database = new Database();
$db = $database->getConnection();
$item = new Employee($db);


$item->name = $_POST['name'];
$item->email = $_POST['email'];
$item->designation = $_POST['designation'];
$item->created = date('Y-m-d H:i:s');
if($item->createEmployee()){
echo 'Employee created successfully.';
} else{
echo 'Employee could not be created.';
}
    }
    if($_POST['action'] == "delete"){
        header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once 'RestServerDB.php';
include_once '../employees.php';
$database = new Database();
$db = $database->getConnection();
$item = new Employee($db);

$item->id = isset($_GET['id']) ? $_GET['id'] : die();

if($item->deleteEmployee()){
echo json_encode("Employee deleted.");
} else{
echo json_encode("Data could not be deleted");
}
    }
    if($_GET['action'] == "update"){
        header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'RestServerDB.php';
include_once '../employees.php';

$database = new Database();
$db = $database->getConnection();
$item = new Employee($db);

$item->id = isset($_GET['id']) ? $_GET['id'] : die();
$item->name = $_GET['name'];
$item->email = $_GET['email'];
$item->designation = $_GET['designation'];
$item->created = date('Y-m-d H:i:s');
if($item->updateEmployee()){
echo json_encode("Employee data updated.");
} else{
echo json_encode("Data could not be updated");
}
    }
    if($_GET['action'] == "single_read"){
        header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once 'RestServerDB.php';
include_once '../employees.php';
$database = new Database();
$db = $database->getConnection();
$item = new Employee($db);
$item->id = isset($_GET['id']) ? $_GET['id'] : die();
$item->getSingleEmployee();
if($item->name != null){

// create array
$emp_arr = array(
"id" => $item->id,
"name" => $item->name,
"email" => $item->email,
"designation" => $item->designation,
"created" => $item->created
);

http_response_code(200);
echo json_encode($emp_arr);
}
else{
http_response_code(404);
echo json_encode("Employee not found.");
}
    }
}

?>