@extends('layouts.main')

@section('container-fluid')
<div class="container-fluid" id="container-wrapper">
  <!-- Your container content -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Rekap Penjualan</h1> <!-- EDIT NAMA -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Penerimaan Jasa</a></li>
      <li class="breadcrumb-item active" aria-current="page">Rekap Penjualan</li> <!-- EDIT NAMA -->
    </ol>
  </div>
  <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
  <!-- Modal Tambah Data -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data Rekap Penjualan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="id_rekap_penjualan" class="form-label">ID Rekap Penjualan:</label>
              <input type="text" class="form-control" id="id_rekap_penjualan" name="id_rekap_penjualan" required>
            </div>
            <div class="mb-3">
              <label for="id_invoice" class="form-label">ID Invoice:</label>
              <input type="text" class="form-control" id="id_invoice" name="id_invoice" required>
            </div>
            <div class="mb-3">
              <label for="volume" class="form-label">Volume:</label>
              <input type="text" class="form-control" id="volume" name="volume" required>
            </div>
            <div class="mb-3">
              <label for="quantity" class="form-label">Quantity:</label>
              <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="mb-3">
              <label for="total_penjualan" class="form-label">Total Penjualan:</label>
              <input type="text" class="form-control" id="total_penjualan" name="total_penjualan" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Edit Data -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data Rekap Penjualan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="edit_id_rekap_penjualan" class="form-label">ID Rekap Penjualan:</label>
              <input type="text" class="form-control" id="edit_id_rekap_penjualan" name="edit_id_rekap_penjualan"
                readonly required>
            </div>
            <div class="mb-3">
              <label for="edit_id_invoice" class="form-label">ID Invoice:</label>
              <input type="text" class="form-control" id="edit_id_invoice" name="edit_id_invoice" required>
            </div>
            <div class="mb-3">
              <label for="edit_volume" class="form-label">Volume:</label>
              <input type="text" class="form-control" id="edit_volume" name="edit_volume" required>
            </div>
            <div class="mb-3">
              <label for="edit_quantity" class="form-label">Quantity:</label>
              <input type="number" class="form-control" id="edit_quantity" name="edit_quantity" required>
            </div>
            <div class="mb-3">
              <label for="edit_total_penjualan" class="form-label">Total Penjualan:</label>
              <input type="text" class="form-control" id="edit_total_penjualan" name="edit_total_penjualan" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->

  <!-- Row -->
  <div class="row">
    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Rekap Penjualan</h6> <!-- EDIT NAMA -->
          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <!-- Tombol Tambah dengan Icon -->
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#addModal">
              Tambah
            </button>
            <!-- Tombol Filter Tanggal dengan Icon -->
            <div class="input-group">
              <input type="date" class="form-control-sm border-0" id="tanggalMulai"
                aria-describedby="tanggalMulaiLabel">
              <input type="date" class="form-control-sm border-0" id="tanggalAkhir"
                aria-describedby="tanggalAkhirLabel">
              <button type="button" class="btn btn-secondary btn-sm" onclick="filterTanggal()">
                Filter
              </button>
            </div>
            <!-- Tombol Cetak Tabel dengan Icon -->
            <button type="button" class="btn btn-sm btn-warning" onclick="cetakTabel()">
              Cetak
            </button>
          </div>

          <!-- Skrip JavaScript untuk Filter Tanggal dan Cetak Tabel -->
          <script>
            function filterTanggal() {
                  var tanggalMulai = document.getElementById("tanggalMulai").value;
                  var tanggalAkhir = document.getElementById("tanggalAkhir").value;
                  
                  // Lakukan sesuatu dengan tanggalMulai dan tanggalAkhir, misalnya menyaring data tabel
                  // Anda dapat menambahkan logika Anda di sini
                  console.log("Tanggal Mulai:", tanggalMulai);
                  console.log("Tanggal Akhir:", tanggalAkhir);
              }

              function cetakTabel() {
                  // Mencetak isi tabel yang sesuai dengan rentang tanggal yang dipilih
                  filterTanggal(); // Memanggil fungsi filterTanggal() untuk mendapatkan rentang tanggal yang dipilih
                  
                  // Lakukan pencetakan sesuai dengan rentang tanggal yang dipilih
                  window.print();
              }
          </script>
        </div>

        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
            <thead class="thead-light">
              <tr>
                <th>Id Rekap Penjualan</th>
                <th>Id Invoice</th>
                <th>Volume</th>
                <th>Quantity</th>
                <th>Total Penjualan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              {{--
              <?php
              $query = "SELECT * FROM rekap_penjualan";
              $result = mysqli_query($conn, $query);
              while ($data = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>".$data['id_rekap_penjualan']."</td>";
                  echo "<td>".$data['id_invoice']."</td>";
                  echo "<td>".$data['volume']."</td>";
                  echo "<td>".$data['quantity']."</td>";
                  echo "<td>".number_format($data['total_penjualan'], 2, ',', '.')."</td>";
                  echo "<td>";
                  echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"".$data['id_rekap_penjualan']."\", \"".$data['id_invoice']."\", \"".$data['volume']."\", \"".$data['quantity']."\", \"".$data['total_penjualan']."\")'><i class='fas fa-edit'></i></button>"; // Menggunakan nama kolom yang sesuai
                  echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData(\"".$data['id_rekap_penjualan']."\")'><i class='fas fa-trash'></i></button>"; // Menggunakan nama kolom yang sesuai
                  echo "</td>";
                  echo "</tr>"; 
              }
            ?> --}}
            </tbody>
            <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    function updateTanggalJam() {
      var date = new Date();
      var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
      var formattedDate = date.toLocaleDateString('id-ID', options);
      document.getElementById('tanggalJam').textContent = formattedDate;
    }

    // Memanggil fungsi untuk pertama kali saat halaman dimuat
    updateTanggalJam();

    // Memperbarui tanggal dan jam setiap detik
    setInterval(updateTanggalJam, 1000);
    
    function openEditModal(idRekapPenjualan, idInvoice, volume, quantity, totalPenjualan) {
        document.getElementById("edit_id_rekap_penjualan").value = idRekapPenjualan;
        document.getElementById("edit_id_invoice").value = idInvoice;
        document.getElementById("edit_volume").value = volume;
        document.getElementById("edit_quantity").value = quantity;
        document.getElementById("edit_total_penjualan").value = totalPenjualan;
    }

    function deleteData(idRekapPenjualan) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = "?id_rekap_penjualan=" + idRekapPenjualan;
        }
    }
    
	// Ajax Data Table 
	$(document).ready(function () {
	  $('#dataTableHover').DataTable();
	});
  </script>
  @endsection