<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="#">
        <?php
          $uri = $this->uri->segment('2');
          if (($uri == '') || ($uri == 'index')) {
            echo 'Dashboard';
          }else{
            echo ucwords($uri); 
          }
        ?>
      </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <form class="navbar-form">
        <span class="bmd-form-group"></span>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">settings</i>
            <p class="d-lg-none d-md-block">
              Akun
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <?php if ($this->uri->segment('1') == 'mahasiswa') {
              echo '<a class="dropdown-item navbar-toggler" href="#" data-toggle="modal" data-target="#pemberitahuan">Pemberitahuan</a>';
            } ?>
            <a class="dropdown-item" href="<?php echo base_url().'auth/tema'; ?>">Beralih tema</a>
            <a class="dropdown-item" href="<?php echo base_url().$this->session->userdata('role'); ?>/password">Ubah password</a>
            <a class="dropdown-item" href="<?php echo base_url(); ?>auth/keluar">Keluar</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
