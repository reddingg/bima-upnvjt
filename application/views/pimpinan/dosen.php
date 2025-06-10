<?php
function jumlah($id,$data,$kolom){
  foreach ($data as $value) {
    if ($value[$kolom] == $id) {
      return $value['total'];
    }
  }
  return 0;
}
?>

<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header card-header-warning">
				<h4 class="card-title">Mahasiswa aktif - dospem 1</h4>
			</div>
			<div class="card-body">
        <div id="grafik1" style="height: 400px; min-width: 320px; max-width: 600px; margin: 0 auto"></div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Mahasiswa aktif - dospem 2</h4>
      </div>
      <div class="card-body">
        <div id="grafik2" style="height: 400px; min-width: 320px; max-width: 600px; margin: 0 auto"></div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Mahasiswa selesai - dospem 1</h4>
      </div>
      <div class="card-body">
        <div id="grafik3" style="height: 400px; min-width: 320px; max-width: 600px; margin: 0 auto"></div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Mahasiswa selesai - dospem 2</h4>
      </div>
      <div class="card-body">
        <div id="grafik4" style="height: 400px; min-width: 320px; max-width: 600px; margin: 0 auto"></div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/highstock.js"></script>
<script src="<?php echo base_url(); ?>assets/exporting.js"></script>
<script type="text/javascript">
  Highcharts.chart('grafik1', {
  chart: {
    type: 'bar',
    marginLeft: 150
  },
  title: {
    text: 'Data'
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
    max: 20,
    title: {
      text: 'Mahasiswa',
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
    name: 'Mahasiswa',
    data: [
      <?php 
        foreach ($dosen as $value) {
          echo '['.'"'.$value['nama'].'",'.jumlah($value['id'],$kuotaAktif,'id_dosen_1').'],';
        }
      ?>
    ]
  }]
});
</script>

<script type="text/javascript">
  Highcharts.chart('grafik2', {
  chart: {
    type: 'bar',
    marginLeft: 150
  },
  title: {
    text: 'Data'
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
    max: 20,
    title: {
      text: 'Mahasiswa',
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
    name: 'Mahasiswa',
    data: [
      <?php 
        foreach ($dosen as $value) {
          echo '['.'"'.$value['nama'].'",'.jumlah($value['id'],$kuotaAktif2,'id_dosen_2').'],';
        }
      ?>
    ]
  }]
});
</script>

<script type="text/javascript">
  Highcharts.chart('grafik3', {
  chart: {
    type: 'bar',
    marginLeft: 150
  },
  title: {
    text: 'Data'
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
    max: 20,
    title: {
      text: 'Mahasiswa',
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
    name: 'Mahasiswa',
    data: [
      <?php 
        foreach ($dosen as $value) {
          echo '['.'"'.$value['nama'].'",'.jumlah($value['id'],$kuotaSelesai,'id_dosen_1').'],';
        }
      ?>
    ]
  }]
});
</script>

<script type="text/javascript">
  Highcharts.chart('grafik4', {
  chart: {
    type: 'bar',
    marginLeft: 150
  },
  title: {
    text: 'Data'
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
    max: 20,
    title: {
      text: 'Mahasiswa',
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
    name: 'Mahasiswa',
    data: [
      <?php 
        foreach ($dosen as $value) {
          echo '['.'"'.$value['nama'].'",'.jumlah($value['id'],$kuotaSelesai2,'id_dosen_2').'],';
        }
      ?>
    ]
  }]
});
</script>