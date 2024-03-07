@extends('layouts.main')

@section('container-fluid')
<div class="container-fluid" id="container-wrapper">
  <!-- Your container content -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Customer</h1> <!-- EDIT NAMA -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Penerimaan Jasa</a></li>
      <li class="breadcrumb-item active" aria-current="page">Customer</li> <!-- EDIT NAMA -->
    </ol>
  </div>
  <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
  <!-- Modal Tambah Data -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data Customer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="id_customer" class="form-label">ID Customer:</label>
              <input type="text" class="form-control" id="id_customer" name="id_customer" required>
            </div>
            <div class="mb-3">
              <label for="nama_customer" class="form-label">Nama Customer:</label>
              <input type="text" class="form-control" id="nama_customer" name="nama_customer" required>
            </div>
            <div class="mb-3">
              <label for="alamat_customer" class="form-label">Alamat Customer:</label>
              <input type="text" class="form-control" id="alamat_customer" name="alamat_customer" required>
            </div>
            <div class="mb-3">
              <label for="telp_customer" class="form-label">Telepon Customer:</label>
              <input type="number" class="form-control" id="telp_customer" name="telp_customer" required>
            </div>
            <div class="mb-3">
              <label for="email_customer" class="form-label">Email Customer:</label>
              <input type="email" class="form-control" id="email_customer" name="email_customer" required>
            </div>
            <div class="mb-3">
              <label for="pic" class="form-label">PIC:</label>
              <input type="text" class="form-control" id="pic" name="pic" required>
            </div>
            <div class="mb-3">
              <label for="phone_pic" class="form-label">Telepon PIC:</label>
              <input type="number" class="form-control" id="phone_pic" name="phone_pic" required>
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
          <h5 class="modal-title" id="editModalLabel">Edit Data Customer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="edit_id_customer" class="form-label">ID Customer:</label>
              <input type="text" class="form-control" id="edit_id_customer" name="edit_id_customer" readonly required>
            </div>
            <div class="mb-3">
              <label for="edit_nama_customer" class="form-label">Nama Customer:</label>
              <input type="text" class="form-control" id="edit_nama_customer" name="edit_nama_customer" required>
            </div>
            <div class="mb-3">
              <label for="edit_alamat_customer" class="form-label">Alamat Customer:</label>
              <input type="text" class="form-control" id="edit_alamat_customer" name="edit_alamat_customer" required>
            </div>
            <div class="mb-3">
              <label for="edit_telp_customer" class="form-label">Telepon Customer:</label>
              <input type="number" class="form-control" id="edit_telp_customer" name="edit_telp_customer" required>
            </div>
            <div class="mb-3">
              <label for="edit_email_customer" class="form-label">Email Customer:</label>
              <input type="email" class="form-control" id="edit_email_customer" name="edit_email_customer" required>
            </div>
            <div class="mb-3">
              <label for="edit_pic" class="form-label">PIC:</label>
              <input type="text" class="form-control" id="edit_pic" name="edit_pic" required>
            </div>
            <div class="mb-3">
              <label for="edit_phone_pic" class="form-label">Telepon PIC:</label>
              <input type="number" class="form-control" id="edit_phone_pic" name="edit_phone_pic" required>
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
          <h6 class="m-0 font-weight-bold text-primary">Customer</h6> <!-- EDIT NAMA -->
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
                <th>Id Customer</th>
                <th>Nama Customer</th>
                <th>Alamat Customer</th>
                <th>Telp Customer</th>
                <th>Email Customer</th>
                <th>Nama PIC</th>
                <th>Telp PIC</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              {{--
              <?php
			  $query = "SELECT * FROM data_customer";
			  $result = mysqli_query($conn, $query);
			  while ($data = mysqli_fetch_assoc($result)) {
				  echo "<tr>";
				  echo "<td>".$data['id_customer']."</td>";
				  echo "<td>".$data['nama_customer']."</td>";
				  echo "<td>".$data['alamat_customer']."</td>";
				  echo "<td>".$data['telp_customer']."</td>";
				  echo "<td>".$data['email_customer']."</td>";
				  echo "<td>".$data['pic']."</td>";
				  echo "<td>".$data['phone_pic']."</td>";
				  echo "<td><span class='badge badge-danger'>Process</span></td>";
				  echo "<td>";
				  echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"".$data['id_customer']."\", \"".$data['nama_customer']."\", \"".$data['alamat_customer']."\", \"".$data['telp_customer']."\", \"".$data['email_customer']."\", \"".$data['pic']."\", \"".$data['phone_pic']."\")'><i class='fas fa-edit'></i></button>";
				  echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData(\"".$data['id_customer']."\")'><i class='fas fa-trash'></i></button>";
				  echo "<a href='generate_pdf.php?id_customer=".htmlspecialchars($data['id_customer'])."' class='btn btn-primary btn-sm' target='_blank' role='button'><i class='fas fa-print'></i></a>";
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

	
	function openEditModal(idCustomer, namaCustomer, alamatCustomer, telpCustomer, emailCustomer, pic, phonePic) {
		document.getElementById("edit_id_customer").value = idCustomer;
		document.getElementById("edit_nama_customer").value = namaCustomer;
		document.getElementById("edit_alamat_customer").value = alamatCustomer;
		document.getElementById("edit_telp_customer").value = telpCustomer;
		document.getElementById("edit_email_customer").value = emailCustomer;
		document.getElementById("edit_pic").value = pic;
		document.getElementById("edit_phone_pic").value = phonePic;
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