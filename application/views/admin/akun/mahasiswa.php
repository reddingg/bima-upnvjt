<?php
$uri = $this->uri->segment('3');

function tahap($tahap, $alur)
{
  $no = 0;
  foreach ($alur as $value) {
    if ($no == $tahap) {
      return $value['judul'];
    }
    $no++;
  }
}
?>
<div class="row">
  <div class="col-md-12">
    <?php echo $this->session->flashdata('pesan'); ?>
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">Tambah</button>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar akun <?php echo $uri; ?></h4>
        <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>No.Induk</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Status</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($data as $value) {
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . @$value['no_induk'] . @$value['npm'] . '</td>';
                echo '<td>' . @$value['nama'] . '</td>';
                echo '<td>' . $value['email'] . '</td>';
                echo '<td>' . tahap($value['tahap'], $alur) . '</td>';
                echo '<td class="text-center">';
              ?>
                <a title="Detail" href="<?php echo base_url() . 'admin/akun/detail/' . $value['id']; ?>" class="btn btn-primary"><i class="far fa-file-alt"></i></a>
                <a title="Ubah" href="<?php echo base_url() . 'admin/akun/' . $uri . '/ubah/' . $value['id']; ?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                <a title="Hapus" href="<?php echo base_url() . 'admin/akun/' . $uri . '/hapus/' . $value['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus akun <?php echo @$value['nama']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
                <a title="Aktif" href="<?php echo base_url() . 'admin/akun/' . $uri . '/aktif/' . $value['id']; ?>" class="btn btn-light" onclick="return confirm('Aktifkan akun <?php echo @$value['nama']; ?> ?');"><i class="fas fa-toggle-on"></i></a>
                <a title="Nonaktif" href="<?php echo base_url() . 'admin/akun/' . $uri . '/nonaktif/' . $value['id']; ?>" class="btn btn-danger" onclick="return confirm('Non-Aktifkan akun <?php echo @$value['nama']; ?> ?');"><i class="fas fa-toggle-off"></i></a>
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
if (@$ubah['email'] != '') {
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
    $(window).on("load", function() {
      $("#exampleModalCenterUbah").modal("show");
    });
  </script>
<?php

}

?>