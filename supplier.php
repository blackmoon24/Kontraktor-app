<div class="pagetitle">
      <h1>Supplier</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item active">Supplier</li>
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
                    <h5 class="modal-title">Tambah Data Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>  
                <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="">No Telp</label>
                        <input type="number" class="form-control" name="no">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea type="text" rowspan="3" class="form-control" name="alamat"></textarea>
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
            $no = $_POST['no'];
            $cekno = strlen(strval($_POST['no']));

            $query = $koneksi->query("SELECT id_supplier FROM supplier ORDER BY id_supplier DESC LIMIT 1");
            $result = $query->fetch_assoc();
            $lastId = $result['id_supplier'];
            if ($lastId) {
                $id = ++$lastId;
            } else {
                $id = 'SP001';
            }
            // echo "<script>alert('".$id."');</script>";
            if ($cekno > 12) {
              echo "<script>alert('No Telp tidak boleh lebih dari 12 karakter');
              location.href='?page=supplier'</script>";
            } else {
              $tambah = $koneksi->query("INSERT INTO supplier VALUES('$id','$nama','$no', '$alamat') ");
              if ($tambah) {
                  echo "<script>alert('berhasil insert data');
                  location.href='?page=supplier'</script>";
              }
            }
        }
    ?>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">No. Telp</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php $sql = $koneksi->query("SELECT * FROM supplier"); ?>
            <?php while($row = $sql->fetch_assoc()) : ?>
            <tr>
                <th><?= $no++ ?></th>
                <td><?= $row['nama_supplier'] ?></td>
                <td><?= $row['no_telp'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id_supplier'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $row['id_supplier'] ?>"><i class="fa-solid fa-trash-can"></i></button>
                </td>
            </tr>

            <!-- modal edit -->
            <div class="modal fade" id="edit<?= $row['id_supplier'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data supplier</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id_supplier'] ?>">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?= $row['nama_supplier'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">No. Telp</label>
                                <input type="number" class="form-control" name="no" value="<?= $row['no_telp'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea type="text" class="form-control" name="alamat"><?= $row['alamat'] ?></textarea>
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
                  $no = $_POST['no'];
                  $alamat = $_POST['alamat'];
                  $proyek = $_POST['proyek'];
                  $id = $_POST['id'];
                  $cekno = strlen(strval($_POST['no']));

                  if ($cekno > 12) {
                    echo "<script>alert('No Telp tidak boleh lebih dari 12 karakter');
                    location.href='?page=supplier'</script>";
                  } else {
                    $edit = $koneksi->query("UPDATE supplier SET nama_supplier='$nama', no_telp='$no', alamat='$alamat' WHERE id_supplier='$id' ");
                    if ($edit) {
                        echo "<script>alert('berhasil update data');
                        location.href='?page=supplier'</script>";
                    }
                  }
                }
            ?>

            <!-- modal delete -->
            <div class="modal fade" id="delete<?= $row['id_supplier'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Data supplier</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id_supplier'] ?>">
                            Anda yakin ingin menghapus <?= $row['nama_supplier'] ?> ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="hapus" class="btn btn-danger">Delete</button>
                        </div>
                        </form>
                            <?php 
                                if (isset($_POST['hapus'])) {
                                    $id = $_POST['id'];

                                    $hapus = $koneksi->query("DELETE FROM supplier WHERE id_supplier='$id' ");
                                    if ($hapus) {
                                        echo "<script>alert('berhasil hapus data');
                                        location.href='?page=supplier'</script>";
                                    }
                                }
                            ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </tbody>
    </table>