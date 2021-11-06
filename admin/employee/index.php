<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Employee</h3>
		<div class="card-tools">
			<a href="<?php echo base_url."admin?page=employee/manage_employee" ?>" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Add New Employee</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="13%">
					<col width="10%">
					<col width="25%">
					<col width="25%">
					<col width="12%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Avatar</th>
						<th>Employee</th>
						<th>Company Info</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$department_qry = $conn->query("SELECT * FROM department_list where id in (SELECT department_id FROM employee_list) ");
						$department_arr = array_column($department_qry->fetch_all(MYSQLI_ASSOC),'name','id');
						$designation_qry = $conn->query("SELECT * FROM designation_list where id in (SELECT designation_id FROM employee_list) ");
						$designation_arr = array_column($designation_qry->fetch_all(MYSQLI_ASSOC),'name','id');
						$qry = $conn->query("SELECT *  from `employee_list`order by fullname asc ");
						while($row = $qry->fetch_assoc()):
							$row['department'] = isset($department_arr[$row['department_id']]) ? $department_arr[$row['department_id']] : 'N/A';
							$row['designation'] = isset($designation_arr[$row['designation_id']]) ? $designation_arr[$row['designation_id']] : 'N/A';
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class="text-right"><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td class="text-center"><img src="<?php echo validate_image("uploads/employee-".$row['id'].".png")."?v=".(isset($row['date_updated']) ? strtotime($row['date_updated']) : "") ?>" class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar"></td>
							<td>
								<p class="m-0">
									<small>
										<span class="text-muted">Code: </span><span><?php echo $row['employee_code'] ?></span><br>
										<span class="text-muted">Name: </span><span><?php echo $row['fullname'] ?></span>
									</small>
								</p>
							</td>
							<td>
								<p class="m-0">
									<small>
										<span class="text-muted">Department: </span><span><?php echo $row['department'] ?></span><br>
										<span class="text-muted">Position: </span><span><?php echo $row['designation'] ?></span>
									</small>
								</p>
							</td>
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-success rounded-pill">Active</span>
                                <?php else: ?>
                                    <span class="badge badge-danger rounded-pill">Inactive</span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="<?php echo base_url."admin?page=employee/view_employee&id=".$row['id'] ?>" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item" href="<?php echo base_url."admin?page=employee/manage_employee&id=".$row['id'] ?>" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this User permanently?","delete_user",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Client Details","clients/view_details.php?id="+$(this).attr('data-id'))
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_user($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Users.php?f=delete",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					branch.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>