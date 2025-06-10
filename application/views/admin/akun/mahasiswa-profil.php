  <?php 
  echo $this->session->flashdata('pesan'); 
  if ($this->session->userdata('tema') == 'black') {
    $color = 'white';
  }
  else{
    $color = 'black';
  }
  ?>
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Profil mahasiswa</h4>
        <p class="card-category">Profil ini dapat dilihat oleh Admin, Pimpinan, Dosen, dan Mahasiswa</p>
      </div>
      <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Email</label>
            <input type="email" value="<?php echo $data['email']; ?>" class="form-control" disabled="disabled" style="color: <?php echo $color; ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">NPM</label>
            <input type="text" value="<?php echo $data['npm']; ?>" class="form-control" disabled="disabled" style="color: <?php echo $color; ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Nama lengkap</label>
            <input type="text" name="nama" value="<?php echo $data['nama']; ?>" disabled="disabled" class="form-control" style="color: <?php echo $color; ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">No. Handphone / Whatsapp</label>
            <input type="text" name="nohp" value="<?php echo $data['no_hp']; ?>" disabled="disabled" class="form-control" style="color: <?php echo $color; ?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Telegram</label>
            <input type="text" name="telegram" value="<?php echo $data['telegram']; ?>" disabled="disabled" class="form-control" style="color: <?php echo $color; ?>">
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 1rem;">
        <div class="col">
          <div class="form-group bmd-form-group">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Jenis kelamin</label>
            <select class="form-control" name="jeniskelamin" required="required" style="margin-top: -0.3rem; color: <?php echo $color; ?>" disabled="disabled">
              <option <?php if($data['jenis_kelamin'] == '1') { echo "selected"; } ?> value="1">Laki-laki</option>
              <option <?php if($data['jenis_kelamin'] == '0') { echo "selected"; } ?> value="0">Perempuan</option>
            </select>
          </div>
        </div>
        <div class="col">
          <div class="form-group bmd-form-group">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Jumlah SKS</label>
            <input name="sks" value="<?php echo $data['jumlah_sks']; ?>" type="text" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
          </div>
        </div>
        <div class="col">
          <div class="form-group bmd-form-group">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">IPK (contoh : 3.25)</label>
            <input name="ipk" value="<?php echo $data['ipk']; ?>" type="text" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Alamat</label>
            <input name="alamat" value="<?php echo $data['alamat']; ?>" type="text" value="" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
          </div>
        </div>
      </div>
  </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-profile">
      <div class="card-avatar">
        <a href="#">
          <?php
            $lokasiFile = base_url().'data/profil/mahasiswa/'.$data['foto'];
            if ($data['foto'] != '') {
              echo '<img class="img" src="'.$lokasiFile.'">';
            }
            else{
              echo '<img class="img" src="'.base_url().'assets/img/profile.png">';
            }
          ?>
        </a>
      </div>
      <div class="card-body">
          <h4 class="card-title"><?php echo $data['nama']; ?></h4>
          <h6 class="card-category text-gray">Mahasiswa</h6>
      </div>
    </div>
  </div>
</div>