<?php
echo $this->session->flashdata('pesan'); 
if ($this->session->userdata('tema') == 'black') {
  $color = 'white';
}
else{
  $color = 'black';
}

?>
<!-- data topik -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Data topik</h4>
        <p class="card-category">Setelah topik disetujui, mahasiswa tidak bisa merubah data lagi. Silahkan hubungi admin untuk informasi lebih lanjut.</p>
      </div>
      <div class="card-body">
        <form method="post" action="<?php echo base_url(); ?>mahasiswa/topik" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group" style="margin-top: 1rem;">
                <label style="color: #AAAAAA; top: -1rem;">Judul</label>
                <input type="text" value="<?php echo $topik['judul']; ?>" name="judul" class="form-control" style="color: <?php echo $color; ?>" required="required">
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group" style="margin-top: 0rem;">
                    <label style="color: #AAAAAA; top: -1rem;">Dosen pembimbing 1</label>
                    <select class="form-control" name="dosen1" required="required" style="margin-top: -0.3rem; color: <?php echo $color; ?>" required="required">
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
                        $class  = 'success';
                      }
                      elseif ($acc[0]['status'] == 2) {
                        $accept = 'Tidak disetujui';
                        $class  = 'danger';
                      }
                      else {
                        $accept = 'Belum disetujui';
                        $class  = 'warning';
                      }
                      echo '<a href="#" class="btn btn-'.$class.' btn-sm">'.$accept.'</a>';
                    ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group" style="margin-top: 0rem;">
                    <label style="color: #AAAAAA; top: -1rem;">Dosen pembimbing 2</label>
                    <select class="form-control" name="dosen2" required="required" style="margin-top: -0.3rem; color: <?php echo $color; ?>">
                      <?php 
                        foreach ($dosen as $value) {
                          if ($topik['id_dosen_2'] == $value['id']) {
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
                        $class  = 'success';
                      }
                      elseif ($acc[1]['status'] == 2) {
                        $accept = 'Tidak disetujui';
                        $class  = 'danger';
                      }
                      else {
                        $accept = 'Belum disetujui';
                        $class  = 'warning';
                      }
                      echo '<a href="#" class="btn btn-'.$class.' btn-sm">'.$accept.'</a>';
                    ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group" style="margin-top: 0rem;">
                    <label style="color: #AAAAAA; top: -1rem;">Laboratorium</label>
                    <select class="form-control" name="lab" required="required" style="margin-top: -0.3rem; color: <?php echo $color; ?>">
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
                  <div class="form-group" style="margin-top: 0rem;">
                    <label style="color: #AAAAAA; top: -1rem;">Bidang keahlian</label>
                    <select class="form-control" name="bidang" required="required" style="margin-top: -0.3rem; color: <?php echo $color; ?>">
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
          if ($topik['tahap'] < $daftar[0]) {
            echo '<button type="submit" name="simpan-ubah" class="btn btn-warning pull-right">Simpan</button>';
          }

          $no=0;
          foreach ($alur as $value) {
            if ($value['daftar'] == 1) {
              //jika tahap sama brati muncul tombol batal daftar dan posisi mundur 1 langkah
              if ($no == $topik['tahap']) {
                echo '<button type="submit" name="ubah-status" value="'.($no-1).'"" class="btn btn-danger pull-right">BATAL '.$value['judul'].'</button>';
              }
              elseif ($no-1 == $topik['tahap']) {
                echo '<button type="submit" name="ubah-status" value="'.($no).'"" class="btn btn-primary pull-right">'.$value['judul'].'</button>';
              }
            }
            $no++;
          }
          ?>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
  </div>
</div>
