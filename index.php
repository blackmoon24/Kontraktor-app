<?php include 'koneksi.php';
include 'fungsi.php';
session_start(); 
if (!isset($_SESSION['login'])) {
    echo "<script>alert('silahkan login dulu');
        location.href='login/login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <?php if ($_GET['page']=='home') { ?>
  <title>Home</title>
  <?php } elseif ($_GET['page']=='karyawan') { ?>
  <title>Data Karyawan</title>
  <?php } elseif ($_GET['page']=='alat') { ?>
  <title>Data Alat</title>
  <?php } elseif ($_GET['page']=='bahan') { ?>
  <title>Data Bahan</title>
  <?php } elseif ($_GET['page']=='supplier') { ?>
  <title>Data Supplier</title>
  <?php } elseif ($_GET['page']=='proyek') { ?>
  <title>Data Project</title>
  <?php } elseif ($_GET['page']=='absensi') { ?>
  <title>Data Absensi Karyawan</title>
  <?php } elseif ($_GET['page']=='mobilisasi') { ?>
  <title>Data Mobilisasi</title>
  <?php } ?>


  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon"> -->
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- icon -->
  <script src="https://kit.fontawesome.com/17f0b08d6d.js" crossorigin="anonymous"></script>
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- datatable -->
<link href="assets/vendor/datatable/DataTables-1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
<link href="assets/vendor/datatable/Buttons-2.3.6/css/buttons.bootstrap5.min.css" rel="stylesheet"/>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <!-- <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a> -->
      <i class="fa-sharp fa-solid fa-bars toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
            <i class="fa-solid fa-user"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION["login"]["username"] ?></span>
          </a>
          <!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
              <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed " href="?page=home">
        <i class="fa-sharp fa-solid fa-house-chimney"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <?php if ($_SESSION['login']['level']=='admin') : ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="?page=karyawan">
          <i class="fa-solid fa-users"></i>
          <span>Karyawan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="?page=alat">
        <i class="fa-solid fa-hammer"></i>
          <span>Alat</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="?page=bahan">
        <i class="fa-solid fa-cube"></i>
          <span>Bahan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="?page=supplier">
        <i class="fa-solid fa-boxes-packing"></i>
          <span>Supplier</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="?page=proyek">
        <i class="fa-solid fa-building"></i>
          <span>Project</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="?page=mobilisasi">
        <i class="fa-solid fa-truck-fast"></i>
          <span>Mobilisasi</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="?page=upah">
        <i class="fa fa-money"></i>
          <span>Upah</span>
        </a>
      </li>
      <?php endif; ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="?page=absensi">
        <i class="fa-solid fa-book"></i>
          <span>Absensi</span>
        </a>
      </li>


      <?php if ($_SESSION['login']['level']=='admin') : ?>
      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="?page=profile">
          <i class="fa-solid fa-user"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->
      <?php endif; ?>

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <section class="section dashboard">
      <div class="row">
          <?php 
            if(isset($_GET['page']))
            {  
                if ($_GET['page']=='home') {
                    include 'home.php';
                }
                elseif ($_GET['page']=='karyawan' && $_SESSION['login']['level']=='admin') 
                {
                    include 'karyawan.php';
                }
                elseif ($_GET['page']=='alat' && $_SESSION['login']['level']=='admin') 
                {
                    include 'alat.php';
                }
                elseif ($_GET['page']=='bahan' && $_SESSION['login']['level']=='admin') 
                {
                    include 'bahan.php';
                }
                elseif ($_GET['page']=='supplier' && $_SESSION['login']['level']=='admin') 
                {
                    include 'supplier.php';
                }
                elseif ($_GET['page']=='proyek' && $_SESSION['login']['level']=='admin') 
                {
                    include 'proyek.php';
                }
                elseif ($_GET['page']=='profile') 
                {
                    include 'profile.php';
                }
                elseif ($_GET['page']=='absensi') 
                {
                    include 'absensii.php';
                }
                elseif ($_GET['page']=='upah') 
                {
                    include 'upah.php';
                }
                elseif ($_GET['page']=='mobilisasi') 
                {
                    include 'mobilisasi.php';
                }
            }
            else
            {
                include 'home.php';
            }
          ?>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- datatable -->
  <script src="assets/vendor/datatable/JSZip-2.5.0/jszip.min.js"></script>
  <script src="assets/vendor/datatable/pdfmake-0.2.7/pdfmake.min.js"></script>
  <script src="assets/vendor/datatable/pdfmake-0.2.7/vfs_fonts.js"></script>
  <script src="assets/vendor/datatable/DataTables-1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatable/DataTables-1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="assets/vendor/datatable/Buttons-2.3.6/js/dataTables.buttons.min.js"></script>
  <script src="assets/vendor/datatable/Buttons-2.3.6/js/buttons.bootstrap5.min.js"></script>
  <script src="assets/vendor/datatable/Buttons-2.3.6/js/buttons.colVis.min.js"></script>
  <script src="assets/vendor/datatable/Buttons-2.3.6/js/buttons.html5.min.js"></script>
  <script src="assets/vendor/datatable/Buttons-2.3.6/js/buttons.print.min.js"></script>
  
  <?php if ($_SESSION['login']['level'] == 'admin') : ?>
  <script>
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        buttons: [ 'copy', 'excel', 'print', 'pdf' ],
        dom:
        "<'row'<'col'-md-3'l><'col-md-5'B><'col-md-4'f>> " +
        "<'row'<'col'-md-12'tr>>" +
        "<'row'<'col'-md-5'i><'col-md-7'p>>" ,
        lengthMenu:[
          [-1,5,10,25,50,100],
          ["All",5,10,25,50,100]
        ],
        footer: true,
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
  </script>
  <?php else : ?>
  <script>
    $(document).ready(function() {
    var table = $('#example').DataTable( {
      lengthMenu:[
          [-1,5,10,25,50,100],
          ["All",5,10,25,50,100]
        ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
  </script>
  <?php endif; ?>
  <script src="script.js"></script>
</body>

</html>