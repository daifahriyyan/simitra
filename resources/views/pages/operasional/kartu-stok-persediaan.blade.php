<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Kartu Persediaan</title>

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

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <!-- Your container content -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kartu Persediaan</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Operasional</a></li>
              <li class="breadcrumb-item active" aria-current="page">Kartu Persediaan</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Kartu Persediaan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Kartu Stok Persediaan') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="id_kartu_persediaan" class="form-label">ID Kartu Persediaan:</label>
                      <input type="text" class="form-control" id="id_kartu_persediaan" name="id_kartu_persediaan"
                        value="KP{{ str_pad($id_KP + 1, 4, 0, STR_PAD_LEFT) }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_persediaan" class="form-label">ID Persediaan:</label>
                      <select class="form-control form-select-lg" name="id_persediaan" id="id_persediaan" required>
                        <option selected>Pilih ID Persediaan</option>
                        @foreach ($dataPersediaan as $item)
                        <option value="{{ $item->id }}">{{ $item->id_persediaan }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="harga_keluar" class="form-label">Harga Keluar:</label>
                      <input type="number" class="form-control" id="harga_keluar" name="harga_keluar">
                    </div>
                    <div class="mb-3">
                      <label for="jumlah_keluar" class="form-label">Jumlah Keluar:</label>
                      <input type="number" class="form-control" id="jumlah_keluar" name="jumlah_keluar">
                    </div>
                    <div class="mb-3">
                      <label for="harga_saldo" class="form-label">Harga Saldo:</label>
                      <input type="number" class="form-control" id="harga_saldo" name="harga_saldo">
                    </div>
                    <div class="mb-3">
                      <label for="jumlah_saldo" class="form-label">Jumlah Saldo:</label>
                      <input type="number" class="form-control" id="jumlah_saldo" name="jumlah_saldo">
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
          @foreach ($kartuPersediaan as $record)
          <!-- Modal Edit Data -->
          <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Kartu Persediaan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Ubah Kartu Stok Persediaan', $record->id) }}">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                      <label for="id_kartu_persediaan" class="form-label">ID Kartu Persediaan:</label>
                      <input type="text" class="form-control" id="id_kartu_persediaan" name="id_kartu_persediaan"
                        value="{{ $record->id_kartu_persediaan }}" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="id_persediaan" class="form-label">ID Persediaan:</label>
                      <select class="form-control form-select-lg" name="id_persediaan" id="id_persediaan" required>
                        <option value="{{ $record->id_persediaan }}">{{ $record->dataPersediaan->id_persediaan }}
                        </option>
                        @foreach ($dataPersediaan as $item)
                        <option value="{{ $item->id }}">{{ $item->id_persediaan }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="nama_persediaan" class="form-label">Nama Persediaan:</label>
                      <input type="text" class="form-control" id="nama_persediaan" name="nama_persediaan"
                        value="{{ $record->dataPersediaan->nama_persediaan }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_input" class="form-label">Tanggal Input:</label>
                      <input type="datetime-local" class="form-control" id="tanggal_input" name="tanggal_input"
                        value="{{ $record->tanggal_input }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="harga_masuk" class="form-label">Harga Masuk:</label>
                      <input type="number" class="form-control" id="harga_masuk" name="harga_masuk"
                        value="{{ $record->harga_masuk }}">
                    </div>
                    <div class="mb-3">
                      <label for="jumlah_masuk" class="form-label">Jumlah Masuk:</label>
                      <input type="number" class="form-control" id="jumlah_masuk" name="jumlah_masuk"
                        value="{{ $record->jumlah_masuk }}">
                    </div>
                    <div class="mb-3">
                      <label for="harga_keluar" class="form-label">Harga Keluar:</label>
                      <input type="number" class="form-control" id="harga_keluar" name="harga_keluar"
                        value="{{ $record->harga_keluar }}">
                    </div>
                    <div class="mb-3">
                      <label for="jumlah_keluar" class="form-label">Jumlah Keluar:</label>
                      <input type="number" class="form-control" id="jumlah_keluar" name="jumlah_keluar"
                        value="{{ $record->jumlah_keluar }}">
                    </div>
                    <div class="mb-3">
                      <label for="harga_saldo" class="form-label">Harga Saldo:</label>
                      <input type="number" class="form-control" id="harga_saldo" name="harga_saldo"
                        value="{{ $record->harga_saldo }}">
                    </div>
                    <div class="mb-3">
                      <label for="jumlah_saldo" class="form-label">Jumlah Saldo:</label>
                      <input type="number" class="form-control" id="jumlah_saldo" name="jumlah_saldo"
                        value="{{ $record->jumlah_saldo }}">
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
          <!-- Modal Delete -->
          <div class="modal fade" id="deleteRecord{{ $record->id }}" tabindex="-1" aria-labelledby="deleteRecordLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <form method="POST" action="{{ route('Hapus Kartu Stok Persediaan', $record->id) }}">
                  @method('delete')@csrf
                  <div class="modal-body">
                    Apakah Anda sudah yakin ingin menghapus Data ini?
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
          <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Kartu Persediaan</h6> <!-- EDIT NAMA -->
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Tambah dengan Icon -->
                    <div>
                      <button type="button" class="btn btn-sm btn-info" style='width: 70px; height: 30px;'
                        data-bs-toggle="modal" data-bs-target="#addModal">
                        Pakai
                      </button>
                    </div>
                    <!-- Tombol Filter Tanggal dengan Icon -->
                    <div class="input-group">
                      <input type="date" class="form-control-sm border-1" id="tanggalMulai"
                        aria-describedby="tanggalMulaiLabel">
                      <input type="date" class="form-control-sm border-1" id="tanggalAkhir"
                        aria-describedby="tanggalAkhirLabel">
                      <button type="button" class="btn btn-secondary btn-sm" style='width: 60px; height: 30px;'
                        onclick="filterTanggal()">
                        Filter
                      </button>
                    </div>
                    <!-- Tombol Cetak Tabel dengan Icon -->
                    <div>
                      <button type="button" class="btn btn-sm btn-warning" style='width: 60px; height: 30px;'
                        onclick="cetakTabel()">
                        Cetak
                      </button>
                    </div>
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
                        <th>ID Kartu Persediaan</th>
                        <th>ID Persediaan</th>
                        <th>Nama Persediaan</th>
                        <th>Tanggal Input</th>
                        <th>Harga Masuk</th>
                        <th>Jumlah Masuk</th>
                        <th>Total Masuk</th>
                        <th>Harga Keluar</th>
                        <th>Jumlah Keluar</th>
                        <th>Total Keluar</th>
                        <th>Harga Saldo</th>
                        <th>Jumlah Saldo</th>
                        <th>Total Saldo</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($kartuPersediaan as $record)
                      <tr>
                        <td>{{ $record->id_kartu_persediaan }}</td>
                        <td>{{ $record->dataPersediaan->id_persediaan }}</td>
                        <td>{{ $record->dataPersediaan->nama_persediaan }}</td>
                        <td>{{ $record->updated_at }}</td>
                        <td>{{ $record->harga_masuk }}</td>
                        <td>{{ $record->jumlah_masuk }}</td>
                        <td>{{ $record->total_masuk }}</td>
                        <td>{{ $record->harga_keluar }}</td>
                        <td>{{ $record->jumlah_keluar }}</td>
                        <td>{{ $record->total_keluar }}</td>
                        <td>{{ $record->harga_saldo }}</td>
                        <td>{{ $record->jumlah_saldo }}</td>
                        <td>{{ $record->total_saldo }}</td>
                        <td class="d-flex">
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
          style="font-size: 12px; margin: 0; justify-content: flex-end; display: flex; background-color: #f8f9fa;"></p>
      </footer>
      <!-- Footer -->
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