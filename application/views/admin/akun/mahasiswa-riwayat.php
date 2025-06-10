<?php
if ($this->session->userdata('tema') == 'black') {
  $color = 'white';
}
else{
  $color = 'black';
}

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
                <th>Durasi</th>
                <?php if ($this->session->userdata('role') == 'admin') { echo '<th class="text-center"><i class="fas fa-cog"></i></th>'; } ?>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($riwayat as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.tgl_indo($value['tanggal']).' '.$value['jam'].'</td>';
                  echo '<td>'.$value['judul'].'</td>';
                  echo '<td>'.dosen($value['id_dosen_1'], $dosen).'</td>';
                  echo '<td>'.dosen($value['id_dosen_2'], $dosen).'</td>';
                  echo '<td>'.dosen($value['penguji_1'], $dosen).'</td>';
                  echo '<td>'.dosen($value['penguji_2'], $dosen).'</td>';
                  echo '<td>'.dosen($value['penguji_3'], $dosen).'</td>';
                  echo '<td>'.hasil($value['status']).'</td>';
                  echo '<td>'.$value['keterangan'].'</td>';
                  echo '<td>'.tahap($value['tahap'],$alur).'</td>';

                  // durasi
                  if ($value['status'] == 2) {
                    echo '<td>'.selisihTanggal($value['tanggal']).' Hari</td>';
                  }
                  else{
                    echo '<td>-</td>';
                  }

                  if ($this->session->userdata('role') == 'admin'){
                  echo '<td class="text-center">';
                  ?>
                    <a title="Hapus" href="<?php echo base_url().'admin/akun/riwayat/'.$this->uri->segment('4').'/hapus/'.$value['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus riwayat <?php echo tgl_indo($value['tanggal']).' '.$value['jam']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
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