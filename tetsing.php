<?php
INCLUDE "fungsi.php";
// Koneksi ke database MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_proyek";
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk menggabungkan data dari tabel "karyawan" dan "absensi"
$sql = "SELECT karyawan.nama_karyawan, GROUP_CONCAT(absensi.tanggal ORDER BY absensi.tanggal) AS tanggal_absensi
        FROM karyawan
        LEFT JOIN absensi ON karyawan.id_karyawan = absensi.id_karyawan
        GROUP BY karyawan.nama_karyawan";

$result = $conn->query($sql);

// Menginisialisasi tanggal pertama dan terakhir yang akan ditampilkan
$tanggal_pertama = "2023-06-01";
$tanggal_terakhir = "2023-06-30";

// Menghitung selisih hari antara tanggal pertama dan terakhir
$selisih_hari = (strtotime($tanggal_terakhir) - strtotime($tanggal_pertama)) / (60 * 60 * 24) + 1;

// Membuat array tanggal absensi
$tanggal_absensi = array();
for ($i = 0; $i < $selisih_hari; $i++) {
    $tanggal = date("Y-m-d", strtotime("+$i days", strtotime($tanggal_pertama)));
    $tanggal_absensi[] = $tanggal;
}

// Membuat tabel HTML
echo "<table>
        <tr>
            <th>No</th>
            <th>Nama</th>";

// Menampilkan kolom tanggal
foreach ($tanggal_absensi as $tanggal) {
    echo "<th>".formatTanpaTahun($tanggal)."</th>";
}

echo "</tr>";

if ($result->num_rows > 0) {
    // Mendapatkan data dari hasil query
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $nama_karyawan = $row["nama_karyawan"];
        if($row["tanggal_absensi"] != null) {
        $tanggal_absensi_karyawan = explode(",", $row["tanggal_absensi"]);
        }

        // Menampilkan data dalam baris tabel
        echo "<tr>
                <td>$no</td>
                <td>$nama_karyawan</td>";

        // Menampilkan status kehadiran berdasarkan tanggal
        foreach ($tanggal_absensi as $tanggal) {
            // Mencari kehadiran karyawan pada tanggal tertentu
            $hadir = in_array($tanggal, $tanggal_absensi_karyawan);

            // Menentukan warna sel berdasarkan kehadiran
            $cell_color = $hadir ? "green" : "red";

            // Menampilkan sel dengan warna yang sesuai
            echo "<td style='background-color: $cell_color'></td>";
        }

        echo "</tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='" . (count($tanggal_absensi) + 2) . "'>Tidak ada data</td></tr>";
}

echo "</table>";

// Menutup koneksi database
$conn->close();
?>
