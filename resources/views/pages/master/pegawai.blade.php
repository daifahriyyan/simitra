<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Pegawai</title>

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
          <!-- Your container content -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pegawai</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Master</a></li>
              <li class="breadcrumb-item active" aria-current="page">Pegawai</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Pegawai</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('pegawai.store') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="id_pegawai" class="form-label">ID Pegawai:</label>
                      <input type="text" class="form-control" id="id_pegawai" name="id_pegawai"
                        value="P00{{ $records->count()+1 }}" readonly>
                    </div>
                    <div class="mb-3">
                      <label for="nama_pegawai" class="form-label">Nama Pegawai:</label>
                      <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" required>
                    </div>
                    <div class="mb-3">
                      <label for="alamat_pegawai" class="form-label">Alamat Pegawai:</label>
                      <input type="text" class="form-control" id="alamat_pegawai" name="alamat_pegawai" required>
                    </div>
                    <div class="mb-3">
                      <label for="telp_pegawai" class="form-label">Telepon Pegawai:</label>
                      <input type="text" class="form-control" id="telp_pegawai" name="telp_pegawai" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="posisi">Posisi : </label>
                      <select class="form-control" id="posisi" name="posisi" required>
                        <option>Pilih Posisi</option>
                        <option value="Direktur">Direktur</option>
                        <option value="Manajer">Manajer</option>
                        <option value="Admin">Admin</option>
                        <option value="Operasional">Operasional</option>
                        <option value="Keuangan">Keuangan</option>
                        <option value="Fumigator">Fumigator</option>
                        <option value="Staff Lainnya">Staff Lainnya</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="noreg_fumigasi" class="form-label">No. Registrasi Fumigasi:</label>
                      <input type="text" class="form-control" id="noreg_fumigasi" name="noreg_fumigasi">
                    </div>
                    <div class="mb-3">
                      <label for="gaji_pokok" class="form-label">Gaji Pokok:</label>
                      <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" required>
                    </div>
                    <div class="mb-3">
                      <label for="fax" class="form-label">FAX:</label>
                      <input type="text" class="form-control" id="fax" name="fax">
                    </div>
                    <div class="mb-3">
                      <label for="usci" class="form-label">USCI:</label>
                      <input type="text" class="form-control" id="usci" name="usci">
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
                  <h5 class="modal-title" id="editModalLabel">Edit Data Pegawai</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('pegawai.update', $record->id) }}">
                    @csrf @method('put')
                    <div class="mb-3">
                      <label for="id_pegawai" class="form-label">ID Pegawai:</label>
                      <input type="text" class="form-control" id="id_pegawai" value="{{ $record->id_pegawai }}"
                        name="id_pegawai" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="nama_pegawai" class="form-label">Nama Pegawai:</label>
                      <input type="text" class="form-control" id="nama_pegawai" value="{{ $record->nama_pegawai }}"
                        name="nama_pegawai" required>
                    </div>
                    <div class="mb-3">
                      <label for="alamat_pegawai" class="form-label">Alamat Pegawai:</label>
                      <input type="text" class="form-control" id="alamat_pegawai" value="{{ $record->alamat_pegawai }}"
                        name="alamat_pegawai" required>
                    </div>
                    <div class="mb-3">
                      <label for="telp_pegawai" class="form-label">Telepon Pegawai:</label>
                      <input type="text" class="form-control" id="telp_pegawai" value="{{ $record->telp_pegawai }}"
                        name="telp_pegawai" required>
                    </div>
                    <div class="mb-3">
                      <label for="posisi" class="form-label">Posisi:</label>
                      <br>
                      <select class="form-control" id="posisi" name="posisi" required>
                        @if (isset($record->posisi))
                        <option value="{{ $record->posisi }}">{{ $record->posisi }}</option>
                        @else
                        <option value="">Pilih Posisi</option>
                        @endif
                        <option value="Direktur">Direktur</option>
                        <option value="Manajer">Manajer</option>
                        <option value="Admin">Admin</option>
                        <option value="Operasional">Operasional</option>
                        <option value="Keuangan">Keuangan</option>
                        <option value="Fumigator">Fumigator</option>
                        <option value="Staff Lainnya">Staff Lainnya</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="noreg_fumigasi" class="form-label">No. Registrasi Fumigasi:</label>
                      <input type="text" class="form-control" id="noreg_fumigasi" value="{{ $record->noreg_fumigasi }}"
                        name="noreg_fumigasi">
                    </div>
                    <div class="mb-3">
                      <label for="gaji_pokok" class="form-label">Gaji Pokok:</label>
                      <input type="number" class="form-control" id="gaji_pokok" value="{{ $record->gaji_pokok }}"
                        name="gaji_pokok" required>
                    </div>
                    <div class="mb-3">
                      <label for="fax" class="form-label">FAX:</label>
                      <input type="text" class="form-control" id="fax" name="fax" value="{{ $record->fax }}">
                    </div>
                    <div class="mb-3">
                      <label for="usci" class="form-label">USCI:</label>
                      <input type="text" class="form-control" id="usci" name="usci" value="{{ $record->usci }}">
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
                <form method="POST" action="{{ route('pegawai.destroy', $record->id) }}">
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
                  <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6> <!-- EDIT NAMA -->
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Tambah dengan Icon -->
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#addModal">
                      Tambah
                    </button>
                    <!-- Tombol Cetak Tabel dengan Icon -->
                    <a href="{{ route('pegawai.index') }}?export=pdf" class="btn btn-sm btn-warning">
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
                        <th>ID Pegawai</th>
                        <th>Nama Pegawai</th>
                        <th>Alamat Pegawai</th>
                        <th>Telepon Pegawai</th>
                        <th>Posisi</th>
                        <th>No Reg Fumigasi</th>
                        <th>Gaji Pokok</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($records as $record)
                      <tr>
                        <td>{{ $record->id_pegawai }}</td>
                        <td>{{ $record->nama_pegawai }}</td>
                        <td>{{ $record->alamat_pegawai }}</td>
                        <td>{{ $record->telp_pegawai }}</td>
                        <td>{{ $record->posisi }}</td>
                        <td>{{ $record->noreg_fumigasi?? '-' }}</td>
                        <td>{{ number_format($record->gaji_pokok, 2, ',', '.') }}</td>
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