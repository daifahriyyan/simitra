<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Methyl Recordsheet</title>

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
            <h1 class="h3 mb-0 text-gray-800">Invoice</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Penerimaan Jasa</a></li>
              <li class="breadcrumb-item active" aria-current="page">Invoice</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data Invoice -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Invoice</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Invoice') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="id_invoice" class="form-label">ID Invoice:</label>
                      <input type="text" class="form-control" id="id_invoice" name="id_invoice"
                        value="INV{{ str_pad($id_invoice + 1, 4, 0, STR_PAD_LEFT) }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_invoice" class="form-label">Tanggal Invoice:</label>
                      <input type="date" class="form-control" id="tanggal_invoice" name="tanggal_invoice"
                        value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_order" class="form-label">ID Order:</label>
                      <select class="form-control form-select-lg" name="id_order" id="id_order" required>
                        <option selected>Pilih ID Order</option>
                        @foreach ($dataOrder as $item)
                        <option value="{{ $item->id }}">{{ $item->id_order }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="id_sertif" class="form-label">ID Sertifikat:</label>
                      <select class="form-control form-select-lg" name="id_sertif" id="id_sertif" required>
                        <option selected>Pilih ID Sertifikat</option>
                        @foreach ($dataSertif as $item)
                        <option value="{{ $item->id }}">{{ $item->id_sertif }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="no_bl" class="form-label">No BL:</label>
                      <input type="text" class="form-control" id="no_bl" name="no_bl" required>
                    </div>
                    <div class="mb-3">
                      <label for="shipper" class="form-label">Shipper:</label>
                      <input type="text" class="form-control" id="shipper" name="shipper" required>
                    </div>
                    <div class="mb-3">
                      <label for="termin" class="form-label">Termin:</label>
                      <input type="text" class="form-control" id="termin" name="termin" required>
                    </div>
                    <div class="mb-3">
                      <label for="stuffing_date" class="form-label">Stuffing Date:</label>
                      <input type="date" class="form-control" id="stuffing_date" name="stuffing_date" required>
                    </div>
                    <div class="mb-3">
                      <label for="closing_time" class="form-label">Closing Time:</label>
                      <input type="datetime-local" class="form-control" id="closing_time" name="closing_time" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_recordsheet" class="form-label">ID Recordsheet:</label>
                      <select class="form-control form-select-lg" name="id_recordsheet" id="id_recordsheet" required>
                        <option selected>Pilih ID Recordsheet</option>
                        @foreach ($recordsheet as $item)
                        <option value="{{ $item->id }}">{{ $item->id_recordsheet }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="id_data_standar" class="form-label">ID Data Standar:</label>
                      <select class="form-control form-select-lg" name="id_data_standar" id="id_data_standar" required>
                        <option selected>Pilih ID Data Standar</option>
                        @foreach ($dataHarga as $item)
                        <option value="{{ $item->id }}">{{ $item->id_datastandar }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="ppn" class="form-label">PPN:</label>
                      <input type="number" class="form-control" id="ppn" name="ppn">
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
          @foreach ($invoice as $record)
          <!-- Modal Edit Data Invoice -->
          <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Invoice</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Ubah Invoice', $record->id) }}">
                    @csrf @method('put')
                    <div class="mb-3">
                      <label for="id_invoice" class="form-label">ID Invoice:</label>
                      <input type="text" class="form-control" id="id_invoice" name="id_invoice"
                        value="{{ $record->id_invoice }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_invoice" class="form-label">Tanggal Invoice:</label>
                      <input type="date" class="form-control" id="tanggal_invoice" name="tanggal_invoice"
                        value="{{ $record->tanggal_invoice }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_order" class="form-label">ID Order:</label>
                      <select class="form-control form-select-lg" name="id_order" id="id_order" required>
                        <option value="{{ $record->id_order }}">{{ $record->dataOrder->id_order }}</option>
                        @foreach ($dataOrder as $item)
                        <option value="{{ $item->id }}">{{ $item->id_order }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="id_sertif" class="form-label">ID Sertifikat:</label>
                      <select class="form-control form-select-lg" name="id_sertif" id="id_sertif" required>
                        <option value="{{ $record->id_sertif }}">{{ $record->sertifikat->id_sertif }}</option>
                        @foreach ($dataSertif as $item)
                        <option value="{{ $item->id }}">{{ $item->id_sertif }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="no_bl" class="form-label">No BL:</label>
                      <input type="text" class="form-control" id="no_bl" name="no_bl" value="{{ $record->no_bl }}"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="shipper" class="form-label">Shipper:</label>
                      <input type="text" class="form-control" id="shipper" name="shipper" value="{{ $record->shipper }}"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="stuffing_date" class="form-label">Stuffing Date:</label>
                      <input type="date" class="form-control" id="stuffing_date" name="stuffing_date"
                        value="{{ $record->stuffing_date }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="closing_time" class="form-label">Closing Time:</label>
                      <input type="datetime-local" class="form-control" id="closing_time" name="closing_time"
                        value="{{ $record->closing_time }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_recordsheet" class="form-label">ID Recordsheet:</label>
                      <select class="form-control form-select-lg" name="id_recordsheet" id="id_recordsheet" required>
                        <option value="{{ $record->id_recordsheet }}">{{ $record->methylRecordsheet->id_recordsheet }}
                        </option>
                        @foreach ($recordsheet as $item)
                        <option value="{{ $item->id }}">{{ $item->id_recordsheet }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="id_data_standar" class="form-label">ID Data Standar:</label>
                      <select class="form-control form-select-lg" name="id_data_standar" id="id_data_standar" required>
                        <option value="{{ $record->id_data_standar }}">{{ $record->dataHarga->id_datastandar }}</option>
                        @foreach ($dataHarga as $item)
                        <option value="{{ $item->id }}">{{ $item->id_datastandar }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="ppn" class="form-label">PPN:</label>
                      <input type="number" class="form-control" id="ppn" name="ppn" value="{{ $record->ppn }}">
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
                <form method="POST" action="{{ route('Hapus Invoice', $record->id) }}">
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
                  <h6 class="m-0 font-weight-bold text-primary">Invoice</h6> <!-- EDIT NAMA -->
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Tambah dengan Icon -->
                    <div>
                      <button type="button" class="btn btn-sm btn-info" style='width: 70px; height: 30px;'
                        data-bs-toggle="modal" data-bs-target="#addModal">
                        Tambah
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
                  <table class="table align-items-center table-flush table-hover text-nowrap" id="dataTableHover">
                    <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
                    <thead class="thead-light">
                      <tr>
                        <th>ID Invoice</th>
                        <th>Tanggal Invoice</th>
                        <th>ID Order</th>
                        <th>Nama Customer</th>
                        <th>Alamat Customer</th>
                        <th>ID Sertif</th>
                        <th>No BL</th>
                        <th>Shipper</th>
                        <th>Destination</th>
                        <th>Commodity</th>
                        <th>Stuffing Date</th>
                        <th>Closing Time</th>
                        <th>ID Recordsheet</th>
                        <th>Dossage (g/m³)</th>
                        <th>Treatment</th>
                        <th>Quantity</th>
                        <th>Volume</th>
                        <th>No Kontainer</th>
                        <th>ID Data Standar</th>
                        <th>Harga Jual</th>
                        <th>Total Penjualan</th>
                        <th>PPN</th>
                        <th>Jumlah Dibayar</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($invoice as $record)
                      <tr>
                        <td>{{ $record->id_invoice }}</td>
                        <td>{{ $record->tanggal_invoice }}</td>
                        <td>{{ $record->dataOrder->id_order }}</td>
                        <td>{{ $record->dataOrder->dataCustomer->nama_customer }}</td>
                        <td>{{ $record->dataOrder->dataCustomer->alamat_customer }}</td>
                        <td>{{ $record->sertifikat->id_sertif }}</td>
                        <td>{{ $record->no_bl }}</td>
                        <td>{{ $record->shipper }}</td>
                        <td>{!! $record->detailOrder->destination ?? "<span class='text-danger'>Data Tidak
                            Ditemukan</span>" !!}</td>
                        <td>{!! $record->detailOrder->commodity ?? "<span class='text-danger'>Data Tidak
                            Ditemukan</span>" !!}</td>
                        <td>{{ $record->stuffing_date }}</td>
                        <td>{{ $record->closing_time }}</td>
                        <td>{{ $record->id_recordsheet }}</td>
                        <td>{{ $record->methylRecordsheet->applied_dose_rate }}</td>
                        <td>{{ $record->dataOrder->treatment }}</td>
                        <td>{{ $record->dataOrder->jumlah_order }}</td>
                        <td>{{ $record->dataOrder->volume }}</td>
                        <td>{!! $record->detailOrder->container ?? "<span class='text-danger'>Data Tidak
                            Ditemukan</span>" !!}</td>
                        <td>{{ $record->dataHarga->id_datastandar}}</td>
                        <td>{{ $record->dataHarga->harga_jual }}</td>
                        <td>{{ $record->total_penjualan }}</td>
                        <td>{{ $record->ppn }}</td>
                        <td>{{ $record->jumlah_dibayar }}</td>
                        <td>
                          <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                            data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                          <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                            data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                          <a href='generate_pdf.php?id_invoice=".htmlspecialchars($data[' id_invoice'])."'
                            class='btn btn-primary btn-sm' style='width: 30px; height: 30px;' target='_blank'
                            role='button'><i class='fas fa-print'></i></a>
                          <button type='button' class='btn btn-info btn-sm' style='width: 30px; height: 30px;'
                            onclick='approveData(\"".$data[' id_invoice']."\")'><i class='fas fa-check'></i></button>
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