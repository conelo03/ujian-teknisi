<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Utama</li>
        <?php if ($judul == 'Dashboard') {?>
        <li class="active">
        <?php } else {?>
        <li class="">
        <?php }?>
          <a href="<?php echo base_url().'admin/dashboard.html'?>">
            <i class="fa fa-home"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>

        <?php if ($judul == 'Data User') {?>
        <li class="active">
        <?php } else {?>
        <li class="">
        <?php }?>
          <a href="<?php echo base_url().'admin/data-pengguna.html'?>">
            <i class="fa fa-users"></i> <span>Data Pengguna</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>

        <?php if ($judul == 'Data Soal Pilihan Ganda' || $judul == 'Data Soal Essai' || $judul == 'Materi Ujian Praktek' || $judul == 'Kategori Soal' || $judul == 'Komponen Ujian Praktek' || $judul == 'Sub Komponen Ujian Praktek') {?>
        <li class="treeview active">
        <?php } else {?>
        <li class="treeview">
        <?php }?>
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Bank Soal</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'admin/soal-pilihan-ganda.html'?>"><i class="fa fa-book"></i> Soal Pilihan Ganda</a></li>
            <li><a href="<?php echo base_url().'admin/soal-essai.html'?>"><i class="fa fa-book"></i> Soal Essai</a></li>
            <li><a href="<?php echo base_url().'admin/materi-ujian-praktek.html'?>"><i class="fa fa-book"></i> Materi Ujian Praktek</a></li>
            <li><a href="<?php echo base_url().'admin/kategori-soal.html'?>"><i class="fa fa-book"></i> Kategori Soal</a></li>
            <li><a href="<?php echo base_url().'Admin/Bank_soal/komponen_uprak'?>"><i class="fa fa-book"></i> Komponen Ujian Praktek</a></li>
          </ul>
        </li>

        <?php if ($judul == 'Data Ujian') {?>
        <li class="active">
        <?php } else {?>
        <li class="">
        <?php }?>
          <a href="<?php echo base_url().'admin/data-ujian.html'?>">
            <i class="fa fa-file"></i> <span>Data Ujian</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>

        <?php if ($judul == 'Data Akumulasi Pilihan Ganda' || $judul == 'Data Akumulasi Essai' || $judul == 'Data Akumulasi Ujian Praktek' || $judul == 'Data Akumulasi Nilai' || $judul == 'Data Subkomponen Uprak') {?>
        <li class="treeview active">
        <?php } else {?>
        <li class="treeview">
        <?php }?>
          <a href="#">
            <i class="fa fa-pencil"></i>
            <span>Data Nilai</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'admin/data-hasil-ujian-pg.html'?>"><i class="fa fa-pencil"></i> Nilai Pilihan Ganda</a></li>
            <li><a href="<?php echo base_url().'admin/data-hasil-ujian-essai.html'?>"><i class="fa fa-pencil"></i> Nilai Essai</a></li>
            <li><a href="<?php echo base_url().'admin/data-hasil-ujian-praktek.html'?>"><i class="fa fa-pencil"></i> Nilai Ujian Praktek</a></li>
            <li><a href="<?php echo base_url().'admin/nilai-akumulasi.html'?>"><i class="fa fa-pencil"></i> Nilai Akumulasi</a></li>
          </ul>
        </li>

        <?php if ($judul == 'Data Klasterisasi' || $judul == 'Data Peringkat') {?>
        <li class="treeview active">
        <?php } else {?>
        <li class="treeview">
        <?php }?>
          <a href="#">
            <i class="fa fa-list"></i>
            <span>Data Klasterisasi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'Admin/Klasterisasi'?>"><i class="fa fa-list"></i> Data Klasterisasi</a></li>
            <li><a href="<?php echo base_url().'Admin/Klasterisasi/peringkat'?>"><i class="fa fa-trophy"></i> Data Peringkat</a></li>
          </ul>
        </li>

        <?php if ($judul == 'Data Indikator Jabatan') {?>
        <li class="active">
        <?php } else {?>
        <li class="">
        <?php }?>
          <a href="<?php echo base_url().'admin/indikator-jabatan.html'?>">
            <i class="fa fa-user"></i> <span>Data Indikator Jabatan</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>

        <?php if ($judul == 'Laporan Hasil Ujian' || $judul == 'Laporan Hasil Klasterisasi') {?>
        <li class="treeview active">
        <?php } else {?>
        <li class="treeview">
        <?php }?>
          <a href="#">
            <i class="fa fa-file"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'Admin/Laporan/ujian'?>"><i class="fa fa-file"></i> Laporan Hasil Ujian</a></li>
            <li><a href="<?php echo base_url().'Admin/Laporan/Klasterisasi'?>"><i class="fa fa-file"></i> Laporan Hasil Klasterisasi</a></li>
          </ul>
        </li>
        
        <li>
          <a href="<?php echo base_url().'Login/logout'?>">
            <i class="fa fa-sign-out"></i> <span>Sign Out</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>