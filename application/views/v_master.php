<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php $this->load->view('_include/_head'); ?>

<body class="<?php if ($this->session->userdata('tema') == 'black'){ echo 'dark-edition'; } ?>">
  <div class="wrapper ">

    <!-- sidebar -->
    <?php 
      $role = $this->session->userdata('role');
      if (@$role == 'admin') {
        $this->load->view('_include/_sidebar_admin'); 
      }elseif (@$role == 'dosen') {
        $this->load->view('_include/_sidebar_dosen');
      }elseif (@$role == 'mahasiswa') {
        $this->load->view('_include/_sidebar_mahasiswa'); 
      }else {
        $this->load->view('_include/_sidebar_pimpinan'); 
      }
    ?>

    <div class="main-panel">  
      <!-- navbar -->
      <?php $this->load->view('_include/_navbar'); ?>

      <div class="content">
        <div class="container-fluid">
          
          <!-- content -->
          <?php echo $contents; ?>
        
        </div>
      </div>

      <!-- footer -->
      <?php $this->load->view('_include/_footer'); ?>
    
    </div>
  </div>
  

</body>

</html>

<!-- script -->
<?php $this->load->view('_include/_script'); ?>