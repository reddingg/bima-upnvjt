<?php
function jumlah($id,$data,$kolom){
  foreach ($data as $value) {
    if ($value[$kolom] == $id) {
      return $value['total'];
    }
  }
  return 0;
}

function sisa($kuota,$jumlah){
  return $kuota-$jumlah;
}

function lab($id,$lab){
  foreach ($lab as $value) {
    if ($value['id'] == $id) {
      return $value['nama'];
    }
  }
  return 0;
}
?>

<div class="row">
  <div class="col-md-12">
    <?php echo $this->session->flashdata('pesan'); ?>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar kuota dosen pembimbing</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Nama dosen</th>
                <th colspan="2">Kuota dimiliki</th>
                <th colspan="2">Bimbingan aktif</th>
                <th colspan="2">Sisa kuota</th>
                <!-- <th colspan="2">Bimbingan selesai</th> -->
                <th rowspan="2">Lab</th>
                <!-- <th class="text-center" rowspan="2"><i class="fas fa-cog"></i></th> -->
              </tr>
              <tr>
                <th>Dospem 1</th>
                <th>Dospem 2</th>
                <th>Dospem 1</th>
                <th>Dospem 2</th>
                <th>Dospem 1</th>
                <th>Dospem 2</th>
                <!-- <th>Dospem 1</th> -->
                <!-- <th>Dospem 2</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($dosen as $value) {
                  $jumlah1 = jumlah($value['id'],$kuotaAktif,'id_dosen_1'); // jumlah bimbingan 1
                  $jumlah2 = jumlah($value['id'],$kuotaAktif2,'id_dosen_2'); // jumlah bimbinga 2

                  // $selesai = jumlah($value['id'],$kuotaSelesai,'id_dosen_1');
                  // $selesai2= jumlah($value['id'],$kuotaSelesai2,'id_dosen_2');
                  
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$value['nama'].'</td>';
                  echo '<td>'.$value['kuota_pembimbing_1'].'</td>';
                  echo '<td>'.$value['kuota_pembimbing_2'].'</td>';
                  echo '<td>'.$jumlah1.'</td>';
                  echo '<td>'.$jumlah2.'</td>';
                  echo '<td>'.sisa($value['kuota_pembimbing_1'], $jumlah1).'</td>';
                  echo '<td>'.sisa($value['kuota_pembimbing_2'], $jumlah2).'</td>';
                  // echo '<td>'.$selesai.'</td>';
                  // echo '<td>'.$selesai2.'</td>';
                  echo '<td>'.lab($value['id_laboratorium'],$lab).'</td>';
                  // echo '<td class="text-center"><a title="Detail" href="'.base_url().'mahasiswa/kuota/detail/'.$value['id'].'" class="btn btn-info"><i class="far fa-file-alt"></i></a></td>';
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
