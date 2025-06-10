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

	<div id="fh5co-services">
		<div class="container">
			<table id="example" class="table dataTable no-footer" role="grid">
			  	<thead>
			  		<th>No.</th>
				  	<th>Pertanyaan</th>
				  	<th>Jawaban</th>
			  	</thead>
			 	<tbody>
			 		<?php
		                $no = 1;
		                foreach ($data as $value) {
		                  echo '<tr>';
		                  echo "<td>$no</td>";
		                  echo '<td>'.$value['tanya'].'</td>';
		                  echo '<td>'.$value['jawab'].'</td>';
		                  echo '</tr>';
		                  $no++;
		                }
		              ?>
				</tbody>
			</table>
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#example').DataTable({
            "paging": true,
            "info": false,
            "ordering": true,
            "lengthChange": false
        });
    } );
</script>