  <?php 
  echo $this->session->flashdata('pesan'); 
  if ($this->session->userdata('tema') == 'black') { $color = 'white'; }
  else { $color = 'black'; }
  ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Profil saya</h4>
      </div>
      <div class="card-body">
    <form method="post">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Email</label>
            <input type="email" value="<?php echo $profil['email']; ?>" class="form-control" disabled="disabled" style="color: <?php echo $color; ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">No. Induk / NIDN</label>
            <input type="text" name="no" value="<?php echo $profil['no_induk']; ?>" class="form-control" style="color: <?php echo $color; ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Nama lengkap</label>
            <input type="text" name="nama" value="<?php echo $profil['nama']; ?>" class="form-control" style="color: <?php echo $color; ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Laboratorium</label>
            <select class="form-control" name="lab" required="required" style="margin-top: -0.3rem; color: <?php echo $color; ?>">
              <?php
                foreach ($lab as $value) {
                  if ($value['id'] == $profil['id_laboratorium']) {
                    echo '<option selected value="'.$value['id'].'">'.$value['nama'].'</option>';
                  }
                  else{
                    echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                  }
                }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Status Lektor</label>
            <select class="form-control" name="status_lektor" required="required" style="margin-top: -0.3rem; color: <?php echo $color; ?>">
              <?php
                foreach ($status_lektor as $value) {
                  if ($value['id'] == $profil['id_status_lektor']) {
                    echo '<option selected value="'.$value['id'].'">'.$value['nama'].'</option>';
                  }
                  else{
                    echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                  }
                }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Kuota pembimbing 1</label>
            <input type="text" value="<?php echo $profil['kuota_pembimbing_1']; ?>" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
            <small style="color: #000;">
              Aktif: <?php echo $kuota_aktif_1 ?? 0; ?> |
              Proses: <?php echo $kuota_proses_1 ?? 0; ?> |
              Sisa: <?php echo $sisa_kuota_1 ?? 0; ?>
            </small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Kuota pembimbing 2</label>
            <input type="text" value="<?php echo $profil['kuota_pembimbing_2']; ?>" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
            <small style="color: #000;">
              Aktif: <?php echo $kuota_aktif_2 ?? 0; ?> |
              Proses: <?php echo $kuota_proses_2 ?? 0; ?> |
              Sisa: <?php echo $sisa_kuota_2 ?? 0; ?>
            </small>
          </div>
        </div>
      </div>
      <button type="submit" name="simpan-ubah" class="btn btn-warning pull-right">Simpan</button>
      <div class="clearfix"></div>
    </form>
  </div>
    </div>
  </div>
</div>