<title>Absensi Karyawan</title>
<div class="pagetitle">
    <h1>Absensi Karyawan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
            <li class="breadcrumb-item active">Absensi Karyawan</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

<?php
	$all = array();
	$mulai = " ";
	$selesai = " ";
	if (isset($_POST['kirim'])) {
        $mulai = $_POST["tglm"];
        $selesai = $_POST["tgls"];
        $tgl_mulai = format($mulai);
        $tgl_selesai = format($selesai);
        // $tgl_mulai = date('j F Y',strtotime($mulai));
        // $tgl_selesai = date('j F Y',strtotime($selesai));
    }
?>
<?php if($_SESSION['login']['level']=="admin") : ?>
<?php if (empty($tgl_mulai) || empty($tgl_selesai)) { ?>
<h4>Laporan Absensi dari ... hingga ...</h4>
<?php } else { ?>
<h4>Laporan Absensi dari <b><i><?= $tgl_mulai ?></i></b> hingga <b><i><?= $tgl_selesai ?></i><b></h4>
<?php } ?>
<hr>
<form method="post">
	<div class="row">
		<div class="col-xl-4 col-md-5">
			<div class="form-group">
				<label>Tanggal Mulai</label>
				<input type="date" name="tglm" class="form-control" value="<?= $mulai ?>">
			</div>
		</div>
		<div class="col-xl-4 col-md-5">
			<div class="form-group">
				<label>Tanggal Selesai</label>
				<input type="date" name="tgls" class="form-control" value="<?= $selesai ?>">
			</div>
		</div>
		<div class="col-md-2">
			<label>&nbsp;</label><br>
			<button class="btn btn-primary" name="kirim">Lihat</button>
		</div>
	</div>
    <hr>
</form>
<?php endif; ?>
<?php 
    if (isset($_POST["kirim"])) {
        
        if ($mulai == "" || $selesai == "") {
            echo "<script>alert('mohon input tanggal terlebih dahulu');
                location.href='?page=absensi'</script>";
        }

        $ambil = $koneksi->query("SELECT * FROM absensi JOIN karyawan ON karyawan.id_karyawan=absensi.id_karyawan WHERE tanggal BETWEEN '$mulai' AND '$selesai'");
        while ($data = $ambil->fetch_assoc()) {
            $all[] = $data;
        }
        // echo "<pre>";
        // print_r($all);
        // echo "</pre>";
    
?>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php foreach ($all as $key => $value) : ?>
            <tr>
                <th><?= $no++ ?></th>
                <td><?= $value['id_karyawan'] ?></td>
                <td><?= $value['nama_karyawan'] ?></td>
                <td><?= format($value['tanggal']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table><br>
    <div class="container">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
    </div>

<?php } else { ?>

    <p style="color:red">nb : jangan checklist kotak jika karyawan tidak hadir</p>
<form method="post">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Absensi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php $sql = $koneksi->query("SELECT * FROM karyawan"); ?>
            <?php while($row = $sql->fetch_assoc()) : ?>
            <tr>
                <th><?= $no++ ?></th>
                <!-- <td><?= $row['id_karyawan'] ?></td> -->
                <td><?= $row['nama_karyawan'] ?></td>
                <td>
                    <input type="checkbox" name="hadir[]" value="<?= $row['id_karyawan'] ?>">
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table><br>
    <div class="container">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
    </div>
</form>
<?php } ?>
<?php 
    if (isset($_POST['submit'])) {
        $karyawan = $_POST['hadir'];
        $tanggal = date('Y-m-d');
        $absensi = false;
        foreach ($karyawan as $id) {
            $query = $koneksi->query("SELECT * FROM absensi WHERE id_karyawan = '$id' AND tanggal = '$tanggal'");
            if (mysqli_num_rows($query) > 0) {
                $absensi = true;
                break; 
            } else {
                $sql = $koneksi->query("INSERT INTO absensi VALUES (NULL, '$id', '$tanggal')");
            }
        }
        if ($absensi) {
            echo "<script>alert('Absensi sudah ada.')</script>";
        } else {
            echo "<script>alert('Absensi berhasil disimpan')</script>";
        }

        // $jml = count($karyawan); 

        // for ($i = 0; $i < $jml; $i++) {
        //     $id = $karyawan[$i];
        //     $query = $koneksi->query("SELECT * FROM absensi WHERE id_karyawan = '$id' AND tanggal = '$tanggal'");

        //     if (mysqli_num_rows($query) > 0) {
        //         $absensi = true;
        //         break; 
        //     } else {
        //         $sql = $koneksi->query("INSERT INTO absensi VALUES (NULL, '$id', '$tanggal')");
        //     }
        // }

        // if ($absensi) {
        //     echo "<script>alert('Absensi sudah ada.')</script>";
        // } else {
        //     echo "<script>alert('Absensi berhasil disimpan')</script>";
        // }

    }
?>