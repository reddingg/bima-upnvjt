<?php
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

<!DOCTYPE HTML>
<html>

<!-- head -->
<?php $this->load->view('utama/_include/_head'); ?>
	
<body>		
	<div class="fh5co-loader"></div>
	<div id="page">
	
	<!-- navbar -->
	<?php $this->load->view('utama/_include/_navbar'); ?>
	
	<!-- header -->
	<?php $this->load->view('utama/_include/_header'); ?>

	<div id="fh5co-blog" class="fh5co-bg-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title"><?php echo $berita['judul']; ?></h4>
                  <p class="card-category"><?php echo tgl_indo($berita['tanggal']); ?></p>
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group bmd-form-group">
                          <img style="width: 100%; max-height: 60vw;" src="<?php echo base_url().'data/berita/'.$berita['nama_file']; ?>" class="img-responsive img-fluid">
                          <p style="margin-top: 1rem" class="text-justify"><?php echo $berita['keterangan']; ?></p>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
			</div>
		</div>
	</div>
	
	<!-- footer -->
	<?php $this->load->view('utama/_include/_footer'); ?>
	<!-- obrolan -->
	<?php $this->load->view('utama/_include/_obrolan'); ?>

	</body>
</html>

<!-- script -->
<?php $this->load->view('utama/_include/_script'); ?>