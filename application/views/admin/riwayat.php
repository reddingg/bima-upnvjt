<?php 
function tgl_indo($tanggal){
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

function selisihTanggal($date){
  if ($date != '0000-00-00 00:00:00') {
    $date       = explode(' ', $date);
    $date       = $date[0];

    $date2      = date('Y-m-d');
    $datetime1  = new DateTime($date);
    $datetime2  = new DateTime($date2);
    $difference = $datetime1->diff($datetime2);
    return $difference->days;
  }
  return '0';
}
?>

<div class="row">
  <div class="col-md-12">
    <?php echo $this->session->flashdata('pesan'); ?>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Riwayat</h4>
     </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>NPM</th>
                <th>Nama</th>
                <th>Judul</th>
                <th>Pembimbing 1</th>
                <th>Pembimbing 2</th>
                <th>Penguji 1</th>
                <th>Penguji 2</th>
                <th>Penguji 3</th>
                <th>Hasil</th>
                <th>Keterangan</th>
                <th class="text-center"><i class="fas fa-cog"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($mhs as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.tgl_indo($value['tanggal']).'</td>';
                  echo '<td>'.$value['npm'].'</td>';
                  echo '<td>'.$value['nama'].'</td>';
                  echo '<td>'.$value['judul'].'</td>';
                  echo '<td>'.dosen($value['id_dosen_1'], $dosen).'</td>';
                  echo '<td>'.dosen($value['id_dosen_2'], $dosen).'</td>';
                  echo '<td>'.dosen($value['penguji_1'], $dosen).'</td>';
                  echo '<td>'.dosen($value['penguji_2'], $dosen).'</td>';
                  echo '<td>'.dosen($value['penguji_3'], $dosen).'</td>';
                  echo '<td>'.hasil($value['status']).'</td>';
                  echo '<td>'.$value['keterangan'].'</td>';
                  echo '<td class="text-center"><a title="Detail" href="'.base_url().'admin/akun/detail/'.$value['id_mahasiswa'].'" class="btn btn-info"><i class="far fa-file-alt"></a></td>';
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
