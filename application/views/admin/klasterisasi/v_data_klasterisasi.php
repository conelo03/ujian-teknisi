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
				        <?php 
                
                foreach ($data->result_array() as $i) :
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
                  
                  foreach ($get_akumulasi as $a):
                  ?>
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

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <h4>
                Iterasi 1</h4>
                <a class="btn btn-success btn-flat" href="<?php echo base_url().'Admin/Klasterisasi/klasterisasi_next/'.$ujian_id?>"><span class="fa fa-refresh"></span> Proses Selanjutnya</a>
                <small></small>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="" class="table table-striped table-bordered table-hover" style="font-size:13px;">
                <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama Peserta</th>
                    <th colspan="4" style="text-align: center">Akumulasi Nilai Ujian</th>
                    <th colspan="4" style="text-align: center">Teknisi Produksi</th>
                    <th colspan="4" style="text-align: center">Teknisi Inventory</th>
                    <th colspan="4" style="text-align: center">Teknisi Instalasi Listrik</th>
                    <th colspan="4" style="text-align: center">Teknisi Instalasi Umum</th>
                    <th colspan="4" style="text-align: center">Teknisi Konfigurasi</th>
                    <th colspan="4" style="text-align: center">Teknisi Software</th>
                    <th colspan="4" style="text-align: center">Teknisi RnD</th>
                    <th rowspan="2">TP</th>
                    <th rowspan="2">TI</th>
                    <th rowspan="2">TIL</th>
                    <th rowspan="2">TIU</th>
                    <th rowspan="2">TK</th>
                    <th rowspan="2">TS</th>
                    <th rowspan="2">TR</th>
                </tr>
                <tr>
                  <?php
                  $a = 0; 
                  $b = 0; 
                  $c = 0; 
                  $d = 0; 
                  $e = 0; 
                  $f = 0; 
                  $g = 0; 
                  $get_kategori=$this->db->order_by('kategori_id','ASC')->get('tb_kategori_soal'); 

                  $get_skor_max = $this->db->select('*, skor_max_skor as max_skor')
                                            ->where('ujian_id' , $id_ujian)
                                            ->order_by('kategori_id','ASC')
                                            ->get('tb_skor_max')->result_array();

                  $tp = $this->db->get_where('tb_indikator_jabatan', ['i_jabatan_teknisi' => 'Teknisi Produksi'])->row_array();
                  $tp_array = array($tp['i_jabatan_pu'], $tp['i_jabatan_software'], $tp['i_jabatan_hardware'], $tp['i_jabatan_listrik'] );

                  $ti = $this->db->get_where('tb_indikator_jabatan', ['i_jabatan_teknisi' => 'Teknisi Inventory'])->row_array();
                  $ti_array = array($ti['i_jabatan_pu'], $ti['i_jabatan_software'], $ti['i_jabatan_hardware'], $ti['i_jabatan_listrik'] );

                  $til = $this->db->get_where('tb_indikator_jabatan', ['i_jabatan_teknisi' => 'Teknisi Instalasi Listrik'])->row_array();
                  $til_array = array($til['i_jabatan_pu'], $til['i_jabatan_software'], $til['i_jabatan_hardware'], $til['i_jabatan_listrik'] );

                  $tiu = $this->db->get_where('tb_indikator_jabatan', ['i_jabatan_teknisi' => 'Teknisi Instalasi Umum'])->row_array();
                  $tiu_array = array($tiu['i_jabatan_pu'], $tiu['i_jabatan_software'], $tiu['i_jabatan_hardware'], $tiu['i_jabatan_listrik'] );

                  $tk = $this->db->get_where('tb_indikator_jabatan', ['i_jabatan_teknisi' => 'Teknisi Konfigurasi'])->row_array();
                  $tk_array = array($tk['i_jabatan_pu'], $tk['i_jabatan_software'], $tk['i_jabatan_hardware'], $tk['i_jabatan_listrik'] );

                  $ts = $this->db->get_where('tb_indikator_jabatan', ['i_jabatan_teknisi' => 'Teknisi Software'])->row_array();
                  $ts_array = array($ts['i_jabatan_pu'], $ts['i_jabatan_software'], $ts['i_jabatan_hardware'], $ts['i_jabatan_listrik'] );

                  $tr = $this->db->get_where('tb_indikator_jabatan', ['i_jabatan_teknisi' => 'Teknisi RnD'])->row_array();
                  $tr_array = array($tr['i_jabatan_pu'], $tr['i_jabatan_software'], $tr['i_jabatan_hardware'], $tr['i_jabatan_listrik'] );
                  ?>
                  
                    <th style="text-align: center">PU</th>
                    <th style="text-align: center">S</th>
                    <th style="text-align: center">H</th>
                    <th style="text-align: center">L</th>

                  <?php
                  $c_tp = array(); 
                  foreach($get_skor_max as $tp):
                  $tp_array1 = $tp_array[$a++];
                  $c_tp[] = $tp['max_skor']*$tp_array1;   
                  ?>
                    <th style="text-align: center"><?php echo $tp['max_skor']*$tp_array1 ?></th>
                  <?php endforeach; ?>

                  <?php foreach($get_skor_max as $tp): 
                  $ti_array1 = $ti_array[$b++];
                  $c_ti[] = $tp['max_skor']*$ti_array1;
                  ?>
                    <th style="text-align: center"><?php echo $tp['max_skor']*$ti_array1 ?></th>
                  <?php endforeach; ?>

                  <?php foreach($get_skor_max as $tp): 
                  $til_array1 = $til_array[$c++];
                  $c_til[] = $tp['max_skor']*$til_array1;
                  ?>
                    <th style="text-align: center"><?php echo $tp['max_skor']*$til_array1 ?></th>
                  <?php endforeach; ?>

                  <?php foreach($get_skor_max as $tp): 
                  $tiu_array1 = $tiu_array[$d++];
                  $c_tiu[] = $tp['max_skor']*$tiu_array1;
                  ?>
                    <th style="text-align: center"><?php echo $tp['max_skor']*$tiu_array1 ?></th>
                  <?php endforeach; ?>

                  <?php foreach($get_skor_max as $tp): 
                  $tk_array1 = $tk_array[$e++];
                  $c_tk[] = $tp['max_skor']*$tk_array1;
                  ?>
                    <th style="text-align: center"><?php echo $tp['max_skor']*$tk_array1 ?></th>
                  <?php endforeach; ?>

                  <?php foreach($get_skor_max as $tp): 
                  $ts_array1 = $ts_array[$f++];
                  $c_ts[] = $tp['max_skor']*$ts_array1;
                  ?>
                    <th style="text-align: center"><?php echo $tp['max_skor']*$ts_array1 ?></th>
                  <?php endforeach; ?>

                  <?php foreach($get_skor_max as $tp): 
                  $tr_array1 = $tr_array[$g++];
                  $c_tr[] = $tp['max_skor']*$tr_array1;
                  ?>
                    <th style="text-align: center"><?php echo $tp['max_skor']*$tr_array1 ?></th>
                  <?php endforeach; ?>
                </tr>
                </thead>
                <?php 
                $c1a = $c_tp[0];
                $c1b = $c_tp[1];
                $c1c = $c_tp[2];
                $c1d = $c_tp[3];
                
                $c2a = $c_ti[0];
                $c2b = $c_ti[1];
                $c2c = $c_ti[2];
                $c2d = $c_ti[3];
                
                $c3a = $c_til[0];
                $c3b = $c_til[1];
                $c3c = $c_til[2];
                $c3d = $c_til[3];

                $c4a = $c_tiu[0];
                $c4b = $c_tiu[1];
                $c4c = $c_tiu[2];
                $c4d = $c_tiu[3];

                $c5a = $c_tk[0];
                $c5b = $c_tk[1];
                $c5c = $c_tk[2];
                $c5d = $c_tk[3];

                $c6a = $c_ts[0];
                $c6b = $c_ts[1];
                $c6c = $c_ts[2];
                $c6d = $c_ts[3];

                $c7a = $c_tr[0];
                $c7b = $c_tr[1];
                $c7c = $c_tr[2];
                $c7d = $c_tr[3];
                
                $c1a_b = "";
                $c1b_b = "";
                $c1c_b = "";
                $c1d_b = "";
                
                $c2a_b = "";
                $c2b_b = "";
                $c2c_b = "";
                $c2d_b = "";
                
                $c3a_b = "";
                $c3b_b = "";
                $c3c_b = "";
                $c3d_b = "";

                $c4a_b = "";
                $c4b_b = "";
                $c4c_b = "";
                $c4d_b = "";

                $c5a_b = "";
                $c5b_b = "";
                $c5c_b = "";
                $c5d_b = "";

                $c6a_b = "";
                $c6b_b = "";
                $c6c_b = "";
                $c6d_b = "";

                $c7a_b = "";
                $c7b_b = "";
                $c7c_b = "";
                $c7d_b = "";
                
                $hc1=0;
                $hc2=0;
                $hc3=0;
                $hc4=0;
                $hc5=0;
                $hc6=0;
                $hc7=0;
                
                $no=0;
                $arr_c1 = array();
                $arr_c2 = array();
                $arr_c3 = array();
                $arr_c4 = array();
                $arr_c5 = array();
                $arr_c6 = array();
                $arr_c7 = array();
                
                $arr_c1_temp = array();
                $arr_c2_temp = array();
                $arr_c3_temp = array();
                $arr_c4_temp = array();
                
                $this->db->query('TRUNCATE table hasil_klasterisasi');
                $this->db->query('TRUNCATE table centroid_temp');
                $this->db->query('TRUNCATE table hasil_centroid');
                ?>
                <tbody>
                <?php $nom = 1; ?>
                <?php foreach($akumulasi->result_array() as $a) {

                ?>
                <tr>
                  <td><?php echo $nom++;?></td>
                  <td><?php echo $a['nama_teknisi'];?></td>
                  <td><?php echo $a['pu']; ?></td>
                  <td><?php echo $a['software']; ?></td>
                  <td><?php echo $a['hardware']; ?></td>
                  <td><?php echo $a['kelistrikan']; ?></td>
                  
                  <td colspan="4"><?php 
                  $hc1 = sqrt(pow(($a['pu']-$c1a),2)+pow(($a['software']-$c1b),2)+pow(($a['hardware']-$c1c),2)+pow(($a['kelistrikan']-$c1d),2));
                    echo $hc1;
                  ?></td>
                  <td colspan="4"><?php 
                    $hc2 = sqrt(pow(($a['pu']-$c2a),2)+pow(($a['software']-$c2b),2)+pow(($a['hardware']-$c2c),2)+pow(($a['kelistrikan']-$c2d),2));
                    echo $hc2;
                  ?></td>
                  <td colspan="4"><?php 
                    $hc3 = sqrt(pow(($a['pu']-$c3a),2)+pow(($a['software']-$c3b),2)+pow(($a['hardware']-$c3c),2)+pow(($a['kelistrikan']-$c3d),2));
                    echo $hc3;
                  ?></td>
                  <td colspan="4"><?php 
                    $hc4 = sqrt(pow(($a['pu']-$c4a),2)+pow(($a['software']-$c4b),2)+pow(($a['hardware']-$c4c),2)+pow(($a['kelistrikan']-$c4d),2));
                    echo $hc4;
                  ?></td>
                  <td colspan="4"><?php 
                    $hc5 = sqrt(pow(($a['pu']-$c5a),2)+pow(($a['software']-$c5b),2)+pow(($a['hardware']-$c5c),2)+pow(($a['kelistrikan']-$c5d),2));
                    echo $hc5;
                  ?></td>
                  <td colspan="4"><?php 
                    $hc6 = sqrt(pow(($a['pu']-$c6a),2)+pow(($a['software']-$c6b),2)+pow(($a['hardware']-$c6c),2)+pow(($a['kelistrikan']-$c6d),2));
                    echo $hc6;
                  ?></td>
                  <td colspan="4"><?php 
                    $hc7 = sqrt(pow(($a['pu']-$c7a),2)+pow(($a['software']-$c7b),2)+pow(($a['hardware']-$c7c),2)+pow(($a['kelistrikan']-$c7d),2));
                    echo $hc7;
                  ?></td>

                  <?php 
                  $hc = array($hc1, $hc2, $hc3, $hc4, $hc5, $hc6, $hc7);
                  $min_hc = min($hc);
                  
                  if($hc1==$min_hc)
                  {
                    $arr_c1[$no] = 1;
                  }
                  else
                  {
                    $arr_c1[$no] = '0';
                  }
                  
                  if($hc2==$min_hc)
                  {
                    $arr_c2[$no] = 1;
                  }
                  else
                  {
                    $arr_c2[$no] = '0';
                  }
                  
                  if($hc3==$min_hc)
                  {
                    $arr_c3[$no] = 1;
                  }
                  else
                  {
                    $arr_c3[$no] = '0';
                  }

                  if($hc4==$min_hc)
                  {
                    $arr_c4[$no] = 1;
                  }
                  else
                  {
                    $arr_c4[$no] = '0';
                  }

                  if($hc5==$min_hc)
                  {
                    $arr_c5[$no] = 1;
                  }
                  else
                  {
                    $arr_c5[$no] = '0';
                  }

                  if($hc6==$min_hc)
                  {
                    $arr_c6[$no] = 1;
                  }
                  else
                  {
                    $arr_c6[$no] = '0';
                  }

                  if($hc7==$min_hc)
                  {
                    $arr_c7[$no] = 1;
                  }
                  else
                  {
                    $arr_c7[$no] = '0';
                  }
                  
                  $arr_c1_temp[$no] = $a['pu'];
                  $arr_c2_temp[$no] = $a['software'];
                  $arr_c3_temp[$no] = $a['hardware'];
                  $arr_c4_temp[$no] = $a['kelistrikan'];
                  
                  $warna1="";
                  $warna2="";
                  $warna3="";
                  $warna4="";
                  $warna5="";
                  $warna6="";
                  $warna7="";
                  ?>
                  <?php if($arr_c1[$no]==1){$warna1='#FFFF00';} else{$warna1='#ccc';} ?><td bgcolor="<?php echo $warna1; ?>"><?php echo $arr_c1[$no] ;?></td>
                  <?php if($arr_c2[$no]==1){$warna2='#FFFF00';} else{$warna2='#ccc';} ?><td bgcolor="<?php echo $warna2; ?>"><?php echo $arr_c2[$no] ;?></td>
                  <?php if($arr_c3[$no]==1){$warna3='#FFFF00';} else{$warna3='#ccc';} ?><td bgcolor="<?php echo $warna3; ?>"><?php echo $arr_c3[$no] ;?></td>
                  <?php if($arr_c4[$no]==1){$warna4='#FFFF00';} else{$warna4='#ccc';} ?><td bgcolor="<?php echo $warna4; ?>"><?php echo $arr_c4[$no] ;?></td>
                  <?php if($arr_c5[$no]==1){$warna5='#FFFF00';} else{$warna5='#ccc';} ?><td bgcolor="<?php echo $warna5; ?>"><?php echo $arr_c5[$no] ;?></td>
                  <?php if($arr_c6[$no]==1){$warna6='#FFFF00';} else{$warna6='#ccc';} ?><td bgcolor="<?php echo $warna6; ?>"><?php echo $arr_c6[$no] ;?></td>
                  <?php if($arr_c7[$no]==1){$warna7='#FFFF00';} else{$warna7='#ccc';} ?><td bgcolor="<?php echo $warna7; ?>"><?php echo $arr_c7[$no] ;?></td>

                  </tr>

                    
                </tr>
                <?php
                
                $q = "insert into centroid_temp(iterasi,c1,c2,c3,c4,c5,c6,c7) values(1,'".$arr_c1[$no]."','".$arr_c2[$no]."','".$arr_c3[$no]."','".$arr_c4[$no]."','".$arr_c5[$no]."','".$arr_c6[$no]."','".$arr_c7[$no]."')";
                $this->db->query($q);
                
                $no++; 
                }
                
                //centroid baru 1.a
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c1_temp[$i]*$arr_c1[$i];
                  if($arr_c1[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c1a_b = 0;
                }else{
                  $c1a_b = array_sum($arr)/$jum;
                }
                
                //centroid baru 1.b
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c2_temp[$i]*$arr_c1[$i];
                  if($arr_c1[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c1b_b = 0;
                }else{
                  $c1b_b = array_sum($arr)/$jum;
                }
                
                
                //centroid baru 1.c
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c3_temp[$i]*$arr_c1[$i];
                  if($arr_c1[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c1c_b = 0;
                }else{
                  $c1c_b = array_sum($arr)/$jum;
                }
                
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c4_temp[$i]*$arr_c1[$i];
                  if($arr_c1[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c1d_b = 0;
                }else{
                  $c1d_b = array_sum($arr)/$jum;
                }
                
                //centroid baru 2.a
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c1_temp[$i]*$arr_c2[$i];
                  if($arr_c2[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c2a_b = 0;
                }else{
                  $c2a_b = array_sum($arr)/$jum;
                }


                
                
                //centroid baru 2.b
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c2_temp[$i]*$arr_c2[$i];
                  if($arr_c2[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c2b_b = 0;
                }else{
                  $c2b_b = array_sum($arr)/$jum;
                }

                //centroid baru 2.c
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c3_temp[$i]*$arr_c2[$i];
                  if($arr_c2[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c2c_b = 0;
                }else{
                  $c2c_b = array_sum($arr)/$jum;
                }
                
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c4_temp[$i]*$arr_c2[$i];
                  if($arr_c2[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c2d_b = 0;
                }else{
                  $c2d_b = array_sum($arr)/$jum;
                }
                
                
                //centroid baru 3.a
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c1_temp[$i]*$arr_c3[$i];
                  if($arr_c3[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c3a_b = 0;
                }else{
                  $c3a_b = array_sum($arr)/$jum;
                }
                
                //centroid baru 3.b
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c2);$i++)
                {
                  $arr[$i] = $arr_c2_temp[$i]*$arr_c3[$i];
                  if($arr_c3[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c3b_b = 0;
                }else{
                  $c3b_b = array_sum($arr)/$jum;
                }
                
                //centroid baru 3.c
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c3);$i++)
                {
                  $arr[$i] = $arr_c3_temp[$i]*$arr_c3[$i];
                  if($arr_c3[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c3c_b = 0;
                }else{
                  $c3c_b = array_sum($arr)/$jum;
                }

                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c4);$i++)
                {
                  $arr[$i] = $arr_c4_temp[$i]*$arr_c3[$i];
                  if($arr_c3[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c3d_b = 0;
                }else{
                  $c3d_b = array_sum($arr)/$jum;
                }

                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c1_temp[$i]*$arr_c4[$i];
                  if($arr_c4[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c4a_b = 0;
                }else{
                  $c4a_b = array_sum($arr)/$jum;
                }
                
                //centroid baru 3.b
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c2);$i++)
                {
                  $arr[$i] = $arr_c2_temp[$i]*$arr_c4[$i];
                  if($arr_c4[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c4b_b = 0;
                }else{
                  $c4b_b = array_sum($arr)/$jum;
                }
                
                //centroid baru 3.c
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c3);$i++)
                {
                  $arr[$i] = $arr_c3_temp[$i]*$arr_c4[$i];
                  if($arr_c4[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c4c_b = 0;
                }else{
                  $c4c_b = array_sum($arr)/$jum;
                }

                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c4);$i++)
                {
                  $arr[$i] = $arr_c4_temp[$i]*$arr_c4[$i];
                  if($arr_c4[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c4d_b = 0;
                }else{
                  $c4d_b = array_sum($arr)/$jum;
                }
                
                 $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c1_temp[$i]*$arr_c5[$i];
                  if($arr_c5[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c5a_b = 0;
                }else{
                  $c5a_b = array_sum($arr)/$jum;
                }
                
                //centroid baru 3.b
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c2);$i++)
                {
                  $arr[$i] = $arr_c2_temp[$i]*$arr_c5[$i];
                  if($arr_c5[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c5b_b = 0;
                }else{
                  $c5b_b = array_sum($arr)/$jum;
                }
                
                //centroid baru 3.c
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c3);$i++)
                {
                  $arr[$i] = $arr_c3_temp[$i]*$arr_c5[$i];
                  if($arr_c5[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c5c_b = 0;
                }else{
                  $c5c_b = array_sum($arr)/$jum;
                }

                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c4);$i++)
                {
                  $arr[$i] = $arr_c4_temp[$i]*$arr_c5[$i];
                  if($arr_c5[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c5d_b = 0;
                }else{
                  $c5d_b = array_sum($arr)/$jum;
                }

                 $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c1_temp[$i]*$arr_c6[$i];
                  if($arr_c6[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c6a_b = 0;
                }else{
                  $c6a_b = array_sum($arr)/$jum;
                }
                
                //centroid baru 3.b
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c2);$i++)
                {
                  $arr[$i] = $arr_c2_temp[$i]*$arr_c6[$i];
                  if($arr_c6[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c6b_b = 0;
                }else{
                  $c6b_b = array_sum($arr)/$jum;
                }
                
                //centroid baru 3.c
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c3);$i++)
                {
                  $arr[$i] = $arr_c3_temp[$i]*$arr_c6[$i];
                  if($arr_c6[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c6c_b = 0;
                }else{
                  $c6c_b = array_sum($arr)/$jum;
                }

                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c4);$i++)
                {
                  $arr[$i] = $arr_c4_temp[$i]*$arr_c6[$i];
                  if($arr_c6[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c6d_b = 0;
                }else{
                  $c6d_b = array_sum($arr)/$jum;
                }

                 $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c1);$i++)
                {
                  $arr[$i] = $arr_c1_temp[$i]*$arr_c7[$i];
                  if($arr_c7[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c7a_b = 0;
                }else{
                  $c7a_b = array_sum($arr)/$jum;
                }
                
                //centroid baru 3.b
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c2);$i++)
                {
                  $arr[$i] = $arr_c2_temp[$i]*$arr_c7[$i];
                  if($arr_c7[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c7b_b = 0;
                }else{
                  $c7b_b = array_sum($arr)/$jum;
                }
                
                //centroid baru 3.c
                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c3);$i++)
                {
                  $arr[$i] = $arr_c3_temp[$i]*$arr_c7[$i];
                  if($arr_c7[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c7c_b = 0;
                }else{
                  $c7c_b = array_sum($arr)/$jum;
                }

                $jum = 0;
                $arr = array();
                for($i=0;$i<count($arr_c4);$i++)
                {
                  $arr[$i] = $arr_c4_temp[$i]*$arr_c7[$i];
                  if($arr_c7[$i]==1)
                  {
                    $jum++;
                  }
                }
                if($jum==0){
                  $c7d_b = 0;
                }else{
                  $c7d_b = array_sum($arr)/$jum;
                }

                $q = "insert into hasil_centroid(c1a,c1b,c1c,c1d,c2a,c2b,c2c,c2d,c3a,c3b,c3c,c3d,c4a,c4b,c4c,c4d,c5a,c5b,c5c,c5d,c6a,c6b,c6c,c6d,c7a,c7b,c7c,c7d) values('".$c1a_b."','".$c1b_b."','".$c1c_b."','".$c1d_b."','".$c2a_b."','".$c2b_b."','".$c2c_b."','".$c2d_b."','".$c3a_b."','".
                  $c3b_b."','".$c3c_b."','".$c3d_b."','".$c4a_b."','".$c4b_b."','".$c4c_b."','".$c4d_b."','".$c5a_b."','".
                  $c5b_b."','".$c5c_b."','".$c5d_b."','".$c6a_b."','".
                  $c6b_b."','".$c6c_b."','".$c6d_b."','".$c7a_b."','".
                  $c7b_b."','".$c7c_b."','".$c7d_b."')";
                  $this->db->query($q);
                
                
                ?>

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
                      <label for="inputUserName" class="col-sm-4 control-label">Status</label>
                        <div class="col-sm-7">
                          <div class="radio radio-info radio-inline">
                              <input type="radio" id="inlineRadio1" value="1" name="status" checked>
                              <label for="inlineRadio1"> Aktif </label>
                          </div>
                          <div class="radio radio-info radio-inline">
                              <input type="radio" id="inlineRadio1" value="0" name="status">
                              <label for="inlineRadio2"> Tidak Aktif </label>
                          </div>
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
