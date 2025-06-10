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
                  echo '<td class="text-center"><a title="Detail" href="'.base_url().'dosen/mahasiswa/detail/'.$value['id_mahasiswa'].'" class="btn btn-info"><i class="far fa-file-alt"></i></a></td>';
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
                  echo '<td class="text-center"><a title="Detail" href="'.base_url().'dosen/mahasiswa/detail/'.$value['id_mahasiswa'].'" class="btn btn-info"><i class="far fa-file-alt"></i></a></td>';
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
                  echo '<td class="text-center"><a title="Detail" href="'.base_url().'dosen/mahasiswa/detail/'.$value['id_mahasiswa'].'" class="btn btn-info"><i class="far fa-file-alt"></i></a></td>';
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
