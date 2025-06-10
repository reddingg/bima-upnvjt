<div class="row">
  <div class="col-md-12">
  <?php echo $this->session->flashdata('pesan'); ?>
  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalBerita">Tambah</button>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar faq</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Pertanyaan</th>
              <th>Jawaban</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($data as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$value['tanya'].'</td>';
                  echo '<td>'.substr($value['jawab'],0,50).' ... </td>';
                  echo '<td class="text-center">';
                  ?>
                    <a title="Detail" href="<?php echo base_url().'admin/faq/detail/'.$value['id']; ?>" class="btn btn-info"><i class="far fa-file-alt"></i></a>
                    <a title="Hapus" href="<?php echo base_url().'admin/faq/hapus/'.$value['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus alur <?php echo $value['tanya']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
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

<!-- Modal alur -->
<div class="modal fade" id="modalBerita" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah faq</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;">Pertanyaan</label>
            <input type="text" name="tanya" class="form-control" required="required">
          </div>
          <div class="form-group" style="margin-top: 1rem;">
            <label style="color: #AAAAAA; top: -1rem;">Jawaban</label>
            <textarea rows="5" name="jawab" class="form-control" required="required"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" name="simpan" class="btn btn-warning">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
if (@$ubah['tanya'] != '' ) {
  ?>
  <div class="modal fade" id="exampleModalCenterUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Ubah faq</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Pertanyaan</label>
              <input type="text" name="tanya" value="<?php echo $ubah['tanya']; ?>" class="form-control" required="required">
              <input type="hidden" value="<?php echo $ubah['id'] ?>" name="id">
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Jawaban</label>
              <textarea rows="5" name="jawab" class="form-control" required="required"><?php echo $ubah['jawab']; ?></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning" name="simpan-ubah">Ubah</button>
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