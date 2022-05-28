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
            Data Nilai
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo 'Nama Teknisi : '.$nama_peserta?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="table-tes" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori Soal</th>
                            <th>Soal</th>
                            <th>Jawaban</th>
                            <th>Koreksi</th>
                            <th>Skor</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php $no = 1; ?>
                        <?php foreach ($jawaban->result_array() as $i) :
                              $nilai_pg_id=$i['nilai_pg_id'];
                              $soal_pg_id=$i['soal_pg_id'];
                              $user_id=$i['user_id'];
                              $user_nama=$i['user_nama'];
                              $kategori_soal=$i['kategori_soal'];
                              $soal_pg_soal=$i['soal_pg_soal'];
                              $nilai_pg_jawaban=$i['nilai_pg_jawaban'];
                              $nilai_pg_koreksi=$i['nilai_pg_koreksi'];
                              $nilai_pg_skor=$i['nilai_pg_skor'];
                        ?>
                        <tr>
                          <td style="width:40px;"><?php echo $no++;?></td>
                          <td><?php echo $kategori_soal;?></td>
                          <td><?php echo $soal_pg_soal;?></td>
                          <td><?php echo $nilai_pg_jawaban;?></td>
                          <td>
                            <?php if($nilai_pg_koreksi == '1'){
                              echo 'Benar';
                            } else {
                              echo 'Salah';
                            }
                            
                            ?>
                              
                          </td>
                          <td><?php echo $nilai_pg_skor;?></td>
                        </tr>
                <?php endforeach;?>
                    </tbody>
                </table>
                <a class="btn btn-default" href="<?php echo base_url().'Teknisi/Dashboard/'?>"><span class="fa fa-arrow-left"></span> Kembali</a>   
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