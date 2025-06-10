<style type="text/css">
	h1{
		font-size: 7vmin;
	}
	h2{
		font-size: 4vmin;
	}
</style>
<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url(<?php echo base_url(); ?>assets/utama/images/bg.png);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<?php 
								$uri = $this->uri->segment('2');
								if ($uri == 'alur') {
									echo '<h1>Alur Pengerjaan Skripsi</h1><h2>Informatika UPN "Veteran" Jatim</h2>';
								}
								elseif ($uri == 'jadwal') {
									echo '<h1>Jadwal Skripsi</h1><h2>Informatika UPN "Veteran" Jatim</h2>';
								}
								elseif ($uri == 'unduh') {
									echo '<h1>Unduh berkas</h1><h2>Informatika UPN "Veteran" Jatim</h2>';
								}
								elseif ($uri == 'bantuan') {
									echo '<h1>Bantuan dan FAQ</h1><h2>Informatika UPN "Veteran" Jatim</h2>';
								}
								elseif ($uri == 'kontak') {
									echo '<h1>Hubungi kami</h1><h2>Informatika UPN "Veteran" Jatim</h2>';
								}
								elseif ($uri == 'berita') {
									echo '<h1>Selengkapnya</h1>';
								}

							?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>