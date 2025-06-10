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
        <a class="nav-link" href="<?php echo base_url(); ?>pimpinan">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'dosen') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>pimpinan/dosen">
          <i class="material-icons">person</i>
          <p>Dosen</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'mahasiswa') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>pimpinan/mahasiswa">
          <i class="material-icons">group</i>
          <p>Mahasiswa</p>
        </a>
      </li>
    </ul>
  </div>
</div>