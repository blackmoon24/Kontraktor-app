<div class="pagetitle">
    <h1>Mobilisasi</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
        <li class="breadcrumb-item active">Mobilisasi</li>
    </ol>
    </nav>
</div><!-- End Page Title -->

<div class="container">
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add"><i class="fa-solid fa-plus"></i> Data</button>
    </div><br><br>

    <div class="modal fade" id="add" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Mobilisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>  
                <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" class="form-control" name="ket">
                    </div>
                    <div class="form-group">
                        <label for="">Nominal</label>
                        <input type="number" class="form-control" name="nominal">
                    </div>
                    <div class="form-group">
                        <label for="">test</label>
                        <input type="date" class="form-control" name="nominal">
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
            $ket = $_POST['ket'];
            $nominal = $_POST['nominal'];
            $tgl = date("Y-m-d");

            $query = $koneksi->query("SELECT id_mobilisasi FROM mobilisasi ORDER BY id_mobilisasi DESC LIMIT 1");
            $result = $query->fetch_assoc();
            $lastId = $result['id_mobilisasi'];
            if ($lastId) {
                $id = ++$lastId;
            } else {
                $id = 'MB001';
            }
            // echo "<script>alert('".$id."');</script>";
            
              $tambah = $koneksi->query("INSERT INTO mobilisasi VALUES('$id','$tgl', '$ket', '$nominal') ");
              if ($tambah) {
                  echo "<script>alert('berhasil insert data');
                  location.href='?page=mobilisasi'</script>";
              }
            
        }
    ?>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Nominal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php $sql = $koneksi->query("SELECT * FROM mobilisasi"); ?>
            <?php while($row = $sql->fetch_assoc()) : ?>
            <tr>
                <th><?= $no++ ?></th>
                <td><?= format($row['tgl']) ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td>Rp <?= number_format($row['harga']) ?></td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id_mobilisasi'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $row['id_mobilisasi'] ?>"><i class="fa-solid fa-trash-can"></i></button>
                </td>
            </tr>

            <!-- modal edit -->
            <div class="modal fade" id="edit<?= $row['id_mobilisasi'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data mobilisasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id_mobilisasi'] ?>">
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" class="form-control" name="ket" value="<?= $row['keterangan'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Nominal</label>
                                <input type="number" class="form-control" name="nominal" value="<?= $row['harga'] ?>">
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
                  $ket = $_POST['ket'];
                  $nominal = $_POST['nominal'];
                  $alamat = $_POST['alamat'];
                  $id = $_POST['id'];

                    $edit = $koneksi->query("UPDATE mobilisasi SET keterangan='$ket', harga='$nominal' WHERE id_mobilisasi='$id' ");
                    if ($edit) {
                        echo "<script>alert('berhasil update data');
                        location.href='?page=mobilisasi'</script>";
                    }
                  
                }
            ?>

            <!-- modal delete -->
            <div class="modal fade" id="delete<?= $row['id_mobilisasi'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Data mobilisasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id_mobilisasi'] ?>">
                            Anda yakin ingin menghapus ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="hapus" class="btn btn-danger">Delete</button>
                        </div>
                        </form>
                            <?php 
                                if (isset($_POST['hapus'])) {
                                    $id = $_POST['id'];

                                    $hapus = $koneksi->query("DELETE FROM mobilisasi WHERE id_mobilisasi='$id' ");
                                    if ($hapus) {
                                        echo "<script>alert('berhasil hapus data');
                                        location.href='?page=mobilisasi'</script>";
                                    }
                                }
                            ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </tbody>
    </table>