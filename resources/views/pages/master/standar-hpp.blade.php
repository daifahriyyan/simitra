@extends('layouts.main')

@section('container-fluid')
<div class="container-fluid" id="container-wrapper">
  <!-- Your container content -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Standar HPP</h1> <!-- EDIT NAMA -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Master</a></li>
      <li class="breadcrumb-item active" aria-current="page">Standar HPP</li> <!-- EDIT NAMA -->
    </ol>
  </div>
  <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
  <!-- Modal Tambah Data -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data HPP Feet</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="id_standar" class="form-label">ID Standar:</label>
              <input type="text" class="form-control" id="id_standar" name="id_standar" required>
            </div>
            <div class="mb-3">
              <label for="bbb_feet" class="form-label">BBB Feet:</label>
              <input type="number" class="form-control" id="bbb_feet" name="bbb_feet" required>
            </div>
            <div class="mb-3">
              <label for="btk_feet" class="form-label">BTK Feet:</label>
              <input type="number" class="form-control" id="btk_feet" name="btk_feet" required>
            </div>
            <div class="mb-3">
              <label for="bop_feet" class="form-label">BOP Feet:</label>
              <input type="number" class="form-control" id="bop_feet" name="bop_feet" required>
            </div>
            <div class="mb-3">
              <label for="jumlah_hpp_feet" class="form-label">Jumlah HPP Feet:</label>
              <input type="number" class="form-control" id="jumlah_hpp_feet" name="jumlah_hpp_feet" required>
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
          <h5 class="modal-title" id="editModalLabel">Edit Data HPP Feet</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="edit_id_standar" class="form-label">ID Standar:</label>
              <input type="text" class="form-control" id="edit_id_standar" name="edit_id_standar" readonly required>
            </div>
            <div class="mb-3">
              <label for="edit_bbb_feet" class="form-label">BBB Feet:</label>
              <input type="number" class="form-control" id="edit_bbb_feet" name="edit_bbb_feet" required>
            </div>
            <div class="mb-3">
              <label for="edit_btk_feet" class="form-label">BTK Feet:</label>
              <input type="number" class="form-control" id="edit_btk_feet" name="edit_btk_feet" required>
            </div>
            <div class="mb-3">
              <label for="edit_bop_feet" class="form-label">BOP Feet:</label>
              <input type="number" class="form-control" id="edit_bop_feet" name="edit_bop_feet" required>
            </div>
            <div class="mb-3">
              <label for="edit_jumlah_hpp_feet" class="form-label">Jumlah HPP Feet:</label>
              <input type="number" class="form-control" id="edit_jumlah_hpp_feet" name="edit_jumlah_hpp_feet" required>
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
          <h6 class="m-0 font-weight-bold text-primary">Standar HPP</h6> <!-- EDIT NAMA -->
          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <!-- Tombol Tambah dengan Icon -->
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#addModal">
              Tambah
            </button>
            <!-- Tombol Cetak Tabel dengan Icon -->
            <button type="button" class="btn btn-sm btn-warning" onclick="cetakTabel()">
              Cetak
            </button>
          </div>

          <!-- Skrip JavaScript untuk Cetak Tabel -->
          <script>
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
                <th>Id Standar</th>
                <th>BBB/feet</th>
                <th>BTK/feet</th>
                <th>BOP/feet</th>
                <th>Jumlah HPP/feet</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              {{--
              <?php
              $query = "SELECT * FROM data_hpp_feet";
              $result = mysqli_query($conn, $query);
              while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$data['id_standar']."</td>";
                echo "<td>".number_format($data['bbb_feet'], 2, ',', '.')."</td>"; 
                echo "<td>".number_format($data['btk_feet'], 2, ',', '.')."</td>"; 
                echo "<td>".number_format($data['bop_feet'], 2, ',', '.')."</td>"; 
                echo "<td>".number_format($data['jumlah_hpp_feet'], 2, ',', '.')."</td>";
                echo "<td>";
                echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"".$data['id_standar']."\", \"".$data['bbb_feet']."\", \"".$data['btk_feet']."\", \"".$data['bop_feet']."\", \"".$data['jumlah_hpp_feet']."\")'><i class='fas fa-edit'></i></button>";
                echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData(\"".$data['id_standar']."\")'><i class='fas fa-trash'></i></button>";
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
  
  function openEditModal(idStandar, bbbFeet, btkFeet, bopFeet, jumlahHppFeet) {
      document.getElementById("edit_id_standar").value = idStandar;
      document.getElementById("edit_bbb_feet").value = bbbFeet;
      document.getElementById("edit_btk_feet").value = btkFeet;
      document.getElementById("edit_bop_feet").value = bopFeet;
      document.getElementById("edit_jumlah_hpp_feet").value = jumlahHppFeet;
    }

    function deleteData(idStandar) {
      if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = "?id_standar=" + idStandar;
      }
    }
    
	// Ajax Data Table 
	$(document).ready(function () {
	  $('#dataTableHover').DataTable();
	});
  </script>
  @endsection