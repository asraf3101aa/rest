<?php require 'header.php'; ?>


<section class="py-5" data-aos="fade-up">
				<div class="container">
					<div class="row">
						<div class="col-md-3"></div>
		<div class="col-md-6">
			<form method="POST" id="api_crud_form" enctype="multipart/form-data">
				<h2 class="pt-3 pb-5 text-center">Add Employee</h2>
				
					<div class="mb-3 col-md-12">
					<label class="mb-2" for="">Name</label>
					<input type="text" class="form-control" name="name" id="name" required>
				</div>
				<div class="mb-3 col-md-12">
					<label class="mb-2" for="">Email</label>
					<input type="text" class="form-control" name="email" id="email" required>
				</div>
                <div class="mb-3 col-md-12">
					<label class="mb-2" for="">Designation</label>
					<input type="text" class="form-control" name="designation" id="designation" required>
				</div>
				
				
				
				
				<div class="text-center pt-2 d-flex">
					<button type="submit" name="button_action" id="button_action" class="btn btn-lg btn-success me-3 w-50 text-white text-center">Upload</button>
					<button type="reset"  class="cancel btn btn-lg btn-danger ms-3 w-50 text-white text-center">Cancel</button>
				</div><br>
			</form>
		</div>
		</div>
	</div>
</section>


<?php require 'footer.php'; ?>
<script type="text/javascript">
    $('#button_action').val('create');
    $('#api_crud_form').on('submit', function(event) {
            event.preventDefault();
            if ($('name').val() == '') {
                alert("Enter Name");
            } else if ($('#email').val() == '') {
                alert("Enter Email");
            }else if ($('#designation').val() == '') {
                alert("Enter Designation");
            }
             else {
                var form_data = $(this).serialize();
                $.ajax({
                    url: "app/RequestAction.php",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        fetch_data();
                        $('#api_crud_form')[0].reset();
                        if (data == 'insert') {
                            alert("Data Inserted using PHP API");
                        }
                        if (data == 'update') {
                            alert("Data Updated using PHP API");
                        }
                    }
                });
            }
        });