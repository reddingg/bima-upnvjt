<?php 
echo $this->session->flashdata('pesan'); 
if ($this->session->userdata('tema') == 'black') {
  $color = 'white';
}
else{
  $color = 'black';
}
?>

<div class="row">
  <!-- laboratorium -->
  <div class="col-md-6">
    <div class="card card-body">
      <form method="post">
        <div class="row " style="margin-top: -1rem; margin-bottom: -1rem;">
            <div class="col-md-9">
              <div class="form-group">
                <input type="text" name="nama" value="<?php echo @$ubahlaboratorium['nama']; ?>" placeholder="Nama laboratorium" class="form-control" style="color: <?php echo $color; ?>">
                <input type="hidden" name="id" value="<?php echo @$ubahlaboratorium['id']; ?>">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <?php
                  if (@$ubahlaboratorium['nama'] != '') {
                    echo '<button value="laboratorium" class="btn btn-warning btn-sm" name="simpan-ubah">Ubah</button>';
                  }
                  else{
                    echo '<button value="laboratorium" class="btn btn-warning btn-sm" name="simpan">Tambah</button>';
                  }
                ?>
              </div>
            </div>
        </div>
      </form>
    </div>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar laboratorium</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table1" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Nama laboratorium</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
              $no=1;
              foreach ($lab as $value) {
                echo '<tr>';
                echo '<td>'.$no.'</td>';
                echo '<td>'.$value['nama'].'</td>';
                echo '<td class="text-center">
                <a title="Ubah" href="'.base_url()."admin/laboratorium/ubah/".$value["id"].'/laboratorium"'.' class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>';
                if ($no > 1) {
                ?>
                  <a title="Hapus" href="<?php echo base_url().'admin/laboratorium/hapus/'.$value['id']; ?>/laboratorium" class="btn btn-danger" onclick="return confirm('Hapus laboratorium <?php echo $value['nama']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
                <?php
                }
                echo '</td>';
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
  <!-- bidang keahlian -->
  <div class="col-md-6">
    <div class="card card-body">
      <form method="post">
        <div class="row " style="margin-top: -1rem; margin-bottom: -1rem;">
            <div class="col-md-9">
              <div class="form-group">
                <input type="text" name="nama" value="<?php echo @$ubahbidang_keahlian['nama']; ?>" placeholder="Nama bidang keahlian" class="form-control" style="color: <?php echo $color; ?>">
                <input type="hidden" name="id" value="<?php echo @$ubahbidang_keahlian['id']; ?>">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <?php
                  if (@$ubahbidang_keahlian['nama'] != '') {
                    echo '<button value="bidang_keahlian" class="btn btn-warning btn-sm" name="simpan-ubah">Ubah</button>';
                  }
                  else{
                    echo '<button value="bidang_keahlian" class="btn btn-warning btn-sm" name="simpan">Tambah</button>';
                  }
                ?>
              </div>
            </div>
        </div>
      </form>
    </div>
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Daftar bidang keahlian</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table2" class="table dataTable">
            <thead>
              <th>No.</th>
              <th>Nama bidang keahlian</th>
              <th class="text-center"><i class="fas fa-cog"></i></th>
            </thead>
            <tbody>
              <?php
              $no=1;
              foreach ($bidang as $value) {
                echo '<tr>';
                echo '<td>'.$no.'</td>';
                echo '<td>'.$value['nama'].'</td>';
                echo '<td class="text-center">
                      <a title="Ubah" href="'.base_url()."admin/laboratorium/ubah/".$value["id"].'/bidang_keahlian"'.' class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>';
                if ($no > 1) {
                ?>
                  <a title="Hapus" href="<?php echo base_url().'admin/laboratorium/hapus/'.$value['id']; ?>/bidang_keahlian" class="btn btn-danger" onclick="return confirm('Hapus laboratorium <?php echo $value['nama']; ?> ?');"><i class="fas fa-trash-alt"></i></a>
                <?php
                }
                echo '</td>';
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
        $('#example').DataTable({
            "paging": true,
            "info": false,
            "ordering": true,
            "lengthChange": false
        });
    });
    $(document).ready( function () {
        $('#example2').DataTable({
            "paging": true,
            "info": false,
            "ordering": true,
            "lengthChange": false
        });
    });
</script>
