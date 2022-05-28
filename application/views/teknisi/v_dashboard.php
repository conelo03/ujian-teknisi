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
            Selamat datang, <?= $nama_peserta?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="callout callout-info">
            <h4>Informasi</h4>
            <p>Silahkan pilih Tes yang diikuti dari daftar tes yang tersedia dibawah ini. Apabila tes tidak muncul, silahkan menghubungi Admin yang bertugas.</p>
        </div>
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Tes</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="table-tes" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ujian</th>
                        <th>Tanggal</th>
                        <th>Waktu Ujian</th>
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
                          $ujian_status=$i['ujian_status'];
                          $tanggal=date('d  F  Y', strtotime($ujian_tanggal));
                    ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $ujian_nama;?></td>
                      <td><?php echo $tanggal;?></td>
                      <td><?php echo $ujian_waktu." Menit";?></td>
                      <td style="text-align:center;">
                        <?php 
                        $id_user = $this->session->userdata('id');
                        ?>
                       
                        <a class="btn btn-primary" href="<?php echo base_url().'Teknisi/Dashboard/konfirmasi/'.$ujian_id?>"><span class="fa fa-pencil"></span> Kerjakan</a>
                    
                      </td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>   
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section><!-- /.content -->
    </div><!-- /.container -->            
</div>
<script type="text/javascript">
    $(function () {
        $('#table-tes').DataTable();   
    });
</script>
<?php $this->load->view('teknisi/v_footer')?>