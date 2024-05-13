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
  @if (session()->has('error'))
  <div class="row">
    <div class="col d-flex justify-content-center">
      <div class="alert alert-danger alert-dismissible fade show" style="min-height: 50px; width:500px;" role="alert">
        <div>
          {{ session('error') }}
        </div>
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
  @endif
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
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('Tambah Standar HPP') }}">
            @csrf
            <div class="mb-3">
              <label for="id_standar" class="form-label">ID Standar:</label>
              <input type="text" class="form-control" id="id_standar" name="id_standar" value="feet" required>
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
            {{-- <div class="mb-3">
              <label for="jumlah_hpp_feet" class="form-label">Jumlah HPP Feet:</label>
              <input type="number" class="form-control" id="jumlah_hpp_feet" name="jumlah_hpp_feet" required>
            </div> --}}
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
          <h5 class="modal-title" id="editModalLabel">Edit Data HPP Feet</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('Ubah Standar HPP', $record->id) }}">
            @csrf @method('put')
            <div class="mb-3">
              <label for="id_standar" class="form-label">ID Standar:</label>
              <input type="text" class="form-control" id="id_standar" value="{{ $record->id_standar }}"
                name="id_standar" required>
            </div>
            <div class="mb-3">
              <label for="bbb_feet" class="form-label">BBB Feet:</label>
              <input type="number" class="form-control" id="bbb_feet" value="{{ $record->bbb_feet }}" name="bbb_feet"
                required>
            </div>
            <div class="mb-3">
              <label for="btk_feet" class="form-label">BTK Feet:</label>
              <input type="number" class="form-control" id="btk_feet" value="{{ $record->btk_feet }}" name="btk_feet"
                required>
            </div>
            <div class="mb-3">
              <label for="bop_feet" class="form-label">BOP Feet:</label>
              <input type="number" class="form-control" id="bop_feet" value="{{ $record->bop_feet }}" name="bop_feet"
                required>
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
        <form method="POST" action="{{ route('Hapus Standar HPP', $record->id) }}">
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
          <h6 class="m-0 font-weight-bold text-primary">Standar HPP</h6> <!-- EDIT NAMA -->
          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <!-- Tombol Tambah dengan Icon -->
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#addModal">
              Tambah
            </button>
            <!-- Tombol Cetak Tabel dengan Icon -->
            <a href="{{ route('Standar HPP') }}?export=pdf" class="btn btn-sm btn-warning">
              Cetak
            </a>
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
              @foreach ($records as $record)
              <tr>
                <th>{{ $record->id_standar }}</th>
                <th>{{ number_format($record->bbb_feet, 2, ',', '.') }}</th>
                <th>{{ number_format($record->btk_feet, 2, ',', '.') }}</th>
                <th>{{ number_format($record->bop_feet, 2, ',', '.') }}</th>
                <th>{{ number_format($record->jumlah_hpp_feet, 2, ',', '.') }}</th>
                <td>
                  <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                    data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                  <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                    data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                </td>
              </tr>
              @endforeach
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