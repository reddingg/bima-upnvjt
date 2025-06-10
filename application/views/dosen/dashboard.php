<?php 
$tahun  = $this->input->post('tahun');
if ($tahun == '') {
    $tahun = date('Y');
}
?>
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header card-header-warning">
				<h4 class="card-title">Frekuensi bimbingan</h4>
			</div>
			<div class="card-body">
				<form method="post">
					<div class="container row">
						<input type="number" value="<?php echo $tahun; ?>" class="form-control" name="tahun">&nbsp;&nbsp;&nbsp;
						<input type="submit" class="btn btn-warning btn-sm" value="set" name="set">&nbsp;&nbsp;&nbsp;
                        <input type="button" onclick="cetak('grafik1')" class="btn btn-primary btn-sm" value="Cetak">
					</div>
				</form>
				<canvas id="grafik1" width="400" height="400"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header card-header-warning">
				<h4 class="card-title">Bimbingan mahasiswa</h4>
			</div>
			<div class="card-body">
                <input type="button" onclick="cetak('grafik2')" class="btn btn-primary btn-sm" value="Cetak">
				<canvas id="grafik2" width="400" height="400"></canvas>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>assets/Chart.min.js"></script>
<script>
var ctx = document.getElementById('grafik1').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni', 'Juli', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: '<?php echo $tahun; ?>',
            data: [<?php foreach ($frek as $value) { echo $value.','; } ?>],
            backgroundColor: [
                'rgba(255, 5, 5, 0.3)',
                'rgba(255, 130, 5, 0.3)',
                'rgba(255, 255, 5, 0.3)',
                'rgba(5, 255, 5, 0.3)',
                'rgba(5, 5, 255, 0.3)',
                'rgba(104, 0, 209, 0.3)',
                'rgba(0, 0, 0, 0.3)',
                'rgba(105, 251, 232, 0.3)',
                'rgba(0, 107, 0, 0.3)',
                'rgba(255, 0, 208, 0.3)'
            ],
            borderColor: [
                'rgba(255, 5, 5, 1)',
                'rgba(255, 130, 5, 1)',
                'rgba(255, 255, 5, 1)',
                'rgba(5, 255, 5, 1)',
                'rgba(5, 5, 255, 1)',
                'rgba(104, 0, 209, 1)',
                'rgba(0, 0, 0, 1)',
                'rgba(105, 251, 232, 1)',
                'rgba(0, 107, 0, 1)',
                'rgba(255, 0, 208, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


var ctx = document.getElementById("grafik2");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Aktif","Selesai"],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $aktif.','.$selesai; ?>],
            backgroundColor: [
                'rgba(255, 5, 5, 0.3)',
                'rgba(5, 5, 255, 0.3)',
                'rgba(255, 255, 5, 0.3)',
                'rgba(255, 130, 5, 0.3)',
                'rgba(5, 255, 5, 0.3)',
                'rgba(104, 0, 209, 0.3)',
                'rgba(0, 0, 0, 0.3)',
                'rgba(105, 251, 232, 0.3)',
                'rgba(0, 107, 0, 0.3)',
                'rgba(255, 0, 208, 0.3)'
            ],
            borderColor: [
                'rgba(255, 5, 5, 1)',
                'rgba(5, 5, 255, 1)',
                'rgba(255, 255, 5, 1)',
                'rgba(255, 130, 5, 1)',
                'rgba(5, 255, 5, 1)',
                'rgba(104, 0, 209, 1)',
                'rgba(0, 0, 0, 1)',
                'rgba(105, 251, 232, 1)',
                'rgba(0, 107, 0, 1)',
                'rgba(255, 0, 208, 1)'
            ],
            borderWidth: 1
        }]
    },
});

function cetak(id) {
    var canvas = document.getElementById(id);
    var win = window.open();
    win.document.write("<br><img src='" + canvas.toDataURL() + "'/>");
    setTimeout(function(){win.print()},1000);
}
</script>