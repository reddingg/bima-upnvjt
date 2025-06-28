<?php
echo $this->session->flashdata('pesan');
// cek posisi dosen
if ($topik['id_dosen_1'] == $this->session->userdata('id')) {
  $posisi = 0;
} else {
  $posisi = 1;
}

if ($this->session->userdata('tema') == 'black') {
  $color = 'white';
} else {
  $color = 'black';
}
?>

<style type="text/css">
  .multi-steps>li.is-active:before,
  .multi-steps>li.is-active~li:before {
    content: counter(stepNum);
    font-family: inherit;
    font-weight: 700;
  }

  /* nonaktif */
  .multi-steps>li.is-active:after,
  .multi-steps>li.is-active~li:after {
    background-color: red;
  }

  .multi-steps {
    display: table;
    table-layout: fixed;
    width: 100%;
  }

  .multi-steps>li {
    counter-increment: stepNum;
    text-align: center;
    display: table-cell;
    position: relative;
    color: #33cc33;
  }

  .multi-steps>li:before {
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

  .multi-steps>li:after {
    content: '';
    height: 2px;
    width: 100%;
    background-color: #33cc33;
    position: absolute;
    top: 16px;
    left: 50%;
    z-index: -1;
  }

  .multi-steps>li:last-child:after {
    display: none;
  }

  .multi-steps>li.is-active:before {
    background-color: #fff;
    border-color: #33cc33;
  }

  /* nonaktif */
  .multi-steps>li.is-active~li {
    color: red;
  }

  .multi-steps>li.is-active~li:before {
    background-color: white;
    border-color: red;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <?php
    echo '<a href="' . base_url() . 'dosen/mahasiswa/pemberitahuan/' . $topik['id_mahasiswa'] . '" class="btn btn-primary pull-right">Pemberitahuan</a>
				<a href="' . base_url() . 'dosen/mahasiswa/riwayat/' . $topik['id_mahasiswa'] . '" class="btn btn-primary pull-right" style="margin-right: 1rem;">Riwayat</a>
        <a href="' . base_url() . 'dosen/mahasiswa/bimbingan/' . $topik['id_mahasiswa'] . '" class="btn btn-primary pull-right" style="margin-right: 1rem;">Bimbingan</a>
				<a href="' . base_url() . 'dosen/mahasiswa/profil/' . $topik['id_mahasiswa'] . '" class="btn btn-primary pull-right" style="margin-right: 1rem;">Profil</a>';
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
        <div class="row">
          <div class="col-md-12">
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Nama</label>
              <input type="text" value="<?php echo $profil['nama']; ?>" name="nama" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">NPM</label>
              <input type="text" value="<?php echo $profil['npm']; ?>" name="npm" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
            </div>
            <div class="form-group" style="margin-top: 1rem;">
              <label style="color: #AAAAAA; top: -1rem;">Judul</label>
              <input type="text" value="<?php echo $topik['judul']; ?>" name="judul" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group" style="margin-top: 0;">
                  <label style="color: #AAAAAA; top: -1rem;">Dosen pembimbing 1</label>
                  <select class="form-control" name="dosen1" style="margin-top: -0.5rem; color: <?php echo $color; ?>" disabled="disabled">
                    <?php
                    foreach ($dosen as $value) {
                      if ($topik['id_dosen_1'] == $value['id']) {
                        echo '<option selected value="' . $value['id'] . '">' . $value['nama'] . '</option>';
                      } else {
                        echo '<option value="' . $value['id'] . '">' . $value['nama'] . '</option>';
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
                  $accept1 = 'Belum disetujui';
                  if ($acc[0]['status'] == 1) {
                    $accept1 = 'Sudah disetujui';
                  } elseif ($acc[0]['status'] == 2) {
                    $accept1 = 'Tidak disetujui';
                  }
                  ?>
                  <input type="text" value="<?php echo $accept1; ?>" name="npm" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">

                  <?php if ($posisi == 0): ?>
                    <a href="<?php echo base_url().'dosen/mahasiswa/detail/'.$topik['id_mahasiswa'].'/acc/1/0'; ?>" 
                      class="btn btn-success btn-sm"
                      onclick="return confirm('Setujui topik ini ?')"
                    >
                      Setuju
                    </a>
                    <a href="<?php echo base_url().'dosen/mahasiswa/detail/'.$topik['id_mahasiswa'].'/acc/2/0'; ?>"
                      class="btn btn-danger btn-sm"
                      onclick="return confirm('Tolak topik ini ?')"
                    >
                      Tolak
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group" style="margin-top: 0;">
                  <label style="color: #AAAAAA; top: -1rem;">Dosen pembimbing 2</label>
                  <select class="form-control" name="dosen2" disabled="disabled" style="margin-top: -0.5rem; color: <?php echo $color; ?>">
                    <?php
                    foreach ($dosen as $value) {
                      if ($topik['id_dosen_2'] == $value['id']) {
                        echo '<option selected value="' . $value['id'] . '">' . $value['nama'] . '</option>';
                      } else {
                        echo '<option value="' . $value['id'] . '">' . $value['nama'] . '</option>';
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
                  } elseif ($acc[1]['status'] == 2) {
                    $accept = 'Tidak disetujui';
                  } else {
                    $accept = 'Belum disetujui';
                  }
                  ?>
                  <input type="text" value="<?php echo $accept; ?>" class="form-control" style="color: <?php echo $color; ?>" disabled="disabled">

                  <?php if ($posisi == 1): ?>
                    <a href="<?php echo base_url().'dosen/mahasiswa/detail/'.$topik['id_mahasiswa'].'/acc/1/1'; ?>" 
                      class="btn btn-success btn-sm"
                      onclick="return confirm('Setujui topik ini ?')"
                    >
                      Setuju
                    </a>
                    <a href="<?php echo base_url().'dosen/mahasiswa/detail/'.$topik['id_mahasiswa'].'/acc/2/1'; ?>"
                      class="btn btn-danger btn-sm"
                      onclick="return confirm('Tolak topik ini ?')"
                    >
                      Tolak
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group" style="margin-top: 0;">
                  <label style="color: #AAAAAA; top: -1rem;">Laboratorium</label>
                  <select class="form-control" name="lab" disabled="disabled" style="margin-top: -0.5rem; color: <?php echo $color; ?>">
                    <?php
                    foreach ($lab as $value) {
                      if ($topik['id_laboratorium'] == $value['id']) {
                        echo '<option selected value="' . $value['id'] . '">' . $value['nama'] . '</option>';
                      } else {
                        echo '<option value="' . $value['id'] . '">' . $value['nama'] . '</option>';
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="form-group" style="margin-top: 0;">
                  <label style="color: #AAAAAA; top: -1rem;">Bidang keahlian</label>
                  <select class="form-control" name="bidang" disabled="disabled" style="margin-top: -0.5rem; color: <?php echo $color; ?>">
                    <?php
                    foreach ($bidang as $value) {
                      if ($topik['id_bidang_keahlian'] == $value['id']) {
                        echo '<option selected value="' . $value['id'] . '">' . $value['nama'] . '</option>';
                      } else {
                        echo '<option value="' . $value['id'] . '">' . $value['nama'] . '</option>';
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
    ?> <li class="is-active"><a href="#"><?php echo $value['judul']; ?></a></li> <?php
                                                                                } else {
                                                                                  ?> <li><a href="#"><?php echo $value['judul']; ?></a></li> <?php
                                                                                                                                                  }
                                                                                                                                                  $no++;
                                                                                                                                                }
                                                                                                                                                    ?>
  </ul>
</div>