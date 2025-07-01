	<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

	<!DOCTYPE html>
	<html>

	<!-- head -->
	<?php $this->load->view('_include/_head'); ?>

	<style>
		html, body {
			min-height: 100vh;
		}

		body {
			display: flex;
			flex-direction: column;
			background-image: url('<?php echo base_url(); ?>assets/utama/images/bg.png');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			position: relative;
		}

		body::before { /* Gunakan pseudo-element untuk overlay */
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: linear-gradient(
				to bottom,
				rgba(67, 29, 0, 0.75) 0%,           /* Transparan di atas */
				rgb(255, 102, 0) 100%     /* Oren solid di bawah */
			);
			z-index: 1;
		}

		.login-form-container {
			flex: 1;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			padding: 20px;
			z-index: 2;
		}

		.login-form-card {
			flex: 1;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			padding: 20px;
			z-index: 1;
			border-radius: 10px;
			background-color:rgba(0, 0, 0, 0.58);
			box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
			position: relative;
			gap: 20px;
		}

		.login-content-wrapper {
			flex: 1;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}

		.button-wrapper {
			display: flex;
			justify-content: center;
			width: 100%;
		}

		.flash-message-container {
			z-index: 1;
		}
		
		@media (min-width: 768px) {
			.login-form-container {
				flex-direction: row;
				justify-content: center;
				align-items: center;
			}

			.login-form-card {
				flex-direction: row;
				justify-content: center;
				align-items: flex-start;
			}

			.login-content-wrapper {
				flex-direction: row;
				justify-content: center;
				align-items: center;
			}

			.button-wrapper {
				position: absolute;
				top: 10px;
				left: 10px;
				width: auto;
			}

			.flash-message-container {
				z-index: 1;
			}
		}
	</style>


	<body class="overlay">
		<div class="overlay"></div>
		<!-- konten utama -->
		<div class="container login-form-container">
			<div class="login-form-card">
				<div class="login-content-wrapper">
					<!-- logo bima  -->
					<div class="container">
						<a href="<?php echo base_url().'bima' ?>">
							<img class="img-fluid mx-auto d-block" src="<?php echo base_url(); ?>assets/img/logo/bima.png" alt="Logo">
						</a>
					</div>
					
					<!-- dynamic auth view: masuk, daftar, lupa -->
					<div class="container">
						<div class="flash-message-container mt-3">
							<!-- flash message > ketika terjadi kesalahan input -->
							<?php echo $this->session->flashdata('pesan'); ?>
						</div>
						<?php 
							$uri = $this->uri->segment('2');
							$this->load->view("auth/_include/_$uri"); 
						?>
					</div>
				</div>

				<!-- button untuk kebali ke beranda -->
				<div class="button-wrapper">
					<a href="<?php echo base_url().'bima' ?>" class="btn btn-warning mx-auto d-block">
						<i class="fas fa-home"></i> Beranda
					</a>
				</div>
			</div>
		</div>
		<footer class="footer mt-auto" style="z-index: 2;">	
		<div class="container">
			<div style="text-align: center; color: #fff;">
				<ul>
					<li>
						<a href="#" style="margin-bottom: -1rem; color: #fff;">Bimbingan Mahasiswa 
							<br>Informatika UPN "Veteran" Jawa Timur &copy;
								<script>
									document.write(new Date().getFullYear())
								</script>
							</br>
						</a>
					</li>
				</ul>
			</div>
		</div>
		</footer>
	</body>
	</html>