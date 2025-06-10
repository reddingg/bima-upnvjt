<div class="row">
  <div class="col-md-12">
  <?php echo $this->session->flashdata('pesan'); ?>
  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalBerita">Tambah</button>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar alur pengerjaan skripsi</h4>
        <p class="card-category"> Alur juga akan ditampilkan pada halaman alur bima</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Judul</th>
              <th>Icon</th>
              <th>Keterangan</th>
              <th>Daftar</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($data as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$value['judul'].'</td>';
                  echo '<td>'.'<i class="'.$value['icon'].'">&nbsp;&nbsp;</i>'.$value['icon'].'</td>';
                  echo '<td>'.substr($value['keterangan'], 0, 20).'</td>';
                  if ($value['daftar'] == 0) { $daftar = 'Tidak'; }
                  else { $daftar = 'Ya'; }
                  echo '<td>'.$daftar.'</td>';
                  echo '<td class="text-center">';
                  ?>
                    <a title="Ubah" href="<?php echo base_url().'admin/alur/ubah/'.$value['id']; ?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a title="Hapus" href="<?php echo base_url().'admin/alur/hapus/'.$value['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus alur <?php echo $value['judul']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
                  <?php
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

<!-- Modal alur -->
<div class="modal fade" id="modalBerita" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah alur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;">Judul</label>
            <input type="text" name="judul" class="form-control" required="required">
          </div>
          <div class="form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;">Icon</label>
            <input type="text" name="icon" class="form-control" required="required">
          </div>
          <div class="form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;">Keterangan</label>
            <!-- <textarea class="form-control" name="keterangan" rows="5"></textarea> -->
            <textarea name="keterangan" class="form-control" rows="10" id="tiny">  </textarea>
          </div>
          <div class="form-group">
            <label style="color: #AAAAAA; top: -1rem;">Status daftar</label>
            <select name="daftar" class="form-control" style="margin-top: -1rem;">
              <option value="0">Tidak</option>
              <option value="1">Ya</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" name="simpan" class="btn btn-warning">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
if (@$ubah['judul'] != '' ) {
  ?>
  <div class="modal fade" id="exampleModalCenterUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Ubah alur</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Judul</label>
              <input type="text" name="judul" value="<?php echo $ubah['judul'] ?>" class="form-control" required="required">
              <input type="hidden" value="<?php echo $ubah['id'] ?>" name="id">
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Icon</label>
              <input type="text" name="icon" value="<?php echo $ubah['icon'] ?>" class="form-control" required="required">
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Keterangan</label>
              <!-- <textarea class="form-control" name="keterangan" rows="5"><?php echo $ubah['keterangan'] ?></textarea> -->
              <textarea name="keterangan" class="form-control" rows="10" id="tiny2"><?php echo $ubah['keterangan']; ?>  </textarea>
            </div>
            <div class="form-group">
              <label style="color: #AAAAAA; top: -1rem;">Status daftar</label>
              <select name="daftar" class="form-control" style="margin-top: -1rem;">
                <option <?php if ($ubah['daftar'] == 0) { echo 'selected'; } ?> value="0">Tidak</option>
                <option <?php if ($ubah['daftar'] == 1) { echo 'selected'; } ?> value="1">Ya</option>
              </select>
            </div>
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

<script src="<?php echo base_url(); ?>assets/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
 selector: 'textarea#tiny'
});// Prevent Bootstrap dialog from blocking focusin

$(document).on('focusin', function(e) {
  if ($(e.target).closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
    e.stopImmediatePropagation();
  }
});

tinymce.init({
 selector: 'textarea#tiny2'
});// Prevent Bootstrap dialog from blocking focusin

$(document).on('focusin', function(e) {
  if ($(e.target).closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
    e.stopImmediatePropagation();
  }
});
</script>