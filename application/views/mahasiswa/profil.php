  <?php
  echo $this->session->flashdata('pesan');
  if ($this->session->userdata('tema') == 'black') {
    $color = 'white';
  } else {
    $color = 'black';
  }
  ?>

  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-warning">
          <h4 class="card-title">Profil saya</h4>
          <p class="card-category">Profil ini dapat dilihat oleh Admin, Pimpinan, dan Dosen</p>
        </div>
        <div class="card-body">
          <form method="post" action="<?php echo base_url(); ?>mahasiswa/profil" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Email</label>
                  <input type="email" value="<?php echo $data['email']; ?>" required="required" class="form-control" disabled="disabled" style="color: <?php echo $color; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">NPM</label>
                  <input type="text" name="npm" value="<?php echo $data['npm']; ?>" required="required" class="form-control" style="color: <?php echo $color; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Nama lengkap</label>
                  <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required="required" class="form-control" style="color: <?php echo $color; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">No. Handphone / Whatsapp</label>
                  <input type="text" name="nohp" value="<?php echo $data['no_hp']; ?>" required="required" class="form-control" style="color: <?php echo $color; ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">ID Telegram</label>
                  <input type="text" name="telegram" value="<?php echo $data['telegram']; ?>" class="form-control" style="color: <?php echo $color; ?>">
                </div>
              </div>
            </div>
            <div class="row" style="margin-top: 1rem;">
              <div class="col">
                <div class="form-group bmd-form-group">
                  <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Jenis kelamin</label>
                  <select class="form-control" name="jeniskelamin" required="required" style="margin-top: -0.3rem; color: <?php echo $color; ?>">
                    <option <?php if ($data['jenis_kelamin'] == '1') {
                              echo "selected";
                            } ?> value="1">Laki-laki</option>
                    <option <?php if ($data['jenis_kelamin'] == '0') {
                              echo "selected";
                            } ?> value="0">Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="form-group bmd-form-group">
                  <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Jumlah SKS</label>
                  <input name="sks" value="<?php echo $data['jumlah_sks']; ?>" type="text" required="required" class="form-control" style="color: <?php echo $color; ?>">
                </div>
              </div>
              <div class="col">
                <div class="form-group bmd-form-group">
                  <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">IPK (contoh : 3.25)</label>
                  <input name="ipk" value="<?php echo $data['ipk']; ?>" type="text" required="required" class="form-control" style="color: <?php echo $color; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Alamat</label>
                  <input name="alamat" value="<?php echo $data['alamat']; ?>" type="text" required="required" class="form-control" style="color: <?php echo $color; ?>">
                </div>
              </div>
            </div>
            <button type="submit" name="simpan-ubah" class="btn btn-warning pull-right">Simpan</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-profile">
        <div class="card-avatar">
          <a href="#">
            <?php
            $lokasiFile = base_url() . 'data/profil/mahasiswa/' . $data['foto'];
            if ($data['foto'] != '') {
              echo '<img class="img" src="' . $lokasiFile . '">';
            } else {
              echo '<img class="img" src="' . base_url() . 'assets/img/profile.png">';
            }
            ?>
          </a>
        </div>
        <div class="card-body">
          <form method="post" action="<?php echo base_url(); ?>mahasiswa/profil" enctype="multipart/form-data">
            <input type="hidden" name="namaFile" value="<?php echo $data['foto']; ?>">
            <input class="form-control" type="file" name="file" accept="image/*" style="margin-bottom: 1rem; color: <?php echo $color; ?>">
            <h4 class="card-title"><?php echo $data['nama']; ?></h4>
            <h6 class="card-category text-gray">Mahasiswa</h6>
            <button class="btn btn-warning btn-round" name="simpan-foto" type="submit">Ubah foto</button>
          </form>
        </div>
      </div>
    </div>
  </div>