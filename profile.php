<title>Profile</title>
<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
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
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>  
                <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="">Level</label>
                        <select class="form-control" name="level" >
                            <option value="admin">Admin</option>
                            <option value="karyawan">Karyawan</option>
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
            $username = $_POST['username'];
            $password = $_POST['password'];
            $level = $_POST['level'];

            $tambah = $koneksi->query("INSERT INTO login VALUES(NULL,'$username','$password', '$level') ");
            if ($tambah) {
                echo "<script>alert('berhasil insert data');
                location.href='?page=profile'</script>";
            }
        }
    ?>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Password</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $sql = $koneksi->query("SELECT * FROM login") ?>
        <?php $no=1; ?>
        <?php while($row = $sql->fetch_assoc()) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['username'] ?></td>
            <td>
                <input type="password" class="form-control" readonly value="<?= $row['password'] ?>">
            </td>
            <td><?= $row['level'] ?></td>
            <td>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id_login'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $row['id_login'] ?>"><i class="fa-solid fa-trash-can"></i></button>
            </td>
        </tr>

        <!-- modal edit -->
        <div class="modal fade" id="edit<?= $row['id_login'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $row['id_login'] ?>">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $row['username'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" value="<?= $row['password'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Level</label>
                            <select class="form-control" name="level" >
                                <option value="admin">Admin</option>
                                <option value="karyawan">Karyawan</option>
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
                $username = $_POST['username'];
                $password = $_POST['password'];
                $level = $_POST['level'];
                $id = $_POST['id'];

                $edit = $koneksi->query("UPDATE login SET username='$username', password='$password', level='$level' WHERE id_login='$id' ");
                if ($edit) {
                    echo "<script>alert('berhasil update data');
                    location.href='?page=profile'</script>";
                }
            }
        ?>

        <!-- modal delete -->
        <div class="modal fade" id="delete<?= $row['id_login'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $row['id_login'] ?>">
                        Anda yakin ingin menghapus <?= $row['username'] ?> ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="hapus" class="btn btn-danger">Delete</button>
                    </div>
                    </form>
                        <?php 
                            if (isset($_POST['hapus'])) {
                                $id = $_POST['id'];

                                $hapus = $koneksi->query("DELETE FROM login WHERE id_login='$id' ");
                                if ($hapus) {
                                    echo "<script>alert('berhasil hapus data');
                                    location.href='?page=profile'</script>";
                                }
                            }
                        ?>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </tbody>
</table>