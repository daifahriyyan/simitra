<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Detail Customer</title>

  <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
  <link href="{{ asset('img/logo/logo.png') }}" rel="icon">
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/simitra.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">

    <!-- Sidebar -->
    @include('partials.sidebar')
    <!-- Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <!-- TopBar -->
        @include('partials.topbar')
        <!-- Topbar -->

        <div class="container-fluid" id="container-wrapper">
          @if (session()->has('error'))
          <div class="row">
            <div class="col d-flex justify-content-center">
              <div class="alert alert-danger alert-dismissible fade show" style="min-height: 50px; width:500px;"
                role="alert">
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
                      <label for="id_detail_customer" class="form-label">ID Detail Customer:</label>
                      <input type="text" class="form-control" id="id_detail_customer" name="id_detail_customer"
                        value="DC{{ str_pad($id_detail_customer + 1, 5, 0, STR_PAD_LEFT) }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_customer" class="form-label">ID Customer:</label>
                      <select class="custom-select form-select-lg mb-3" aria-label="Large select example"
                        id="id_customer" name="id_customer">
                        <option selected>Pilih ID Customer</option>
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->id_customer }}</option>
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
                      <label for="id_detail_customer" class="form-label">ID Detail Customer:</label>
                      <input type="text" class="form-control" id="id_detail_customer"
                        value="{{ $record->id_detail_customer }}" name="id_detail_customer" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="id_customer" class="form-label">ID Customer:</label>
                      <input type="text" class="form-control" id="id_customer" value="{{ $record->id_customer }}"
                        name="id_customer" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="termin" class="form-label">Termin:</label>
                      <input type="text" class="form-control" id="termin" value="{{ $record->termin }}" name="termin"
                        required>
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
                      <input type="number" class="form-control" id="total_penjualan"
                        value="{{ $record->total_penjualan }}" name="total_penjualan" required>
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
          <!-- Modal Verification -->
          <div class="modal fade" id="verification{{ $record->id }}" tabindex="-1" aria-labelledby="verificationLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body">
                  Yakin Telah Membayar Hutang ini?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <a href="{{ route('Detail Customer') }}?status=Lunas&id={{ $record->id }}"
                    class="btn btn-info">Yakin</a>
                </div>
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
                    {{-- <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                      data-bs-target="#addModal">
                      Tambah
                    </button> --}}
                    <!-- Tombol Filter Tanggal dengan Icon -->
                    <div class="input-group">
                      <form action="{{ route('Detail Customer') }}">
                        <input type="date" class="form-control-sm border-1" id="tanggalMulai"
                          value="{{ request()->tanggalMulai }}" name="tanggalMulai"
                          aria-describedby="tanggalMulaiLabel">
                        <input type="date" class="form-control-sm border-1" id="tanggalAkhir"
                          value="{{ request()->tanggalAkhir }}" name="tanggalAkhir"
                          aria-describedby="tanggalAkhirLabel">
                        <button type="subnit" class="btn btn-secondary btn-sm" style="width: 60px; height: 30px;">
                          Filter
                        </button>
                      </form>
                    </div>
                    <!-- Tombol Cetak Tabel dengan Icon -->
                    <a href="{{ route('Detail Customer') }}?export=pdf{{ (request()->tanggalMulai)? '&tanggalMulai='.request()->tanggalMulai : '' }}{{ (request()->tanggalAkhir)? '&tanggalAkhir='.request()->tanggalAkhir : '' }}"
                      class="btn btn-sm btn-warning">
                      Cetak
                    </a>
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
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($records as $record)
                      <tr>
                        <td>{{ $record->dataCustomer->id_customer }}</td>
                        <td>{{ $record->termin }}</td>
                        <td>{{ $record->tanggal_input }}</td>
                        <td>{{ $record->saldo_awal }}</td>
                        <td>{{ $record->total_penjualan }}</td>
                        <td>{{ $record->penerimaan }}</td>
                        <td>{{ $record->saldo_akhir }}</td>
                        <td>
                          @if($record->status == 'Lunas')
                          <span class='badge badge-success'>Lunas</span>
                          @elseif ($record->tanggal_jatuh_tempo > date('Y-m-d') && isset($record->saldo_akhir))
                          <span class='badge badge-warning'>Masa Piutang</span>
                          @elseif($record->tanggal_jatuh_tempo > date('Y-m-d') && is_null($record->saldo_akhir))
                          <span class='badge badge-success'>Lunas</span>
                          @elseif($record->tanggal_jatuh_tempo < date('Y-m-d') && isset($record->saldo_akhir))
                            <span class='badge badge-danger'>Jatuh Tempo</span>
                            @elseif($record->tanggal_jatuh_tempo < date('Y-m-d') && is_null($record->saldo_akhir))
                              <span class='badge badge-danger'>Lunas</span>
                              @endif
                        </td>
                        <td>
                          <button type="button" class='btn btn-info btn-sm' data-bs-toggle="modal"
                            data-bs-target='#verification{{ $record->id }}'>👍</button>
                          <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                            data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                          <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                            data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                          <a href="{{ route('Detail Customer') }}?export=pdf&id_customer={{ $record->id }}"
                            class='btn btn-primary btn-sm' style='width: 30px; height: 30px;' target='_blank'
                            role='button'><i class='fas fa-print'></i></a>
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
        </div>
      </div>
      <!-- Footer -->
      <footer>
        <p id="tanggalJam"
          style="font-size: 12px; margin: 0; justify-content: flex-end; display: flex; background-color: #f8f9fa;">
        </p>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
  <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{ asset('js/simitra.min.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
  $('#dataTableHover').DataTable();
});

// Function to display selected file name
function displayFileName(input, targetId) {
    var fileName = input.files[0].name;
    document.getElementById(targetId).innerHTML = fileName;
}

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
  </script>
</body>

</html>