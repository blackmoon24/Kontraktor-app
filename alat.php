<div class="pagetitle">
    <h1>Alat</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
        <li class="breadcrumb-item active">Alat</li>
    </ol>
    </nav>
    <?php $sum = $koneksi->query("select sum(harga) as total from alat")->fetch_assoc()['total']; ?>
    <!-- <h5>Total harga : Rp <?= number_format($sum) ?></h5> -->
</div><!-- End Page Title -->


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
<h4>Laporan Pembelian Alat dari ... hingga ...</h4>
<?php } else { ?>
<h4>Laporan Pembelian Alat dari <b><?= $tgl_mulai ?></b> hingga <b><?= $tgl_selesai ?><b></h4>
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

    <div class="container">
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add"><i class="fa-solid fa-plus"></i> Data</button>
    </div><br><br>

    <div class="modal fade" id="add" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Alat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>  
                <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Alat</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="">Merk</label>
                        <input type="text" class="form-control" name="merk">
                    </div>
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="number" class="form-control" name="harga">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Beli</label>
                        <input type="date" class="form-control" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="">Supplier</label>
                        <?php $pr = $koneksi->query("SELECT * FROM supplier") ?>
                        <select class="form-control" name="supplier" >
                            <option value="" hidden>Pilih Supplier..</option>
                            <option value="" disabled>Pilih Supplier..</option>
                            <?php while($r = $pr->fetch_assoc()) : ?>
                            <option value="<?= $r['id_supplier'] ?>"><?= $r['nama_supplier'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Proyek</label>
                        <?php $pr = $koneksi->query("SELECT * FROM project") ?>
                        <select class="form-control" name="proyek" >
                            <option value="" hidden>Pilih Project..</option>
                            <option value="" disabled>Pilih Project..</option>
                            <?php while($r = $pr->fetch_assoc()) : ?>
                            <option value="<?= $r['id_project'] ?>"><?= $r['nama_project'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php 
        if (isset($_POST['add'])) {
            $nama = $_POST['nama'];
            $merk = $_POST['merk'];
            $harga = $_POST['harga'];
            $tanggal = $_POST['tanggal'];
            $supplier = $_POST['supplier'];
            $proyek = $_POST['proyek'];

            $query = $koneksi->query("SELECT id_alat FROM alat ORDER BY id_alat DESC LIMIT 1");
            $result = $query->fetch_assoc();
            $lastId = $result['id_alat'];
            if ($lastId) {
                $id = ++$lastId;
            } else {
                $id = 'AL001';
            }
            // echo "<script>alert('".$id."');</script>";

            $tambah = $koneksi->query("INSERT INTO alat VALUES('$id','$nama','$merk', '$supplier','$proyek', '$harga', '$tanggal') ");
            if ($tambah) {
                $py = $koneksi->query("SELECT * FROM project WHERE id_project='$proyek' ")->fetch_assoc()['deposit'];
                $sisa = $py - $harga;
                $depo = $koneksi->query("UPDATE project SET deposit='$sisa' WHERE id_project='$proyek' ");
                echo "<script>alert('berhasil insert data');
                location.href='?page=alat'</script>";
            }
        }
    ?>


    <?php 
        if (isset($_POST["kirim"])) {
            
            if ($mulai == "" || $selesai == "") {
                echo "<script>alert('mohon input tanggal terlebih dahulu');
                    location.href='?page=alat'</script>";
            }

            $ambil = $koneksi->query("SELECT * FROM alat JOIN project ON project.id_project=alat.id_project
            JOIN supplier ON supplier.id_supplier=alat.id_supplier WHERE tgl_beli BETWEEN '$mulai' AND '$selesai'");
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
                <th scope="col">Nama</th>
                <th scope="col">Merk</th>
                <th scope="col">Supplier</th>
                <th scope="col">Harga</th>
                <th scope="col">Proyek</th>
                <th scope="col">Tanggal beli</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php $total=0; ?>
            <?php foreach ($all as $key => $value) : ?>
            <?php $total += $value['harga']; ?>
            <tr>
                <th><?= $no++ ?></th>
                <td><?= $value['nama_alat'] ?></td>
                <td><?= $value['merk'] ?></td>
                <td><?= $value['nama_supplier'] ?></td>
                <td>Rp <?= number_format($value['harga']) ?></td>
                <td><?= $value['nama_project'] ?></td>
                <td><?= format($value['tgl_beli']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
		<tr>
			<th colspan="4">Total</th>
			<th>Rp <?= number_format($total); ?></th>
		</tr>
	</tfoot>
    </table><br>
    <div class="container">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
    </div>

    <?php } else { ?>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Merk</th>
                <th scope="col">Supplier</th>
                <th scope="col">Harga</th>
                <th scope="col">Proyek</th>
                <th scope="col">Tanggal beli</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php $sql = $koneksi->query("SELECT * FROM alat JOIN project ON project.id_project=alat.id_project
            JOIN supplier ON supplier.id_supplier=alat.id_supplier "); ?>
            <?php while($row = $sql->fetch_assoc()) : ?>
            <tr>
                <th><?= $no++ ?></th>
                <td><?= $row['nama_alat'] ?></td>
                <td><?= $row['merk'] ?></td>
                <td><?= $row['nama_supplier'] ?></td>
                <td>Rp <?= number_format($row['harga']) ?></td>
                <td><?= $row['nama_project'] ?></td>
                <td><?= format($row['tgl_beli']) ?></td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id_alat'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $row['id_alat'] ?>"><i class="fa-solid fa-trash-can"></i></button>
                </td>
            </tr>

            <!-- modal edit -->
            <div class="modal fade" id="edit<?= $row['id_alat'] ?>" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Alat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>  
                    <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Alat</label>
                            <input type="hidden" name="id" value="<?= $row['id_alat'] ?>">
                            <input type="text" class="form-control" name="nama" value="<?= $row['nama_alat'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Merk</label>
                            <input type="text" class="form-control" name="merk" value="<?= $row['merk'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="number" class="form-control" name="harga" value="<?= $row['harga'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Beli</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= $row['tgl_beli'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Supplier</label>
                            <?php $pr = $koneksi->query("SELECT * FROM supplier") ?>
                            <select class="form-control" name="supplier" >
                                <option value="<?= $row['id_supplier'] ?>" disabled><?= $row['nama_supplier'] ?></option>
                                <?php while($r = $pr->fetch_assoc()) : ?>
                                <!-- <option value="" disabled>Pilih Supplier..</option> -->
                                <option value="<?= $r['id_supplier'] ?>"><?= $r['nama_supplier'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Proyek</label>
                            <?php $pr = $koneksi->query("SELECT * FROM project") ?>
                            <select class="form-control" name="proyek" >
                                <option value="<?= $row['id_project'] ?>" disabled><?= $row['nama_project'] ?></option>
                                <?php while($r = $pr->fetch_assoc()) : ?>
                                <!-- <option value="" disabled>Pilih Project..</option> -->
                                <option value="<?= $r['id_project'] ?>"><?= $r['nama_project'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="edit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
              </div>
            </div>
            <?php 
              if (isset($_POST['edit'])) {
                  $id = $_POST['id'];
                  $nama = $_POST['nama'];
                  $merk = $_POST['merk'];
                  $harga = $_POST['harga'];
                  $tanggal = $_POST['tanggal'];
                  $supplier = $_POST['supplier'];
                  $proyek = $_POST['proyek'];

                  $tambah = $koneksi->query("UPDATE alat SET nama_alat='$nama', merk='$merk', harga='$harga', 
                  id_supplier='$supplier', id_project='$proyek', tgl_beli='$tanggal' WHERE id_alat='$id' ");
                  if ($tambah) {
                      echo "<script>alert('berhasil update data');
                      location.href='?page=alat'</script>";
                  }
              }
            ?>

            <!-- modal delete -->
            <div class="modal fade" id="delete<?= $row['id_alat'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Data Alat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id_alat'] ?>">
                            Anda yakin ingin menghapus <?= $row['nama_alat'] ?> ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="hapus" class="btn btn-danger">Delete</button>
                        </div>
                        </form>
                            <?php 
                                if (isset($_POST['hapus'])) {
                                    $id = $_POST['id'];
                                    $id = $row['id_alat'];
                                    // $ss = $koneksi->query("SELECT * FROM alat WHERE id_alat = '$id' ")->fetch_assoc();
                                    $harga = $row['harga'];
                                    $proyek = $row['id_project'];

                                    $hapus = $koneksi->query("DELETE FROM alat WHERE id_alat='$id' ");
                                    if ($hapus) {
                                    //   $py = $koneksi->query("SELECT * FROM project WHERE id_project='$proyek' ")->fetch_assoc()['deposit'];
                                      $py = $row['deposit'];
                                      $sisa = $py + $harga;
                                      $depo = $koneksi->query("UPDATE project SET deposit='$sisa' WHERE id_project='$proyek' ");
                                        echo "<script>alert('berhasil hapus data');
                                        location.href='?page=alat'</script>";
                                    }
                                }
                            ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php } ?>