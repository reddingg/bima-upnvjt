<?php
echo $this->session->flashdata('pesan'); 
if ($this->session->userdata('tema') == 'black') {
	$color = 'white';
}
else{
	$color = 'black';
}

function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
  );
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

?>

<style type="text/css">
.multi-steps > li.is-active:before, .multi-steps > li.is-active ~ li:before {
  content: counter(stepNum);
  font-family: inherit;
  font-weight: 700;
}
/* nonaktif */
.multi-steps > li.is-active:after, .multi-steps > li.is-active ~ li:after {
  background-color: red; 
}

.multi-steps {
  display: table;
  table-layout: fixed;
  width: 100%;
}
.multi-steps > li {
  counter-increment: stepNum;
  text-align: center;
  display: table-cell;
  position: relative;
  color: #33cc33;
}
.multi-steps > li:before {
  content: '\f00c';
  content: '\2713;';
  content: '\10003';
  content: '\10004';
  content: '\2713';
  display: block;
  margin: 0 auto 4px;
  background-color: #fff;
  width: 36px;
  height: 36px;
  line-height: 32px;
  text-align: center;
  font-weight: bold;
  border-width: 2px;
  border-style: solid;
  border-color: #33cc33;
  border-radius: 50%;
}
.multi-steps > li:after {
  content: '';
  height: 2px;
  width: 100%;
  background-color: #33cc33;
  position: absolute;
  top: 16px;
  left: 50%;
  z-index: -1;
}
.multi-steps > li:last-child:after {
  display: none;
}
.multi-steps > li.is-active:before {
  background-color: #fff;
  border-color: #33cc33;
}
/* nonaktif */
.multi-steps > li.is-active ~ li { 
  color: red; 
}
.multi-steps > li.is-active ~ li:before {
  background-color: white;
  border-color: red;
}
</style>

<div class="row">
	<div class="col-md-12">
		<?php
			echo '<a href="'.base_url().'admin/akun/pemberitahuan/'.$this->uri->segment('4').'" class="btn btn-primary pull-right">Pemberitahuan</a>
				<a href="'.base_url().'admin/akun/riwayat/'.$this->uri->segment('4').'" class="btn btn-primary pull-right" style="margin-right: 1rem;">Riwayat</a>
        <a href="'.base_url().'admin/akun/bimbingan/'.$this->uri->segment('4').'" class="btn btn-primary pull-right" style="margin-right: 1rem;">Bimbingan</a>
        <a href="'.base_url().'admin/akun/dokumen/'.$this->uri->segment('4').'" class="btn btn-primary pull-right" style="margin-right: 1rem;">Berkas</a>
				<a href="'.base_url().'admin/akun/profil/'.$this->uri->segment('4').'" class="btn btn-primary pull-right" style="margin-right: 1rem;">Profil</a>';
		?>		
	</div>
</div>

<!-- data topik -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Data mahasiswa</h4>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;">Nama</label>
                <input type="text" value="<?php echo $topik['nama']; ?>" name="nama" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
                <input type="hidden" value="<?php echo $topik['id_mahasiswa']; ?>" name="idmhs">
              </div>
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;">NPM</label>
                <input type="text" value="<?php echo $topik['npm']; ?>" name="npm" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
              </div>
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;">Judul</label>
                <input type="text" value="<?php echo $topik['judul']; ?>" name="judul" class="form-control" style="color: <?php echo $color; ?>" required="required">
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group" style="margin-top: 0;">
                    <label style="color: #AAAAAA; top: -1rem;">Dosen pembimbing 1</label>
                    <select class="form-control" name="dosen1" required="required" style="margin-top: -0.5rem; color: <?php echo $color; ?>" required="required">
                      <?php 
                        foreach ($dosen as $value) {
                          if ($topik['id_dosen_1'] == $value['id']) {
                            echo '<option selected value="'.$value['id'].'">'.$value['nama'].'</option>';
                          }
                          else{
                            echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col" style="margin-top: 0rem;">
                  <div class="form-group" style="margin-top: 0rem;">
                    <label style="color: #AAAAAA; top: 0rem;">Status</label><br>
                    <?php
                    	if ($acc[0]['status'] == 1) {
                        $accept = 'Sudah disetujui';
                    	}
                      elseif ($acc[0]['status'] == 2) {
                        $accept = 'Tidak disetujui';
                      }
                    	else {
                        $accept = 'Belum disetujui';
                    	}
                    ?>
                    <input type="text" value="<?php echo $accept; ?>" name="npm" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
                    <a href="<?php echo base_url().'admin/akun/detail/'.$topik['id_mahasiswa'].'/acc/'.$topik['id_dosen_1'].'/1/0'; ?>" class="btn btn-success btn-sm" onclick="return confirm('Setujui topik ini ?')">Setuju</a>
                    <a href="<?php echo base_url().'admin/akun/detail/'.$topik['id_mahasiswa'].'/acc/'.$topik['id_dosen_1'].'/2/0'; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tolak topik ini ?')">Tolak</a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group" style="margin-top: 0;">
                    <label style="color: #AAAAAA; top: -1rem;">Dosen pembimbing 2</label>
                    <select class="form-control" name="dosen2" required="required" style="margin-top: -0.5rem; color: <?php echo $color; ?>">
                      <?php 
                        foreach ($dosen as $value) {
                          if ($topik2['id_dosen_2'] == $value['id']) {
                            echo '<option selected value="'.$value['id'].'">'.$value['nama'].'</option>';
                          }
                          else{
                            echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col" style="margin-top: 0rem;">
                  <div class="form-group" style="margin-top: 0rem;">
                    <label style="color: #AAAAAA; top: 0rem;">Status</label><br>
                    <?php
                      if ($acc[1]['status'] == 1) {
                        $accept = 'Sudah disetujui';
                      }
                      elseif ($acc[1]['status'] == 2) {
                        $accept = 'Tidak disetujui';
                      }
                      else {
                        $accept = 'Belum disetujui';
                      }
                    ?>
                    <input type="text" value="<?php echo $accept; ?>" name="npm" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
                    <a href="<?php echo base_url().'admin/akun/detail/'.$topik['id_mahasiswa'].'/acc/'.$topik2['id_dosen_2'].'/1/1'; ?>" class="btn btn-success btn-sm" onclick="return confirm('Setujui topik ini ?')">Setuju</a>
                    <a href="<?php echo base_url().'admin/akun/detail/'.$topik['id_mahasiswa'].'/acc/'.$topik2['id_dosen_2'].'/2/1'; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tolak topik ini ?')">Tolak</a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group" style="margin-top: 0;">
                    <label style="color: #AAAAAA; top: -1rem;">Laboratorium</label>
                    <select class="form-control" name="lab" required="required" style="margin-top: -0.5rem; color: <?php echo $color; ?>">
                      <?php 
                        foreach ($lab as $value) {
                          if ($topik['id_laboratorium'] == $value['id']) {
                            echo '<option selected value="'.$value['id'].'">'.$value['nama'].'</option>';
                          }
                          else{
                            echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group" style="margin-top: 0;">
                    <label style="color: #AAAAAA; top: -1rem;">Bidang keahlian</label>
                    <select class="form-control" name="bidang" required="required" style="margin-top: -0.5rem; color: <?php echo $color; ?>">
                      <?php 
                        foreach ($bidang as $value) {
                          if ($topik['id_bidang_keahlian'] == $value['id']) {
                            echo '<option selected value="'.$value['id'].'">'.$value['nama'].'</option>';
                          }
                          else{
                            echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;">Latar belakang</label>
                <textarea style="color: <?php echo $color; ?>" class="form-control" name="latar" rows="5"><?php echo $topik['latar_belakang']; ?></textarea>
              </div>
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;">Tujuan</label>
                <textarea style="color: <?php echo $color; ?>" class="form-control" name="tujuan" rows="5"><?php echo $topik['tujuan']; ?></textarea>
              </div>
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;">Permasalahan</label>
                <textarea style="color: <?php echo $color; ?>" class="form-control" name="permasalahan" rows="5"><?php echo $topik['permasalahan']; ?></textarea>
              </div>
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;">Metodologi penelitian</label>
                <textarea style="color: <?php echo $color; ?>" class="form-control" name="metodologi" rows="5"><?php echo $topik['metodologi']; ?></textarea>
              </div>
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;">Metode yang digunakan</label>
                <textarea style="color: <?php echo $color; ?>" class="form-control" name="metode" rows="5"><?php echo $topik['metode']; ?></textarea>
              </div>
            </div>
          </div>
          <?php
            // if ($topik['tahap'] == 0) {
            //   echo '<button type="submit" value="1" name="ubah-status" class="btn btn-primary pull-left">Daftar Pra Skripsi</button>';
            // }
            // elseif ($topik['tahap'] == 1) {
            //   echo '<button type="submit" value="0" name="ubah-status" class="btn btn-danger pull-left">Batal Daftar Pra Skripsi</button>';
            // }
            // elseif ($topik['tahap'] == 2) {
            //   echo '<button type="submit" value="3" name="ubah-status" class="btn btn-primary pull-left">Daftar Ujian Skripsi</button>';
            // }
            // elseif ($topik['tahap'] == 3) {
            //   echo '<button type="submit" value="2" name="ubah-status" class="btn btn-danger pull-left">Batal Daftar Ujian Skripsi</button>';
            // }
          ?>
          <button type="submit" name="ubah-topik" class="btn btn-warning pull-right">Simpan</button>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- alur tahapan -->
<div class="row">
  <ul class="list-unstyled multi-steps">
    <?php
      $no = 0;
      foreach ($alur as $value) {
        if ($no == $topik['tahap']) { 
          ?> <li class="is-active"><a href="<?php echo base_url().'admin/akun/detail/'.$this->uri->segment('4').'/tahap/'.$no ?>" onclick="return confirm('Ubah tahap mahasiswa?')"><?php echo $value['judul']; ?></a></li> <?php
        }
        else { 
          ?> <li><a href="<?php echo base_url().'admin/akun/detail/'.$this->uri->segment('4').'/tahap/'.$no ?>" onclick="return confirm('Ubah tahap mahasiswa?')"><?php echo $value['judul']; ?></a></li> <?php 
        }
        $no++;
      }
    ?>
  </ul>
</div>

<!-- tambah data -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Tambah data mahasiswa</h4>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" value="<?php echo $topik['judul']; ?>" name="judul" class="form-control">
              <input type="hidden" value="<?php echo $topik['id_dosen_1']; ?>" name="pembimbing1" class="form-control">
              <input type="hidden" value="<?php echo $topik2['id_dosen_2']; ?>" name="pembimbing2" class="form-control">
              <div class="row">
                <div class="col form-group" style="margin-top: 0;">
                  <label style="color: #AAAAAA; top: -1rem;">Tahap</label>
                  <select id="tahap" name="tahap" class="form-control" style="margin-top: -0.5rem; color: black" required="required">
                    <option selected="" disabled=""></option>
                    <?php 
                      $no=0;
                      foreach ($alur as $value) {
                        echo '<option value="'.$no.'">'.$value['judul'].'</option>';
                        $no++;
                      }
                    ?>
                  </select>
                </div>
                <div class="col form-group" style="margin-top: 0;">
                  <label style="color: #AAAAAA; top: -1rem;">Tanggal</label>
                  <select class="form-control" name="tanggal" id="tampil_tanggal" style="margin-top: -0.5rem; color: black" required="required">
                    <option></option>
                  </select>
                  <!-- <div id="tampil_tanggal"></div> -->
                </div>
              </div>
              <div class="row">
                <div class="col form-group" style="margin-top: 0;">
                  <label style="color: #AAAAAA; top: -1rem;">Dosen penguji 1</label>
                  <select class="form-control" name="penguji1" style="margin-top: -0.5rem; color: black" required="required">
                    <?php foreach ($dosen as $value) { echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>'; } ?>
                  </select>
                </div>
                <div class="col form-group" style="margin-top: 0;">
                  <label style="color: #AAAAAA; top: -1rem;">Dosen penguji 2</label>
                  <select class="form-control" name="penguji2" style="margin-top: -0.5rem; color: black" required="required">
                    <?php foreach ($dosen as $value) { echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>'; } ?>
                  </select>
                </div>
                <div class="col form-group" style="margin-top: 0;">
                  <label style="color: #AAAAAA; top: -1rem;">Dosen penguji 3</label>
                  <select class="form-control" name="penguji3" style="margin-top: -0.5rem; color: black" required="required">
                    <?php foreach ($dosen as $value) { echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>'; } ?>
                  </select>
                </div>
              </div>
              <div class="form-group" style="margin-top: 0;">
                <label style="color: #AAAAAA; top: -1rem;">Hasil</label>
                <select class="form-control" name="hasil" style="margin-top: -0.5rem; color: black">
                  <option value="0">Dalam proses</option>
                  <option value="1">Ditolak</option>
                  <option value="2">Disetujui</option>
                </select>
              </div>
              <div class="form-group bmd-form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;" class="bmd-label-static">Keterangan</label>
                <input type="text" value="" class="form-control" style="color: black" name="keterangan">
              </div>
            </div>
          </div>
          <button type="submit" name="simpan-riwayat" class="btn btn-warning pull-right">Simpan</button>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<script type="text/javascript">
  $(document).ready(function(){  
      $('#tahap').change(function(){  
           var brand_id = $(this).val();  
           $.ajax({  
                url:"<?php echo base_url(); ?>admin/tanggal",  
                method:"POST",  
                data:{brand_id:brand_id},  
                success:function(data){  
                  // alert(data);
                     $('#tampil_tanggal').html(data);  
                }  
           });  
      });  
 });  
</script>