<?php 
echo $this->session->flashdata('pesan'); 

function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
  );
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}
?>
<div class="row">
  <div class="col-md-12">
  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal">Tambah</button>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#impor">Import excel</button>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar histori judul skripsi</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table">
            <thead>
              <th>No.</th>
              <th>NPM</th>
              <th>Nama mahasiswa</th>
              <th>Judul skripsi</th>
              <th>Pembimbing 1</th>
              <th>Pembimbing 2</th>
              <th>Tanggal lulus</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no=1;
                foreach ($data as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$value['npm'].'</td>';
                  echo '<td>'.$value['nama'].'</td>';
                  echo '<td>'.$value['judul'].'</td>';
                  echo '<td>'.$value['pembimbing_1'].'</td>';
                  echo '<td>'.$value['pembimbing_2'].'</td>';
                  if (validateDate($value['tanggal_lulus'])) { echo '<td>'.tgl_indo($value['tanggal_lulus']).'</td>'; }
                  else{ echo '<td>'.$value['tanggal_lulus'].'</td>'; }
                  echo '<td class="text-center">';
                  ?>
                    <a title="Ubah" href="<?php echo base_url().'admin/histori/ubah/'.$value['id']; ?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a title="Hapus" href="<?php echo base_url().'admin/histori/hapus/'.$value['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus histori <?php echo $value['judul']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
                  <?php
                  echo '</td></tr>';
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
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah histori judul</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;">NPM</label>
                  <input name="npm" type="text" class="form-control" required="required">
                </div>
              </div>
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;">Nama mahasiswa</label>
                  <input name="nama" type="text" class="form-control" required="required">
                </div>
              </div>
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Judul skripsi</label>
              <input name="judul" type="text" class="form-control" required="required">
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;">Pembimbing 1</label>
                  <input name="pembimbing1" type="text" class="form-control" required="required">
                </div>
              </div>
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;">Pembimbing 2</label>
                  <input name="pembimbing2" type="text" class="form-control" required="required">
                </div>
              </div>
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Tanggal lulus</label>
              <input name="tanggal" type="date" class="form-control" required="required">
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

<div class="modal fade" id="impor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Impor data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <a href="<?php echo base_url().'data/import/format.xlsx'; ?>" class="btn btn-info">Download format</a><br>
          <label style="margin-top: 1rem;margin-bottom: 0;">Pilih file</label>
          <input type="file" name="file" class="form-control" required="required">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning" name="impor">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
if (@$ubah['judul'] != '' ) {
  ?>
  <div class="modal fade" id="modalubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Ubah histori judul</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;">NPM</label>
                  <input name="npm" value="<?php echo $ubah['npm']; ?>" type="text" class="form-control" required="required">
                  <input type="hidden" name="id" value="<?php echo $ubah['id']; ?>">
                </div>
              </div>
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;">Nama mahasiswa</label>
                  <input name="nama" value="<?php echo $ubah['nama']; ?>" type="text" class="form-control" required="required">
                </div>
              </div>
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Judul skripsi</label>
              <input name="judul" value="<?php echo $ubah['judul']; ?>" type="text" class="form-control" required="required">
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;">Pembimbing 1</label>
                  <input name="pembimbing1" value="<?php echo $ubah['pembimbing_1']; ?>" type="text" class="form-control" required="required">
                </div>
              </div>
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
                  <label style="color: #AAAAAA; top: -1rem;">Pembimbing 2</label>
                  <input name="pembimbing2" value="<?php echo $ubah['pembimbing_2']; ?>" type="text" class="form-control" required="required">
                </div>
              </div>
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Tanggal lulus</label>
              <input name="tanggal" value="<?php echo $ubah['tanggal_lulus']; ?>" type="date" class="form-control" required="required">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning" name="simpan-ubah">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script>
    $(window).on("load",function(){
           $("#modalubah").modal("show");
      });
  </script>
  <?php
}
?>