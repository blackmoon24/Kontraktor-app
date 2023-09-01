<title>Upah</title>
<div class="pagetitle">
    <h1>Upah</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
            <li class="breadcrumb-item active">Upah</li>
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
                    <h5 class="modal-title">Form Upah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>  
                <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <?php $pr = $koneksi->query("SELECT * FROM karyawan") ?>
                        <select class="form-control" name="nama" id="namaCombobox" onchange="getData(); getJumlahHari(); hitungHasil()">
                            <option value="" hidden>Pilih karyawan..</option>
                            <option value="" disabled>Pilih karyawan..</option>
                            <?php while($r = $pr->fetch_assoc()) : ?>
                            <option value="<?= $r['id_karyawan'] ?>"><?= $r['nama_karyawan'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Dari Tanggal</label>
                            <input type="date" name="tglm" id="tglm" class="form-control" onchange="getJumlahHari()">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Sampai Tanggal</label>
                            <input type="date" name="tgls" id="tgls" class="form-control" onchange="getJumlahHari()">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="">Upah</label>
                            <input type="text" class="form-control" id="input_upah" name="input_upah" readonly>
                            <input type="hidden" class="form-control" id="upah_hidden" name="upah_hidden" readonly>
                        </div>
                        <div class="form-group col-md-1 d-flex align-items-center justify-content-center">
                            <span style="font-weight: bold; font-size: 20px; margin-top: 15px;">x</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Jumlah Hari</label>
                            <input type="text" class="form-control" id="input_jumlahHari" name="input_jumlahHari" readonly oninput="hitungtotal()">
                        </div>
                        <div class="form-group col-md-1 d-flex align-items-center justify-content-center">
                            <span style="font-weight: bold; font-size: 20px; margin-top: 15px;">=</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Total</label>
                            <input type="text" class="form-control" id="input_total" name="input_total" readonly onfocus="hitungtotal()">
                        </div>
                    </div>
                    <div class = "form-group">
                    <input type="checkbox" id="additionalCheckbox" name="additionalCheckbox" onchange="toggleForm()"> Centang untuk tampilkan additional
                    <div id="additionalContainer" style="display: none;">
                        <!-- Isi form tambahan di sini -->
                        <div class = "row mt-2">
                            <div class="form-group col-md-7">
                                <label for="">Nominal tambahan</label>
                                <input type="number" name="add" class="form-control">
                            </div>
                            <div class="form-group col-md-1 d-flex align-items-center justify-content-center">
                                <span style="font-weight: bold; font-size: 20px; margin-top: 15px;">x</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Jumlah Hari</label>
                                <input type="number" name="addJumlahHari" class="form-control">
                            </div>
                        </div>
                        <div>
                            <label for="">Keterangan</label>
                            <input type="text" name="ket" class="form-control">
                        </div>
                        <!-- Tambahkan elemen form lainnya -->
                    </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php 
        if (isset($_POST['save'])) {
            if(isset($_POST['additionalCheckbox'])){
                $nama = $_POST['nama'];
                $tgl = date("Y-m-d");
                $upah = $_POST['input_total'];
                $upah_tot = $_POST['input_total']+($_POST['add']*$_POST['addJumlahHari']);
                $ket = "pokok (" .formatTanpaTahun($_POST['tglm'])." - ".formatTanpaTahun($_POST['tgls']).") + ("
                        .$_POST['ket']." x ".$_POST['addJumlahHari'].")";
    
                $tambah = $koneksi->query("INSERT INTO upah VALUES(NULL,'$nama','$tgl', '$upah', '$upah_tot' ,'$ket') ");
                if ($tambah) {
                    echo "<script>alert('berhasil insert data');
                    location.href='?page=upah'</script>";
                }
            }else{
                $nama = $_POST['nama'];
                $tgl = date("Y-m-d");
                $upah_tot = $_POST['input_total'];
                $upah = 0;
                $ket = "pokok (" .formatTanpaTahun($_POST['tglm'])." - ".formatTanpaTahun($_POST['tgls']).")";
    
                $tambah = $koneksi->query("INSERT INTO upah VALUES(NULL,'$nama','$tgl', '$upah', '$upah_tot','$ket') ");
                if ($tambah) {
                    echo "<script>alert('berhasil insert data');
                    location.href='?page=upah'</script>";
                }
            }
        }
    ?>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Upah Tambahan</th>
                <th scope="col">Upah Total</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Proyek</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php $sql = $koneksi->query("SELECT * FROM upah JOIN karyawan ON upah.id_karyawan=karyawan.id_karyawan 
            JOIN project ON project.id_project=karyawan.id_project"); ?>
            <?php while($row = $sql->fetch_assoc()) : ?>
            <tr>
                <th><?= $no++ ?></th>
                <td><?= format($row['tanggal']) ?></td>
                <td><?= $row['nama_karyawan'] ?></td>
                <td><?= $row['jabatan'] ?></td>
                <td>Rp <?= number_format($row['upah_add']) ?></td>
                <td>Rp <?= number_format($row['upah_total']) ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td><?= $row['nama_project'] ?></td>
                <td class="">
                    <!-- <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?php //echo $row['id_karyawan'] ?>"><i class="fa-solid fa-pen-to-square"></i></button> -->
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $row['id_upah'] ?>"><i class="fa-solid fa-trash-can"></i></button>
                </td>
            </tr>

            <!-- modal edit -->
            <!-- <div class="modal fade" id="edit<?php // $row['id_karyawan'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data Karyawan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?php //$row['id_karyawan'] ?>">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?php //$row['nama_karyawan'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" value="<?php //$row['jabatan'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Upah</label>
                                <input type="number" class="form-control" name="upah" value="<?php //$row['upah'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Proyek</label>
                                <?php //$pr = $koneksi->query("SELECT * FROM project") ?>
                                <select class="form-control" name="proyek" >
                                    <option value="<?php //$row['id_project'] ?>" disabled><?php //$row['nama_project'] ?></option>
                                    <?php //while($r = $pr->fetch_assoc()) : ?> -->
                                    <!-- <option value="" disabled>Pilih Project..</option> -->
                                    <!-- <option value="<?php //$r['id_project'] ?>"><?php //$r['nama_project'] ?></option> -->
                                    <?php// endwhile; ?>
                                <!-- </select> -->
                            <!-- </div> -->
                        <!-- </div> -->
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                            <!-- <button type="submit" name="edit" class="btn btn-primary">Submit</button> -->
                        <!-- </div>
                        </form>
                    </div>
                </div>
            </div> -->
            <?php 
                // if (isset($_POST['edit'])) {
                //     $nama = $_POST['nama'];
                //     $jabatan = $_POST['jabatan'];
                //     $upah = $_POST['upah'];
                //     $proyek = $_POST['proyek'];
                //     $id = $_POST['id'];

                //     $edit = $koneksi->query("UPDATE karyawan SET nama_karyawan='$nama', jabatan='$jabatan', upah='$upah', id_project='$proyek' WHERE id_karyawan='$id' ");
                //     if ($edit) {
                //         echo "<script>alert('berhasil update data');
                //         location.href='?page=karyawan'</script>";
                //     }
                // }
            ?>

            <!-- modal delete -->
            <div class="modal fade" id="delete<?= $row['id_upah'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Data Karyawan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id_upah'] ?>">
                            Anda yakin ingin menghapus baris ini ?
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
                                    $hapus = $koneksi->query("DELETE FROM upah WHERE id_upah='$id' ");
                                    if ($hapus) {
                                        echo "<script>alert('berhasil hapus data');
                                        location.href='?page=upah'</script>";
                                    }
                                }
                            ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <!-- <tr>
                <td hidden>~</td>
                <td hidden>~</td>
                <td colspan="3">Total</td>
                <td colspan="">Rp <?= number_format($total); ?></td>
                <td hidden>~</td>
                <td hidden>~</td>
            </tr> -->
        </tbody>
        <!-- <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th colspan="">Rp <?= number_format($total); ?></th>
            </tr>
        </tfoot> -->
    </table>