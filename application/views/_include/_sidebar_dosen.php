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
        <a class="nav-link" href="<?php echo base_url(); ?>dosen">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'profil') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>dosen/profil">
          <i class="material-icons">person</i>
          <p>Profil</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'mahasiswa') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>dosen/mahasiswa">
          <i class="material-icons">group</i>
          <p>Mahasiswa</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'bimbingan') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>dosen/bimbingan">
          <i class="material-icons">view_list</i>
          <p>Bimbingan</p>
        </a>
      </li>
    </ul>
  </div>
</div>