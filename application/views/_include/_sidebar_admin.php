<?php $uri = $this->uri->segment('2'); ?>

<div class="sidebar" data-color="purple" data-background-color="<?php echo $this->session->userdata('tema'); ?>" data-image="<?php echo base_url(); ?>assets/img/bg.png">
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      <img src="<?php echo base_url(); ?>assets/img/logo/bima.png" class="img-fluid" alt="Responsive image">
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item <?php if($uri == 'dashboard') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'pengajuan') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/pengajuan">
          <i class="material-icons">assignment</i>
          <p>pengajuan</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'riwayat') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/riwayat">
          <i class="material-icons">history</i>
          <p>Riwayat</p>
        </a>
      </li>
      <li class="nav-item dropdown <?php if($uri == 'akun') { echo 'active'; }?>">
        <a class="nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="material-icons">group</i>
          <p>Akun</p>
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a style="color: black;" class="dropdown-item" href="<?php echo base_url(); ?>admin/akun/admin">Admin</a>
          <a style="color: black;" class="dropdown-item" href="<?php echo base_url(); ?>admin/akun/pimpinan">Pimpinan</a>
          <a style="color: black;" class="dropdown-item" href="<?php echo base_url(); ?>admin/akun/dosen">Dosen</a>
          <a style="color: black;" class="dropdown-item" href="<?php echo base_url(); ?>admin/akun/mahasiswa">Mahasiswa</a>
        </div>
      </li>
      <li class="nav-item <?php if($uri == 'kuota') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/kuota">
          <i class="material-icons">bar_chart</i>
          <p>Kuota Dosen</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'jadwal') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/jadwal">
          <i class="material-icons">date_range</i>
          <p>Jadwal</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'dokumen') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/dokumen">
          <i class="material-icons">library_books</i>
          <p>Berkas</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'laboratorium') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/laboratorium">
          <i class="material-icons">desktop_windows</i>
          <p>Lab & Bidang</p>
        </a>
      </li>
      <!-- <li class="nav-item <?php if($uri == 'saw') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/saw">
          <i class="material-icons">bubble_chart</i>
          <p>Pembobotan mahasiswa</p>
        </a>
      </li> -->
      <li class="nav-item <?php if($uri == 'email') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/email">
          <i class="material-icons">email</i>
          <p>Email</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'berita') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/berita">
          <i class="material-icons">forum</i>
          <p>Berita</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'alur') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/alur">
          <i class="material-icons">swap_callss</i>
          <p>Alur</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'faq') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/faq">
          <i class="material-icons">view_list</i>
          <p>FAQ</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'histori') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/histori">
          <i class="material-icons">menu_book</i>
          <p>Histori judul</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'kontak') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin/kontak">
          <i class="material-icons">contact_mail</i>
          <p>Kontak</p>
        </a>
      </li>
    </ul>
  </div>
</div>