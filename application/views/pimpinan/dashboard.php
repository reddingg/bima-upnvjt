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
				<h4 class="card-title">Frekuensi seluruh bimbingan</h4>
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
				<h4 class="card-title">Frekuensi bimbingan /dosen</h4>
			</div>
			<div class="card-body">
				<div id="grafik2" style="height: 400px; min-width: 320px; max-width: 600px; margin: 0 auto"></div>
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
            data: [<?php foreach ($allBimbingan as $value) { echo $value.','; } ?>],
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

function cetak(id) {
    var canvas = document.getElementById(id);
    var win = window.open();
    win.document.write("<br><img src='" + canvas.toDataURL() + "'/>");
    setTimeout(function(){win.print()},1000);
}
</script>

<script src="<?php echo base_url(); ?>assets/highstock.js"></script>
<script src="<?php echo base_url(); ?>assets/exporting.js"></script>
<script type="text/javascript">
	Highcharts.chart('grafik2', {
  chart: {
    type: 'bar',
    marginLeft: 150
  },
  title: {
    text: 'Tahun <?php echo $tahun; ?>'
  },
  subtitle: {
    text: ''
  },
  xAxis: {
    type: 'category',
    title: {
      text: null
    },
    min: 0,
    max: 4,
    scrollbar: {
      enabled: true
    },
    tickLength: 0
  },
  yAxis: {
    min: 0,
    max: 120,
    title: {
      text: 'Bimbingan',
      align: 'high'
    }
  },
  plotOptions: {
    bar: {
      dataLabels: {
        enabled: true
      }
    }
  },
  legend: {
    enabled: false
  },
  credits: {
    enabled: false
  },
  series: [{
    name: 'Bimbingan',
    data: [
      <?php 
      	foreach ($dosen as $value) {
      		echo '['.'"'.$value['nama'].'",'.$value['jumlah'].'],';
      	}
      ?>
    ]
  }]
});

</script>