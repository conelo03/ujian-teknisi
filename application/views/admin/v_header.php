<header class="main-header">

    <!-- Logo -->
    <a href="dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">UK</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">SI-UJIAN</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->

          <?php
              $id=$this->session->userdata('id');
              $q=$this->db->query("SELECT * FROM tb_user WHERE user_id='$id'");
              $c=$q->row_array();
          ?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url().'assets/images/user_blank.png';?>" class="user-image" alt="">
              <span class="hidden-xs"><?php echo $c['user_nama'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url().'assets/images/user_blank.png';?>" class="img-circle" alt="">

                <p>
                  <?php echo $c['user_nama'];?>
                  <?php if($c['user_level']=='1'):?>
                    <small>Administrator</small>
                  <?php else:?>
                    <small>Author</small>
                  <?php endif;?>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url().'Login/logout'?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?php echo base_url().'Login/logout'?>" title="Lihat Website"><i class="fa fa-globe"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
