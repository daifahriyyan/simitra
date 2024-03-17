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
          <form method="POST" action="{{ route('Tambah Detail Customer') }}">
            @csrf
            <div class="mb-3">
              <label for="id_customer" class="form-label">ID Customer:</label>
              <select class="custom-select form-select-lg mb-3" aria-label="Large select example" id="id_customer"
                name="id_customer">
                <option selected>Pilih ID Customer</option>
                @foreach ($customers as $customer)
                <option value="{{ $customer->id_customer }}">{{ $customer->id_customer }}</option>
                @endforeach
              </select>
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
  @foreach ($records as $record)
  <!-- Modal Edit Data -->
  <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data Detail Customer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('Ubah Detail Customer', $record->id_customer) }}">
            @method('put')
            @csrf
            <div class="mb-3">
              <label for="id_customer" class="form-label">ID Customer:</label>
              <input type="text" class="form-control" id="id_customer" value="{{ $record->id_customer }}"
                name="id_customer" readonly required>
            </div>
            <div class="mb-3">
              <label for="termin" class="form-label">Termin:</label>
              <input type="text" class="form-control" id="termin" value="{{ $record->termin }}" name="termin" required>
            </div>
            <div class="mb-3">
              <label for="tanggal_input" class="form-label">Tanggal Input:</label>
              <input type="date" class="form-control" id="tanggal_input" value="{{ $record->tanggal_input }}"
                name="tanggal_input" required>
            </div>
            <div class="mb-3">
              <label for="saldo_awal" class="form-label">Saldo Awal:</label>
              <input type="number" class="form-control" id="saldo_awal" value="{{ $record->saldo_awal }}"
                name="saldo_awal" required>
            </div>
            <div class="mb-3">
              <label for="total_penjualan" class="form-label">Total Penjualan:</label>
              <input type="number" class="form-control" id="total_penjualan" value="{{ $record->total_penjualan }}"
                name="total_penjualan" required>
            </div>
            <div class="mb-3">
              <label for="penerimaan" class="form-label">Penerimaan:</label>
              <input type="number" class="form-control" id="penerimaan" value="{{ $record->penerimaan }}"
                name="penerimaan" required>
            </div>
            <div class="mb-3">
              <label for="saldo_akhir" class="form-label">Saldo Akhir:</label>
              <input type="number" class="form-control" id="saldo_akhir" value="{{ $record->saldo_akhir }}"
                name="saldo_akhir" required>
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
        <form method="POST" action="{{ route('Hapus Detail Customer', $record->id) }}">
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
              @foreach ($records as $record)
              <tr>
                <th>{{ $record->id_customer }}</th>
                <th>{{ $record->termin }}</th>
                <th>{{ $record->tanggal_input }}</th>
                <th>{{ $record->saldo_awal }}</th>
                <th>{{ $record->total_penjualan }}</th>
                <th>{{ $record->penerimaan }}</th>
                <th>{{ $record->saldo_akhir }}</th>
                <th>
                  <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                    data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                  <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                    data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                </th>
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