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

	<div id="fh5co-services" class="fh5co-bg-section">
		<div class="container">
			<table id="example" class="table dataTable no-footer" role="grid">
			  	<thead>
				  	<th>Nama berkas</th>
				  	<th>Keterangan</th>
				  	<th>Opsi</th>
			  	</thead>
			 	<tbody>
			 		<?php
			 			foreach ($data as $value) {
							if ($value['nama_file'] != '') { // hanya yg terdapat file yg ditampilkan
				 				echo '<tr>';
								echo '<td>'.$value['nama'].'</td>';
								echo '<td>'.tahap($value['jenis'],$alur).'</td>';
								echo '<td>'.
	                      				'<a href="'.base_url().'data/dokumen/'.$value['nama_file'].'"><i class="fa fa-download"></i> Unduh</a>
	                      			</td>';
				 				echo '</tr>';
							}
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