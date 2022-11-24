<?php

if ($_GET['action']="read") {
    $api_url = "http://localhost/restserver/SourceFiles/app/RouteAction.php?action=read";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response);
    print_r($result);
    $output = '';
    if (count($result) > 0) {
        foreach ($result as $row) {
            $output .= '
            <tr>
                <td>' . $row->id . '</td>
                <td>' . $row->name . '</td>
                <td>' . $row->email . '</td>
                <td>' . $row->designation . '</td>
            </tr>
        ';
        }
    } else {
        $output .= '<tr><td colspan="4" align="center">Not found!</td></tr>';
    }
    echo $output;
}
if ($_POST['action']="create") {
    $form_data = array(
        'name' => $_POST['name'],
        'email'  => $_POST['last_name'],
        'designation' => $_POST['designation']
       );
       $api_url = "http://localhost/tutorial/rest-api-crud-using-php/api/test_api.php?action=create";
       $client = curl_init($api_url);
       curl_setopt($client, CURLOPT_POST, true);
       curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
       curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
       $response = curl_exec($client);
       curl_close($client);
       $result = json_decode($response, true);
       foreach($result as $keys => $values)
       {
        if($result[$keys]['success'] == '1')
        {
         echo 'insert';
        }
        else
        {
         echo 'error';
        }
}
}
?>