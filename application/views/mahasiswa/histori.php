<?php 
echo $this->session->flashdata('pesan'); 

function tgl_indo2($tanggal){
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
                  if (validateDate($value['tanggal_lulus'])) { echo '<td>'.tgl_indo2($value['tanggal_lulus']).'</td>'; }
                  else{ echo '<td>'.$value['tanggal_lulus'].'</td>'; }
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
