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
        <h4 class="card-title">Daftar jadwal</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Tanggal</th>
              <th>Jam / Ruang</th>
              <th>Keterangan</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($jadwal as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.tgl_indo($value['tanggal']).'</td>';
                  echo '<td>'.$value['jam'].'</td>';
                  echo '<td>'.tahap($value['keterangan'],$alur).'</td>';
                  echo '<td class="text-center">';
                  ?>
                    <a title="Detail" href="<?php echo base_url().'admin/jadwal/detail/'.$value['id'].'/'.$value['tanggal']; ?>" class="btn btn-primary btn-sm"><i class="far fa-file-alt"></i></a>
                    <a title="Ubah" href="<?php echo base_url().'admin/jadwal/ubah/'.$value['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                    <a title="Hapus" href="<?php echo base_url().'admin/jadwal/hapus/'.$value['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus jadwal <?php echo $value['tanggal']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah jadwal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url(); ?>admin/jadwal" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
              		<label style="color: #AAAAAA; top: -1rem;">Tanggal</label>
              		<input type="date" class="form-control" name="tanggal" required="required">
              	</div>
              </div>
              <div class="col">
                <div class="form-group" style="margin-top: 1rem;">
              		<label style="color: #AAAAAA; top: -1rem;">Jam / Ruang</label>
              		<input type="text" name="jam" class="form-control">
              	</div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Keterangan</label>
              <select class="form-control" name="keterangan" required="required">
                <?php 
                  $no=0;
                  foreach ($alur as $value) {
                    echo '<option value="'.$no.'">'.$value['judul'].'</option>';
                    $no++;
                  }
                ?>
              </select>
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

<?php
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

if (@$ubah['tanggal'] != '' ) {
	?>
	<div class="modal fade" id="exampleModalCenterUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalCenterTitle">Ubah jadwal</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="post" action="<?php echo base_url(); ?>admin/jadwal" enctype="multipart/form-data">
	        <div class="modal-body">
	            <div class="form-group" style="margin-top: 0rem;">
	              <div class="row">
	              	<div class="col">
	              		<label style="color: #AAAAAA; top: -1rem;">Tanggal</label>
	              		<input type="date" class="form-control" value="<?php echo $ubah['tanggal']; ?>" name="tanggal" required="required">
	              		<input type="hidden" name="id" value="<?php echo $ubah['id']; ?>">
	              	</div>
	              	<div class="col">
	              		<label style="color: #AAAAAA; top: -1rem;">Jam / Ruang</label>
	              		<input type="text" name="jam" value="<?php echo $ubah['jam']; ?>" class="form-control">
	              	</div>
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="exampleFormControlSelect1">Keterangan</label>
	              <select class="form-control" name="keterangan" required="required">
	                <?php 
                  $no=0;
                  foreach ($alur as $value) {
                    if ($ubah['keterangan'] == $no) {
                      echo '<option selected value="'.$no.'">'.$value['judul'].'</option>';
                    }
                    else{
                      echo '<option value="'.$no.'">'.$value['judul'].'</option>';
                    }
                    $no++;
                  }
                  ?>
	              </select>
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