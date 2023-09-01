<title>Karyawan</title>
<div class="pagetitle">
    <h1>Karyawan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
            <li class="breadcrumb-item active">Karyawan</li>
        </ol>
        <?php $sum = $koneksi->query("select sum(upah) as total from karyawan")->fetch_assoc()['total']; ?>
        <!-- <h5>Total upah : Rp <?= number_format($sum) ?></h5> -->
    </nav>
</div><!-- End Page Title -->

    <div class="container">
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add"><i class="fa-solid fa-plus"></i> Data</button>
    </div><br><br>

    <div class="modal fade" id="add" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>  
                <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan">
                    </div>
                    <div class="form-group">
                        <label for="">Upah</label>
                        <input type="number" class="form-control" name="upah">
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
            $jabatan = $_POST['jabatan'];
            $upah = $_POST['upah'];
            $proyek = $_POST['proyek'];

            $query = $koneksi->query("SELECT id_karyawan FROM karyawan ORDER BY id_karyawan DESC LIMIT 1");
            $result = $query->fetch_assoc();
            $lastId = $result['id_karyawan'];
            if ($lastId) {
                $id = ++$lastId;
            } else {
                $id = 'KR001';
            }
            // echo "<script>alert('".$id."');</script>";

            $tambah = $koneksi->query("INSERT INTO karyawan VALUES('$id','$nama','$jabatan', '$upah','$proyek') ");
            if ($tambah) {
                echo "<script>alert('berhasil insert data');
                location.href='?page=karyawan'</script>";
            }
        }
    ?>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Upah</th>
                <th scope="col">Proyek</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php $total=0 ?>
            <?php $sql = $koneksi->query("SELECT * FROM karyawan JOIN project ON project.id_project=karyawan.id_project"); ?>
            <?php while($row = $sql->fetch_assoc()) : ?>
            <?php $total+=$row['upah'] ?>
            <tr>
                <th><?= $no++ ?></th>
                <td><?= $row['nama_karyawan'] ?></td>
                <td><?= $row['jabatan'] ?></td>
                <td>Rp <?= number_format($row['upah']) ?></td>
                <td><?= $row['nama_project'] ?></td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id_karyawan'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $row['id_karyawan'] ?>"><i class="fa-solid fa-trash-can"></i></button>
                </td>
            </tr>

            <!-- modal edit -->
            <div class="modal fade" id="edit<?= $row['id_karyawan'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data Karyawan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id_karyawan'] ?>">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?= $row['nama_karyawan'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" value="<?= $row['jabatan'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Upah</label>
                                <input type="number" class="form-control" name="upah" value="<?= $row['upah'] ?>">
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
                    $nama = $_POST['nama'];
                    $jabatan = $_POST['jabatan'];
                    $upah = $_POST['upah'];
                    $proyek = $_POST['proyek'];
                    $id = $_POST['id'];

                    $edit = $koneksi->query("UPDATE karyawan SET nama_karyawan='$nama', jabatan='$jabatan', upah='$upah', id_project='$proyek' WHERE id_karyawan='$id' ");
                    if ($edit) {
                        echo "<script>alert('berhasil update data');
                        location.href='?page=karyawan'</script>";
                    }
                }
            ?>

            <!-- modal delete -->
            <div class="modal fade" id="delete<?= $row['id_karyawan'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Data Karyawan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id_karyawan'] ?>">
                            Anda yakin ingin menghapus <?= $row['nama_karyawan'] ?> ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="hapus" class="btn btn-danger">Delete</button>
                        </div>
                        </form>
                            <?php 
                                if (isset($_POST['hapus'])) {
                                    $id = $_POST['id'];
                                    // echo "<script>alert('".$id."');</script>";
                                    $hapus = $koneksi->query("DELETE FROM karyawan WHERE id_karyawan='$id' ");
                                    if ($hapus) {
                                        echo "<script>alert('berhasil hapus data');
                                        location.href='?page=karyawan'</script>";
                                    }
                                }
                            ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th colspan="">Rp <?= number_format($total); ?></th>
            </tr>
        </tfoot>
    </table>