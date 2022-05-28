<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ujian Teknisi - PT. Matahari Teknologi Jaya</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/iCheck/square/blue.css'?>">
  <style type="">
            body {
                background: linear-gradient(180deg,#2b87da 0%,#29c4a9 100%);
                width: 100%;
                height: 100%;
                
            }
        </style>

</head>
<body class="">
<div class="login-box">
  <div>
    <?php echo $this->session->flashdata('msg');  ?>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <center><p class="login-box-msg"> <img width="150px;" src="<?php echo base_url().'assets/theme/images/logo-dark.png'?>"><br/><h2>Computer Assisted Test</h2><h4>PT. Matahari Teknologi Jaya</h4></p></center><hr/>

   <form action="<?php echo base_url().'Login/cek'; ?>" method="post">
     <div class="form-group has-feedback">
       <input type="text" name="username" class="form-control" placeholder="Username" required>
       <span class="glyphicon glyphicon-user form-control-feedback"></span>
     </div>
     <div class="form-group has-feedback">
       <input type="password" name="password" class="form-control" placeholder="Password" required>
       <span class="glyphicon glyphicon-lock form-control-feedback"></span>
     </div>
     <div class="row">
       <div class="col-xs-4">
         <div class="checkbox icheck">
         </div>
       </div>
       <!-- /.col -->
       <div class="col-xs-4">
         <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
       </div>
       <!-- /.col -->
     </div>
   </form>


    <!-- /.social-auth-links -->
    <hr/>
    <p><center>Copyright @2020 by Ramadhan <br/> All Right Reserved</center></p>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url().'assets/plugins/iCheck/icheck.min.js'?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
