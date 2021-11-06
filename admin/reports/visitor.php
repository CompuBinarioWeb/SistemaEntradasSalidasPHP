<?php 
$from = isset($_GET['from']) ? $_GET['from'] : date("Y-m-d",strtotime(date('Y-m-d')." -1 week"));
$to = isset($_GET['to']) ? $_GET['to'] : date("Y-m-d");
?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Visitors Logs</h3>
        <div class="card-tools">
			<button type="button" class="btn btn-flat btn-success" id="print"><span class="fas fa-print"></span>  Print</button>
		</div>
	</div>
	<div class="card-body">
		<fieldset>
			<legend class="text-info">Filter Date Range</legend>
			<form action="" id="filter-data">
				<div class="row align-items-end">
					<div class="col-md-4">
						<div class="form-group">
							<label for="date_from" class="control-label text-info">From</label>
							<input type="date" id="from" name="from" class="form-control form-control-sm rounded-0" value="<?php echo $from ?>" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="date_to" class="control-label text-info">To</label>
							<input type="date" id="to" name="to" class="form-control form-control-sm rounded-0" value="<?php echo $to ?>" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<button class="btn btn-flat btn-sm btn-primary"><i class="fa fa-filter"></i> Filter</button>
						</div>
					</div>
				</div>
			</form>
		</fieldset>
		<div id="print_out">
		<style>
			.img-avatar{
				width:45px;
				height:45px;
				object-fit:cover;
				object-position:center center;
				border-radius:100%;
			}
		</style>
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="16%">
                        <col width="22%">
                        <col width="22%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date/Time</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th>Purpose</th>
                            <th>Log Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
						$where= " where date(`date_created`) BETWEEN '{$from}' and '{$to}'";
                        $qry = $conn->query("SELECT * FROM `visitor_logs` {$where}");
                        while($row = $qry->fetch_assoc()):
                            
                        ?>
                            <tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td class="text-right"><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
								<td class="text-center"><?php echo $row['name'] ?></td>
								<td>
									<p class="m-0">
										<small>
											<span class="text-muted">Contact #: </span><span><?php echo $row['contact'] ?></span><br>
											<span class="text-muted">Address: </span><span><?php echo $row['address'] ?></span>
										</small>
									</p>
								</td>
								<td><?php echo $row['purpose'] ?></td>
								<td class="text-center">
									<?php if($row['type'] == 1): ?>
										<span class="badge badge-primary rounded-pill">In</span>
									<?php else: ?>
										<span class="badge badge-danger rounded-pill">Out</span>
									<?php endif; ?>
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
	var dtTable;
	$(document).ready(function(){
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		dtTable = $('.table').dataTable();
		$('#filter-data').submit(function(e){
			e.preventDefault()
			location.href = location.href +"&"+$(this).serialize() 
		})

		$('#print').click(function(){
            start_loader()
			dtTable.fnDestroy();
            var _el = $('<div>')
            var _head = $('head').clone()
                _head.find('title').text("Visitors Logs List - Print View")
            var p = $('#print_out').clone()
            p.find('tr.text-light').removeClass("text-light bg-navy")
            _el.append(_head)
            _el.append('<div class="d-flex justify-content-center">'+
                      '<div class="col-1 text-right">'+
                      '<img src="<?php echo validate_image($_settings->info('logo')) ?>" width="65px" height="65px" />'+
                      '</div>'+
                      '<div class="col-10">'+
                      '<h4 class="text-center"><?php echo $_settings->info('name') ?></h4>'+
                      '<h4 class="text-center">Visitors Logs List</h4>'+
                      '</div>'+
                      '<div class="col-1 text-right">'+
                      '</div>'+
                      '</div><hr/>')
            _el.append(p.html())
            var nw = window.open("","","width=1200,height=900,left=250,location=no,titlebar=yes")
                     nw.document.write(_el.html())
                     nw.document.close()
                     setTimeout(() => {
                         nw.print()
                         setTimeout(() => {
                            nw.close()
                            end_loader()
							dtTable = $('.table').dataTable();
                         }, 200);
                     }, 500);
        })
	})
	
</script>