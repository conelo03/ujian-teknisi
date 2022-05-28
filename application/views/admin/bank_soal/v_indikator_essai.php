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
  <!-- SOAL PG -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- /.content -->

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
              <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Tambah Indikator Nilai Essai</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped" style="font-size:13px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Poin</th>
                    <th>Indikator</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                <?php foreach ($data->result_array() as $i) :
                      $soal_essai_id=$i['soal_essai_id'];
                      $skor=$i['skor'];
                      $indikator=$i['indikator'];
                      $indikator_nilai_essai_id=$i['indikator_nilai_essai_id'];
                ?>
                <tr>
                  <td style="width:40px;"><?php echo $no++;?></td>
                  <td style="width:150px;"><?php echo $skor;?></td>
                  <td><?php echo $indikator;?></td>
                  <td style="text-align:center;width:150px;">
                    <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $indikator_nilai_essai_id;?>"><span class="fa fa-pencil"></span></a>
                    <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $indikator_nilai_essai_id;?>"><span class="fa fa-trash"></span></a>
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

<?php
  $this->load->view('admin/v_footer');
?>
</div>
<!-- ./wrapper -->

<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!--Modal Add Soal PG-->

<!--Modal Add Soal Essai-->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                      <h4 class="modal-title" id="myModalLabel">Tambah Indikator Nilai Essai</h4>
                  </div>
                  <form class="form-horizontal" action="<?php echo base_url().'Admin/Bank_soal/tambah_indikator_soal_essai'?>" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Bobot</label>
                        <div class="col-sm-7">
                          <input type="hidden" id="inputUserName" name="soal_essai_id" class="form-control" value="<?= $soal['soal_essai_id']?>" required>
                          <input type="text" id="inputUserName" name="" class="form-control" value="<?= $soal['soal_essai_bobot']?>"  readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Jawaban</label>
                        <div class="col-sm-7">
                          <textarea type="text" name="" class="form-control" id="inputUsername" readonly><?= $soal['soal_essai_jawaban']?></textarea>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Skor / Rentan Skor</label>
                        <div class="col-sm-7">
                          <input type="text" id="inputUserName" name="skor" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Indikator</label>
                        <div class="col-sm-7">
                          <textarea type="text" name="indikator" class="form-control" id="inputUsername" required></textarea>
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
                      $soal_essai_id=$i['soal_essai_id'];
                      $skor=$i['skor'];
                      $indikator=$i['indikator'];
                      $indikator_nilai_essai_id=$i['indikator_nilai_essai_id'];
                ?>
<!--Modal Edit Pengguna-->
      <div class="modal fade" id="ModalEdit<?php echo $indikator_nilai_essai_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                      <h4 class="modal-title" id="myModalLabel">Edit Indikator Nilai Essai</h4>
                  </div>
                  <form class="form-horizontal" action="<?php echo base_url().'Admin/Bank_soal/update_indikator_soal_essai'?>" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Bobot</label>
                        <div class="col-sm-7">
                          <input type="hidden" id="inputUserName" name="soal_essai_id" class="form-control" value="<?= $soal['soal_essai_id']?>" required>
                          <input type="text" id="inputUserName" name="" class="form-control" value="<?= $soal['soal_essai_bobot']?>"  readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Jawaban</label>
                        <div class="col-sm-7">
                          <textarea type="text" name="" class="form-control" id="inputUsername" readonly><?= $soal['soal_essai_jawaban']?></textarea>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Skor / Rentan Skor</label>
                        <div class="col-sm-7">
                          <input type="hidden" id="inputUserName" name="indikator_nilai_essai_id" class="form-control" value="<?= $indikator_nilai_essai_id?>" required>
                          <input type="text" id="inputUserName" name="skor" class="form-control" value="<?= $skor?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Indikator</label>
                        <div class="col-sm-7">
                          <textarea type="text" name="indikator" class="form-control" id="inputUsername"><?= $indikator?></textarea>
                        </div>
                    </div>
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
      $soal_essai_id=$i['soal_essai_id'];
                      $skor=$i['skor'];
                      $indikator=$i['indikator'];
                      $indikator_nilai_essai_id=$i['indikator_nilai_essai_id'];
?>
<!--Modal Hapus Pengguna-->
      <div class="modal fade" id="ModalHapus<?php echo $indikator_nilai_essai_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                      <h4 class="modal-title" id="myModalLabel">Hapus Soal Essai</h4>
                  </div>
                  <form class="form-horizontal" action="<?php echo base_url().'Admin/Bank_soal/hapus_indikator_soal_essai'?>" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <input type="hidden" id="inputUserName" name="soal_essai_id" class="form-control" value="<?= $soal['soal_essai_id']?>" required>
                          <input type="hidden" name="indikator_nilai_essai_id" value="<?php echo $indikator_nilai_essai_id;?>"/>
                          <p>Apakah Anda yakin mau menghapus indikator ini ?</p>
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
<script>
$(function () {
  $("#example1").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": true
  });
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            autoclose:true
        });
    });
</script>
<?php if($this->session->flashdata('msg')=='error'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Indikator Gagal disimpan.",
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
                    text: "Indikator Berhasil disimpan ke database.",
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
                    text: "Indikator berhasil di update",
                    showHideTransition: 'slide',
                    icon: 'info',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#00C9E6'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='error-import'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Soal Essai Gagal diimport.",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#FF4859'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='success-import'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Soal Essai Berhasil diimport ke database.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='success-hapus'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Indikator Berhasil dihapus.",
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