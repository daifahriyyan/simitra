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
            <h1 class="h3 mb-0 text-gray-800">Methyl Recordsheet</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Operasional</a></li>
              <li class="breadcrumb-item active" aria-current="page">Methyl Recordsheet</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Metil Recordsheet</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Methyl Recordsheet') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="id_recordsheet" class="form-label">ID Recordsheet:</label>
                      <input type="text" class="form-control" id="id_recordsheet" name="id_recordsheet"
                        value="R00{{ $dataRecordsheet->count() + 1 }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_order" class="form-label">ID Order:</label>
                      <select class="form-control form-select-lg" name="id_order" id="id_order" required>
                        <option selected>Pilih ID Order</option>
                        @foreach ($dataOrder as $item)
                        <option value="{{ $item->id }}">{{ $item->id_detailorder }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_selesai" class="form-label">Tanggal Selesai:</label>
                      <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                    </div>
                    <div class="mb-3">
                      <label for="daff_prescribed_doses_rate" class="form-label">DAFF Prescribed Doses Rate
                        (g/m³):</label>
                      <input type="number" class="form-control" id="daff_prescribed_doses_rate"
                        name="daff_prescribed_doses_rate" required>
                    </div>
                    <div class="mb-3">
                      <label for="forecast_minimum_temperature" class="form-label">Forecast Minimum Temperature
                        (hours):</label>
                      <input type="number" class="form-control" id="forecast_minimum_temperature"
                        name="forecast_minimum_temperature" required>
                    </div>
                    <div class="mb-3">
                      <label for="exposure_period" class="form-label">Exposure Period (°c):</label>
                      <input type="number" class="form-control" id="exposure_period" name="exposure_period" required>
                    </div>
                    <div class="mb-3">
                      <label for="applied_dose_rate" class="form-label">Applied Dose Rate (g/m³):</label>
                      <input type="number" class="form-control" id="applied_dose_rate" name="applied_dose_rate"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="dokumen_metil_recordsheet" class="form-label">Upload File Metil Recordsheet:</label>
                      <input type="file" class="form-control" id="dokumen_metil_recordsheet"
                        name="dokumen_metil_recordsheet"
                        onchange="displayFileName(this, 'dokumen_metil_recordsheet_filename')" required>
                      <span id="dokumen_metil_recordsheet_filename"></span>
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
          @foreach ($dataRecordsheet as $record)
          <!-- Modal Edit Data -->
          <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Metil Recordsheet</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Ubah Methyl Recordsheet', $record->id) }}"
                    enctype="multipart/form-data">
                    @method('put')@csrf
                    <div class="mb-3">
                      <label for="id_recordsheet" class="form-label">ID Recordsheet:</label>
                      <input type="text" class="form-control" id="id_recordsheet" name="id_recordsheet"
                        value="{{ $record->id_recordsheet }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_order" class="form-label">ID Order:</label>
                      <select class="form-control form-select-lg" name="id_order" id="id_order" required>
                        <option value="{{ $record->id_order }}">{{ $record->dataOrder->id_order }}</option>
                        @foreach ($dataOrder as $item)
                        <option value="{{ $item->id }}">{{ $item->id_detailorder }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_selesai" class="form-label">Tanggal Selesai:</label>
                      <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required
                        value="{{ $record->tanggal_selesai }}">
                    </div>
                    <div class="mb-3">
                      <label for="daff_prescribed_doses_rate" class="form-label">DAFF Prescribed Doses Rate
                        (g/m³):</label>
                      <input type="number" class="form-control" id="daff_prescribed_doses_rate"
                        name="daff_prescribed_doses_rate" value="{{ $record->daff_prescribed_doses_rate }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="forecast_minimum_temperature" class="form-label">Forecast Minimum Temperature
                        (hours):</label>
                      <input type="number" class="form-control" id="forecast_minimum_temperature"
                        name="forecast_minimum_temperature" value="{{ $record->forecast_minimum_temperature }}"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="exposure_period" class="form-label">Exposure Period (°c):</label>
                      <input type="number" class="form-control" id="exposure_period" name="exposure_period"
                        value="{{ $record->exposure_period }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="applied_dose_rate" class="form-label">Applied Dose Rate (g/m³):</label>
                      <input type="number" class="form-control" id="applied_dose_rate" name="applied_dose_rate"
                        value="{{ $record->applied_dose_rate }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="dokumen_metil_recordsheet" class="form-label">Upload File Metil Recordsheet:</label>
                      <input type="file" class="form-control" id="dokumen_metil_recordsheet"
                        name="dokumen_metil_recordsheet" value="{{ $record->dokumen_metil_recordsheet }}">
                      <span>{{ $record->dokumen_metil_recordsheet }}</span>
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
                <form method="POST" action="{{ route('Hapus Methyl Recordsheet', $record->id) }}">
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
                  <h6 class="m-0 font-weight-bold text-primary">Methyl Recordsheet</h6> <!-- EDIT NAMA -->
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Download dengan Icon -->
                    <div>
                      <a href="{{ asset('assets/file/DOWNLOAD METHYL RECORDSHEET.pdf') }}"
                        class="btn btn-sm btn-success" style='width: 90px; height: 30px;' target="_blank">
                        Download
                      </a>
                    </div>
                    <!-- Tombol Tambah dengan Icon -->
                    <div>
                      <button type="button" class="btn btn-sm btn-info" style='width: 70px; height: 30px;'
                        data-bs-toggle="modal" data-bs-target="#addModal">
                        Tambah
                      </button>
                    </div>
                    <!-- Tombol Filter Tanggal dengan Icon -->
                    <div class="input-group">
                      <form action="{{ route('Methyl Recordsheet') }}">
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
                    <div>
                      <a href="{{ route('Methyl Recordsheet') }}?export=pdf{{ (request()->tanggalMulai)? '&tanggalMulai='.request()->tanggalMulai : '' }}{{ (request()->tanggalAkhir)? '&tanggalAkhir='.request()->tanggalAkhir : '' }}"
                        class="btn btn-sm btn-warning" style='width: 60px; height: 30px;'>
                        Cetak
                      </a>
                    </div>
                  </div>

                  <!-- Skrip JavaScript untuk Filter Tanggal dan Cetak Tabel -->
                  <script>
                    function downloadPDF() {
                        // Mengirim permintaan AJAX ke server untuk menghasilkan file PDF
                        var xhr = new XMLHttpRequest();
                        xhr.open("GET", "generate_pdf.php", true);
                        xhr.responseType = "blob";

                        xhr.onload = function () {
                            if (xhr.status === 200) {
                                // Membuat tautan untuk mengunduh file PDF
                                var blob = new Blob([xhr.response], { type: "application/pdf" });
                                var link = document.createElement("a");
                                link.href = window.URL.createObjectURL(blob);
                                link.download = "dokumen.pdf";
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                            }
                        };

                        xhr.send();
                    }

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
                  <table class="table align-items-center table-flush table-hover nowrap" id="dataTableHover">
                    <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
                    <thead class="thead-light">
                      <tr>
                        <th>ID Recordsheet</th>
                        <th>ID Order</th>
                        <th>ID Order Container</th>
                        <th>Tanggal Selesai</th>
                        <th>DAFF Prescribed Doses Rate (g/m³)</th>
                        <th>Forecast Minimum Temperature (hours)</th>
                        <th>Exposure Period (°c)</th>
                        <th>Applied Dose Rate (g/m³)</th>
                        <th>Berkas Metil Recordsheet</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($dataRecordsheet as $record)
                      <tr>
                        <td>{{ $record->id_recordsheet }}</td>
                        <td>{{ $record->detailOrder->dataOrder->id_order }}</td>
                        <td>{{ $record->detailOrder->id_detailorder }}</td>
                        <td>{{ $record->tanggal_selesai }}</td>
                        <td>{{ $record->daff_prescribed_doses_rate }}</td>
                        <td>{{ $record->forecast_minimum_temperature }}</td>
                        <td>{{ $record->exposure_period }}</td>
                        <td>{{ $record->applied_dose_rate }}</td>
                        <td>
                          <a href='{{ asset("storage/metil_recordsheet/$record->dokumen_metil_recordsheet") }}'
                            target="_blank">{{ $record->dokumen_metil_recordsheet }}</a>
                        </td>
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