<?php  
function dosen($id, $dosen){
  foreach ($dosen as $value) {
    if ($value['id'] == $id) {
      return $value['nama'];
    }
  }
}

function tgl_indo2($tanggal){
  $bulan = array (
    1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
  );
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function statusBimbingan($value){
  if ($value == 1) { return 'Divalidasi oleh dosen '; }
  elseif ($value == 2) { return 'Divalidasi oleh admin'; }
  else { return 'Belum divalidasi'; }
}
?>

<div class="row">
  <div class="col-md-12">
    <?php echo $this->session->flashdata('pesan'); ?>
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">Tambah</button>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar bimbingan</h4>
        <p class="card-category">Bimbingan ini dapat dilihat oleh Admin, Pimpinan, dan Dosen</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>Tanggal</th>
              <th>Dosen</th>
              <th>Materi bimbingan <small>(Minimal bimbingan 6 kali)</small></th>
              <th>Status</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($bimbingan as $value) {
                  echo '<tr>';
                  echo '<td>'.tgl_indo2($value['tanggal']).'</td>';
                  echo '<td>'.dosen($value['id_dosen'],$dosen).'</td>';
                  echo '<td>'.$value['materi'].'</td>';
                  echo '<td>'.statusBimbingan($value['status']).'</td>';
                  echo '<td class="text-center">';
                  ?>
                    <a title="Hapus" href="<?php echo base_url().'mahasiswa/bimbingan/hapus/'.$value['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus bimbingan <?php echo $value['materi']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah bimbingan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
        <div class="modal-body">
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Tanggal</label>
              <input type="date" class="form-control" name="tanggal" required="required">
            </div>
            <div class="form-group" style="margin-top: 0rem;">
              <label style="color: #AAAAAA; top: -1rem;">Dosen pembimbing</label>
              <select class="form-control" name="dosen" required="required">
                <?php 
                  echo '<option value="'.$topik['id_dosen_1'].'">'.dosen($topik['id_dosen_1'],$dosen).'</option>';
                  echo '<option value="'.$topik['id_dosen_2'].'">'.dosen($topik['id_dosen_2'],$dosen).'</option>';
                ?>
              </select>
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Materi bimbingan</label>
              <input type="text" class="form-control" name="materi" required="required">
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
