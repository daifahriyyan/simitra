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
    <h1 class="h3 mb-0 text-gray-800">Harga Jasa</h1> <!-- EDIT NAMA -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Master</a></li>
      <li class="breadcrumb-item active" aria-current="page">Harga Jasa</li> <!-- EDIT NAMA -->
    </ol>
  </div>
  <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
  <!-- Modal Tambah Data -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data Harga</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('Tambah Harga Jasa') }}">
            @csrf
            <div class="mb-3">
              <label for="id_datastandar" class="form-label">ID Data Standar:</label>
              <input type="text" class="form-control" id="id_datastandar" name="id_datastandar">
            </div>
            <div class="mb-3">
              <label for="id_standar" class="form-label">ID Standar:</label>
              <select class="form-control" id="id_standar" name="id_standar">
                <option>Pilih ID Standar</option>
                @foreach ($datahppfeet as $data)
                <option value="{{ $data->id }}">{{ $data->id_standar }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="volume" class="form-label">Volume:</label>
              <input type="number" class="form-control" id="volume" name="volume">
            </div>
            <div class="mb-3">
              <label for="treatment" class="form-label">Treatment:</label>
              <select class="form-select" id="treatment" name="treatment">
                <option value="FCL">FCL</option>
                <option value="LCL">LCL</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="markup" class="form-label">Markup:</label>
              <input type="number" class="form-control" id="markup" name="markup">
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
          <h5 class="modal-title" id="editModalLabel">Edit Data Harga</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('Ubah Harga Jasa', $record->id) }}">
            @csrf
            @method('put')
            <div class="mb-3">
              <label for="id_datastandar" class="form-label">ID Data Standar:</label>
              <input type="text" class="form-control" id="id_datastandar" value="{{ $record->id_datastandar }}"
                name="id_datastandar" readonly required>
            </div>
            <div class="mb-3">
              <label for="id_standar" class="form-label">ID Standar:</label>
              <input type="text" class="form-control" id="id_standar" value="{{ $record->id_standar }}"
                name="id_standar" required>
            </div>
            <div class="mb-3">
              <label for="volume" class="form-label">Volume:</label>
              <input type="text" class="form-control" id="volume" value="{{ $record->volume }}" name="volume" required>
            </div>
            <div class="mb-3">
              <label for="treatment" class="form-label">Treatment:</label>
              <select class="form-select" id="treatment" value="{{ $record->treatment }}" name="treatment" required>
                <option value="FCL">FCL</option>
                <option value="LCL">LCL</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="bbb_standar" class="form-label">BBB Standar:</label>
              <input type="number" class="form-control" id="bbb_standar" value="{{ $record->bbb_standar }}"
                name="bbb_standar" readonly>
            </div>
            <div class="mb-3">
              <label for="btk_standar" class="form-label">BTK Standar:</label>
              <input type="number" class="form-control" id="btk_standar" value="{{ $record->btk_standar }}"
                name="btk_standar" readonly>
            </div>
            <div class="mb-3">
              <label for="bop_standar" class="form-label">BOP Standar:</label>
              <input type="number" class="form-control" id="bop_standar" value="{{ $record->bop_standar }}"
                name="bop_standar" readonly>
            </div>
            <div class="mb-3">
              <label for="hpp" class="form-label">HPP:</label>
              <input type="number" class="form-control" id="hpp" value="{{ $record->hpp }}" name="hpp" readonly>
            </div>
            <div class="mb-3">
              <label for="markup" class="form-label">Markup:</label>
              <input type="number" class="form-control" id="markup" value="{{ $record->markup }}" name="markup"
                required>
            </div>
            <div class="mb-3">
              <label for="harga_jual" class="form-label">Harga Jual:</label>
              <input type="number" class="form-control" id="harga_jual" value="{{ $record->harga_jual }}"
                name="harga_jual" readonly>
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
          <h6 class="m-0 font-weight-bold text-primary">Harga Jasa</h6> <!-- EDIT NAMA -->
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
                <th>Id Data Standar</th>
                <th>Id Standar</th>
                <th>Volume</th>
                <th>Treatment</th>
                <th>Biaya Bahan Baku</th>
                <th>Biaya Tenaga Kerja</th>
                <th>Biaya Overhead Pabrik</th>
                <th>Harga Pokok Penjualan</th>
                <th>MarkUp</th>
                <th>Harga Jual</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($records as $record)
              <tr>
                <td>{{ $record->id_datastandar }}</td>
                <td>{{ $record->standarHPP->id_standar }}</td>
                <td>{{ $record->volume }}</td>
                <td>{{ $record->treatment }}</td>
                <td>{{ number_format($record->bbb_standar, 2, ',', '.') }}</td>
                <td>{{ number_format($record->btk_standar, 2, ',', '.') }}</td>
                <td>{{ number_format($record->bop_standar, 2, ',', '.') }}</td>
                <td>{{ number_format($record->hpp, 2, ',', '.') }}</td>
                <td>{{ number_format($record->markup, 2, ',', '.') }}</td>
                <td>{{ number_format($record->harga_jual, 2, ',', '.') }}</td>
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

  <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
  <script>
    function openEditModal(idDataStandar, idStandar, volume, treatment, bbbStandar, btkStandar, bopStandar, hpp, markup, hargaJual) {
      document.getElementById("id_datastandar").value = idDataStandar;
      document.getElementById("id_standar").value = idStandar;
      document.getElementById("volume").value = volume;
      document.getElementById("treatment").value = treatment;
      document.getElementById("bbb_standar").value = bbbStandar;
      document.getElementById("btk_standar").value = btkStandar;
      document.getElementById("bop_standar").value = bopStandar;
      document.getElementById("hpp").value = hpp;
      document.getElementById("markup").value = markup;
      document.getElementById("harga_jual").value = hargaJual;
    }

    function deleteData(idDataStandar) {
      if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = "?id_datastandar=" + idDataStandar;
      }
    }
    
	// Ajax Data Table 
	$(document).ready(function () {
	  $('#dataTableHover').DataTable();
	});
  </script>
  <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->
  @endsection