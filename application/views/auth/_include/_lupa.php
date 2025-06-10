<div class="card">
  <div class="card-header card-header-success">
    <h4 class="text-center card-title">Lupa password</h4>
  </div>
  <div class="card-body">
    <form method="post" action="<?php echo base_url(); ?>auth/lupa">
      <div class="row">
        <div class="col-md">
          <div class="form-group bmd-form-group">
            <input type="email" name="email" placeholder="Email" class="form-control" required="required" style="background-image: linear-gradient(to top, #47a44b 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);">
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success mx-auto d-block">Kirim</button>
      <div class="row mx-auto d-block" align="center" style="margin-top: 1rem;">
      	<a class="text-secondary" href="<?php echo base_url(); ?>bima/masuk">Masuk</a>&nbsp;&nbsp;
      	<a class="text-secondary" href="<?php echo base_url(); ?>bima/daftar">Daftar</a>
      </div>
    </form>
  </div>
</div>