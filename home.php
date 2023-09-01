<div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
          <li class="breadcrumb-item active">asdqwe</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<!-- Left side columns -->
<!-- <div class="col-lg-8"> -->
<div class="row">

          <?php if ($_SESSION['login']['level'] == 'admin') : ?>
            <!-- Sales Card -->
            <div class="col-xl-4 col-md-6">
              <div class="card info-card">

        <div class="card-body">
          <h5 class="card-title">Jumlah <a href="?page=karyawan">Karyawan</a></h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-users"></i>
            </div>
            <div class="ps-3">
              <?php
              $sql = $koneksi->query("SELECT * FROM karyawan");
              $data = array();
              while (($row = $sql->fetch_assoc()) != null) {
                $data[] = $row;
              }
              $count = count($data);
              ?>
              <h6><?= $count ?></h6>
            </div>
          </div>
        </div>

      </div>
    </div><!-- End Sales Card -->

    <!-- Revenue Card -->
    <div class="col-xl-4 col-md-6">
      <div class="card info-card">

        <div class="card-body">
          <h5 class="card-title">Jumlah <a href="?page=alat">Alat</a></h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-hammer"></i>
            </div>
            <div class="ps-3">
              <?php
              $sql = $koneksi->query("SELECT * FROM alat");
              $data = array();
              while (($row = $sql->fetch_assoc()) != null) {
                $data[] = $row;
              }
              $count = count($data);
              ?>
              <h6><?= $count ?></h6>
            </div>
          </div>
        </div>

      </div>
    </div><!-- End Revenue Card -->

    <!-- Customers Card -->
    <div class="col-xl-4 col-md-6">
      <div class="card info-card">

        <div class="card-body">
          <h5 class="card-title">Jumlah <a href="?page=bahan">Bahan</a></h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-cube"></i>
            </div>
            <div class="ps-3">
              <?php
              $sql = $koneksi->query("SELECT * FROM bahan");
              $data = array();
              while (($row = $sql->fetch_assoc()) != null) {
                $data[] = $row;
              }
              $count = count($data);
              ?>
              <h6><?= $count ?></h6>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- End Customers Card -->

    <div class="col-xl-4 col-md-6">
      <div class="card info-card">

        <div class="card-body">
          <h5 class="card-title">Jumlah <a href="?page=supplier">Supplier</a></h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-boxes-packing"></i>
            </div>
            <div class="ps-3">
              <?php
              $sql = $koneksi->query("SELECT * FROM supplier");
              $data = array();
              while (($row = $sql->fetch_assoc()) != null) {
                $data[] = $row;
              }
              $count = count($data);
              ?>
              <h6><?= $count ?></h6>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="col-xl-4 col-md-6">
      <div class="card info-card">

        <div class="card-body">
          <h5 class="card-title">Jumlah <a href="?page=proyek">Project</a></h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-building"></i>
            </div>
            <div class="ps-3">
              <?php
              $sql = $koneksi->query("SELECT * FROM project");
              $data = array();
              while (($row = $sql->fetch_assoc()) != null) {
                $data[] = $row;
              }
              $count = count($data);
              ?>
              <h6><?= $count ?></h6>
            </div>
          </div>

        </div>
      </div>
    </div>

  <?php else : ?>
    <div class="col-xl-4 col-md-6">
      <div class="card info-card">

        <div class="card-body">
          <h5 class="card-title">Jumlah <a href="?page=absensi">Karyawan</a></h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-users"></i>
            </div>
            <div class="ps-3">
              <?php
              $sql = $koneksi->query("SELECT * FROM karyawan");
              $data = array();
              while (($row = $sql->fetch_assoc()) != null) {
                $data[] = $row;
              }
              $count = count($data);
              ?>
              <h6><?= $count ?></h6>
            </div>
          </div>
        </div>

      </div>
    </div>
  <?php endif; ?>
</div>
<!-- </div> -->
<!-- End Left side columns -->