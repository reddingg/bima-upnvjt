<?php 
$tahun  = $this->input->post('tahun');
$tahap  = $this->input->post('tahap');
if ($tahun == '') { $tahun = date('Y'); }
if ($tahap == '') { $tahap = 0; }
?>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
          <div class="card-icon">
            <i class="material-icons">supervisor_account</i>
          </div>
          <p class="card-category">Mahasiswa</p>
          <h3 class="card-title"><?php echo $jumlahMhs; ?>
            <small>Akun</small>
          </h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">folder</i>
            <a href="<?php echo base_url().'admin/akun/mahasiswa'; ?>">Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
          <div class="card-icon">
            <i class="material-icons">perm_identity</i>
          </div>
          <p class="card-category">Dosen</p>
          <h3 class="card-title"><?php echo $jumlahDosen; ?>
            <small>Akun</small>
          </h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">folder</i>
            <a href="<?php echo base_url().'admin/akun/dosen'; ?>">Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="row">
	<div class="col-md-7">
		<div class="card">
			<div class="card-header card-header-warning">
				<h4 class="card-title">Peserta Mahasiswa</h4>
			</div>
			<div class="card-body">
				<form method="post">
					<div class="container row">
            <div class="col-md-6">
              <select class="form-control" style="margin-top: -0.3rem;" name="tahap" required="required">
                <?php 
                  $no=0;
                  foreach ($alur as $value) {
                    if ($tahap == $no) {
                      echo '<option selected value="'.$no.'">'.$value['judul'].'</option>';
                    }
                    else{
                      echo '<option value="'.$no.'">'.$value['judul'].'</option>';
                    }
                    $no++;
                  }
                ?>
              </select>
            </div>
            <div class="col"><input type="number" value="<?php echo $tahun; ?>" class="form-control" name="tahun"></div>
            <div class="col"><input type="submit" class="btn btn-warning btn-sm" value="set" name="set"></div>
            <div><input type="button" onclick="cetak('grafik1')" class="btn btn-primary btn-sm" value="Cetak"></div>           	
					</div>
				</form>
        <canvas id="grafik1" width="800" height="450"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="card">
			<div class="card-header card-header-warning">
				<h4 class="card-title">Mahasiswa berdasarkan bidang keahlian</h4>
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
            label: 'Data',
            data: [<?php foreach ($data as $value) { echo $value.','; } ?>],
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
</script>

<script type="text/javascript">

function cetak(id) {
    var canvas = document.getElementById(id);
    var win = window.open();
    win.document.write("<br><img src='" + canvas.toDataURL() + "'/>");
    setTimeout(function(){win.print()},1000);
}
</script>