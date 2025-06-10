<?php
echo $this->session->flashdata('pesan');

function tahap($tahap, $alur)
{
  $no = 0;
  foreach ($alur as $value) {
    if ($no == $tahap) {
      return $value['judul'];
    }
    $no++;
  }
}

function status($value)
{
  if ($value == 2) {
    return 'Sudah divalidasi';
  } elseif ($value == 1) {
    return 'Sudah diunggah';
  } else {
    return 'Belum diunggah';
  }
}

function cek($id, $berkas, $kolom)
{
  foreach ($berkas as $value) {
    if ($id == $value['id_dokumen']) {
      return $value[$kolom];
    }
  }
  return 0;
}
?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar berkas</h4>
        <p class="card-category">Mahasiswa wajib mengunggah berkas administrasi</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Tahap</th>
              <th>Nama berkas</th>
              <th>Jumlah</th>
              <th>Format</th>
              <th>Unggah (.pdf, max 2MB)</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($berkas as $value) {
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . tahap($value['jenis'], $alur) . '</td>';
                echo '<td>' . $value['nama'] . '</td>';
                echo '<td>' . $value['jumlah'] . '</td>';

                // format
                echo '<td class="text-center">';
                if ($value['nama_file'] != '') {
                  # code...
                  echo '<a title="unduh" href="/bima/data/dokumen/' . $value['nama_file'] . '" class="btn btn-success"><i class="fas fa-download"></i></a>';
                } else {
                  echo '-';
                }
                echo '</td>';

                // unggah
                $status = cek($value['id'], $berkasMhs, 'status');
                if ($status == 0) {
                  echo '<td><form method="post" enctype="multipart/form-data">
                            <input type="file" name="file" required="required" accept="application/pdf">
                            <input type="hidden" name="id" value="' . $value['id'] . '">
                            <input type="submit" name="unggah" class="btn btn-primary btn-sm" value="Unggah">
                          </form></td>';
                } else {
                  // status
                  echo '<td>' . status($status) . '</td>';
                }


                //opsi
                echo '<td class="text-center">';
                if ($status != 0) {
                  echo '<a title="unduh" href="' . base_url() . 'data/dokumen/mahasiswa/' . cek($value['id'], $berkasMhs, 'nama_file') . '" class="btn btn-info"><i class="fas fa-download"></i></a>';
                }
                if ($status == 1) {
              ?>
                  <a title="Hapus" href="<?php echo base_url() . 'mahasiswa/dokumen/hapus/' . cek($value['id'], $berkasMhs, 'id'); ?>" class="btn btn-danger" onclick="return confirm('Hapus berkas <?php echo $value['nama']; ?> ?');"><i class="fas fa-trash-alt"></i></a></td>
              <?php
                }

                echo '</td></tr>';
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