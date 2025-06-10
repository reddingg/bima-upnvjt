<?php
if ($this->session->userdata('tema') == 'black') { $color = 'white'; }
else { $color = 'black'; }
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-warning">
				<h4 class="card-title">Perhitungan algoritma SAW</h4>
			</div>
			<div class="card-body">
				<?php if (@$mhs[0]['id'] != '') { ?>
				<div class="col-md-12">
					<h4 align="center">DATA TERPILIH</h4>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<th>No.</th>
								<th>NPM</th>
								<th>Nama mahasiswa</th>
								<th>Semester</th>
								<th>Bidang keahlian</th>
								<th>IPK</th>
								<th>Jumlah SKS</th>
								<th class="text-center"><i class="fas fa-cog"></i></th>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach ($mhs as $value){
									echo '<tr>';
									echo '<td>'.$no.'</td>';
									echo '<td>'.$value['npm'].'</td>';
									echo '<td>'.$value['nama'].'</td>';
									echo '<td>'.$value['semester'].'</td>';
									echo '<td>'.$value['bidang'].'</td>';
									echo '<td>'.$value['ipk'].'</td>';
									echo '<td>'.$value['jumlah_sks'].'</td>';
									echo '<td class="text-center"><a title="Detail" target="_blank" href="'.base_url().'admin/akun/detail/'.$value['id'].'" class="btn btn-primary btn-sm"><i class="far fa-file-alt"></i></a></td>';
									echo '</tr>';
									$no++;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="dropdown-divider"></div><br>

				<div class="col-md-12">
					<h4 align="center">HASIL PERHITUNGAN</h4>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>No.</th>
									<th>NPM</th>
									<th>Nama mahasiswa</th>
									<th>Semester (<?php echo $bobotSemester; ?>%)</th>
									<th>Bidang keahlian (<?php echo $bobotBidang; ?>%)</th>
									<th>IPK (<?php echo $bobotIpk; ?>%)</th>
									<th>Jumlah SKS (<?php echo $bobotSks; ?>%)</th>
									<th>Total (%)</th>
									<th>Peringkat</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								foreach ($hasil as $value){
									echo '<tr>';
									echo '<td>'.$no.'</td>';
									echo '<td>'.$value['npm'].'</td>';
									echo '<td>'.$value['nama'].'</td>';
									echo '<td>'.$value['semester'].'</td>';
									echo '<td>'.$value['bidang'].'</td>';
									echo '<td>'.$value['ipk'].'</td>';
									echo '<td>'.$value['jumlah_sks'].'</td>';
									echo '<td>'.$value['total'].'</td>';
									echo '<td>'.$value['rank'].'</td>';
									echo '</tr>';
									$no++;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="dropdown-divider"></div><br>
				<?php } ?>

				<form method="post">
					<div class="row" id="dinamis">
						<div class="col-md-4">
							<div class="form-group" style="margin-top: 0rem;">
								<label>Pilih mahasiswa</label>
								<select name="mhs[]" class="form-control" style="margin-top: -0.5rem; color: <?php echo $color ?>">
									<?php 
									foreach ($data as $value) {
										echo '<option value="'.$value['id'].'">'.$value['npm'].' - '.$value['nama'].'</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="" style="margin-top: 1rem;">
						<div class="form-group">
							<div class="d-flex form-group">
				                <div class="col">
				                    <label>Bobot semester (%)</label>
				                    <input type="number" class="form-control" value="40" name="%semester" required="required" style="color: <?php echo $color; ?>">
				                </div>
				                <div class="col">
				                    <label>Bobot bidang keahlian (%)</label>
				                    <input type="number" class="form-control" value="20" name="%bidang" required="required" style="color: <?php echo $color; ?>">
				                </div>
				                <div class="col">
				                    <label>Bobot IPK (%)</label>
				                    <input type="number" class="form-control" value="20" name="%ipk" required="required" style="color: <?php echo $color; ?>">
				                </div>
				                <div class="col">
				                    <label>Bobot SKS (%)</label>
				                    <input type="number" class="form-control" value="20" name="%sks" required="required" style="color: <?php echo $color; ?>">
				                </div>
				            </div>
							<button id="tambah" type="button" class="btn btn-primary mb-2 btn-sm"><i class="fas fa-plus"></i></button>
							<button type="submit" name="hitung" class="btn btn-warning mb-2 btn-sm">Hitung</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var no =1;
	$('#tambah').click(function(){
		no++;
		$('#dinamis').append('<div id="row'+no+'" class="col-md-4"><div class="form-group" style="margin-top: 0rem;"><label>Pilih mahasiswa</label><select name="mhs[]" class="form-control" style="margin-top: -0.5rem;"><?php foreach ($data as $value) { echo '<option value="'.$value['id'].'">'.$value['npm'].' - '.$value['nama'].'</option>'; } ?></select><button type="button" id="'+no+'" class="btn btn-danger btn-sm btn_remove"><i class="fas fa-trash-alt"></i></button></div></div>');
	});

	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
});
</script>