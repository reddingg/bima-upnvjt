<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>

<!-- head -->
<?php $this->load->view('_include/_head'); ?>

<body class="bg-light">

	<!-- <div class="" > -->
		<div class="col-md-4 mx-auto d-block" style="margin-top: 3rem;">
			<!-- <div class="container"> -->
				<?php echo $this->session->flashdata('pesan'); ?>
				<a href="<?php echo base_url().'bima' ?>"><img class="mb-5 img-fluid mx-auto d-block" src="<?php echo base_url(); ?>assets/img/logo/bima.png" alt="Logo"></a>
		      <!-- menu -->
		      <?php 
		        $uri = $this->uri->segment('2');
		        $this->load->view("auth/_include/_$uri"); 
		      ?>
  			<!-- </div> -->
		</div>
	<!-- </div> -->
	<footer class="footer">
	  <div class="container-fluid">
	    <div style="position: fixed; left: 0; bottom: 0.5rem; width: 100%; text-align: center;">
	      <ul><li><a href="#" style="margin-bottom: -1rem;">Bimbingan Mahasiswa</a></li></ul>
          Informatika UPN "Veteran" Jawa Timur &copy;
	      <script>
	        document.write(new Date().getFullYear())
	      </script>
	    </div>
	  </div>
	</footer>
</body>
</html>