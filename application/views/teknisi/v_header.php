<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $judul; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=0.9, minimum-scale=0.1, maximum-scale=10, user-scalable=yes' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url(); ?>public/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>public/plugins/adminlte/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>public/plugins/adminlte/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>public/plugins/pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?php echo base_url(); ?>public/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>public/plugins/adminlte/js/app.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>public/app.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>public/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/dataTables.reload.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>public/plugins/pnotify/pnotify.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/app.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>
    
    <!-- membuat gambar responsive pada soal -->
    <style type="text/css">
      #isi-tes-soal img {
        display: block;
        max-width: 100%;
        height: auto;
      }
      
        .pagination_wrap ul li a.active {
          border-color: #00D363;
          color: #00D363;
        }
    </style>

    <script type="text/javascript">
    function notify_success(pesan){
      new PNotify({
        title: 'Berhasil',
        text: pesan,
        type: 'success',
        history: false,
        delay:2000
      });
    }
        
    function notify_info(pesan){
      new PNotify({
        title: 'Informasi',
        text: pesan,
        type: 'info',
        history: false,
        delay:2000
      });
    }
    
    function notify_error(pesan){
      new PNotify({
        title: 'Error',
        text: pesan,
        type: 'error',
        history: false,
        delay:2000
      });
    } 
  </script>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue-light layout-top-nav">
    <div class="wrapper">

      <header class="main-header">               
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="<?php echo base_url().'Teknisi/Dashboard/'; ?>" class="navbar-brand"> <b>Ujian Teknisi PT. Matahari Teknologi Jaya</b></a>
            </div>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <ul class="nav navbar-nav">
                    <li><a href="#"><span id="timestamp"></span></a></li>
                  </ul>
                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="<?php echo base_url(); ?>public/images/avatar.png" class="user-image" alt="User Image" />
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs"><?php if(!empty($nama_peserta)){ echo $nama_peserta; }else{ echo 'User Tes'; } ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                      <li class="user-header" style="max-height: 70px;">
                        <p>
                          <?php if(!empty($nama_peserta)){ echo $nama_peserta; }else{ echo 'User Tes'; } ?>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a data-toggle="modal" href="#modal-password" class="btn btn-default btn-flat">Password</a>
                        </div>
                        <div class="pull-right">
                          <a href="<?php echo base_url(); ?>Login/logout" class="btn btn-default btn-flat">Log out</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
  <script type="text/javascript">
    $(function () {
        var serverTime = <?php if(!empty($timestamp)){ echo $timestamp; } ?>;
        var counterTime=0;
        var date;

        setInterval(function() {
          date = new Date();

          serverTime = serverTime+1;

          date.setTime(serverTime*1000);
          time = date.toLocaleTimeString();
          $("#timestamp").html(time);
        }, 1000);
    });
  </script>