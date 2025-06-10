<?php
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
        <h4 class="card-title">Daftar pengajuan</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <tr>
                <th>No.</th>
                <th>NPM</th>
                <th>Nama Mahasiswa</th>
                <th>Judul</th>
                <th>Pembimbing 1</th>
                <th>Pembimbing 2</th>
                <th>Tahap</th>
                <th class="text-center"><i class="fas fa-cog"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 0;
                $index = 0;
                foreach ($topik as $values) {
                  $i=0;
                  foreach ($values as $value) {
                    echo '<tr>';
                    echo '<td>'.($no+1).'</td>';
                    echo '<td>'.$value['npm'].'</td>';
                    echo '<td>'.$value['nama'].'</td>';
                    echo '<td>'.$value['judul'].'</td>';
                    echo '<td>'.$value['dosen'].'</td>';
                    echo '<td>'.$topik2[$index][$i]['dosen'].'</td>';
                    echo '<td>'.tahap($value['tahap'],$alur).'</td>';
                    echo '<td class="text-center"><a title="Detail" href="'.base_url().'admin/akun/detail/'.$value['id_mahasiswa'].'" class="btn btn-info"><i class="far fa-file-alt"></i></a></td>';
                    echo '</tr>';
                    $no++;
                    $i++;
                  }
                  $index++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
