<?php
$id=$this->session->userdata('id');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $judul; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/daterangepicker/daterangepicker.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/daterangepicker/daterangepicker.css'?>">
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.css'?>">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datepicker/datepicker3.css'?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!--Header-->
  <?php
    $this->load->view('admin/v_header');
    $this->load->view('admin/v_sidebar', $judul);
  ?>
  <!-- Left side column. contains the logo and sidebar -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $judul; ?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $judul; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#myModal"><span class="fa fa-user-plus"></span> Tambah Ujian</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped" style="font-size:13px;">
                <thead>
                <tr>
                    <th>No</th>
					          <th>Nama Ujian</th>
                    <th>Tanggal</th>
                    <th>Waktu Ujian</th>
                    <th>Status</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
				        <?php foreach ($data->result_array() as $i) :
                      $ujian_id=$i['ujian_id'];
                      $ujian_nama=$i['ujian_nama'];
                      $ujian_tanggal=$i['ujian_tanggal'];
                      $ujian_waktu=$i['ujian_waktu'];
                      $ujian_essai_waktu=$i['ujian_essai_waktu'];
                      $ujian_status=$i['ujian_status'];
                      $tanggal=date('d  F  Y', strtotime($ujian_tanggal));
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $ujian_nama;?></td>
                  <td><?php echo $tanggal;?></td>
                  <td><?php echo "Pilihan Ganda = ".$ujian_waktu." Menit <br/> Essai = ".$ujian_essai_waktu." Menit";?></td>
                  <td>
                    <?php if($ujian_status == '1'){
                      echo 'Aktif';
                    } else {
                      echo 'TIdak Aktif';
                    }
                    ?>
                  
                  </td>
                  <td style="text-align:right;">
                        <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $ujian_id;?>"><span class="fa fa-pencil"></span></a>
                        <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $ujian_id;?>"><span class="fa fa-trash"></span></a>
                  </td>
                </tr>
				<?php endforeach;?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
  $this->load->view('admin/v_footer');
?>
</div>
<!-- ./wrapper -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Create the tabs -->
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Home tab content -->
    <div class="tab-pane" id="control-sidebar-home-tab">
      <h3 class="control-sidebar-heading">Recent Activity</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

              <p>Will be 23 on April 24th</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-user bg-yellow"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

              <p>New phone +1(800)555-1234</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

              <p>nora@example.com</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-file-code-o bg-green"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

              <p>Execution time 5 seconds</p>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->

      <h3 class="control-sidebar-heading">Tasks Progress</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Custom Template Design
              <span class="label label-danger pull-right">70%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Update Resume
              <span class="label label-success pull-right">95%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-success" style="width: 95%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Laravel Integration
              <span class="label label-warning pull-right">50%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Back End Framework
              <span class="label label-primary pull-right">68%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->

    </div>
    <!-- /.tab-pane -->
    <!-- Stats tab content -->
    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
    <!-- /.tab-pane -->
    <!-- Settings tab content -->
    <div class="tab-pane" id="control-sidebar-settings-tab">
      <form method="post">
        <h3 class="control-sidebar-heading">General Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Report panel usage
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Some information about this general settings option
          </p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Allow mail redirect
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Other sets of options are available
          </p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Expose author name in posts
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Allow the user to show his name in blog posts
          </p>
        </div>
        <!-- /.form-group -->

        <h3 class="control-sidebar-heading">Chat Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Show me as online
            <input type="checkbox" class="pull-right" checked>
          </label>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Turn off notifications
            <input type="checkbox" class="pull-right">
          </label>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Delete chat history
            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
          </label>
        </div>
        <!-- /.form-group -->
      </form>
    </div>
    <!-- /.tab-pane -->
  </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!--Modal Add Pengguna-->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                      <h4 class="modal-title" id="myModalLabel">Tambah Ujian</h4>
                  </div>
                  <form class="form-horizontal" action="<?php echo base_url().'Admin/Data_ujian/tambah_ujian'?>" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Nama Ujian</label>
                        <div class="col-sm-7">
                          <input type="hidden" name="status" class="form-control" id="inputUserName" value="0" required>
                            <input type="text" name="nama" class="form-control" id="inputUserName" placeholder="Nama Ujian" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Tanggal</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control datepicker" id="datepicker" name="tanggal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-4 control-label">Waktu Ujian (menit)</label>
                        <div class="col-sm-7">
                            <input type="number" name="waktu" class="form-control" id="" placeholder="Waktu Ujian (menit)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Waktu Ujian Essai(menit)</label>
                        <div class="col-sm-7">
                            <input type="text" name="waktu_essai" class="form-control" id="inputUsername" placeholder="Waktu Ujian Essai (menit)" required>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                  </div>
                  </form>
              </div>
          </div>
      </div>


          <?php foreach ($data->result_array() as $i) :
              $ujian_id=$i['ujian_id'];
              $ujian_nama=$i['ujian_nama'];
              $ujian_tanggal=$i['ujian_tanggal'];
              $ujian_waktu=$i['ujian_waktu'];
              $ujian_essai_waktu=$i['ujian_essai_waktu'];
              $ujian_status=$i['ujian_status'];
              $tanggal=date('d-m-Y', strtotime($ujian_tanggal));
          ?>
<!--Modal Edit Pengguna-->
      <div class="modal fade" id="ModalEdit<?php echo $ujian_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                      <h4 class="modal-title" id="myModalLabel">Edit Ujian</h4>
                  </div>
                  <form class="form-horizontal" action="<?php echo base_url().'Admin/Data_ujian/update_ujian'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Nama Ujian</label>
                        <div class="col-sm-7">
                            <input type="text" name="nama" class="form-control" id="inputUserName" value="<?php echo $ujian_nama; ?>">
                            <input type="hidden" name="id_ujian" class="form-control" id="inputUserName" value="<?php echo $ujian_id; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Tanggal</label>
                        <div class="col-sm-7">
                            <input type="text" name="tanggal" class="form-control datepicker" id="datepicker" value="<?php echo $tanggal;?>" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Waktu Ujian (menit)</label>
                        <div class="col-sm-7">
                            <input type="text" name="waktu" class="form-control" id="inputUsername" value="<?php echo $ujian_waktu;?>" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Waktu Ujian Essai(menit)</label>
                        <div class="col-sm-7">
                            <input type="text" name="waktu_essai" class="form-control" id="inputUsername" value="<?php echo $ujian_essai_waktu;?>" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                          <div class="col-sm-7">
                            <?php if($ujian_status=='1'){?>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="1" name="status" checked>
                                <label for="inlineRadio1"> Aktif </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="0" name="status">
                                <label for="inlineRadio2"> Tidak Aktif </label>
                            </div>
                            <?php } else {?>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="1" name="status" >
                                <label for="inlineRadio1"> Aktif </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="0" name="status" checked>
                                <label for="inlineRadio2"> Tidak Aktif </label>
                            </div>
                          <?php } ?>
                          </div>
                      </div>
                      <p>Catatan: Setelah anda mengaktifkan ujian ini, diharapkan untuk tidak mengubah status soal pada menu <b>Bank Soal</b> sampai semua peserta ujian telah melaksanakan ujian.</p> 
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary btn-flat" id="simpan">Update</button>
                  </div>
                  </form>
              </div>
          </div>
      </div>
<?php endforeach;?>

          <?php foreach ($data->result_array() as $i) :
              $ujian_id=$i['ujian_id'];
              $ujian_nama=$i['ujian_nama'];
              $ujian_tanggal=$i['ujian_tanggal'];
              $ujian_waktu=$i['ujian_waktu'];
              $ujian_status=$i['ujian_status'];
              $tanggal=date('d  F  Y', strtotime($ujian_tanggal));
          ?>
<!--Modal Hapus Pengguna-->
      <div class="modal fade" id="ModalHapus<?php echo $ujian_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                      <h4 class="modal-title" id="myModalLabel">Hapus Ujian</h4>
                  </div>
                  <form class="form-horizontal" action="<?php echo base_url().'Admin/Data_ujian/hapus_ujian'?>" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                          <input type="hidden" name="id_ujian" value="<?php echo $ujian_id;?>"/>
                          <p>Apakah Anda yakin mau menghapus Ujian tanggal <b><?php echo $tanggal;?></b> ?</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
                  </div>
                  </form>
              </div>
          </div>
      </div>
<?php endforeach;?>


<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/datepicker/bootstrap-datepicker.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/daterangepicker/daterangepicker.js'?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>
<!-- page script -->
<script type="text/javascript">
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: "dd-mm-yyyy",
                autoclose:true
            });
        });
    </script>
<script>
$(function () {
  $("#example1").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false
  });
});
</script>
<?php if($this->session->flashdata('msg')=='error'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Data Ujian Gagal disimpan.",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#FF4859'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='warning'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Warning',
                    text: "Gambar yang Anda masukan terlalu besar.",
                    showHideTransition: 'slide',
                    icon: 'warning',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#FFC017'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='username-ganda'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Warning',
                    text: "Username sudah ada.",
                    showHideTransition: 'slide',
                    icon: 'warning',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#FFC017'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='success'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Data Ujian Berhasil disimpan ke database.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='info'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Info',
                    text: "Data Ujian berhasil di update",
                    showHideTransition: 'slide',
                    icon: 'info',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#00C9E6'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='success-hapus'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Data Ujian Berhasil dihapus.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='show-modal'):?>
        <script type="text/javascript">
                $('#ModalResetPassword').modal('show');
        </script>
    <?php else:?>

    <?php endif; ?>
</body>
</html>
