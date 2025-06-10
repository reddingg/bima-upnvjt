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

	<div id="fh5co-contact">
		<div class="container">
			<div class="row">
				<div class="col-md-5 col-md-push-1 animate-box">
					
					<div class="fh5co-contact-info">
						<h3>Informasi Kontak</h3>
						<ul>
							<li class="address">Jl. Raya Rungkut Madya Gunung Anyar<br>Fakultas Ilmu Komputer<br>UPN ‘Veteran’ Jatim</li>
							<li class="phone">031 000000</li>
							<li class="email">bima.informatika@gmail.com</li>
							<li class="url">bima.com</li>
						</ul>
					</div>

				</div>
				<div class="col-md-6 animate-box">
					<?php echo $this->session->flashdata('pesan'); ?>
					<h3>Kritik Saran atau Pertanyaan</h3>
					<form method="post">
						<div class="row form-group">
							<div class="col-md-12">
								<input type="text" name="nama" class="form-control" placeholder="Nama" required="required">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="email" name="email" class="form-control" placeholder="Email" required="required">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="text" name="subjek" class="form-control" placeholder="Subjek" required="required">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<textarea name="pesan" class="form-control" rows="10" id="tiny" required="required">Isi pesan</textarea>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" name="kirim" value="Kirim pesan" class="btn btn-primary">
						</div>
					</form>		
				</div>
			</div>
			
		</div>
	</div>

	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.1679374213977!2d112.78617791427999!3d-7.335028794706583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb792f87d495%3A0xaae1e1cbcc3e2778!2sFakultas%20Ilmu%20Komputer%202%20UPN%20Veteran%20Jatim!5e0!3m2!1sid!2sid!4v1578796548332!5m2!1sid!2sid" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen=""></iframe>

	<!-- footer -->
	<?php $this->load->view('utama/_include/_footer'); ?>
	<!-- obrolan -->
	<?php $this->load->view('utama/_include/_obrolan'); ?>
	
</body>
</html>

<!-- script -->
<?php $this->load->view('utama/_include/_script'); ?>

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