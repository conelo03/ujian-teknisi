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
                <a class="btn btn-primary btn-flat" href="<?php echo base_url().'Admin/Laporan/laporan_ujian_pdf/'.$ujian_id?>" target="_blank"><span class="fa fa-print"></span> Ekspor PDF</a>
                <!--<a class="btn btn-primary btn-flat" href="<?php echo base_url().'Admin/Klasterisasi/klasterisasi_next/'.$ujian_id?>"><span class="fa fa-print"></span> Ekspor Excel</a>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example2" class="table table-bordered" style="font-size:13px;">
                <thead>
                <tr>
                    <th style="text-align: center;" rowspan="2">No</th>
                    <th style="text-align: center;" rowspan="2">Nama Teknisi</th>
                    <th style="text-align: center;" colspan="4">Skor Soal PG</th>
                    <th style="text-align: center;" colspan="4">Skor Soal Essai</th>
                    <th style="text-align: center;" colspan="4">Skor Ujian Praktek</th>
                    <th style="text-align: center;" colspan="4">Skor Akumulasi</th>
                </tr>
                <tr>
                    <?php for($x=1; $x<=4;$x++): ?>
                      <th style="text-align: center;">PU</th>
                      <th style="text-align: center;">S</th>
                      <th style="text-align: center;">H</th>
                      <th style="text-align: center;">L</th>
                    <?php endfor; ?>
                </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                <?php foreach ($data->result_array() as $i) :?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td>
                    <?php
                    $user_id = $i['user_id'];
                    $get_user = $this->db->get_where('tb_user', ['user_id' => $user_id])->row_array();
                    echo $get_user['user_nama'];
                    ?>
                  </td>
                  <!--Nilai PG-->
                  <?php 
                  $get_akumulasi_pg = $this->db->select('*, sum(nilai_pg_skor) as skor_pg')
                                            ->join('tb_soal_pg', 'tb_soal_pg.soal_pg_id=tb_nilai_pg.soal_pg_id')
                                            ->join('tb_kategori_soal', 'tb_soal_pg.kategori_id=tb_kategori_soal.kategori_id')
                                            ->where('user_id' , $user_id)
                                            ->where('ujian_id' , $i['ujian_id'])
                                            ->order_by('tb_kategori_soal.kategori_id','ASC')
                                            ->group_by('tb_kategori_soal.kategori_id')
                                            ->get('tb_nilai_pg')->result_array();
                  
                  if(!empty($get_akumulasi_pg)){
                  foreach ($get_akumulasi_pg as $a):
                  ?>
                    <td style="text-align: center"><?php echo $a['skor_pg'];?></td>
                  <?php endforeach;
                  } else { ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  <?php } ?>
                  <!--Nilai Essai-->
                  <?php 
                  $get_akumulasi_essai = $this->db->select('*, sum(nilai_essai_skor) as skor_essai')
                                            ->join('tb_soal_essai', 'tb_soal_essai.soal_essai_id=tb_nilai_essai.soal_essai_id')
                                            ->join('tb_kategori_soal', 'tb_soal_essai.kategori_id=tb_kategori_soal.kategori_id')
                                            ->where('user_id' , $user_id)
                                            ->where('ujian_id' , $i['ujian_id'])
                                            ->order_by('tb_kategori_soal.kategori_id','ASC')
                                            ->group_by('tb_kategori_soal.kategori_id')
                                            ->get('tb_nilai_essai')->result_array();
                  if(!empty($get_akumulasi_essai)){
                  foreach ($get_akumulasi_essai as $a):
                  ?>
                    <td style="text-align: center"><?php echo $a['skor_essai'];?></td>
                  <?php endforeach;
                  } else { ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  <?php } ?>
                  <!--Ujian Praktek-->
                  <?php 
                  $get_materi_uprak = $this->db->select('*, sum(nilai_uprak_skor) as skor_uprak')
                                            ->join('tb_materi_uprak', 'tb_materi_uprak.uprak_id=tb_nilai_uprak.uprak_id')
                                            ->join('tb_kategori_soal', 'tb_materi_uprak.kategori_id=tb_kategori_soal.kategori_id')
                                            ->where('tb_nilai_uprak.user_id' , $user_id)
                                            ->where('tb_nilai_uprak.ujian_id' , $i['ujian_id'])
                                            ->order_by('tb_kategori_soal.kategori_id','ASC')
                                            ->group_by('tb_kategori_soal.kategori_id')
                                            ->get('tb_nilai_uprak')->result_array();
                  
                  if(!empty($get_materi_uprak)){
                  foreach ($get_materi_uprak as $a):
                  ?>
                    <td style="text-align: center"><?php echo $a['skor_uprak'];?></td>
                  <?php endforeach;
                  } else { ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  <?php } ?>
                  <?php 
                  $get_akumulasi = $this->db->select('*, sum(akumulasi_skor) as skor')
                                            ->where('user_id' , $user_id)
                                            ->where('ujian_id' , $i['ujian_id'])
                                            ->order_by('kategori_id','ASC')
                                            ->group_by('kategori_id')
                                            ->get('tb_akumulasi')->result_array();
                  
                  if(!empty($get_akumulasi)){
                  foreach ($get_akumulasi as $a):
                  ?>
                    <td style="text-align: center"><?php echo $a['skor'];?></td>
                  <?php endforeach;
                  } else { ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  <?php } ?>
                </tr>
        <?php endforeach;?>
                </tbody>
              </table>
            </div>
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
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!--Modal Add Pengguna-->
      


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
    "lengthChange": true,
    "searching": true,
    "ordering": false,
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
