<?php 
$uri = $this->uri->segment('2'); 

function tgl_indo($tanggal){
  $tanggal = explode(' ', $tanggal);
  $jam   = $tanggal[1];
  $tanggal = $tanggal[0];

  $bulan = array (
    1 =>   'Januari','Februari','Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0].' - '.$jam;
}
?>

<div class="sidebar" data-color="purple" data-background-color="<?php echo $this->session->userdata('tema'); ?>" data-image="<?php echo base_url(); ?>assets/img/bg.png">
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      <img src="<?php echo base_url(); ?>assets/img/logo/bima.png" class="img-fluid" alt="Responsive image">
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item <?php if($uri == 'dashboard') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>mahasiswa">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'profil') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>mahasiswa/profil">
          <i class="material-icons">person</i>
          <p>Profil</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'topik') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>mahasiswa/topik">
          <i class="material-icons">content_paste</i>
          <p>Topik</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'dokumen') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>mahasiswa/dokumen">
          <i class="material-icons">library_books</i>
          <p>Berkas</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'bimbingan') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>mahasiswa/bimbingan">
          <i class="material-icons">view_list</i>
          <p>Bimbingan</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'riwayat') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>mahasiswa/riwayat">
          <i class="material-icons">restore</i>
          <p>Riwayat</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'kuota') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>mahasiswa/kuota">
          <i class="material-icons">bar_chart</i>
          <p>Kuota Dosen</p>
        </a>
      </li>
      <li class="nav-item <?php if($uri == 'histori') { echo 'active'; }?>">
        <a class="nav-link" href="<?php echo base_url(); ?>mahasiswa/histori">
          <i class="material-icons">menu_book</i>
          <p>Histori judul</p>
        </a>
      </li>
    </ul>
  </div>
</div>

<div class="modal fade" id="pemberitahuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Pemberitahuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="overflow: auto; max-height: 20rem;">
        <?php 
        foreach ($pemberitahuan as $value) {
          echo '<small>'.tgl_indo($value['tanggal']).'</small><p>'.$value['pesan'].'</p>
                <div class="dropdown-divider"></div>';
        }
        ?>
      </div>
      <form method="post" style="height: 4rem;">
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-warning" name="pemberitahuan">Sudah dibaca</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
  foreach ($pemberitahuan as $value) { //jika ada pesan belum dibaca maka akan muncul modal
    if ($value['status'] == '0') {
      echo '<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script>
              $(window).on("load",function(){
                  $("#pemberitahuan").modal("show");
                });
            </script>';
      break;
    }
  }
?>