<?php
for ($i = 0; $i <= $jumlahAlur; $i++) {
  if ($i <= $data['tahap']) {
    $status[$i] = 'oke';
  } else {
    $status[$i] = 'bg-danger';
  }
}

// var_dump($status);die();

if ($this->session->userdata('tema') == 'black') {
  $color = 'white';
} else {
  $color = 'black';
}

?>
<style type="text/css">
  .circle {
    padding: 13px 20px;
    border-radius: 50%;
    background-color: #ff0000 !important;
    color: #fff;
    max-height: 50px;
    z-index: 2;
  }

  .how-it-works.row .col-2 {
    align-self: stretch;
  }

  .how-it-works.row .col-2::after {
    content: "";
    position: absolute;
    border-left: 3px solid <?php echo $color; ?>;
    z-index: 1;
  }

  .how-it-works.row .col-2.bottom::after {
    height: 50%;
    left: 50%;
    top: 50%;
  }

  .how-it-works.row .col-2.full-left::after {
    height: 100%;
    left: calc(50%);
  }

  .how-it-works.row .col-2.full-right::after {
    height: 100%;
    left: calc(50% - 3px);
  }

  .how-it-works.row .col-2.top::after {
    height: 50%;
    left: 50%;
    top: 0;
  }

  .how-it-works.row .col-2.top2::after {
    height: 50%;
    left: calc(50% - 3px);
    top: 0;
  }

  .row {
    color: <?php echo $color; ?>;
  }

  .oke {
    background-color: #00ff88 !important;
    color: black;
  }

  .timeline div {
    padding: 0;
    height: 40px;
  }

  .timeline hr {
    border-top: 3px solid <?php echo $color; ?>;
    margin: 0;
    top: 17px;
    position: relative;
  }

  .timeline .col-2 {
    display: flex;
    overflow: hidden;
  }

  .timeline .corner {
    border: 3px solid <?php echo $color; ?>;
    width: 100%;
    position: relative;
    border-radius: 15px;
  }

  .timeline .top-right {
    left: 50%;
    top: -50%;
  }

  .timeline .left-bottom {
    left: -50%;
    top: calc(50% - 3px);
  }

  .timeline .top-left {
    left: -50%;
    top: -50%;
  }

  .timeline .right-bottom {
    left: 50%;
    top: calc(50% - 3px);
  }

  h5 {
    font-weight: bold;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <marquee>
      <h4 style="color: <?php echo $color; ?>">Selamat Datang dihalaman utama Bimbingan Mahasiswa Informatika UPN "Veteran" jatim</h4>
    </marquee>
    <div class="card card-body" style="margin-top: 1rem;">
      <div style="margin-top: -2rem;">
        <h3 class="pb-3 pt-2 border-bottom mb-5" style="color: <?php echo $color; ?>">Kemajuan saya</h3>
        <!-- bagian 1 -->
        <?php
        $no = 0;
        foreach ($alur as $value) {
          if ($no % 2 == 0) {
            if ($no > 0) {
              echo '<div class="row timeline">
                        <div class="col-2">
                          <div class="corner right-bottom"></div>
                        </div>
                        <div class="col-8">
                          <hr/>
                        </div>
                        <div class="col-2">
                          <div class="corner top-left"></div>
                        </div>
                      </div>';
            }
            echo '<div class="row align-items-center how-it-works d-flex">
                      <div class="col-2 text-center bottom d-inline-flex justify-content-center align-items-center">
                        <div class="circle ' . $status[$no] . ' font-weight-bold">' . ($no + 1) . '</div>
                      </div>
                      <div class="col-6">
                        <h5>' . $value['judul'] . '</h5>
                      </div>
                    </div>';
          } else {
            echo '<div class="row timeline">
                      <div class="col-2">
                        <div class="corner top-right"></div>
                      </div>
                      <div class="col-8">
                        <hr/>
                      </div>
                      <div class="col-2">
                        <div class="corner left-bottom"></div>
                      </div>
                    </div>
                    <div class="row align-items-center justify-content-end how-it-works d-flex">
                      <div class="col-6 text-right">
                        <h5>' . $value['judul'] . '</h5>
                      </div>
                      <div class="col-2 text-center full-right d-inline-flex justify-content-center align-items-center">
                        <div class="circle ' . $status[$no] . ' font-weight-bold">' . ($no + 1) . '</div>
                      </div>
                    </div>';
          }
          $no++;
        }
        ?>
      </div>
    </div>
  </div>
</div>