<?php
if ($this->session->userdata('tema') == 'black') {
  $color = 'white';
}
else{
  $color = 'black';
}

function tgl_indo($tanggal){
  $tanggal = explode(' ', $tanggal);
  $jam   = $tanggal[1];
  $tanggal = $tanggal[0];

  $bulan = array (
    1 =>   'Januari','Februari','Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0].' - '.$jam;
}
?>

<div class="row">
  <div class="col-md-12">
    <?php echo $this->session->flashdata('pesan'); ?>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Kirim pemberitahuan</h4>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Nama</label>
                <input type="text" value="<?php echo $mahasiswa['nama']; ?>" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">NPM</label>
                <input type="text" value="<?php echo $mahasiswa['npm']; ?>" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Email</label>
                <input type="text" value="<?php echo $mahasiswa['email']; ?>" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
                <input type="hidden" name="id" value="<?php echo $mahasiswa['id']; ?>">
                <input type="hidden" name="email" value="<?php echo $mahasiswa['email']; ?>">
                <input type="hidden" name="telegram" value="<?php echo $mahasiswa['telegram']; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">ID Telegram</label>
                <input type="text" value="<?php echo $mahasiswa['telegram']; ?>" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Pesan</label>
            <textarea rows="5" name="pesan" class="form-control" required="required" style="color: <?php echo $color; ?>"></textarea>
          </div>
          <button type="submit" onclick="return confirm('Kirim pesan pemberitahuan ?');" name="kirim" class="btn btn-warning pull-right">Kirim</button>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Sudah terkirim</h4>
        <!-- <p class="card-category"> Alur juga akan ditampilkan pada halaman alur bima</p> -->
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Tanggal</th>
              <th>Pesan</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($email as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.tgl_indo($value['tanggal']).'</td>';
                  echo '<td>'.$value['pesan'].'</td>';
                  echo '<td class="text-center">';
                  ?>
                  <a title="Hapus" href="<?php echo base_url().$this->uri->segment('1').'/'.$this->uri->segment('2').'/pemberitahuan/'.$mahasiswa['id'].'/hapus/'.$value['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus pesan terpilih ?');"><i class="fas fa-trash-alt"></i></a>
                  <?php
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
    $(document).ready( function () {
        $('#berita').DataTable({
            "paging": true,
            "info": false,
            "ordering": true,
            "lengthChange": false
        });
    } );
</script>