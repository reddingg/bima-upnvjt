<?php  
if ($this->session->userdata('tema') == 'black') {
  $color = 'white';
}
else{
  $color = 'black';
}

function dosen($id, $dosen){
  foreach ($dosen as $value) {
    if ($value['id'] == $id) {
      return $value['nama'];
    }
  }
}

function tgl_indo($tanggal){
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
    <div class="card card-body">
      <div class="row">
        <div class="col">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Nama</label>
            <input type="text" value="<?php echo $data['nama']; ?>" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
          </div>
        </div>
        <div class="col">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">NPM</label>
            <input type="text" name="kuota1" value="<?php echo $data['npm']; ?>" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar bimbingan</h4>
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
                  echo '<td>'.tgl_indo($value['tanggal']).'</td>';
                  echo '<td>'.dosen($value['id_dosen'],$dosen).'</td>';
                  echo '<td>'.$value['materi'].'</td>';
                  echo '<td>'.statusBimbingan($value['status']).'</td>';
                  echo '<td class="text-center">';
                  if ($value['status'] == 0) {
                    if ($this->session->userdata('role') == 'admin') {
                  ?>
                    <a href="<?php echo base_url().'admin/akun/bimbingan/'.$data['id'].'/validasi/'.$value['id']; ?>" class="btn btn-primary" onclick="return confirm('Validasi bimbingan <?php echo $value['materi']; ?> ?');">Validasi</a>
                  <?php
                    }
                    else{
                  ?>
                    <a href="<?php echo base_url().'dosen/mahasiswa/bimbingan/'.$data['id'].'/validasi/'.$value['id']; ?>" class="btn btn-primary" onclick="return confirm('Validasi bimbingan <?php echo $value['materi']; ?> ?');">Validasi</a>
                  <?php
                    }
                  }
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
