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
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Riwayat bimbingan</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Tanggal</th>
              <th>NPM</th>
              <th>Nama mahasiswa</th>
              <th>Materi bimbingan <small></th>
              <th>Status</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($data as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.tgl_indo($value['tanggal']).'</td>';
                  echo '<td>'.$value['npm'].'</td>';
                  echo '<td>'.$value['nama'].'</td>';
                  echo '<td>'.$value['materi'].'</td>';
                  echo '<td>'.statusBimbingan($value['status']).'</td>';
                  echo '<td class="text-center">';
                  if ($value['status'] == 0) {
                  ?>
                    <a href="<?php echo base_url().'dosen/bimbingan/validasi/'.$value['id']; ?>" class="btn btn-primary" onclick="return confirm('Validasi bimbingan <?php echo $value['materi']; ?> ?');">Validasi</a>
                  <?php
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