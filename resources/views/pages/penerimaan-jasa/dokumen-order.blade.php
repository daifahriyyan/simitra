@extends('layouts.main')

@section('container-fluid')
<div class="container-fluid" id="container-wrapper">
  <!-- Your container content -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dokumen Order</h1> <!-- EDIT NAMA -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Penerimaan Jasa</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dokumen Order</li> <!-- EDIT NAMA -->
    </ol>
  </div>
  <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
  <!-- Modal Tambah Data -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data Persyaratan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="id_order" class="form-label">ID Order:</label>
              <input type="text" class="form-control" id="id_order" name="id_order" required>
            </div>
            <div class="mb-3">
              <label for="id_order_container" class="form-label">ID Order Container:</label>
              <input type="text" class="form-control" id="id_order_container" name="id_order_container" required>
            </div>
            <div class="mb-3">
              <label for="nama_driver" class="form-label">Nama Driver:</label>
              <input type="text" class="form-control" id="nama_driver" name="nama_driver" required>
            </div>
            <div class="mb-3">
              <label for="telp_driver" class="form-label">Telepon Driver:</label>
              <input type="number" class="form-control" id="telp_driver" name="telp_driver" required>
            </div>
            <div class="mb-3">
              <label for="shipment_instruction" class="form-label">Instruksi Pengiriman:</label>
              <input type="file" class="form-control" id="shipment_instruction" name="shipment_instruction" required>
            </div>
            <div class="mb-3">
              <label for="packing_list" class="form-label">Packing List:</label>
              <input type="file" class="form-control" id="packing_list" name="packing_list" required>
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
          <h5 class="modal-title" id="editModalLabel">Edit Data Persyaratan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="edit_id_order" class="form-label">ID Order:</label>
              <input type="text" class="form-control" id="edit_id_order" name="edit_id_order" readonly required>
            </div>
            <div class="mb-3">
              <label for="edit_id_order_container" class="form-label">ID Order Container:</label>
              <input type="text" class="form-control" id="edit_id_order_container" name="edit_id_order_container"
                required>
            </div>
            <div class="mb-3">
              <label for="edit_nama_driver" class="form-label">Nama Driver:</label>
              <input type="text" class="form-control" id="edit_nama_driver" name="edit_nama_driver" required>
            </div>
            <div class="mb-3">
              <label for="edit_telp_driver" class="form-label">Telepon Driver:</label>
              <input type="number" class="form-control" id="edit_telp_driver" name="edit_telp_driver" required>
            </div>
            <div class="mb-3">
              <label for="edit_shipment_instruction" class="form-label">Instruksi Pengiriman:</label>
              <input type="text" class="form-control" id="edit_shipment_instruction" name="edit_shipment_instruction"
                required>
            </div>
            <div class="mb-3">
              <label for="edit_packing_list" class="form-label">Packing List:</label>
              <input type="text" class="form-control" id="edit_packing_list" name="edit_packing_list" required>
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
          <h6 class="m-0 font-weight-bold text-primary">Dokumen Order</h6> <!-- EDIT NAMA -->
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
                <th>Id Order</th>
                <th>Id Order Container</th>
                <th>Nama Driver</th>
                <th>Telp Driver</th>
                <th>Berkas Shipment Instruction</th>
                <th>Berkas Packing List</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              {{--
              <?php
              $query = "SELECT * FROM data_persyaratan";
              $result = mysqli_query($conn, $query);
              while ($data = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>".$data['id_order']."</td>";
                  echo "<td>".$data['id_order_container']."</td>";
                  echo "<td>".$data['nama_driver']."</td>";
                  echo "<td>".$data['telp_driver']."</td>";
                  echo "<td>".$data['shipment_instruction']."</td>";
                  echo "<td>".$data['packing_list']."</td>";
                  echo "<td><span class='badge badge-danger'>Process</span></td>";
                  echo "<td>";
                  echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"".$data['id_order']."\", \"".$data['id_order_container']."\", \"".$data['nama_driver']."\", \"".$data['telp_driver']."\", \"".$data['shipment_instruction']."\", \"".$data['packing_list']."\")'><i class='fas fa-edit'></i></button>";
                  echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData(\"".$data['id_order']."\")'><i class='fas fa-trash'></i></button>";
                  echo "<a href='generate_pdf.php?id_order=".htmlspecialchars($data['id_order'])."' class='btn btn-primary btn-sm' target='_blank' role='button'><i class='fas fa-print'></i></a>";
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
    
    function openEditModal(idOrder, idOrderContainer, namaDriver, telpDriver, shipmentInstruction, packingList) {
        document.getElementById("edit_id_order").value = idOrder;
        document.getElementById("edit_id_order_container").value = idOrderContainer;
        document.getElementById("edit_nama_driver").value = namaDriver;
        document.getElementById("edit_telp_driver").value = telpDriver;
        document.getElementById("edit_shipment_instruction").value = shipmentInstruction;
        document.getElementById("edit_packing_list").value = packingList;
    }

    function deleteData(idOrder) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = "?id_order=" + idOrder;
        }
    }
     
	// Ajax Data Table 
	$(document).ready(function () {
	  $('#dataTableHover').DataTable();
	});
  </script>
  @endsection