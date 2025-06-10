<div class="row">
  <div class="col-md-12">
  <?php echo $this->session->flashdata('pesan'); ?>
  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalBerita">Tambah berita</button>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar berita</h4>
        <p class="card-category"> Berita juga akan ditampilkan pada halaman beranda bima</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Tanggal</th>
              <th>Judul</th>
              <th>Keterangan</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($berita as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$value['tanggal'].'</td>';
                  echo '<td>'.$value['judul'].'</td>';
                  echo '<td>'.substr($value['keterangan'],0,50).' ...</td>';
                  echo '<td class="text-center">';
                  ?>
                    <a title="Detail" href="<?php echo base_url().'admin/berita/lihat/'.$value['id']; ?>" class="btn btn-info"><i class="far fa-file-alt"></i></a>
                    <a title="Hapus" href="<?php echo base_url().'admin/berita/hapus-berita/'.$value['id'].'/'.$value['nama_file']; ?>" class="btn btn-danger" onclick="return confirm('Hapus berita <?php echo $value['judul']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
                  <?php
                  echo '</tr>';
                  $no++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalGambar">Tambah gambar</button>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar gambar utama</h4>
        <p class="card-category"> Gambar akan ditampilkan pada halaman beranda bima</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table2" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Judul</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($carousel as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$value['judul'].'</td>';
                  echo '<td class="text-center">';
                  ?>
                    <a title="Detail" target="_blank" href="<?php echo base_url().'data/carousel/'.$value['nama_file']; ?>" class="btn btn-info"><i class="far fa-file-alt"></i></a>
                    <a title="Hapus" href="<?php echo base_url().'admin/berita/hapus-carousel/'.$value['id'].'/'.$value['nama_file']; ?>" class="btn btn-danger" onclick="return confirm('Hapus gambar <?php echo $value['judul']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
                  <?php
                  echo '</tr>';
                  $no++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal berita -->
<div class="modal fade" id="modalBerita" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah berita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url(); ?>admin/berita" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group" style="margin-top: 1rem;">
            <label for="exampleFormControlInput1" style="color: #AAAAAA; top: -1rem;">Judul</label>
            <input type="text" name="judul" class="form-control" id="exampleFormControlInput1" required="required">
          </div>
          <div class="form-group" style="margin-top: 1rem;">
            <label for="exampleFormControlInput1" style="color: #AAAAAA; top: -1rem;">Keterangan</label>
            <textarea class="form-control" name="keterangan" rows="5"></textarea>
          </div>
          <div class="">
            <label for="exampleFormControlfFile1">Lampiran</label>
            <input type="file" name="file" class="form-control" required="required">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" name="simpan-berita" class="btn btn-warning">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal gambar -->
<div class="modal fade" id="modalGambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url(); ?>admin/berita" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group" style="margin-top: 1rem;">
              <label for="exampleFormControlInput1" style="color: #AAAAAA; top: -1rem;">Judul</label>
              <input type="text" name="judul" class="form-control" id="exampleFormControlInput1" placeholder="" required="required">
            </div>
            <div class="">
              <label for="exampleFormControlfFile1">Pilih gambar</label>
              <input type="file" name="file" class="form-control" id="exampleFormControlFile1" placeholder="name@example.com">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" name="simpan-carousel" class="btn btn-warning">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>