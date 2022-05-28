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
  <!--Header-->
  <!-- Left side column. contains the logo and sidebar -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <center>
      <h1>
        <?php echo $judul.' Tahun '.$tahun; ?>
        <small></small>
      </h1>
      <h3>
        <?php echo $hari.', '.$tgl.' '.$bln.' '.$tahun; ?>
      </h3>
      </center>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example2" class="table table-bordered" style="font-size:13px;">
                <thead>
                <tr>
                    <th style="text-align: center;" rowspan="2">No</th>
                    <th style="text-align: center;" rowspan="2">Nama Teknisi</th>
                    <th style="text-align: center;" colspan="4">Akumulasi (Per Kategori)</th>
                    <th style="text-align: center;" rowspan="2">Jabatan Teknisi</th>
                </tr>
                <tr>
                    <th style="text-align: center;">Pengetahuan Umum</th>
                    <th style="text-align: center;">Software</th>
                    <th style="text-align: center;">Hardware</th>
                    <th style="text-align: center;">Kelistrikan</th>
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
                    <td>
                      <?php
                        $get_jabatan = $this->db->get_where('hasil_klasterisasi', ['user_id' => $user_id])->row_array();
                        echo $get_jabatan['jabatan'];
                      ?>
                    </td>
                </tr>
              <?php endforeach;?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->
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
