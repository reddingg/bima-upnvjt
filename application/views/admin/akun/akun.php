<?php $uri = $this->uri->segment('3'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo $this->session->flashdata('pesan'); ?>
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">Tambah</button>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar akun <?php echo $uri; ?></h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>No.Induk</th>
              <th>Nama</th>
              <th>Email</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($data as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.@$value['no_induk'].@$value['npm'].'</td>';
                  echo '<td>'.@$value['nama'].'</td>';
                  echo '<td>'.$value['email'].'</td>';
                  if($value['id'] == 99){

                  }else{
                  echo '<td class="text-center">
                        <a title="Ubah" href="'.base_url()."admin/akun/".$uri."/ubah/".$value["id"].'" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>';
                  if ($no > 1 ) {
                  ?>
                    <a title="Hapus" href="<?php echo base_url().'admin/akun/'.$uri.'/hapus/'.$value['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus akun <?php echo @$value['nama']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
                  <?php
                  }}
                  echo '</tr>';
                  $no++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah akun <?php echo $uri; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url(); ?>admin/akun/<?php echo $uri; ?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group bmd-form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Nama</label>
            <input type="text" name="nama" class="form-control" required="required">
          </div>
          <div class="form-group bmd-form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Email</label>
            <input type="email" name="email" class="form-control" required="required">
            <?php echo $this->session->flashdata('email'); ?>
          </div>
          <div class="form-group bmd-form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Password</label>
            <input type="password" name="password" class="form-control" required="required">
            <?php echo $this->session->flashdata('password'); ?>
          </div>
          <div class="form-group bmd-form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Konfirmasi password</label>
            <input type="password" name="konfirmasi" class="form-control" required="required">
          </div>
          <?php if ($this->uri->segment('3') == 'dosen') { ?>
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Laboratorium</label>
            <select class="form-control" name="lab" required="required" style="margin-top: -0.3rem; color: <?php echo $color; ?>">
              <?php
                foreach ($lab as $value) {
                  echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                }
              ?>
            </select>
          </div>
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Status Lektor</label>
            <select class="form-control" name="status_lektor" required="required" style="margin-top: -0.3rem; color: <?php echo $color; ?>">
              <?php
                foreach ($status_lektor as $value) {
                  echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                }
              ?>
            </select>
          </div>
          <?php } ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning" name="simpan">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
if (@$ubah['email'] != '' ) {
	?>
	<div class="modal fade" id="exampleModalCenterUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalCenterTitle">Ubah akun <?php echo $uri; ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="post" action="<?php echo base_url(); ?>admin/akun/<?php echo $uri; ?>" enctype="multipart/form-data">
	        <div class="modal-body">
          <div class="form-group bmd-form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Nama</label>
            <input type="text" name="nama" value="<?php echo $ubah['nama']; ?>" name="email" class="form-control">
          </div>
          <div class="form-group bmd-form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Email</label>
            <input type="email" value="<?php echo $ubah['email']; ?>" name="email" class="form-control" disabled>
            <input type="hidden" name="id" value="<?php echo $ubah['id']; ?>">
          </div>
          <div class="form-group bmd-form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Password</label>
            <input type="password" name="password" class="form-control" required="required">
          </div>
          <div class="form-group bmd-form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Konfirmasi password</label>
            <input type="password" name="konfirmasi" class="form-control" required="required">
          </div>
          <?php if ($this->uri->segment('3') == 'dosen') { ?>
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Laboratorium</label>
            <select class="form-control" name="lab" required="required" style="margin-top: -0.3rem; color: <?php echo $color; ?>">
              <?php
                foreach ($lab as $value) {
                  if ($value['id'] == $ubah['id_laboratorium']) {
                    echo '<option selected value="'.$value['id'].'">'.$value['nama'].'</option>';
                  }
                  else{
                    echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                  }
                }
              ?>
            </select>
          </div>
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Status Lektor</label>
            <select class="form-control" name="status_lektor" required="required" style="margin-top: -0.3rem; color: <?php echo $color; ?>">
              <?php
                foreach ($status_lektor as $value) {
                  if ($value['id'] == $ubah['id_status_lektor']) {
                    echo '<option selected value="'.$value['id'].'">'.$value['nama'].'</option>';
                  } else {
                      echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';

                  }
                }
              ?>
            </select>
          </div>
          <?php } ?>
        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
	          <button type="submit" class="btn btn-warning" name="simpan-ubah">Ubah</button>
	        </div>
	      </form>
	    </div>
	  </div>
	</div>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script>
		$(window).on("load",function(){
	         $("#exampleModalCenterUbah").modal("show");
	    });
	</script>
	<?php

}

?>