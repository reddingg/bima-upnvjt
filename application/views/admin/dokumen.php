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
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">Tambah</button>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar berkas</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Nama berkas</th>
              <th>Jumlah</th>
              <th>Jenis berkas</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($berkas as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$value['nama'].'</td>';
                  echo '<td>'.$value['jumlah'].'</td>';
                  echo '<td>'.tahap($value['jenis'],$alur).'</td>';
                  echo '<td class="text-center">';
                  if ($value['nama_file'] != '') {
                    echo '<a title="Unduh" href="'.base_url().'data/dokumen/'.$value['nama_file'].'" class="btn btn-info"><i class="fas fa-download"></i></a>';
                  }
                  ?>
                    
                    <a title="Hapus" href="<?php echo base_url().'admin/dokumen/hapus/'.$value['id'].'/'.$value['nama_file']; ?>" class="btn btn-danger" onclick="return confirm('Hapus berkas <?php echo $value['nama']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
                  <?php
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


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url(); ?>admin/dokumen" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Nama dokumen</label>
              <input type="text" name="nama" class="form-control" required="required">
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Jumlah</label>
              <input type="number" name="jumlah" class="form-control" required="required">
            </div>
            <div class="form-group">
              <label>Jenis dokumen</label>
              <select class="form-control" name="jenis" required="required">
                <?php 
                  $no=0;
                  foreach ($alur as $value) {
                    echo '<option value="'.$no.'">'.$value['judul'].'</option>';
                    $no++;
                  }
                ?>
              </select>
            </div>
            <div class="">
              <label>Pilih file</label>
              <input type="file" name="file" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning" name="simpan">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>