<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="hold-transition login-page  dark-mode">
  <style>
    body{
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size:cover;
      background-repeat:no-repeat;
      
    }
    .login-title{
        text-shadow: 2px 2px black;
        backdrop-filter: invert(.3);
    }
  </style>
  <h1 class="text-center py-2 px-2 rounded my-5 login-title"><b><?php echo $_settings->info('name') ?></b></h1>
<div class="w-100">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="panel-tab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-employees-tab" data-toggle="pill" href="#custom-tabs-one-employees" role="tab" aria-controls="custom-tabs-one-employees" aria-selected="true">EMPLEADOS</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-visitors-tab" data-toggle="pill" href="#custom-tabs-one-visitors" role="tab" aria-controls="custom-tabs-one-visitors" aria-selected="false">VISITANTES</a>
                </li>
                
                
            </ul>
            </div>
            <div class="card-body">
            <div class="tab-content" id="panel-tab-Content">
                <div class="tab-pane fade active show" id="custom-tabs-one-employees" role="tabpanel" aria-labelledby="custom-tabs-one-employees-tab">
                   <div class="container-fluid py-5">
                       <form action="" id="employee-log-form">
                           <input type="hidden" name="type">
                           <div class="col-12">
                               <div class="row justify-content-center">
                                   <div class="col-md-8">
                                       <div class="form-group text-center">
                                           <label for="employee_code">INGRESE SUS CODIGO DE EMPLEADO:</label>
                                           <input type="text" id="employee_code" name="employee_code" class="form-control form-control-lg rounded-0" autofocus autocomplete="off">
                                       </div>
                                       <div class="form-group text-center">
                                           <button class="btn btn-lg rounded-pill btn-primary elog px-4 col-4" type="button" data-type='1' >ENTRADA</button>
                                           <button class="btn btn-lg rounded-pill btn-danger elog px-4 col-4" type="button" data-type='2' >SALIDA</button>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </form>
                   </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-visitors" role="tabpanel" aria-labelledby="custom-tabs-one-visitors-tab">
                <div class="container-fluid py-5">
                       <form action="" id="visitor-log-form">
                           <input type="hidden" name="type">
                           <div class="col-12">
                               <div class="row justify-content-center">
                                   <div class="col-md-8">
                                       <div class="form-group text-center">
                                           <label for="name">Name</label>
                                           <input type="text" id="name" name="name" class="form-control form-control-lg rounded-0" autocomplete="off">
                                       </div>
                                       <div class="form-group text-center">
                                           <label for="contact">Contact #</label>
                                           <input type="text" id="contact" name="contact" class="form-control form-control-lg rounded-0" autocomplete="off">
                                       </div>
                                       <div class="form-group text-center">
                                           <label for="address">Address</label>
                                           <textarea rows="2" id="address" name="address" class="form-control form-control-lg rounded-0" autocomplete="off"></textarea>
                                       </div>
                                       <div class="form-group text-center">
                                           <label for="purpose">Purpose</label>
                                           <textarea rows="2" id="purpose" name="purpose" class="form-control form-control-lg rounded-0" autocomplete="off"></textarea>
                                       </div>
                                       <div class="form-group text-center">
                                           <button class="btn btn-lg rounded-pill btn-primary elog px-4 col-4" type="button" data-type='1' >In</button>
                                           <button class="btn btn-lg rounded-pill btn-danger elog px-4 col-4" type="button" data-type='2' >Out</button>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </form>
                   </div>
                </div>
                
                
            </div>
            </div>
            <!-- /.card -->
        </div>
        </div>
    </div>
</div>

<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
    function alert_swal($title="",$message= "",$type="success",$timer = 3500){
        Swal.fire({
            icon:$type,
            title: $title,
            text: $message,
            timer: $timer
        }).then((result)=>{
            setTimeout(() => {
                if(result.isConfirmed === true || result.isDismissed === true){
                if($('form#employee-log-form #employee_code').is(":visible") === true)
                $('form#employee-log-form #employee_code').show().trigger('focus');
                if($('form#visitor-log-form #name').is(":visible") === true)
                $('form#visitor-log-form #name').show().trigger('focus');
                }
            }, 650);
            })
    }
  $(document).ready(function(){
      $('#panel-tab .nav-link').click(function(){
          setTimeout(() => {
          if($('#employee_code').is(':visible') == true)
          $('#employee_code').focus()
          if($('#name').is(':visible') == true)
          $('#name').focus()
        }, 650);

      })
    $('form#employee-log-form #employee_code').on('keypress',function(e){
        if(e.which == 13)
        e.preventDefault()
    })
    $('.elog').click(function(){
        if($('#employee_code').is(':visible') == true){
            $('form#employee-log-form [name="type"]').val($(this).attr('data-type'))
            $('form#employee-log-form').submit()
        }
        if($('#name').is(':visible') == true){
            $('form#visitor-log-form [name="type"]').val($(this).attr('data-type'))
            $('form#visitor-log-form').submit()
        }
    })
    $('form#employee-log-form').submit(function(e){
        e.preventDefault();
        start_loader();
        $.ajax({
            url:_base_url_+'classes/Master.php?f=log_employee',
            method:'POST',
            data:$(this).serialize(),
            dataType:'json',
            error:err=>{
                console.log(err)
                alert_toast("An error occured","error")
                end_loader();
            },
            success:function(resp){
                if(resp.status == 'success'){
                    alert_swal(resp.title,resp.msg,'success')
                    $('form#employee-log-form').get(0).reset()
                }else{
                    alert_swal(resp.title,resp.msg,'error',0)
                }
                end_loader();
            }
        })
    })
    $('form#visitor-log-form').submit(function(e){
        e.preventDefault();
        start_loader();
        $.ajax({
            url:_base_url_+'classes/Master.php?f=log_visitor',
            method:'POST',
            data:$(this).serialize(),
            dataType:'json',
            error:err=>{
                console.log(err)
                alert_toast("An error occured","error")
                end_loader();
            },
            success:function(resp){
                if(resp.status == 'success'){
                    alert_swal(resp.title,resp.msg,'success')
                    $('form#visitor-log-form').get(0).reset()
                }else{
                    alert_swal(resp.title,resp.msg,'error',0)
                }
                end_loader();
            }
        })
    })
  })
  
</script>
</body>
</html>