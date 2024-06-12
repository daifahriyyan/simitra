<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Harga Jasa</title>

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
                      <select class="form-control" id="treatment" name="treatment">
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
                      <input type="text" class="form-control" id="volume" value="{{ $record->volume }}" name="volume"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="treatment" class="form-label">Treatment:</label>
                      <select class="form-control" id="treatment" value="{{ $record->treatment }}" name="treatment"
                        required>
                        <option value="FCL">FCL</option>
                        <option value="LCL">LCL</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="markup" class="form-label">Markup:</label>
                      <input type="number" class="form-control" id="markup" value="{{ $record->markup }}" name="markup"
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
                    <a href="{{ route('Harga Jasa') }}?export=pdf" class="btn btn-sm btn-warning">
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
                  <table class="table align-items-center table-flush table-hover text-nowrap" id="dataTableHover">
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
                      @php
                      $bbb_feet = $record->standarHPP->bbb_feet * $record->volume;
                      $btk_feet = $record->standarHPP->btk_feet * $record->volume;
                      $bop_feet = $record->standarHPP->bop_feet * $record->volume;
                      $hpp = $record->standarHPP->jumlah_hpp_feet * $record->volume;
                      $harga_jual = $hpp * ($record->markup / 100);
                      @endphp
                      <tr>
                        <td>{{ $record->id_datastandar }}</td>
                        <td>{{ $record->standarHPP->id_standar }}</td>
                        <td>{{ $record->volume }}</td>
                        <td>{{ $record->treatment }}</td>
                        <td>{{ number_format($bbb_feet, 2, ',', '.') }}</td>
                        <td>{{ number_format($btk_feet, 2, ',', '.') }}</td>
                        <td>{{ number_format($bop_feet, 2, ',', '.') }}</td>
                        <td>{{ number_format($hpp, 2, ',', '.') }}</td>
                        <td>{{ number_format($record->markup, 2, ',', '.') }}</td>
                        <td>{{ number_format($harga_jual, 2, ',', '.') }}</td>
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