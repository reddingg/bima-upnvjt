<div class="card">
  <div class="card-header card-header-success">
    <h4 class="text-center card-title">Reset password</h4>
  </div>
  <div class="card-body">
    <form method="post" action="<?php echo base_url(); ?>auth/reset">
      <div class="row">
        <div class="col-md">
          <div class="form-group bmd-form-group">
            <input type="text" value="<?php echo $this->uri->segment('3'); ?>" placeholder="Password baru" class="form-control" disabled="disabled">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="email" value="<?php echo $this->uri->segment('3'); ?>">
            <input type="hidden" name="kode" value="<?php echo $this->uri->segment('4'); ?>">
          </div>
          <div class="form-group bmd-form-group">
            <input type="password" name="password" placeholder="Password baru" class="form-control" required="required" style="background-image: linear-gradient(to top, #47a44b 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);">
            <?php echo $this->session->flashdata('password'); ?>
          </div>
          <div class="form-group bmd-form-group">
            <input type="password" name="konfirmasi" placeholder="Konfirmasi password" class="form-control" required="required" style="background-image: linear-gradient(to top, #47a44b 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);">
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success mx-auto d-block">Simpan</button>
      <div class="row mx-auto d-block" align="center" style="margin-top: 1rem;">
      	<a class="text-secondary" href="<?php echo base_url(); ?>bima/masuk">Masuk</a>&nbsp;&nbsp;
      	<a class="text-secondary" href="<?php echo base_url(); ?>bima/daftar">Daftar</a>
      </div>
    </form>
  </div>
</div>