<?php
// Mengambil ID dari parameter URL
$id = $_GET['id'];

// Lakukan pengolahan data sesuai dengan kebutuhan
// Misalnya, melakukan kueri ke database untuk mendapatkan data berdasarkan ID
// Ganti 'koneksi_database' dengan koneksi database Anda
// Ganti 'nama_tabel' dengan nama tabel yang sesuai
$koneksi = mysqli_connect('localhost', 'root', '', 'db_proyek');
$query = "SELECT upah FROM karyawan WHERE id_karyawan = '$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $data = $row['upah'];

    // Mengembalikan data sebagai respons dalam format JSON
    $response = array('data' => number_format($data, 0, ',', '.'), 'data2' => $data);
    echo json_encode($response);

  } else {
    // Jika ID tidak ditemukan, mengembalikan respons kosong
    echo json_encode(array('data' => ''));
  }
} else {
  // Jika terjadi kesalahan dalam kueri, mengembalikan respons kosong
  echo json_encode(array('data' => ''));
}

// Menutup koneksi database
mysqli_close($koneksi);
?>