@extends('layouts.main')

@section('container-fluid')
<div class="container-fluid" id="container-wrapper">
  <!-- Your container content -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Persediaan</h1> <!-- EDIT NAMA -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Master</a></li>
      <li class="breadcrumb-item active" aria-current="page">Persediaan</li> <!-- EDIT NAMA -->
    </ol>
  </div>
  <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
  <!-- Modal Tambah Data -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data Persediaan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('Tambah Persediaan') }}">
            @csrf
            <div class="mb-3">
              <label for="id_persediaan" class="form-label">ID Persediaan:</label>
              <input type="text" class="form-control" id="id_persediaan" name="id_persediaan" required>
            </div>
            <div class="mb-3">
              <label for="nama_persediaan" class="form-label">Nama Persediaan:</label>
              <input type="text" class="form-control" id="nama_persediaan" name="nama_persediaan" required>
            </div>
            <div class="mb-3">
              <label for="quantity" class="form-label">Quantity:</label>
              <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="mb-3">
              <label for="saldo" class="form-label">Saldo:</label>
              <input type="number" class="form-control" id="saldo" name="saldo" required>
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
  <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data Persediaan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('Ubah Persediaan', $record->id) }}">
            @csrf @method('put')
            <div class="mb-3">
              <label for="id_persediaan" class="form-label">ID Persediaan:</label>
              <input type="text" class="form-control" id="id_persediaan" value="{{ $record->id_persediaan }}"
                name="id_persediaan" readonly required>
            </div>
            <div class="mb-3">
              <label for="nama_persediaan" class="form-label">Nama Persediaan:</label>
              <input type="text" class="form-control" id="nama_persediaan" value="{{ $record->nama_persediaan }}"
                name="nama_persediaan" required>
            </div>
            <div class="mb-3">
              <label for="quantity" class="form-label">Quantity:</label>
              <input type="number" class="form-control" id="quantity" value="{{ $record->quantity }}" name="quantity"
                required>
            </div>
            <div class="mb-3">
              <label for="saldo" class="form-label">Saldo:</label>
              <input type="number" class="form-control" id="saldo" value="{{ $record->saldo }}" name="saldo" required>
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
        <form method="POST" action="{{ route('Hapus Harga Jasa', $record->id) }}">
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
          <h6 class="m-0 font-weight-bold text-primary">Persediaan</h6> <!-- EDIT NAMA -->
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
                <th>Id Persediaan</th>
                <th>Nama Persediaan</th>
                <th>Quantity</th>
                <th>Saldo</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($records as $record)
              <tr>
                <td>{{ $record->id_persediaan }}</td>
                <td>{{ $record->nama_persediaan }}</td>
                <td>{{ $record->quantity }}</td>
                <td>{{ $record->saldo }}</td>
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
              $query = "SELECT * FROM data_persediaan";
              $result = mysqli_query($conn, $query);
              while ($data = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>".$data['id_persediaan']."</td>";
                  echo "<td>".$data['nama_persediaan']."</td>";
                  echo "<td>".$data['quantity']."</td>";
                  echo "<td>".number_format($data['Saldo'], 2, ',', '.')."</td>";
                  echo "<td>";
                  echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"".$data['id_persediaan']."\", \"".$data['nama_persediaan']."\", \"".$data['quantity']."\", \"".$data['Saldo']."\")'><i class='fas fa-edit'></i></button>";
                  echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData(\"".$data['id_persediaan']."\")'><i class='fas fa-trash'></i></button>";
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
    
    function openEditModal(idPersediaan, namaPersediaan, quantity, saldo) {
      document.getElementById("edit_id_persediaan").value = idPersediaan;
      document.getElementById("edit_nama_persediaan").value = namaPersediaan;
      document.getElementById("edit_quantity").value = quantity;
      document.getElementById("edit_saldo").value = saldo;
    }

    function deleteData(idPersediaan) {
      if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = "?id_persediaan=" + idPersediaan;
      }
    }
    
	// Ajax Data Table 
	$(document).ready(function () {
	  $('#dataTableHover').DataTable();
	});
  </script>
  @endsection