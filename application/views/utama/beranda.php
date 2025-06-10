<!DOCTYPE HTML>
<html>

<!-- head -->
<?php 
$this->load->view('utama/_include/_head'); 

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
	
<body>		
	<div class="fh5co-loader"></div>
	<div id="page">
	
	<!-- navbar -->
	<?php $this->load->view('utama/_include/_navbar'); ?>
	<!-- carousel -->
	<?php $this->load->view('utama/_include/_carousel'); ?>	

	<div id="fh5co-blog" class="fh5co-bg-section">
		<div class="container">
			<!-- berita -->
			<div class="row">
				<?php 
				foreach ($berita as $value) {
					echo '<div class="col-lg-4 col-md-4">
							<div class="fh5co-blog animate-box fadeInUp animated-fast">
								<a href="#"><img class="img-responsive" src="'.base_url().'data/berita/'.$value['nama_file'].'" alt="img" style="height: 350px;"></a>
								<div class="blog-text">
									<h3><a href="#">'.substr($value['judul'], 0,20).'</a></h3>
									<span class="posted_on">'.tgl_indo($value['tanggal']).'</span>
									<a href="'.base_url().'bima/berita/'.$value['id'].'" class="btn btn-primary">Selengkapnya</a>
								</div> 
							</div>
						</div>';
				}
				?>
			</div>
			<!-- pagination -->
			<div class="row">
				<div class="col-md-12" align="center">
					 <ul class="pagination">
					  
					 	<?php
					 		$uri = $this->uri->segment('3');
					 		if (($uri == '') || ($uri < 1)) { $uri = 1; }
					 		$previous 	= $uri-1;
					 		$next 		= $uri+1;
					 		echo '<li class="page-item"><a class="page-link" href="'.base_url()."bima/beranda/$previous".'">Previous</a></li>';
					 		for ($i=1; $i <= $pagination; $i++) {
					 			if ($uri == '') {
					 				$uri = 1;
					 			}
					 			if ($uri == $i) {
					 				echo '<li class="page-item active"><a class="page-link" href="'.base_url()."bima/beranda/$i".'">'.$i.'</a></li>';
					 			}
					 			else{
					 				echo '<li class="page-item"><a class="page-link" href="'.base_url()."bima/beranda/$i".'">'.$i.'</a></li>';
					 			}
					 		}
					 		echo '<li class="page-item"><a class="page-link" href="'.base_url()."bima/beranda/$next".'">Next</a></li>';
					 	?>
					</ul> 
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