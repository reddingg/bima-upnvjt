<?php
if ($this->session->userdata('tema') == 'black') {
  $color = 'white';
}
else{
  $color = 'black';
}

function tgl_indo2($tanggal){
  $bulan = array (
    1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
  );
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function hasil($value){
  if      ($value == 1) { $value = 'Ditolak'; }
  elseif  ($value == 2) { $value = 'Diterima'; }
  else    { $value = 'Dalam proses'; }
  return $value;
}

function dosen($id, $dosen){
  foreach ($dosen as $value) {
    if ($value['id'] == $id) {
      return $value['nama'];
    }
  }
}

function tahap($tahap, $alur){
  $no=0;
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
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar riwayat</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Pembimbing 1</th>
                <th>Pembimbing 2</th>
                <th>Penguji 1</th>
                <th>Penguji 2</th>
                <th>Penguji 3</th>
                <th>Hasil</th>
                <th>Keterangan</th>
                <th>Tahap</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($riwayat as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.tgl_indo2($value['tanggal']).' '.$value['jam'].'</td>';
                  echo '<td>'.$value['judul'].'</td>';
                  echo '<td>'.dosen($value['id_dosen_1'], $dosen).'</td>';
                  echo '<td>'.dosen($value['id_dosen_2'], $dosen).'</td>';
                  echo '<td>'.dosen($value['penguji_1'], $dosen).'</td>';
                  echo '<td>'.dosen($value['penguji_2'], $dosen).'</td>';
                  echo '<td>'.dosen($value['penguji_3'], $dosen).'</td>';
                  echo '<td>'.hasil($value['status']).'</td>';
                  echo '<td>'.$value['keterangan'].'</td>';
                  echo '<td>'.tahap($value['tahap'],$alur).'</td>';
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