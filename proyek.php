<div class="pagetitle">
    <h1>Project</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
        <li class="breadcrumb-item active">Project</li>
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
                    <h5 class="modal-title">Tambah Data Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>  
                <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea type="text" rowspan="3" class="form-control" name="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Deposit</label>
                        <input type="number" class="form-control" name="depo">
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
            $alamat = $_POST['alamat'];
            $depo = $_POST['depo'];

            $query = $koneksi->query("SELECT id_project FROM project ORDER BY id_project DESC LIMIT 1");
            $result = $query->fetch_assoc();
            $lastId = $result['id_project'];
            if ($lastId) {
                $id = ++$lastId;
            } else {
                $id = 'PR001';
            }
            // echo "<script>alert('".$id."');</script>";
            
              $tambah = $koneksi->query("INSERT INTO project VALUES('$id','$nama', '$alamat', '$depo') ");
              if ($tambah) {
                  echo "<script>alert('berhasil insert data');
                  location.href='?page=proyek'</script>";
              }
            
        }
    ?>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Deposit</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php $sql = $koneksi->query("SELECT * FROM project"); ?>
            <?php while($row = $sql->fetch_assoc()) : ?>
            <tr>
                <th><?= $no++ ?></th>
                <td><?= $row['nama_project'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td>Rp <?= number_format($row['deposit']) ?></td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id_project'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $row['id_project'] ?>"><i class="fa-solid fa-trash-can"></i></button>
                </td>
            </tr>

            <!-- modal edit -->
            <div class="modal fade" id="edit<?= $row['id_project'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id_project'] ?>">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?= $row['nama_project'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea type="text" class="form-control" name="alamat"><?= $row['alamat'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Deposit</label>
                                <input type="number" class="form-control" name="depo" value="<?= $row['deposit'] ?>">
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
                  $nama = $_POST['nama'];
                  $depo = $_POST['depo'];
                  $alamat = $_POST['alamat'];
                  $id = $_POST['id'];

                    $edit = $koneksi->query("UPDATE project SET nama_project='$nama', deposit='$depo', alamat='$alamat' WHERE id_project='$id' ");
                    if ($edit) {
                        echo "<script>alert('berhasil update data');
                        location.href='?page=proyek'</script>";
                    }
                  
                }
            ?>

            <!-- modal delete -->
            <div class="modal fade" id="delete<?= $row['id_project'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Data project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id_project'] ?>">
                            Anda yakin ingin menghapus <?= $row['nama_project'] ?> ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="hapus" class="btn btn-danger">Delete</button>
                        </div>
                        </form>
                            <?php 
                                if (isset($_POST['hapus'])) {
                                    $id = $_POST['id'];

                                    $hapus = $koneksi->query("DELETE FROM project WHERE id_project='$id' ");
                                    if ($hapus) {
                                        echo "<script>alert('berhasil hapus data');
                                        location.href='?page=proyek'</script>";
                                    }
                                }
                            ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </tbody>
    </table>