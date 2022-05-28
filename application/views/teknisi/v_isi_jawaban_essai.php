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
                Tes : <?php echo $ujian->ujian_nama; ?><span id="timestamp"></span>
            </h1>
            <div class="breadcrumb">
                <img src="<?php echo base_url(); ?>public/images/zoom.png" style="cursor: pointer;" height="20" onclick="zoomnormal()" title="Klik ukuran font normal" />&nbsp;&nbsp;
                <img src="<?php echo base_url(); ?>public/images/zoom.png" style="cursor: pointer;" height="26" onclick="zoombesar()" title="Klik ukuran font lebih besar" />
            </div>
        </section>

    	<!-- Main content -->
        <section class="content">
        	<div class="row">
            <?php 
            $no=(int)$this->uri->segment(5)+1;
            foreach($soal_essai as $soal):?>
            <form action="<?php echo base_url();?>Teknisi/Ujian/simpan_jawaban_essai" method="post">
                <input type="hidden" name="ujian_id" id="tes-id" value="<?php if(!empty($ujian_id)){ echo $ujian_id; } ?>">
                <input type="hidden" name="user_id" id="tes-user-id" value="<?php if(!empty($user_id)){ echo $user_id; } ?>">
                <input type="hidden" name="soal_essai_id" id="tes-soal-id" value="<?php echo $soal->soal_essai_id; ?>">
                <input type="hidden" name="uri" id="tes-soal-id" value="<?php echo $this->uri->segment(5); ?>">
                <input type="hidden" name="jml_soal" id="tes-soal-id" value="<?php echo $jml_soal; ?>">
        		<div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Soal <span id="judul-soal"><?php echo 'ke '.$no; ?></span></h3>
                        <div class="box-tools pull-right">
                            <div class="pull-right">
                                <div id="sisa-waktu"></div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php if ($soal->soal_essai_media == NULL || $soal->soal_essai_media == 'default.jpg'):?>
                        <?php else :?>
                            <img src="<?= base_url().'upload/media/'.$soal->soal_essai_media?>" />
                        <?php endif;?>
                        <div id="isi-tes-soal" style="font-size: 15px;">
                            <?php echo $soal->soal_essai_soal;?>
                            <hr />
                            <div class="form-group">
                                <?php if (empty($soal->nilai_essai_jawaban)):?>
                                <textarea class="textarea" id="soal-jawaban" name="jawaban" style="width: 100%; height: 150px; font-size: 13px; line-height: 25px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                <?php else:?>
                                <textarea class="textarea" id="soal-jawaban" name="jawaban" style="width: 100%; height: 150px; font-size: 13px; line-height: 25px; border: 1px solid #dddddd; padding: 10px;"><?php echo $soal->nilai_essai_jawaban;?></textarea>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer"> 
                        <?php 
                        $uri = (int)$this->uri->segment(5)-1;
                        if($uri == 0){
                            $uri = '';
                        } else {
                            $uri = $uri;
                        }
                        if(empty($this->uri->segment(5))):?>
                        <button type="submit" class="btn btn-default hide" id="btn-sebelumnya">Soal Sebelumnya</button>&nbsp;&nbsp;&nbsp;
                        <?php else:?>
                        <a href="<?php echo base_url().'Teknisi/Ujian/essai/'.$ujian_id.'/'.$uri;?>" class="btn btn-default" id="btn-sebelumnya">Soal Sebelumnya</a>&nbsp;&nbsp;&nbsp;
                        <?php endif;?>
                        <label>
                            <input type="checkbox" style="width:15px;height:15px;" name="ragu" value="1" id="btn-ragu-checkbox" <?php if($soal->nilai_essai_ragu=='1'){ echo "checked"; } ?> /> Ragu-ragu
                        </label>
                        &nbsp;&nbsp;&nbsp;
                        <?php if($this->uri->segment(5) == $jml_soal):?>
                        <button type="submit" class="btn btn-default" id="btn-selanjutnya">Simpan Jawaban</button>
                        <?php else:?>
                        <button type="submit" class="btn btn-default" id="btn-selanjutnya">Soal Selanjutnya</button>
                        <?php endif;?>
                        
                        
                    </div>
                </div><!-- /.box -->
            </form>
            <?php endforeach;?>
        	</div>
            <div class="row">
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Soal</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php 
                        $no_soal=1;
                        foreach($daftar_soal as $s):
                            $no_soall = $no_soal++;
                            $no_uri = $no_soall-1;
                            if($no_uri == 0){
                                $no_uri ='';
                            } else {
                                $no_uri = $no_uri;
                            }
                            ?>
                            <?php if($s->nilai_essai_ragu == '1'): ?>
                                <a href="<?php echo base_url().'Teknisi/Ujian/essai/'.$ujian_id.'/'.$no_uri;?>" class="btn btn-warning" style="margin-bottom: 5px;"><?php echo $no_soall;?></a>
                            <?php elseif($s->nilai_essai_ragu == '0'): ?>
                                <a href="<?php echo base_url().'Teknisi/Ujian/essai/'.$ujian_id.'/'.$no_uri;?>" class="btn btn-primary" style="margin-bottom: 5px;"><?php echo $no_soall;?></a>
                            <?php else: ?>
                                <a href="<?php echo base_url().'Teknisi/Ujian/essai/'.$ujian_id.'/'.$no_uri;?>" class="btn btn-default" style="margin-bottom: 5px;"><?php echo $no_soall;?></a>
                            <?php endif; ?>
                        <?php endforeach;?>
                        <p class="help-block">Soal yang sudah dijawab akan berwarna Biru.</p>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a class="btn btn-default pull-right" data-toggle="modal" data-target="#modal-hentikan"><span></span> Selesai</a>
                    </div>
                </div><!-- /.box -->
            </div>
        </section><!-- /.content -->

        <div class="modal" style="max-height: 100%;overflow-y: auto;" id="modal-hentikan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <form action="<?php echo base_url();?>Teknisi/Ujian/hentikan_tes_essai" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                        <div id="trx-judul">Konfirmasi Hentikan Tes</div>
                    </div>
                    <div class="modal-body" >
                        <div class="row-fluid">
                            <div class="box-body">
                                <div id="form-pesan"></div>
                                <div class="callout callout-info">
                                    <p>Apakah anda yakin mengakhiri ujian ini ?
    								<br />Jawaban Tes yang sudah selesai tidak dapat diubah.
    								</p>
    								
                                </div>
                                <div class="form-group">
                                    <label>Nama Tes</label>
                                    <input type="hidden" name="ujian_id" value="<?php if(!empty($ujian_id)){ echo $ujian_id; } ?>" >
                                    <input type="hidden" name="user_id" value="<?php if(!empty($user_id)){ echo $user_id; } ?>" >
                                    <input type="text" class="form-control" id="hentikan-tes-nama" value="<?php echo $ujian->ujian_nama; ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Keterangan Soal</label>
                                    <input type="text" class="form-control" id="hentikan-dijawab" value="Soal Essai" readonly>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" id="tambah-simpan" class="btn btn-primary">Konfirmasi Selesai</button>
                                <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        </div>
    </div><!-- /.container -->
</div>
<script type="text/javascript">
    $(function () {
        var sisa_detik = <?php if(!empty($detik_sisa)){ echo $detik_sisa; } ?>;
        setInterval(function() {
            
            y   = sisa_detik % 3600;
            jam   = sisa_detik / 3600;
            menit = y / 60;
            detik = y % 60;

            var sisa_menit = 'Sisa Waktu = '+ Math.floor(jam) + ':' + Math.floor(menit) + ':' + Math.floor(detik);
            sisa_detik = sisa_detik-1;
            $("#sisa-waktu").html(sisa_menit);

            if(sisa_detik<1){
                window.location.reload();
            }
        }, 1000);

        $('#btn-sebelumnya').click(function(){
            soal_navigasi(-1);
        });

        $('#btn-selanjutnya').click(function(){
            soal_navigasi(1);
        });

        $('#btn-hentikan').click(function(){
            hentikan_tes();
        });

        });
</script>
<script type="text/javascript">

    function soal_navigasi(navigasi){
        var tes_soal_nomor = parseInt($('#tes-soal-nomor').val());
        var tes_soal_jml = parseInt($('#tes-soal-jml').val());
        var tes_soal_tujuan = tes_soal_nomor+navigasi;

        if((tes_soal_tujuan>=1 && tes_soal_tujuan<=tes_soal_jml)){
            $('#btn-soal-'+tes_soal_tujuan).trigger('click');
        }
    }

    function ragu(){
        $("#modal-proses").modal('show');

        $.ajax({
            url:'<?php echo site_url().'/'.$url; ?>/get_tes_soal_by_tessoal/'+$('#tes-soal-id').val(),
            type:"POST",
            cache: false,
            timeout: 10000,
            success:function(respon){
                var data = $.parseJSON(respon);
                if(data.data==1){
                    // Mengubah nilai ragu-ragu di database
                    if($('#tes-soal-ragu').val()==0){
                        var ragu=1;
                    }else{
                        var ragu=0;
                    }
                    $.ajax({
                            url:'<?php echo site_url().'/'.$url; ?>/update_tes_soal_ragu/'+$('#tes-soal-id').val()+'/'+ragu,
                            type:"POST",
                            cache: false,
                            timeout: 5000,
                            success:function(respon){
                                var data = $.parseJSON(respon);
                                if(data.data==1){
                                    notify_success('Jawaban Ragu-ragu berhasil diubah');
                                }
                            },
                            error: function(xmlhttprequest, textstatus, message) {
                                if(textstatus==="timeout") {
                                    $("#modal-proses").modal('hide');
                                    notify_error("Gagal mengubah Soal, Silahkan Refresh Halaman");
                                }else{
                                    $("#modal-proses").modal('hide');
                                    notify_error(textstatus);
                                }
                            }
                    });

                    // Mengubah warna daftar soal dan checkbox pada tombol ragu-ragu
                    if(data.tessoal_dikerjakan==1){
                        if($('#tes-soal-ragu').val()==0){
                            // Membuat menjadi ragu-ragu
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-primary');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-warning');
                            $('#btn-ragu-checkbox').prop("checked", true);
                            $('#tes-soal-ragu').val(1);
                        }else{
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-warning');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-primary');
                            $('#btn-ragu-checkbox').prop("checked", false);
                            $('#tes-soal-ragu').val(0);
                        }
                    }else{
                        if($('#tes-soal-ragu').val()==0){
                            // Membuat menjadi ragu-ragu
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-default');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-warning');
                            $('#btn-ragu-checkbox').prop("checked", true);
                            $('#tes-soal-ragu').val(1);
                        }else{
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-warning');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-default');
                            $('#btn-ragu-checkbox').prop("checked", false);
                            $('#tes-soal-ragu').val(0);
                        }
                    }
                }
                $("#modal-proses").modal('hide');
            },
            error: function(xmlhttprequest, textstatus, message) {
                if(textstatus==="timeout") {
                    $("#modal-proses").modal('hide');
                    notify_error("Gagal mengubah soal, Silahkan Refresh Halaman");
                }else{
                    $("#modal-proses").modal('hide');
                    notify_error(textstatus);
                }
            }
        });
    }

    function soal(tessoal_id){
        $("#modal-proses").modal('show');
        $.ajax({
            url:'<?php echo site_url().'/'.$url; ?>/get_soal_by_tessoal/'+tessoal_id+'/'+$('#tes-user-id').val(),
            type:"POST",
            cache: false,
            timeout: 10000,
            success:function(respon){
                var data = $.parseJSON(respon);
                if(data.data==1){
                    $('#tes-soal-id').val(data.tes_soal_id);
                    $('#tes-soal-nomor').val(data.tes_soal_nomor);
                    $('#isi-tes-soal').html(data.tes_soal);
                    $('#tes-soal-ragu').val(data.tes_ragu);
                    $('#judul-soal').html('ke '+data.tes_soal_nomor);

                    if(data.tes_ragu==0){
                        // Menghilangkan checkbox ragu-ragu
                        $('#btn-ragu-checkbox').prop("checked", false);
                    }else{
                        // Menambah checkbox ragu-ragu
                        $('#btn-ragu-checkbox').prop("checked", true);
                    }

                    // menghilangkan tombol sebelum jika soal di nomor1
                    // dan menghilangkan tombol selanjutnya jika disoal terakhir
                    var tes_soal_nomor = parseInt($('#tes-soal-nomor').val());
                    var tes_soal_jml = parseInt($('#tes-soal-jml').val());
                    var tes_soal_tujuan = data.tes_soal_nomor;
                    if(tes_soal_tujuan==1){
                        $('#btn-sebelumnya').addClass('hide');
                        $('#btn-selanjutnya').removeClass('hide');
                    }else if(tes_soal_tujuan==tes_soal_jml){
                        $('#btn-sebelumnya').removeClass('hide');
                        $('#btn-selanjutnya').addClass('hide');
                    }else{
                        $('#btn-sebelumnya').removeClass('hide');
                        $('#btn-selanjutnya').removeClass('hide');
                    }

                }else if(data.data==2){
                    window.location.reload();
                }
                $("#modal-proses").modal('hide');
            },
            error: function(xmlhttprequest, textstatus, message) {
                if(textstatus==="timeout") {
                    $("#modal-proses").modal('hide');
                    notify_error("Gagal mengambil Soal, Silahkan Refresh Halaman");
                }else{
                    $("#modal-proses").modal('hide');
                    notify_error(textstatus);
                }
            }
        });
    }
</script>

<script type="text/javascript">

    function ragu(){
        $("#modal-proses").modal('show');

        $.ajax({
            url:'<?php echo site_url().'/'.$url; ?>/get_tes_soal_by_tessoal/'+$('#tes-soal-id').val(),
            type:"POST",
            cache: false,
            timeout: 10000,
            success:function(respon){
                var data = $.parseJSON(respon);
                if(data.data==1){
                    // Mengubah nilai ragu-ragu di database
                    if($('#tes-soal-ragu').val()==0){
                        var ragu=1;
                    }else{
                        var ragu=0;
                    }
                    $.ajax({
                            url:'<?php echo site_url().'/'.$url; ?>/update_tes_soal_ragu/'+$('#tes-soal-id').val()+'/'+ragu,
                            type:"POST",
                            cache: false,
                            timeout: 5000,
                            success:function(respon){
                                var data = $.parseJSON(respon);
                                if(data.data==1){
                                    notify_success('Jawaban Ragu-ragu berhasil diubah');
                                }
                            },
                            error: function(xmlhttprequest, textstatus, message) {
                                if(textstatus==="timeout") {
                                    $("#modal-proses").modal('hide');
                                    notify_error("Gagal mengubah Soal, Silahkan Refresh Halaman");
                                }else{
                                    $("#modal-proses").modal('hide');
                                    notify_error(textstatus);
                                }
                            }
                    });

                    // Mengubah warna daftar soal dan checkbox pada tombol ragu-ragu
                    if(data.tessoal_dikerjakan==1){
                        if($('#tes-soal-ragu').val()==0){
                            // Membuat menjadi ragu-ragu
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-primary');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-warning');
                            $('#btn-ragu-checkbox').prop("checked", true);
                            $('#tes-soal-ragu').val(1);
                        }else{
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-warning');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-primary');
                            $('#btn-ragu-checkbox').prop("checked", false);
                            $('#tes-soal-ragu').val(0);
                        }
                    }else{
                        if($('#tes-soal-ragu').val()==0){
                            // Membuat menjadi ragu-ragu
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-default');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-warning');
                            $('#btn-ragu-checkbox').prop("checked", true);
                            $('#tes-soal-ragu').val(1);
                        }else{
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-warning');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-default');
                            $('#btn-ragu-checkbox').prop("checked", false);
                            $('#tes-soal-ragu').val(0);
                        }
                    }
                }
                $("#modal-proses").modal('hide');
            },
            error: function(xmlhttprequest, textstatus, message) {
                if(textstatus==="timeout") {
                    $("#modal-proses").modal('hide');
                    notify_error("Gagal mengubah soal, Silahkan Refresh Halaman");
                }else{
                    $("#modal-proses").modal('hide');
                    notify_error(textstatus);
                }
            }
        });
    }

    

    function audio(status){
        var audio_player_status = $('#audio-player-status').val();
        var audio_player_update = $('#audio-player-update').val();
        if(status==1){
            if(audio_player_update==0){
                $('#audio-player-update').val('1');
                /**
                 * Update status audio jika pemutaran audio dibatasi
                 */
                $.getJSON('<?php echo site_url().'/'.$url; ?>/update_status_audio/'+$('#tes-soal-id').val(), function(data){
                    if(data.data==1){
                        notify_success(data.pesan);
                    }
                });
            }
        }
        
        if(audio_player_status==0){
            $('#audio-player-status').val('1');
            $('#audio-player').trigger('play');
            $('#audio-player-judul').html('Pause');
            $('#audio-player-judul-logo').removeClass('fa-play');
            $('#audio-player-judul-logo').addClass('fa-pause');
        }else{
            $('#audio-player-status').val('0');
            $('#audio-player').trigger('pause');
            $('#audio-player-judul').html('Play');
            $('#audio-player-judul-logo').removeClass('fa-pause');
            $('#audio-player-judul-logo').addClass('fa-play');
        }
    }

    function audio_ended(status){
        if(status==1){
            $('#audio-control').addClass('hide');
        }else{
            $('#audio-player-status').val('0');
            $('#audio-player-judul').html('Play');
            $('#audio-player-judul-logo').removeClass('fa-pause');
            $('#audio-player-judul-logo').addClass('fa-play');
        }
    }

    function jawab(){
        $('#form-kerjakan').submit();
    }

    function hentikan_tes(){
        $("#modal-proses").modal('show');
        $('#hentikan-centang').prop("checked", false);
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_tes_info/'+$('#tes-id').val(), function(data){
            if(data.data==1){
                $('#hentikan-tes-id').val(data.tes_id);
                $('#hentikan-tes-user-id').val(data.tes_user_id);
                $('#hentikan-tes-nama').val(data.tes_nama);
                $('#hentikan-dijawab').val(data.tes_dijawab+" dijawab. "+data.tes_blum_dijawab+" belum dijawab.");
                $('#hentikan-belum-dijawab').val(data.tes_blum_dijawab);


                $("#modal-hentikan").modal('show');
            }else{
                window.location.reload();
            }
            $("#modal-proses").modal('hide');
        });
    }

    

    $(function () {
        var sisa_detik = <?php if(!empty($detik_berjalan)){ echo $detik_berjalan; } ?>;
        setInterval(function() {
            var sisa_menit = Math.round(sisa_detik/60);
            sisa_detik = sisa_detik-1;
            $("#sisa-waktu").html("Sisa Waktu : "+sisa_menit+" menit");

            if(sisa_detik<1){
                window.location.reload();
            }
        }, 1000);

        $('#btn-sebelumnya').click(function(){
            soal_navigasi(-1);
        });

        $('#btn-selanjutnya').click(function(){
            soal_navigasi(1);
        });

        $('#btn-hentikan').click(function(){
            hentikan_tes();
        });
        /**
         * Submit form soal saat sudah menjawab
         */
        $('#form-kerjakan').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/simpan_jawaban",
                    type:"POST",
                    data:$('#form-kerjakan').serialize(),
                    cache: false,
                    timeout: 10000,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            notify_success(obj.pesan);
                            $('#btn-soal-'+obj.nomor_soal).removeClass('btn-default');
                            $('#btn-soal-'+obj.nomor_soal).removeClass('btn-warning');
                            $('#btn-soal-'+obj.nomor_soal).addClass('btn-primary');
                        }else if(obj.status==2){
                            window.location.reload();
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menyimpan jawaban, Silahkan Refresh Halaman");
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });
            return false;
        });

        /**
         * Submit form hentikan tes
         */
        $('#form-hentikan').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hentikan_tes",
                    type:"POST",
                    data:$('#form-hentikan').serialize(),
                    cache: false,
                    timeout: 10000,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            window.location.reload();
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menghentikan Tes, Silahkan Refresh Halaman");
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });
            return false;
        });

        $( document ).ready(function() {
            
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        var serverTime = <?php if(!empty($timestamp)){ echo $timestamp; } ?>;
        var counterTime=0;
        var date;

        setInterval(function() {
          date = new Date();

          serverTime = serverTime+1;

          date.setTime(serverTime*1000);
          time = date.toLocaleTimeString();
          $("#timestamp").html(time);
        }, 1000);
    });
  </script>

<?php $this->load->view('teknisi/v_footer')?>