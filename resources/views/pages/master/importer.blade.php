@extends('layouts.main')

@section('container-fluid')
<div class="container-fluid" id="container-wrapper">
  @if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h3>Pesan Error</h3>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
	<!-- Your container content -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Importer</h1> <!-- EDIT NAMA -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Master</a></li>
			<li class="breadcrumb-item active" aria-current="page">Importer</li> <!-- EDIT NAMA -->
		</ol>
	</div>
	<!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
	<!-- Modal Tambah Data -->
	<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addModalLabel">Tambah Data Importer</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{ route('Tambah Importer') }}">
						@csrf
						<div class="mb-3">
							<label for="id_importer" class="form-label">ID Importer:</label>
							<input type="text" class="form-control" id="id_importer" name="id_importer" required>
						</div>
						<div class="mb-3">
							<label for="nama_importer" class="form-label">Nama Importer:</label>
							<input type="text" class="form-control" id="nama_importer" name="nama_importer" required>
						</div>
						<div class="mb-3">
							<label for="alamat_importer" class="form-label">Alamat Importer:</label>
							<input type="text" class="form-control" id="alamat_importer" name="alamat_importer" required>
						</div>
						<div class="mb-3">
							<label for="telp_importer" class="form-label">Telepon Importer:</label>
							<input type="text" class="form-control" id="telp_importer" name="telp_importer" required>
						</div>
						<div class="mb-3">
							<label for="fax" class="form-label">Fax:</label>
							<input type="text" class="form-control" id="fax" name="fax">
						</div>
						<div class="mb-3">
							<label for="usci" class="form-label">USCI:</label>
							<input type="text" class="form-control" id="usci" name="usci">
						</div>
						<div class="mb-3">
							<label for="pic" class="form-label">PIC:</label>
							<input type="text" class="form-control" id="pic" name="pic">
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
	@foreach ($records as $record)
	<!-- Modal Edit Data -->
	<div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Edit Data Importer</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{ route('Ubah Importer', $record->id) }}">
						@csrf @method('put')
						<div class="mb-3">
							<label for="id_importer" class="form-label">ID Importer:</label>
							<input type="text" class="form-control" id="id_importer" value="{{ $record->id_importer }}" name="id_importer" readonly required>
						</div>
						<div class="mb-3">
							<label for="nama_importer" class="form-label">Nama Importer:</label>
							<input type="text" class="form-control" id="nama_importer" value="{{ $record->nama_importer }}" name="nama_importer" required>
						</div>
						<div class="mb-3">
							<label for="alamat_importer" class="form-label">Alamat Importer:</label>
							<input type="text" class="form-control" id="alamat_importer" value="{{ $record->alamat_importer }}" name="alamat_importer" required>
						</div>
						<div class="mb-3">
							<label for="telp_importer" class="form-label">Telepon Importer:</label>
							<input type="text" class="form-control" id="telp_importer" value="{{ $record->telp_importer }}" name="telp_importer" required>
						</div>
						<div class="mb-3">
							<label for="fax" class="form-label">Fax:</label>
							<input type="text" class="form-control" id="fax" value="{{ $record->fax }}" name="fax">
						</div>
						<div class="mb-3">
							<label for="usci" class="form-label">USCI:</label>
							<input type="text" class="form-control" id="usci" value="{{ $record->usci }}" name="usci">
						</div>
						<div class="mb-3">
							<label for="pic" class="form-label">PIC:</label>
							<input type="text" class="form-control" id="pic" value="{{ $record->pic }}" name="pic">
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
  <!-- Modal Delete -->
  <div class="modal fade" id="deleteRecord{{ $record->id }}" tabindex="-1" aria-labelledby="deleteRecordLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="POST" action="{{ route('Hapus Importer', $record->id) }}">
          @method('delete')@csrf
          <div class="modal-body">
            Apakah Anda sudah yakin ingin menghapus Record ini?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
	@endforeach
			

	<!-- Row -->
	<div class="row">
		<!-- DataTable with Hover -->
		<div class="col-lg-12">
			<div class="card mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Importer</h6> <!-- EDIT NAMA -->
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

					<!-- Skrip JavaScript untukCetak Tabel -->
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
								<th>ID Importer</th>
								<th>Nama Importer</th>
								<th>Alamat Importer</th>
								<th>Telepon Importer</th>
								<th>FAX</th>
								<th>USCI</th>
								<th>PIC</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($records as $record)
							<tr>
								<td>{{ $record->id_importer }}</td>
								<td>{{ $record->nama_importer }}</td>
								<td>{{ $record->alamat_importer }}</td>
								<td>{{ $record->telp_importer }}</td>
								<td>{{ $record->fax }}</td>
								<td>{{ $record->usci }}</td>
								<td>{{ $record->pic }}</td>
                <td>
                  <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                    data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                  <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                    data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                </td>
							</tr>
							@endforeach
							{{--
							<?php
            $query = "SELECT * FROM data_importer";
            $result = mysqli_query($conn, $query);
            while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$data['id_importer']."</td>";
                echo "<td>".$data['nama_importer']."</td>";
                echo "<td>".$data['alamat_importer']."</td>";
                echo "<td>".$data['telp_importer']."</td>";
                echo "<td>".$data['fax']."</td>";
                echo "<td>".$data['usci']."</td>";
                echo "<td>".$data['pic']."</td>";
                echo "<td>";
                echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"".$data['id_importer']."\", \"".$data['nama_importer']."\", \"".$data['alamat_importer']."\", \"".$data['telp_importer']."\", \"".$data['fax']."\", \"".$data['usci']."\", \"".$data['pic']."\")'><i class='fas fa-edit'></i></button>";
                echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData(\"".$data['id_importer']."\")'><i class='fas fa-trash'></i></button>";
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

	<!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
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

    function openEditModal(idImporter, namaImporter, alamatImporter, telpImporter, fax, usci, pic) {
      document.getElementById("edit_id_importer").value = idImporter;
      document.getElementById("edit_nama_importer").value = namaImporter;
      document.getElementById("edit_alamat_importer").value = alamatImporter;
      document.getElementById("edit_telp_importer").value = telpImporter;
      document.getElementById("edit_fax").value = fax;
      document.getElementById("edit_usci").value = usci;
      document.getElementById("edit_pic").value = pic;
    }

    function deleteData(idImporter) {
      if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = "?id_importer=" + idImporter;
      }
    }
    
	// Ajax Data Table 
	$(document).ready(function () {
	  $('#dataTableHover').DataTable();
	});
	</script>
	<!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->
	@endsection