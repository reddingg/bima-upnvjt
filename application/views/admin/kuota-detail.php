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
?>

<div class="row">
  <div class="col-md-12">
    <?php echo $this->session->flashdata('pesan'); ?>
    <div class="card card-body">
      <form method="post">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Nama dosen</label>
            <input type="text" value="<?php echo $data['nama'] ?>" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
          </div>
        </div>
        <div class="col">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Kuota dosen pembimbing 1</label>
            <input type="number" name="kuota1" value="<?php echo $data['kuota_pembimbing_1'] ?>" class="form-control" style="color: <?php echo $color; ?>" required="required">
          </div>
        </div>
        <div class="col">
          <div class="form-group bmd-form-group is-filled" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Kuota dosen pembimbing 2</label>
            <input type="number" name="kuota2" value="<?php echo $data['kuota_pembimbing_2'] ?>" class="form-control" style="color: <?php echo $color; ?>" required="required">
          </div>
        </div>
        <div class="col-md-2">    
          <button type="submit" name="simpan-ubah" class="btn btn-warning pull-right">Simpan</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Dalam proses</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table3" class="table dataTable">
            <thead>
              <tr>
                <th>No.</th>
                <th>NPM</th>
                <th>Nama mahasiswa</th>
                <th>Judul</th>
                <th>Dosen pembimbing 1</th>
                <th>Dosen pembimbing 2</th>
                <th class="text-center"><i class="fas fa-cog"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                $i = 0;
                foreach ($proses as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$value['npm'].'</td>';
                  echo '<td>'.$value['nama'].'</td>';
                  echo '<td>'.$value['judul'].'</td>';
                  echo '<td>'.dosen($value['id_dosen_1'],$dosen).'</td>';
                  echo '<td>'.dosen($value['id_dosen_2'],$dosen).'</td>';
                  echo '<td class="text-center"><a title="Detail" href="'.base_url().'admin/akun/detail/'.$value['id_mahasiswa'].'" class="btn btn-info"><i class="far fa-file-alt"></i></a></td>';
                  echo '</tr>';
                  $no++;
                  $i++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar bimbingan aktif</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <tr>
                <th>No.</th>
                <th>NPM</th>
                <th>Nama mahasiswa</th>
                <th>Judul</th>
                <th>Dosen pembimbing 1</th>
                <th>Dosen pembimbing 2</th>
                <th class="text-center"><i class="fas fa-cog"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                $i = 0;
                foreach ($aktif as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$value['npm'].'</td>';
                  echo '<td>'.$value['nama'].'</td>';
                  echo '<td>'.$value['judul'].'</td>';
                  echo '<td>'.dosen($value['id_dosen_1'],$dosen).'</td>';
                  echo '<td>'.dosen($value['id_dosen_2'],$dosen).'</td>';
                  echo '<td class="text-center"><a title="Detail" href="'.base_url().'admin/akun/detail/'.$value['id_mahasiswa'].'" class="btn btn-info"><i class="far fa-file-alt"></a></td>';
                  echo '</tr>';
                  $no++;
                  $i++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar bimbingan selesai</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table2" class="table dataTable">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama mahasiswa</th>
                <th>NPM</th>
                <th>Judul</th>
                <th>Dosen pembimbing 1</th>
                <th>Dosen pembimbing 2</th>
                <th class="text-center"><i class="fas fa-cog"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                $i = 0;
                foreach ($selesai as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$value['nama'].'</td>';
                  echo '<td>'.$value['npm'].'</td>';
                  echo '<td>'.$value['judul'].'</td>';
                  echo '<td>'.dosen($value['id_dosen_1'],$dosen).'</td>';
                  echo '<td>'.dosen($value['id_dosen_2'],$dosen).'</td>';
                  echo '<td class="text-center"><a title="Detail" href="'.base_url().'admin/akun/detail/'.$value['id_mahasiswa'].'" class="btn btn-info"><i class="far fa-file-alt"></i></a></td>';
                  echo '</tr>';
                  $no++;
                  $i++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>