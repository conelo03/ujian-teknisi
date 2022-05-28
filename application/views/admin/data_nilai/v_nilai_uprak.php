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
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped" style="font-size:13px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Teknisi</th>
                    <th>Kategori Soal</th>
                    <th>Skor</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                <?php foreach ($data->result_array() as $i) :
                      $akumulasi_id=$i['akumulasi_id'];
                      $user_nama=$i['user_nama'];
                      $user_id=$i['user_id'];
                      $kategori_soal=$i['kategori_soal'];
                      $kategori_id=$i['kategori_id'];
                      $akumulasi_skor=$i['akumulasi_skor'];
                ?>
                <tr>
                  <td style="width:40px;"><?php echo $no++;?></td>
                  <td><?php echo $user_nama;?></td>
                  <td style="width:150px;"><?php echo $kategori_soal;?></td>
                  <td><?php echo $akumulasi_skor;?></td>
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

    <section class="content-header">
      <h1>
        Data Nilai Ujian Praktek
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <div class="box-header">
                <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#myModal"><span class="fa fa-user-plus"></span> Tambah Nilai Uprak</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-striped" style="font-size:13px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Teknisi</th>
                    <th>Kategori Soal</th>
                    <th>Materi Ujian Praktek</th>
                    <th>Bobot</th>
                    <th>Nilai</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                <?php foreach ($jawaban->result_array() as $i) :
                      $nilai_uprak_id=$i['nilai_uprak_id'];
                      $uprak_id=$i['uprak_id'];
                      $user_id=$i['user_id'];
                      $user_nama=$i['user_nama'];
                      $kategori_id=$i['kategori_id'];
                      $kategori_soal=$i['kategori_soal'];
                      $uprak_materi=$i['uprak_materi'];
                      $nilai_uprak_skor=$i['nilai_uprak_skor'];
                ?>
                <tr>
                  <td style="width:40px;"><?php echo $no++;?></td>
                  <td><?php echo $user_nama;?></td>
                  <td><?php echo $kategori_soal;?></td>
                  <td><?php echo $uprak_materi;?></td>
                  <td><?php echo $i['uprak_bobot'];?></td>
                  <td><?php echo $nilai_uprak_skor;?></td>
                  <td style="width:123px;text-align:center;">
                    <a class="btn" href="<?php echo base_url().'Admin/Data_nilai/input_nilai_uprak_per_sk/'.$user_id.'/'.$ujian_id.'/'.$uprak_id?>"><span class="fa fa-pencil"></span></a>
                    <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $nilai_uprak_id;?>"><span class="fa fa-trash"></span></a>
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

<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                      <h4 class="modal-title" id="myModalLabel">Input Skor</h4>
                  </div>
                  <form class="form-horizontal" action="<?php echo base_url().'Admin/Data_nilai/input_skor_uprak'?>" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Nama Teknisi</label>
                        <div class="col-sm-7">
                          <input type="hidden" name="id_ujian" class="form-control" id="inputUsername" value="<?= $ujian_id?>" />
                          <input type="hidden" name="id_user" class="form-control" id="inputUsername" value="<?= $user_id?>" />
                          <input type="text" name="nama" class="form-control" id="inputUsername" value="<?= $user_nama?>" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Materi Ujian Praktek</label>
                        <div class="col-sm-7">
                          <select class="form-control" name="uprak">
                            <?php foreach ($uprak->result_array() as $u) :?>
                            <option value="<?= $u['uprak_id'].'.'.$u['kategori_id']; ?>"><?= $u['uprak_materi']; ?></option>
                            <?php endforeach;?>
                          </select>
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

<?php foreach ($jawaban->result_array() as $i) :
      $nilai_uprak_id=$i['nilai_uprak_id'];
      $uprak_id=$i['uprak_id'];
      $user_id=$i['user_id'];
      $user_nama=$i['user_nama'];
      $kategori_id=$i['kategori_id'];
      $kategori_soal=$i['kategori_soal'];
      $uprak_materi=$i['uprak_materi'];
      $uprak_bobot=$i['uprak_bobot'];
      $nilai_uprak_skor=$i['nilai_uprak_skor'];
?>
<!--Modal Edit Pengguna-->
      <div class="modal fade" id="ModalEdit<?php echo $nilai_uprak_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                      <h4 class="modal-title" id="myModalLabel">Edit Skor</h4>
                  </div>
                  <form class="form-horizontal" action="<?php echo base_url().'Admin/Data_nilai/edit_skor_uprak'?>" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Nama Teknisi</label>
                        <div class="col-sm-7">
                          <input type="hidden" name="id_nilai" class="form-control" id="inputUsername" value="<?= $nilai_uprak_id?>" />
                          <input type="hidden" name="id_ujian" class="form-control" id="inputUsername" value="<?= $ujian_id?>" />
                          <input type="hidden" name="id_user" class="form-control" id="inputUsername" value="<?= $user_id?>" />
                          <input type="hidden" name="id_kategori" class="form-control" id="inputUsername" value="<?= $kategori_id?>" />
                          <input type="text" name="nama" class="form-control" id="inputUsername" value="<?= $user_nama?>" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Materi Ujian Praktek</label>
                        <div class="col-sm-7">
                          <select class="form-control" name="materi">
                            <option value="<?= $uprak_id; ?>"><?= $uprak_materi; ?></option>
                            <?php foreach ($uprak->result_array() as $u) :?>
                            <option value="<?= $u['uprak_id']; ?>"><?= $u['uprak_materi']; ?></option>
                            <?php endforeach;?>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Bobot Ujian</label>
                        <div class="col-sm-7">
                          <input type="number" name="" class="form-control" id="inputUsername" value="<?= $uprak_bobot;?>" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Skor</label>
                        <div class="col-sm-7">
                          <input type="number" name="skor" class="form-control" id="inputUsername" value="<?= $nilai_uprak_skor;?>"/>
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

<?php foreach ($jawaban->result_array() as $i) :
      $nilai_uprak_id=$i['nilai_uprak_id'];
      $uprak_id=$i['uprak_id'];
      $user_id=$i['user_id'];
      $user_nama=$i['user_nama'];
      $kategori_id=$i['kategori_id'];
      $kategori_soal=$i['kategori_soal'];
      $uprak_materi=$i['uprak_materi'];
      $nilai_uprak_skor=$i['nilai_uprak_skor'];
?>
<!--Modal Edit Pengguna-->
      <div class="modal fade" id="ModalHapus<?php echo $nilai_uprak_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                      <h4 class="modal-title" id="myModalLabel">Hapus Skor</h4>
                  </div>
                  <form class="form-horizontal" action="<?php echo base_url().'Admin/Data_nilai/hapus_skor_uprak'?>" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <input type="hidden" name="id_nilai" class="form-control" id="inputUsername" value="<?= $nilai_uprak_id?>" />
                    <input type="hidden" name="id_ujian" class="form-control" id="inputUsername" value="<?= $ujian_id?>" />
                    <input type="hidden" name="id_user" class="form-control" id="inputUsername" value="<?= $user_id?>" />
                    <input type="hidden" name="id_kategori" class="form-control" id="inputUsername" value="<?= $kategori_id?>" />
                    <input type="hidden" name="skor" class="form-control" id="inputUsername" value="<?= $nilai_uprak_skor?>" />
                    <p>Apakah Anda yakin mau menghapus skor Ujian Praktek dari <b><?php echo $user_nama;?></b> ?</p>
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
    "lengthChange": true,
    "searching": true,
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
                    text: "Skor Gagal disimpan.",
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
                    text: "Nilai Berhasil disimpan ke database.",
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
                    text: "Skor berhasil di update",
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
                    text: "Skor Berhasil dihapus.",
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