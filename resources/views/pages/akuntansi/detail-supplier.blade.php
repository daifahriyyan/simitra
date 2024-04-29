<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Supplier</title> <!-- EDIT NAMA -->

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
            <h1 class="h3 mb-0 text-gray-800">Detail Supplier</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Akuntansi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Detail Supplier</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Detail Supplier</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Detail Supplier') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="id_detail_supplier" class="form-label">ID Detail Supplier:</label>
                      <input type="text" class="form-control" id="id_detail_supplier" name="id_detail_supplier"
                        value="DS00{{ $detailSupplier->count() + 1 }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_supplier" class="form-label">ID Supplier:</label>
                      <select class="custom-select form-select-lg mb-3" aria-label="Large select example"
                        id="id_supplier" name="id_supplier">
                        <option selected>Pilih ID Supplier</option>
                        @foreach ($keuSupplier as $item)
                        <option value="{{ $item->id }}">{{ $item->id_supplier }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="termin_pembayaran" class="form-label">Termin Pembayaran:</label>
                      <input type="text" class="form-control" id="termin_pembayaran" name="termin_pembayaran" required>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_input" class="form-label">Tanggal Input:</label>
                      <input type="date" class="form-control" id="tanggal_input" name="tanggal_input" required>
                    </div>
                    <div class="mb-3">
                      <label for="pembelian" class="form-label">Pembelian:</label>
                      <input type="number" class="form-control" id="pembelian" name="pembelian">
                    </div>
                    <div class="mb-3">
                      <label for="pembayaran" class="form-label">Pembayaran:</label>
                      <input type="number" class="form-control" id="pembayaran" name="pembayaran">
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
          @foreach ($detailSupplier as $record)
          <!-- Modal Edit Data -->
          <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Detail Supplier</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Ubah Detail Supplier', $record->id) }}">
                    @method('put')@csrf
                    <div class="mb-3">
                      <label for="id_detail_supplier" class="form-label">ID Detail Supplier:</label>
                      <input type="text" class="form-control" id="id_detail_supplier" name="id_detail_supplier"
                        value="{{ $record->id_detail_supplier }}" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="id_supplier" class="form-label">ID Supplier:</label>
                      <select class="custom-select form-select-lg mb-3" aria-label="Large select example"
                        id="id_supplier" name="id_supplier">
                        <option value="{{ $record->id_supplier }}">{{ $record->supplier->id_supplier }}
                        </option>
                        @foreach ($keuSupplier as $item)
                        <option value="{{ $item->id }}">{{ $item->id_supplier }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="termin_pembayaran" class="form-label">Termin Pembayaran:</label>
                      <input type="text" class="form-control" id="termin_pembayaran" name="termin_pembayaran"
                        value="{{ $record->termin_pembayaran }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_input" class="form-label">Tanggal Input:</label>
                      <input type="date" class="form-control" id="tanggal_input" name="tanggal_input"
                        value="{{ $record->tanggal_input }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="pembelian" class="form-label">Pembelian:</label>
                      <input type="number" class="form-control" id="pembelian" name="pembelian"
                        value="{{ $record->pembelian }}">
                    </div>
                    <div class="mb-3">
                      <label for="pembayaran" class="form-label">Pembayaran:</label>
                      <input type="number" class="form-control" id="pembayaran" name="pembayaran"
                        value="{{ $record->pembayaran }}">
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
                <form method="POST" action="{{ route('Hapus Detail Supplier', $record->id) }}">
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
          <!-- Modal Konfirmasi Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  Apakah Anda Yakin Ingin Keluar dari Sistem?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>
          <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Detail Supplier</h6> <!-- EDIT NAMA -->
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Tambah dengan Icon -->
                    <div>
                      <button type="button" class="btn btn-sm btn-info" style='width: 70px; height: 30px;'
                        data-bs-toggle="modal" data-bs-target="#addModal">
                        Tambah
                      </button>
                    </div>
                    <!-- Tombol Filter Id Supplier dan Tanggal dengan Icon -->
                    {{-- <div class="input-group">
                      <label for="id_supplier" class="mb-0 mr-2">Id Supplier:</label>
                      <select class="form-control-sm border-1" style="width: 100px; height: 30px;" id="id_supplier"
                        onchange="filterData()">
                        <option value="">Supplier</option>
                        <?php echo $id_supplier_options; ?>
                      </select>
                      <input type="date" class="form-control-sm border-1" id="tanggalMulai"
                        aria-describedby="tanggalMulaiLabel">
                      <input type="date" class="form-control-sm border-1" id="tanggalAkhir"
                        aria-describedby="tanggalAkhirLabel">
                      <button type="button" class="btn btn-secondary btn-sm" style="width: 60px; height: 30px;"
                        onclick="filterData()">
                        Filter
                      </button>
                    </div> --}}
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
                        <th>ID Detail Supplier</th>
                        <th>ID Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Termin Pembayaran</th>
                        <th>Tanggal Input</th>
                        <th>Pembelian</th>
                        <th>Pembayaran</th>
                        <th>Saldo Akhir Supplier</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($detailSupplier as $record)
                      <tr>
                        <td>{{ $record->id_detail_supplier}}</td>
                        <td>{{ $record->supplier->id_supplier}}</td>
                        <td>{{ $record->supplier->nama_supplier}}</td>
                        <td>{{ $record->termin_pembayaran}}</td>
                        <td>{{ $record->tanggal_input}}</td>
                        <td>{{ number_format($record->pembelian, 2, ',', '.')}}</td>
                        <td>{{ number_format($record->pembayaran, 2, ',', '.')}}</td>
                        <td>{{ number_format($record->saldo_akhir_supplier, 2, ',', '.')}}</td>
                        <td><span class='badge badge-danger'>Jatuh Tempo</span></td>
                        <td>
                          <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                            data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                          <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                            data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                          <a href='generate_pdf.php?id_detail_supplier=" . htmlspecialchars($data['
                            id_detail_supplier']) . "' class='btn btn-primary btn-sm' style='width: 30px; height: 30px;' target='_blank' role='button'><i class='fas fa-print'></i></a>
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
    </div>
  </div>

  <!-- Footer -->
    <footer>
      <p id=" tanggalJam" style="font-size: 12px; margin: 0; justify-content: flex-end; display: flex; background-color: #f8f9fa;">
                            </p>
                            </footer>

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
                            </script>

                            <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                            <script
                              src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js">
                            </script>
                            <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
                            <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
                            <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
                            <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
                            <script src="{{ asset('js/simitra.min.js') }}"></script>
                            <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
                            <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
                            <!-- Page level plugins -->
                            <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
                            <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
                            <!-- Page level custom scripts -->
                            <script>
                              $(document).ready(function () {
      $('#dataTableHover').DataTable();
    });
                            </script>
                            <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->

</body>

</html>