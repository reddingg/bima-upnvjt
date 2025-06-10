<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header card-header-warning">
				<h4 class="card-title">Jumlah berdasarkan bidang keahlian</h4>
			</div>
			<div class="card-body">
        <input type="button" onclick="cetak('grafik1')" class="btn btn-primary btn-sm" value="Cetak">
				<canvas id="grafik1" width="400" height="400"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-header card-header-warning">
				<h4 class="card-title">Jumlah berdasarkan tahapan</h4>
			</div>
			<div class="card-body">
        <input type="button" onclick="cetak('grafik2')" class="btn btn-primary btn-sm" value="Cetak">
				<canvas id="grafik2" width="400" height="400"></canvas>
			</div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title">Jumlah berdasarkan tahun angkatan</h4>
            </div>
            <div class="card-body">
        <input type="button" onclick="cetak('grafik3')" class="btn btn-primary btn-sm" value="Cetak">
                <canvas id="grafik3" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-warning">
                <h4 class="card-title">Jumlah berdasarkan tahun lulusan</h4>
            </div>
            <div class="card-body">
        <input type="button" onclick="cetak('grafik4')" class="btn btn-primary btn-sm" value="Cetak">
                <canvas id="grafik4" width="400" height="400"></canvas>
            </div>
        </div>
    </div> -->
</div>

<script src="<?php echo base_url(); ?>assets/Chart.min.js"></script>
<script>
var ctx = document.getElementById("grafik1");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [<?php foreach ($bidang as $value) { echo '"'.$value['nama'].'",'; } ?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php foreach ($bidang as $value) { echo $value['jumlah'].','; } ?>],
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
});

var ctx = document.getElementById("grafik2");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [<?php foreach ($alur as $value) { echo '"'.$value['judul'].'",'; } ?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php foreach ($tahap as $value) { echo $value['jumlah'].','; } ?>],
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
});

var ctx = document.getElementById("grafik3");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [<?php for ($i=2013; $i<= date('Y')-3;$i++) { echo $i.','; } ?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php foreach ($angkatan as $value) { echo $value['jumlah'].','; } ?>],
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
});

function cetak(id) {
    var canvas = document.getElementById(id);
    var win = window.open();
    win.document.write("<br><img src='" + canvas.toDataURL() + "'/>");
    setTimeout(function(){win.print()},1000);
}
</script>