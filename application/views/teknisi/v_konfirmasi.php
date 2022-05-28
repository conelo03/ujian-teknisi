<?php 
$header['judul'] = $judul;
$header['nama_peserta'] = $nama_peserta;
$header['timestamp'] = $timestamp;
$this->load->view('teknisi/v_header',$header)?>

<div class="content-wrapper">
    <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SELAMAT DATANG
            <small>di Ujian Online Berbasis Komputer</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form class="form-horizontal" action="<?php echo base_url().'Teknisi/Ujian/index'?>" method="post" enctype="multipart/form-data">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Konfirmasi Ujian (Soal Pilihan Ganda)</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="box-body no-padding">
                    <div id="form-pesan"></div>
                    <input type="hidden" name="ujian_id" id="ujian_id" value="<?php if(!empty($data['ujian_id'])){ echo $data['ujian_id']; } ?>">
                    <table class="table table-striped">
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Nama Peserta : </td>
                            <td style="vertical-align: middle;"><b><?php if(!empty($nama_peserta)){ echo $nama_peserta; } ?></b></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Tes : </td>
                            <td style="vertical-align: middle;"><b><?php if(!empty($data['ujian_nama'])){ echo $data['ujian_nama']; } ?></b></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td></td>
                            <td style="vertical-align: middle;text-align: right;">Tanggal : </td>
                            <td style="vertical-align: middle;"><?php if(!empty($data['ujian_tanggal'])){ echo date('d F Y',strtotime($data['ujian_tanggal'])); } ?></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Waktu : </td>
                            <td style="vertical-align: middle;"><?php if(!empty($data['ujian_waktu'])){ echo $data['ujian_waktu']." Menit"; } ?></td>
                            <td></td>
                        </tr>
                        <?php
                        $id_user = $this->session->userdata('id');
                        $ujian_id = $data['ujian_id'];
                        $get_hasil = $this->db->get_where('tb_hasil_ujian', ['user_id' => $id_user, 'ujian_id' => $ujian_id])->row_array();
                        if($get_hasil['h_ujian_status'] == '1'): ?>

                        <?php else: ?>
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Status : </td>
                            <td style="vertical-align: middle;"><?= 'Selesai'; ?></td>
                            <td></td>
                        </tr>
                        <?php endif;?>
                        
                  </table>
            </div><!-- /.box-body -->
            <div class="box-body">
                <?php
                $id_user = $this->session->userdata('id');
                $ujian_id = $data['ujian_id'];
                $get_hasil = $this->db->get_where('tb_hasil_ujian', ['user_id' => $id_user, 'ujian_id' => $ujian_id])->row_array();
                if($get_hasil['h_ujian_status'] == '1'): ?>
                    <a href="<?php echo base_url().'Teknisi/Ujian/index/'.$data['ujian_id']?>" class="btn btn-primary pull-right"><span class="fa fa-pencil"></span> Kerjakan</a>
                <?php else: ?>
                <?php endif;?>
            </div>
        </div><!-- /.box -->
    </div>
    </form><!-- /.box -->
    </section><!-- /.content -->

    <section class="content">
        <form class="form-horizontal" action="<?php echo base_url().'Teknisi/Ujian/essai'?>" method="post" enctype="multipart/form-data">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Konfirmasi Ujian (Soal Essai)</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="box-body no-padding">
                    <div id="form-pesan"></div>
                    <input type="hidden" name="ujian_id" id="ujian_id" value="<?php if(!empty($data['ujian_id'])){ echo $data['ujian_id']; } ?>">
                    <table class="table table-striped">
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Nama Peserta : </td>
                            <td style="vertical-align: middle;"><b><?php if(!empty($nama_peserta)){ echo $nama_peserta; } ?></b></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Tes : </td>
                            <td style="vertical-align: middle;"><b><?php if(!empty($data['ujian_nama'])){ echo $data['ujian_nama']; } ?></b></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td></td>
                            <td style="vertical-align: middle;text-align: right;">Tanggal : </td>
                            <td style="vertical-align: middle;"><?php if(!empty($data['ujian_tanggal'])){ echo date('d F Y',strtotime($data['ujian_tanggal'])); } ?></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Waktu : </td>
                            <td style="vertical-align: middle;"><?php if(!empty($data['ujian_essai_waktu'])){ echo $data['ujian_essai_waktu']." Menit"; } ?></td>
                            <td></td>
                        </tr>
                        <?php
                        $id_user = $this->session->userdata('id');
                        $ujian_id = $data['ujian_id'];
                        $get_hasil = $this->db->get_where('tb_hasil_ujian', ['user_id' => $id_user, 'ujian_id' => $ujian_id])->row_array();
                        if($get_hasil['h_ujian_status'] == '1' || $get_hasil['h_ujian_status'] == '2' || $get_hasil['h_ujian_status'] == '3' ): ?>

                        <?php else: ?>
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Status : </td>
                            <td style="vertical-align: middle;"><?= 'Selesai'; ?></td>
                            <td></td>
                        </tr>
                        <?php endif;?>
                  </table>
            </div><!-- /.box-body -->
            <div class="box-body">
                <?php
                $id_user = $this->session->userdata('id');
                $ujian_id = $data['ujian_id'];
                $get_hasil = $this->db->get_where('tb_hasil_ujian', ['user_id' => $id_user, 'ujian_id' => $ujian_id])->row_array();
                if($get_hasil['h_ujian_status'] == '2' || $get_hasil['h_ujian_status'] == '3'): ?>
                    <a href="<?php echo base_url().'Teknisi/Ujian/essai/'.$data['ujian_id']?>" class="btn btn-primary pull-right"><span class="fa fa-pencil"></span> Kerjakan</a>
                <?php else: ?>
                <?php endif;?>
            </div>
        </div><!-- /.box -->
    </div>
    </form><!-- /.box -->     
    </section><!-- /.content -->

    <section class="content">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Materi Ujian Praktek</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="table-tes" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Materi</th>
                        <th>Bobot</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                    <?php foreach ($uprak->result_array() as $i) :
                        $get_kategori = $this->db->get_where('tb_kategori_soal', ['kategori_id' => $i['kategori_id']])->row_array()
                    ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $get_kategori['kategori_soal'];?></td>
                      <td><?php echo $i['uprak_materi'];?></td>
                      <td><?php echo $i['uprak_bobot'];?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>   
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section><!-- /.content -->
    <center>
        <div class="row">
            <a href="<?php echo base_url().'Teknisi/Dashboard/'?>" class="btn btn-default"><span class="fa fa-arrow-left"></span> Kembali</a>
        </div>
    </center>
    <br/>

    </div><!-- /.container -->            
</div>
<script type="text/javascript">
    $(function () {
        $('#table-tes').DataTable();   
    });
</script>
<?php if($this->session->flashdata('msg')=='error'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Mohon maaf waktu ujian sudah habis!",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#FF4859'
                });
        </script>
<?php elseif($this->session->flashdata('msg')=='sudah_ujian'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Anda sudah menyelesaikan ujian ini, silahkan kerjakan soal essai!",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#FF4859'
                });
        </script>
<?php elseif($this->session->flashdata('msg')=='belum_ujian'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Anda belum menyelesaikan ujian soal pilihan ganda, silahkan kerjakan soal pilihan ganda terlebih dahulu!",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: '5000',
                    position: 'top-right',
                    bgColor: '#FF4859'
                });
        </script>
<?php elseif($this->session->flashdata('msg')=='selesai'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Anda sudah menyelesaikan ujian ini!",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#FF4859'
                });
        </script>
<?php elseif($this->session->flashdata('msg')=='henti_pg'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Anda sudah menyelesaikan soal Pilihan Ganda, silahkan untuk menyelesaikan soal Essai!",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#7EC857'
                });
        </script>
<?php elseif($this->session->flashdata('msg')=='henti_essai'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Anda sudah menyelesaikan semua ujian!",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: '3000',
                    position: 'top-right',
                    bgColor: '#7EC857'
                });
        </script>
<?php endif; ?>
<?php $this->load->view('teknisi/v_footer')?>