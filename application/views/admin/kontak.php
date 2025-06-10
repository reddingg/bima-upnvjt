<?php
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
        <h4 class="card-title">Daftar kontak masuk</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Tanggal</th>
              <th>Subjek</th>
              <th>Pesan</th>
              <th>Status</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no=1;
                foreach ($data as $value) {
                  if ($value['balasan'] != '') { $status = 'Sudah dibalas'; }
                  else { $status = 'Belum dibalas'; }
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.tgl_indo($value['tanggal']).'</td>';
                  echo '<td>'.$value['subjek'].'</td>';
                  echo '<td>'.substr($value['pesan'],0,30).'</td>';
                  echo '<td>'.$status.'</td>';
                  echo '<td class="text-center">';
                  ?>
                    <a title="Detail" href="<?php echo base_url().'admin/kontak/detail/'.$value['id']; ?>" class="btn btn-info"><i class="far fa-file-alt"></i></a>
                    <a title="Hapus" href="<?php echo base_url().'admin/kontak/hapus/'.$value['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus kontak <?php echo $value['subjek']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
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

<?php
if (@$ubah['subjek'] != '' ) {
  ?>
  <div class="modal fade" id="exampleModalCenterUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Detail kontak</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Tanggal</label>
              <input type="text" value="<?php echo tgl_indo($ubah['tanggal']); ?>" class="form-control" disabled="disabled">
            </div></div>
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Pengirim</label>
              <input type="text" value="<?php echo $ubah['nama']; ?>" class="form-control" disabled="disabled">
              <input type="hidden" value="<?php echo $ubah['id']; ?>" name="id">
            </div></div>
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Email</label>
              <input type="text" value="<?php echo $ubah['email']; ?>" class="form-control" disabled="disabled">
              <input type="hidden" name="email" value="<?php echo $ubah['email']; ?>">
            </div></div>
            </div>            
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Subjek</label>
              <input type="text" value="<?php echo $ubah['subjek']; ?>" class="form-control" disabled="disabled">
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Pesan</label>
              <!-- <textarea class="form-control" rows="1" disabled="disabled"><?php echo $ubah['pesan']; ?></textarea> -->
              <div style="margin: 0; background-color: white;" class="card card-body"><?php echo $ubah['pesan']; ?></div>
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Balas</label>
              <!-- <textarea class="form-control" rows="3" name="balasan" required="required"><?php echo $ubah['balasan']; ?></textarea> -->
              <textarea name="balasan" class="form-control" rows="10" id="tiny" required="required"><?php echo $ubah['balasan']; ?>  </textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning" name="balas">Kirim balasan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script>
    $(window).on("load",function(){
           $("#exampleModalCenterUbah").modal("show");
      });
  </script>
  <?php
}
?>

<script src="<?php echo base_url(); ?>assets/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
 selector: 'textarea#tiny'
});// Prevent Bootstrap dialog from blocking focusin

$(document).on('focusin', function(e) {
  if ($(e.target).closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
    e.stopImmediatePropagation();
  }
});
</script>