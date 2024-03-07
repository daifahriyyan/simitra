@extends('layouts.main')

@section('container-fluid')
<div class="container-fluid" id="container-wrapper">
  <!-- Your container content -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Customer</h1> <!-- EDIT NAMA -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Penerimaan Jasa</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail Customer</li> <!-- EDIT NAMA -->
    </ol>
  </div>
  <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
  <!-- Modal Tambah Data -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data Detail Customer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="id_customer" class="form-label">ID Customer:</label>
              <input type="text" class="form-control" id="id_customer" name="id_customer" required>
            </div>
            <div class="mb-3">
              <label for="termin" class="form-label">Termin:</label>
              <input type="text" class="form-control" id="termin" name="termin" required>
            </div>
            <div class="mb-3">
              <label for="tanggal_input" class="form-label">Tanggal Input:</label>
              <input type="date" class="form-control" id="tanggal_input" name="tanggal_input" required>
            </div>
            <div class="mb-3">
              <label for="saldo_awal" class="form-label">Saldo Awal:</label>
              <input type="number" class="form-control" id="saldo_awal" name="saldo_awal" required>
            </div>
            <div class="mb-3">
              <label for="total_penjualan" class="form-label">Total Penjualan:</label>
              <input type="number" class="form-control" id="total_penjualan" name="total_penjualan" required>
            </div>
            <div class="mb-3">
              <label for="penerimaan" class="form-label">Penerimaan:</label>
              <input type="number" class="form-control" id="penerimaan" name="penerimaan" required>
            </div>
            <div class="mb-3">
              <label for="saldo_akhir" class="form-label">Saldo Akhir:</label>
              <input type="number" class="form-control" id="saldo_akhir" name="saldo_akhir" required>
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
          <h5 class="modal-title" id="editModalLabel">Edit Data Detail Customer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="edit_id_customer" class="form-label">ID Customer:</label>
              <input type="text" class="form-control" id="edit_id_customer" name="edit_id_customer" readonly required>
            </div>
            <div class="mb-3">
              <label for="edit_termin" class="form-label">Termin:</label>
              <input type="text" class="form-control" id="edit_termin" name="edit_termin" required>
            </div>
            <div class="mb-3">
              <label for="edit_tanggal_input" class="form-label">Tanggal Input:</label>
              <input type="date" class="form-control" id="edit_tanggal_input" name="edit_tanggal_input" required>
            </div>
            <div class="mb-3">
              <label for="edit_saldo_awal" class="form-label">Saldo Awal:</label>
              <input type="number" class="form-control" id="edit_saldo_awal" name="edit_saldo_awal" required>
            </div>
            <div class="mb-3">
              <label for="edit_total_penjualan" class="form-label">Total Penjualan:</label>
              <input type="number" class="form-control" id="edit_total_penjualan" name="edit_total_penjualan" required>
            </div>
            <div class="mb-3">
              <label for="edit_penerimaan" class="form-label">Penerimaan:</label>
              <input type="number" class="form-control" id="edit_penerimaan" name="edit_penerimaan" required>
            </div>
            <div class="mb-3">
              <label for="edit_saldo_akhir" class="form-label">Saldo Akhir:</label>
              <input type="number" class="form-control" id="edit_saldo_akhir" name="edit_saldo_akhir" required>
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
          <h6 class="m-0 font-weight-bold text-primary">Detail Customer</h6> <!-- EDIT NAMA -->
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
                <th>Id Customer</th>
                <th>Termin</th>
                <th>Tanggal Input</th>
                <th>Saldo Awal</th>
                <th>Total Penjualan</th>
                <th>Total Penerimaan</th>
                <th>Saldo Akhir</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              {{--
              <?php
                            $query = "SELECT * FROM detail_customer";
                            $result = mysqli_query($conn, $query);

                            while ($data = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>".$data['id_customer']."</td>";
                                echo "<td>".$data['termin']."</td>";
                                echo "<td>".$data['tanggal_input']."</td>";
                                echo "<td>".number_format($data['saldo_awal'], 2, ',', '.')."</td>";
                                echo "<td>".number_format($data['total_penjualan'], 2, ',', '.')."</td>";
                                echo "<td>".number_format($data['penerimaan'], 2, ',', '.')."</td>";
                                echo "<td>".number_format($data['saldo_akhir'], 2, ',', '.')."</td>";
                                echo "<td>";
                                echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"".$data['id_customer']."\", \"".$data['termin']."\", \"".$data['tanggal_input']."\", \"".$data['saldo_awal']."\", \"".$data['total_penjualan']."\", \"".$data['penerimaan']."\", \"".$data['saldo_akhir']."\")'><i class='fas fa-edit'></i></button>";
                                echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData(\"".$data['id_customer']."\")'><i class='fas fa-trash'></i></button>";
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

    
    function openEditModal(idCustomer, termin, tanggalInput, saldoAwal, totalPenjualan, penerimaan, saldoAkhir) {
        document.getElementById("edit_id_customer").value = idCustomer;
        document.getElementById("edit_termin").value = termin;
        document.getElementById("edit_tanggal_input").value = tanggalInput;
        document.getElementById("edit_saldo_awal").value = saldoAwal;
        document.getElementById("edit_total_penjualan").value = totalPenjualan;
        document.getElementById("edit_penerimaan").value = penerimaan;
        document.getElementById("edit_saldo_akhir").value = saldoAkhir;
    }

    function deleteData(idCustomer) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = "?id_customer=" + idCustomer;
        }
    }
    
	// Ajax Data Table 
	$(document).ready(function () {
	  $('#dataTableHover').DataTable();
	});
  </script>
  @endsection