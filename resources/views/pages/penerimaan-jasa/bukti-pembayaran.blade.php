@extends('layouts.main')

@section('container-fluid')
<div class="container-fluid" id="container-wrapper">
  <!-- Your container content -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bukti Pembayaran</h1> <!-- EDIT NAMA -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Penerimaan Jasa</a></li>
      <li class="breadcrumb-item active" aria-current="page">Bukti Pembayaran</li> <!-- EDIT NAMA -->
    </ol>
  </div>
  <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
  <!-- Modal Tambah Data -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data Bukti Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('Tambah Bukti Pembayaran') }}" enctype="multipart/form-data">
            @csrf
            <!-- Perhatikan penambahan enctype -->
            <div class="mb-3">
              <label for="id_order" class="form-label">ID Order:</label>
              {{-- <input type="number" class="form-control" id="id_order" name="id_order" required> --}}
              <select class="form-control form-select-lg" name="id_order" id="id_order">
                <option selected>Pilih ID Order</option>
                @foreach ($dataOrder as $item)
                <option value="{{ $item->id }}">{{ $item->id_order }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="id_invoice" class="form-label">ID Invoice:</label>
              {{-- <input type="number" class="form-control" id="id_invoice" name="id_invoice" required> --}}
              <select class="form-control form-select-lg" name="id_invoice" id="id_invoice">
                <option selected>Pilih ID Invoice</option>
                @foreach ($invoice as $item)
                <option value="{{ $item->id }}">{{ $item->id_invoice }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran:</label>
              <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran" required>
            </div>
            <div class="mb-3">
              <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran:</label>
              <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
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
          <h5 class="modal-title" id="editModalLabel">Edit Data Bukti Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data">
            <!-- Perhatikan penambahan enctype -->
            <div class="mb-3">
              <label for="id_order" class="form-label">ID Order:</label>
              {{-- <input type="number" class="form-control" id="id_order" name="id_order" required> --}}
              <select class="form-control form-select-lg" name="id_order" id="id_order">
                <option value="{{ $record->id_order }}">{{ $record->dataOrder->id_order }}</option>
                @foreach ($dataOrder as $item)
                <option value="{{ $item->id }}">{{ $item->id_order }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="id_invoice" class="form-label">ID Invoice:</label>
              {{-- <input type="number" class="form-control" id="id_invoice" name="id_invoice" required> --}}
              <select class="form-control form-select-lg" name="id_invoice" id="id_invoice">
                <option value="{{ $record->id_order }}">{{ $record->Invoice->id_invoice }}</option>
                @foreach ($invoice as $item)
                <option value="{{ $item->id }}">{{ $item->id_invoice }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran:</label>
              <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran"
                value="{{ $record->tanggal_pembayaran }}" required>
            </div>
            <div class="mb-3">
              <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran:</label>
              <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran">
              <span>current: {{ $record->bukti_pembayaran }}</span>
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
        <form method="POST" action="{{ route('Hapus Bukti Pembayaran', $record->id) }}">
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
          <h6 class="m-0 font-weight-bold text-primary">Bukti Pembayaran</h6> <!-- EDIT NAMA -->
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
                <th>Tanggal Pembayaran</th>
                <th>Bukti Pembayaran</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($records as $record)
              <tr>
                <td>{{ $record->id_order }}</td>
                <td>{{ $record->tanggal_pembayaran }}</td>
                <td>{{ $record->bukti_pembayaran }}</td>
                <td><span class='badge badge-danger'>Process</span></td>
                <td>
                  {{-- <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                    data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                  <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                    data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button> --}}
                  <a href="{{ route('bukti-pembayaran.show', $record->id) }}" class='btn btn-info btn-sm'
                    style='width: 30px; height: 30px;'><i class='fas fa-check'></i></a>
                  <button type='button' class='btn btn-danger btn-sm' style='width: 30px; height: 30px;'><i
                      class='fas fa-times'></i></button>
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

    
    function openEditModal(idOrder, tanggalPembayaran, buktiPembayaranPath) {
        document.getElementById("edit_id_order").value = idOrder;
        document.getElementById("edit_tanggal_pembayaran").value = tanggalPembayaran;
        document.getElementById("edit_bukti_pembayaran_path").value = buktiPembayaranPath;
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