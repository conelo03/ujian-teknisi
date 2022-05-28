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
        Data Klasterisasi per Ujian
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
              <h4>
                Data Akumulasi Nilai Ujian
                <small></small>
              </h4>
              <a class="btn btn-success btn-flat" href="<?php echo base_url().'Admin/Klasterisasi/data_klasterisasi/'.$ujian_id?>"><span class="fa fa-refresh"></span> Mulai Awal</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="" class="table table-striped table-bordered table-hover" style="font-size:13px;">
                <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama Peserta</th>
                    <th colspan="4" style="text-align: center">Akumulasi Nilai Ujian</th>
                </tr>
                <tr>
                  <?php 
                  $get_kategori=$this->db->order_by('kategori_id','ASC')->get('tb_kategori_soal'); 
                  foreach ($get_kategori->result_array() as $k):?>
                    <th style="text-align: center"><?php echo $k['kategori_soal']?></th>
                  <?php endforeach;
                  ?>
                </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
				        <?php foreach ($data->result_array() as $i) :
                      $h_ujian_id=$i['h_ujian_id'];
                      $ujian_id=$i['ujian_id'];
                      $user_id=$i['user_id'];
                      $user_nama=$i['user_nama'];
                      $ujian_nama=$i['ujian_nama'];
                      $ujian_tanggal=$i['ujian_tanggal'];
                      $ujian_waktu=$i['ujian_waktu'];
                      $h_ujian_status=$i['h_ujian_status'];
                      $tanggal=date('d  F  Y', strtotime($ujian_tanggal));
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $user_nama;?></td>
                  <?php 
                  $get_akumulasi = $this->db->select('*, sum(akumulasi_skor) as skor')
                                            ->where('user_id' , $user_id)
                                            ->where('ujian_id' , $ujian_id)
                                            ->order_by('kategori_id','ASC')
                                            ->group_by('kategori_id')
                                            ->get('tb_akumulasi')->result_array();

                  foreach ($get_akumulasi as $a) :?>
                    <td style="text-align: center"><?php echo $a['skor'];?></td>
                  <?php endforeach;
                  ?>
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

    <?php foreach($q->result_array() as $hq){?>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h4>
                Iterasi ke-<?php echo $hq['iterasi']; ?></h4>
                
                <small></small>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="" class="table table-striped table-bordered table-hover" style="font-size:13px;">
                <thead>
                  <tr>
                      <th style="text-align: center">Teknisi Produksi</th>
                      <th style="text-align: center">Teknisi Inventory</th>
                      <th style="text-align: center">Teknisi Instalasi Listrik</th>
                      <th style="text-align: center">Teknisi Instalasi Umum</th>
                      <th style="text-align: center">Teknisi Konfigurasi</th>
                      <th style="text-align: center">Teknisi Software</th>
                      <th style="text-align: center">Teknisi RnD</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $q2 = $this->db->query('select * from centroid_temp where iterasi='.$hq['iterasi'].'');
                foreach($q2->result() as $tq)
                {
                  $warna1="";
                  $warna2="";
                  $warna3="";
                  $warna4="";
                  $warna5="";
                  $warna6="";
                  $warna7="";
            
                  if($tq->c1==1){$warna1='#FFFF00';} else{$warna1='#EAEAEA';}
                  if($tq->c2==1){$warna2='#FFFF00';} else{$warna2='#EAEAEA';}
                  if($tq->c3==1){$warna3='#FFFF00';} else{$warna3='#EAEAEA';}
                  if($tq->c4==1){$warna4='#FFFF00';} else{$warna4='#EAEAEA';}
                  if($tq->c5==1){$warna5='#FFFF00';} else{$warna5='#EAEAEA';}
                  if($tq->c6==1){$warna6='#FFFF00';} else{$warna6='#EAEAEA';}
                  if($tq->c7==1){$warna7='#FFFF00';} else{$warna7='#EAEAEA';}
                ?>
                  <tr align="center">
                    <td bgcolor="<?php echo $warna1; ?>"><?php echo $tq->c1; ?></td>
                    <td bgcolor="<?php echo $warna2; ?>"><?php echo $tq->c2; ?></td>
                    <td bgcolor="<?php echo $warna3; ?>"><?php echo $tq->c3; ?></td>
                    <td bgcolor="<?php echo $warna4; ?>"><?php echo $tq->c4; ?></td>
                    <td bgcolor="<?php echo $warna5; ?>"><?php echo $tq->c5; ?></td>
                    <td bgcolor="<?php echo $warna6; ?>"><?php echo $tq->c6; ?></td>
                    <td bgcolor="<?php echo $warna7; ?>"><?php echo $tq->c7; ?></td>
                  </tr>
                <?php } ?>
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
    <?php } ?>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <h4>
                Hasil Klasterisasi
                <small></small>
              </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="" class="table table-striped table-bordered table-hover" style="font-size:13px;">
                <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama Peserta</th>
                    <th colspan="4" style="text-align: center">Jabatan Teknisi</th>
                </tr>
                </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                <?php foreach ($hasil_klasterisasi->result_array() as $hk) :
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $hk['nama_teknisi'];?></td>
                  <td style="text-align: center"><?php echo $hk['jabatan'];?></td>
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
    <?php elseif($this->session->flashdata('msg')=='iterasi-selesai'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Proses Iterasi Selesai",
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
