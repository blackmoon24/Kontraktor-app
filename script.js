var response;
var response2;
function toggleForm() {
  var checkbox = document.getElementById("additionalCheckbox");
  var formContainer = document.getElementById("additionalContainer");

  if (checkbox.checked) {
    formContainer.style.display = "block";
  } else {
    formContainer.style.display = "none";
  }
}

function getData() {
  var combobox = document.getElementById("namaCombobox");
  var selectedId = combobox.value;

  if (selectedId !== "") {
    // Kirim permintaan AJAX ke server untuk mengambil data dari database
    // Ganti 'get_data.php' dengan URL endpoint Anda
    var url = "get_data.php?id=" + selectedId;
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        response = JSON.parse(xhr.responseText);
        var textField = document.getElementById("input_upah");
        var textField2 = document.getElementById("upah_hidden");

        // Mengisi nilai dari database ke dalam text field
        textField.value = response.data;
        textField2.value = response.data2;
        hitungTotal();
      }
    };

    xhr.open("GET", url, true);
    xhr.send();
  } else {
    // Mengosongkan text field jika ID tidak dipilih
    document.getElementById("input_upah").value = "";
  }
}

function getJumlahHari() {
  var mulai = document.getElementById("tglm");
  var selesai = document.getElementById("tgls");
  var combobox = document.getElementById("namaCombobox");
  var tgl_mulai = mulai.value;
  var tgl_selesai = selesai.value;
  var selectedId = combobox.value;

  if (tgl_mulai !== "" && tgl_selesai !== "") {
    // Kirim permintaan AJAX ke server untuk mengambil data dari database
    // Ganti 'get_data.php' dengan URL endpoint Anda
    var url =
      "get_jumlahHari.php?id=" +
      selectedId +
      "&mulai=" +
      tgl_mulai +
      "&selesai=" +
      tgl_selesai;
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        response2 = JSON.parse(xhr.responseText);
        var textField = document.getElementById("input_jumlahHari");

        // Mengisi nilai dari database ke dalam text field
        textField.value = response2.data;
        hitungTotal();
      }
    };

    xhr.open("GET", url, true);
    xhr.send();
  } else {
    // Mengosongkan text field jika ID tidak dipilih
    document.getElementById("input_jumlahHari").value = "";
  }
}

function hitungTotal() {
  // if (
  //   document.getElementById("upah_hidden").value != "" &&
  //   document.getElementById("input_jumlahHari").value != ""
  // ) {
  var nilai1 = parseFloat(response.data2) || 0;
  var nilai2 = parseFloat(response2.data) || 0;
  var total = nilai1 * nilai2;

  // Set nilai total ke dalam input_total
  document.getElementById("input_total").value = total;
  // }
}
