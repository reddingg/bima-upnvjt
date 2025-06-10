<div class="row">
  <div class="col-md-12">
  <?php echo $this->session->flashdata('pesan'); ?>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar email yang dikirim</h4>
        <!-- <p class="card-category"> Alur juga akan ditampilkan pada halaman alur bima</p> -->
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Tujuan</th>
              <th>Pesan</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach ($data as $value) {
                  echo '<tr>';
                  echo '<td>'.$no.'</td>';
                  echo '<td>'.$value['email'].'</td>';
                  echo '<td>'.substr($value['pesan'],0,50).' ...</td>';
                  echo '<td class="text-center">';
                  ?>
                    <a title="Detail" href="<?php echo base_url().'admin/akun/detail/'.$value['id_mahasiswa']; ?>" class="btn btn-info"><i class="far fa-file-alt"></i></a>
                    <a title="Hapus" href="<?php echo base_url().'admin/email/hapus/'.$value['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus pesan <?php echo $value['email']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
    $(document).ready( function () {
        $('#berita').DataTable({
            "paging": true,
            "info": false,
            "ordering": true,
            "lengthChange": false
        });
    } );
</script>
