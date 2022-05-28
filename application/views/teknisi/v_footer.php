      <footer class="main-footer no-print">
        <div class="pull-right hidden-xs">
           | <strong> <a href="<?php echo base_url(); ?>login/logout" >Log out</a></strong>
        </div>
        <strong>Copyright &copy; 2020 <a href="http://rama-conelo03.epizy.com">Ramadhan</a>.</strong> All rights reserved.<!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->

    <div class="modal" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <?php echo form_open('tes_dashboard/password','id="form-password"')?>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ubah Password</h4>
          </div>
          <div class="modal-body">
                <span id="form-pesan-password"></span>
                <div class="box-body">
                  <div class="form-group">
                    <label>Old Password</label>
                    <input type="password" class="form-control" id="password-old" name="password-old" placeholder="Old Password">
                  </div>
                  <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control" id="password-new" name="password-new" placeholder="New Password">
                  </div>
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="password-confirm" name="password-confirm" placeholder="Confirm Password">
                  </div>
                </div>  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="password-submit">Ubah Password</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
      <?php echo form_close(); ?> 
    </div><!-- /.modal -->
    
    <div class="modal" id="modal-proses" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div style="text-align: center;">
              <img width="50" src="<?php echo base_url(); ?>public/images/loading.gif" /> <br />Data Sedang diproses...              
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


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

        $('#modal-password').on('shown.bs.modal', function (e) {
          $('#form-pesan-password').html('');
          $('#password-old').val('');
          $('#password-new').val('');
          $('#password-confirm').val('');
          $('#password-old').focus();
        });
        
        $('#form-password').submit(function(){        
          $.ajax({
            url:"<?php echo site_url()?>/tes_dashboard/password",
            type:"POST",
            data:$('#form-password').serialize(),
            cache: false,
            success:function(respon){
              var obj = $.parseJSON(respon);
              if(obj.status==1){
                $('#form-pesan-password').html('');
                $('#modal-password').modal('hide');
                notify_success('Password berhasil diubah');
              }else{
                $('#form-pesan-password').html(pesan_err(obj.error));
              }
            }
          });
          return false;
        });
    });
  </script>


  </body>
</html>
