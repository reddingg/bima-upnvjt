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

function status($value){
  if ($value == 2) {
    return 'Sudah divalidasi';
  }
  elseif ($value == 1) {
    return 'Sudah diunggah';
  }
  else{
    return 'Belum diunggah';
  }
}

function cek($id,$berkas,$kolom){
  foreach ($berkas as $value) {
    if ($id == $value['id_dokumen']) {
      return $value[$kolom];
    }
  }
  return 0;
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
        <h4 class="card-title">Daftar berkas</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Tahap</th>
              <th>Nama berkas</th>
              <th>Jumlah</th>
              <th>Status</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($berkas as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.tahap($value['jenis'],$alur).'</td>';
                  echo '<td>'.$value['nama'].'</td>';
                  echo '<td>'.$value['jumlah'].'</td>';
                  
                  // status
                  $status = cek($value['id'],$berkasMhs,'status');
                  echo '<td>'.status($status).'</td>';
                  
                  //opsi
                  echo '<td class="text-center">';
                  if ($status != 0) {
                    echo '<a title="unduh" href="'.base_url().'data/dokumen/mahasiswa/'.cek($value['id'],$berkasMhs,'nama_file').'" class="btn btn-info"><i class="fas fa-download"></i></a>';
                  }
                  if ($status == 1) {
                    ?>
                    <a title="Validasi" href="<?php echo base_url().'admin/akun/dokumen/'.$data['id'].'/validasi/'.cek($value['id'],$berkasMhs,'id'); ?>" class="btn btn-primary" onclick="return confirm('Validasi berkas <?php echo $value['nama']; ?> ?');">Validasi</a>
                    <?php
                  }
                  elseif ($status == 2) {
                    ?>
                    <a title="Batal validasi" href="<?php echo base_url().'admin/akun/dokumen/'.$data['id'].'/batalvalidasi/'.cek($value['id'],$berkasMhs,'id'); ?>" class="btn btn-danger" onclick="return confirm('Batal validasi berkas <?php echo $value['nama']; ?> ?');">Batal validasi</a>
                    <?php
                  }
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
