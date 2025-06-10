<?php 
echo $this->session->flashdata('pesan'); 
if ($this->session->userdata('tema') == 'black') {
  $color = 'white';
}
else{
  $color = 'black';
}
?>
<!-- data topik -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Ubah password akun saya</h4>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;">Password lama</label>
                <input type="password" name="lama" class="form-control" style="color: <?php echo $color; ?>" required="required">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;">Password baru</label>
                <input type="password" name="baru" class="form-control" style="color: <?php echo $color; ?>" required="required">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;">Konfirmasi password</label>
                <input type="password" name="konfirmasi" class="form-control" style="color: <?php echo $color; ?>" required="required">
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