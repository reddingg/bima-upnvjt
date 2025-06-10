<div id="my-pics" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php
    $no = 0;
      foreach ($carousel as $value) {
        if ($no == 0) {
          echo '<li data-target="#my-pics" data-slide-to="0" class="active"></li>';
        }
        else{
          echo '<li data-target="#my-pics" data-slide-to="'.$no.'"></li>';
        }
        $no++;
      }
    ?>
  </ol>
  <!-- Content -->
  <div class="carousel-inner" role="listbox">
    <?php 
      $no = 0;
      foreach ($carousel as $value) {
        if ($no == 0) {
          echo '<div class="item active">';
        }
        else{
          echo '<div class="item">';
        }
        echo '<div class="overlay"></div><img src="'.base_url().'data/carousel/'.$value['nama_file'].'" alt="img" style="height: 80vh; width: 100%">
          <div class="carousel-caption">
            <!-- <h4 style="font-color: white;">'.$value['judul'].'</h3> -->
          </div>
        </div>';
        $no++;
      }
      // jika tidak ada gambar carousel
      if ($no == 0) {
        echo '<div class="item active"><div class="overlay"></div><img src="'.base_url().'assets/utama/images/bg.png'.'" alt="img" style="height: 60vw; width: 100%">
          <div class="carousel-caption">
            <!-- <h4 style="font-color: white;">'.'</h3> -->
          </div>
        </div>';
      }
    ?>    
  </div>
  <!-- Previous/Next controls -->
  <a class="left carousel-control" href="#my-pics" role="button" data-slide="prev">
    <span class="icon-prev" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#my-pics" role="button" data-slide="next">
    <span class="icon-next" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div align="center" style="position: absolute;
    top: 35vh;
    width: 100%;
    color: #FFF;">
  <div class="container">
      <h1 style="color: white; font-size: 7vmin;">Bimbingan Mahasiswa</h1>
      <h2 style="color: white; font-size: 4vmin;">Informatika UPN "Veteran" Jatim</h2>  
  </div>             
</div>