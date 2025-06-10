<?php
function tgl_indo($tanggal){
  if (preg_match("/\d{4}\-\d{2}-\d{2}/", $tanggal)) {
    $bulan = array (
    1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
  }  
}
?>

<div class="row">
  <div class="col-md-12">
    <?php echo $this->session->flashdata('pesan'); ?>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar mahasiswa - <?php echo tgl_indo($this->uri->segment('5')); ?></h4>
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
                <th class="text-center"><i class="fas fa-cog"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                $i = 0;
                foreach ($data as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$value['npm'].'</td>';
                  echo '<td>'.$value['nama'].'</td>';
                  echo '<td>'.$value['judul'].'</td>';
                  echo '<td class="text-center"><a title="Detail" href="'.base_url().'admin/akun/detail/'.$value['id_mahasiswa'].'" class="btn btn-info"><i class="far fa-file-alt"></i></a>';
                  echo '</td>';
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
