<?php 
echo $this->session->flashdata('pesan'); 
if ($this->session->userdata('tema') == 'black') {
	$color = 'white';
}
else{
	$color = 'black';
}

function tgl_indo($tanggal){
	$tanggal = explode(' ', $tanggal);
	$jam	 = $tanggal[1];
	$tanggal = $tanggal[0];

	$bulan = array (
		1 =>   'Januari','Februari','Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0].' - '.$jam;
}
?>
<div class="card">
	<div class="card-header card-header-warning">
	  <h4 class="card-title">Detail berita</h4>
	  <p class="card-category"><?php echo tgl_indo($berita['tanggal']); ?></p>
	</div>
	<div class="card-body">
	  <form method="post" action="<?php echo base_url(); ?>admin/berita" enctype="multipart/form-data">
	  	<div class="row">
	      <div class="col-md-12">
	        <div class="form-group" style="margin-top: 1rem;">
				<label style="color: #AAAAAA; top: -1rem;">Judul</label>
				<input type="hidden" name="id" value="<?php echo $berita['id']; ?>">
				<input type="hidden" name="namaFile" value="<?php echo $berita['nama_file']; ?>">
				<input type="text" name="judul" value="<?php echo $berita['judul']; ?>" class="form-control"required="required" style="color: <?php echo $color; ?>;">
	        </div>
			<div class="">
				<label>Lampiran</label>
				<img style="max-height: 50vw; width: 100%;" src="<?php echo base_url().'data/berita/'.$berita['nama_file']; ?>" class="img-responsive img-fluid">
				<input type="file" name="file" accept="image/*" class="form-control" style="color: <?php echo $color; ?>;">
			</div>
			<div class="form-group" style="margin-top: 2rem;">
				<label style="color: #AAAAAA; top: -1rem;">Keterangan</label>
				<!-- <textarea style="color: <?php echo $color; ?>;" class="form-control" name="keterangan" rows="10"><?php echo $berita['keterangan']; ?></textarea> -->
              <textarea name="keterangan" class="form-control" rows="10" id="tiny" required="required"><?php echo $berita['keterangan']; ?>  </textarea>
	        </div>
	      </div>
	    </div>
	    <button type="submit" name="simpan-ubah" class="btn btn-warning pull-right">Simpan perubahan</button>
	    <div class="clearfix"></div>
	  </form>
	</div>
</div>

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