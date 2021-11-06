<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM employee_list where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k=>$v){
            $$k= $v;
        }

        $qry_meta = $conn->query("SELECT * FROM employee_meta where employee_id = '{$id}'");
        while($row = $qry_meta->fetch_assoc()){
            if(!isset(${$row['meta_field']}))
            ${$row['meta_field']} = $row['meta_value'];
        }
    }
}
?>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: scale-down;
		object-position: center center;
		border-radius: 100% 100%;
	}
    .select2-container--default .select2-selection--single{
        border-radius:0;
    }
</style>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h5 class="card-title"><?php echo isset($id) ? "Update Employee's Details - ".$employee_code : 'Add New Employee' ?></h5>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="" id="employee-form">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <div class="col-md-12">
                    <fieldset class="border-bottom border-info">
                        <legend class="text-info">Personal Information</legend>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="lastname" class="control-label text-info">Last Name</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="lastname" name="lastname" value="<?php echo isset($lastname) ? $lastname : '' ?>" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="firstname" class="control-label text-info">First Name</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="firstname" name="firstname" value="<?php echo isset($firstname) ? $firstname : '' ?>" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="middlename" class="control-label text-info">Middle Name</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="middlename" name="middlename" value="<?php echo isset($middlename) ? $middlename : '' ?>" placeholder="optional">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="gender" class="control-label text-info">Gender</label>
                                <select name="gender" id="gender" class="custom-select custom-select-sm rounded-0" required>
                                    <option <?php echo isset($gender) && $gender == 'Male' ? "selected" : '' ?>>Male</option>
                                    <option <?php echo isset($gender) && $gender == 'Female' ? "selected" : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="dob" class="control-label text-info">Date of Birth</label>
                                <input type="date" class="form-control form-control-sm rounded-0" id="dob" name="dob" value="<?php echo isset($dob) ? $dob : '' ?>" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="contact" class="control-label text-info">Contact #</label>
                                <input type="text" class="form-control form-control-sm rounded-0" id="contact" name="contact" value="<?php echo isset($contact) ? $contact : '' ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="address" class="control-label text-info">Address</label>
                                <textarea type="text" class="form-control form-control-sm rounded-0" id="address" name="address" required placeholder="Street, Apartment Unit #/Building, City, State/Province, ZIP Code"><?php echo isset($address) ? $address : '' ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="email" class="control-label text-info">Email</label>
                                <input type="email" class="form-control form-control-sm rounded-0" id="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border-bottom border-info">
                        <legend class="text-info">Company Details</legend>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="department_id" class="control-label text-info">Department</label>
                                <select name="department_id" id="department_id" class="custom-select custom-select-sm rounded-0 select2" data-placeholder="Select Department Here" required>
                                    <option <?php echo !isset($department_id) ? "selected" : '' ?> disabled></option>
                                    <?php 
                                    $department_qry = $conn->query("SELECT * FROM department_list where status = 1 ".((isset($department_id) && $department_id != null) ? " OR id = '{$department_id}'":"" )." order by name asc");
                                    while($row = $department_qry->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($department_id) && $department_id == $row['id'] ? "selected" : '' ?> <?php echo ($row['status'] != 1) ? "disabled": "" ?>><?php echo $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="designation_id" class="control-label text-info">Designation</label>
                                <select name="designation_id" id="designation_id" class="custom-select custom-select-sm rounded-0 select2" data-placeholder="Select designation Here" required>
                                    <option <?php echo !isset($designation_id) ? "selected" : '' ?> disabled></option>
                                    <?php 
                                    $designation_qry = $conn->query("SELECT * FROM designation_list where status = 1 ".((isset($designation_id) && $designation_id != null) ? " OR id = '{$designation_id}'":"" )." order by name asc");
                                    while($row = $designation_qry->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($designation_id) && $designation_id == $row['id'] ? "selected" : '' ?> <?php echo ($row['status'] != 1) ? "disabled": "" ?>><?php echo $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <?php if(isset($status)): ?>
                            <div class="form-group col-md-4">
                                <label for="status" class="control-label">Status</label>
                                <select name="status" id="status" class="custom-select selevt">
                                    <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                            <?php endif; ?>
                        </div>
                    </fieldset>
                    <fieldset class="border-bottom border-info">
                        <legend class="text-info">Employee Image</legend>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <div class="custom-file rounded-0">
                                    <input type="file" class="custom-file-input rounded-0" id="avatar" name="avatar" onchange="displayImg(this,$(this))">
                                    <label class="custom-file-label rounded-0" for="avatar">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group col-sm-4 text-center">
                                <img src="<?php echo validate_image(isset($id) ? "uploads/employee-".$id.".png" :'')."?v=".(isset($date_updated) ? strtotime($date_updated) : "") ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
    <div class="card-footer text-center">
        <button class="btn btn-flat btn-sn btn-primary" type="submit" form="employee-form">Save</button>
        <a class="btn btn-flat btn-sn btn-dark" href="<?php echo base_url."admin?page=employee" ?>">Cancel</a>
    </div>
</div>
<script>
    $(function(){
		$('.select2').select2({
			width:'resolve'
		})

        $('#employee-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_employee",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = _base_url_+"admin?page=employee/view_employee&id="+resp.id;
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
                _this.siblings('label').text(input.files[0].name)
	        }
	        reader.readAsDataURL(input.files[0]);
	    }else{
            $('#cimg').attr('src', "<?php echo validate_image('no-image-available.png') ?>");
            _this.siblings('label').text('Choose file')
        }
	}
</script>