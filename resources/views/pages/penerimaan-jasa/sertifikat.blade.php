<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Sertifikat</title>

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
            <h1 class="h3 mb-0 text-gray-800">Sertifikat</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Master</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sertifikat</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data sertif</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Sertifikat') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="id_sertif" class="form-label">ID Sertif:</label>
                      <input type="text" class="form-control" id="id_sertif" name="id_sertif"
                        value="MIM/24.0000{{ $sertifikat->count()+1 }}" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="id_reg" class="form-label">ID Reg:</label>
                      <input type="text" class="form-control" id="id_reg" name="id_reg"
                        value="ID-0000{{ $sertifikat->count()+1 }}-MB" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="target" class="form-label">Target :</label>
                      {{-- <input type="number" class="form-control" id="target" name="target" required> --}}
                      <select class="form-control form-select-lg" name="target" id="target">
                        <option selected>Pilih Target Fumigasi</option>
                        <option value="Commodity">Commodity</option>
                        <option value="Packing">Packing</option>
                        <option value="Both Commodity And Packing">Both Commodity And Packing</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="consignment" class="form-label">Consignment:</label>
                      <input type="text" class="form-control" id="consignment" name="consignment" required>
                    </div>
                    <div class="mb-3">
                      <label for="country" class="form-label">Country:</label>
                      <input type="text" class="form-control" id="country" name="country" required>
                    </div>
                    <div class="mb-3">
                      <label for="pol" class="form-label">POL:</label>
                      <input type="text" class="form-control" id="pol" name="pol" value="SEMARANG, INDONESIA" readonly
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="id_order" class="form-label">ID Order:</label>
                      {{-- <input type="number" class="form-control" id="id_order" name="id_order" required> --}}
                      <select class="form-control form-select-lg" name="id_order" id="id_order">
                        <option selected>Pilih ID Order</option>
                        @foreach ($dataOrder as $item)
                        <option value="{{ $item->id }}">{{ $item->id_detailorder }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="attn" class="form-label">ATTN :</label>
                      <input type="text" class="form-control" id="attn" name="attn" required>
                    </div>
                    <div class="mb-3">
                      <label for="tin" class="form-label">TIN :</label>
                      <input type="number" class="form-control" id="tin" name="tin" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_importer" class="form-label">ID Importer:</label>
                      {{-- <input type="number" class="form-control" id="id_importer" name="id_importer" required> --}}
                      <select class="form-control form-select-lg" name="id_importer" id="id_importer">
                        <option selected>Pilih ID Importer</option>
                        @foreach ($dataImporter as $item)
                        <option value="{{ $item->id }}">{{ $item->id_importer }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="id_recordsheet" class="form-label">ID Recordsheet:</label>
                      {{-- <input type="number" class="form-control" id="id_recordsheet" name="id_recordsheet" required>
                      --}}
                      <select class="form-control form-select-lg" name="id_recordsheet" id="id_recordsheet">
                        <option selected>Pilih ID Recordsheet</option>
                        @foreach ($metilRecordsheet as $item)
                        <option value="{{ $item->id }}">{{ $item->id_recordsheet }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="wrapping" class="form-label">Wrapping :</label>
                      <select class="form-control" id="wrapping" name="wrapping" required>
                        <option value="">Pilih Status Wrapping</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_sertif" class="form-label">Tanggal Sertifikat:</label>
                      <input type="date" class="form-control" id="tanggal_sertif" name="tanggal_sertif" required>
                    </div>
                    <div class="mb-3">
                      <label for="no_reg" class="form-label">Nomor Registrasi:</label>
                      <input type="text" class="form-control" id="no_reg" name="no_reg" required>
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
          @foreach ($sertifikat as $record)
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
                  <form method="POST" action="{{ route('Ubah Sertifikat', $record->id) }}">
                    @csrf @method('put')
                    <div class="mb-3">
                      <label for="id_sertif" class="form-label">ID Sertif:</label>
                      <input type="text" class="form-control" id="id_sertif" name="id_sertif"
                        value="{{ $record->id_sertif }}" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="id_reg" class="form-label">ID Reg:</label>
                      <input type="text" class="form-control" id="id_reg" name="id_reg" value="{{ $record->id_reg }}"
                        readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="target" class="form-label">Target :</label>
                      {{-- <input type="number" class="form-control" id="target" name="target" required> --}}
                      <select class="form-control form-select-lg" name="target" id="target">
                        <option value="{{ $record->target }}">{{ $record->target }}</option>
                        <option value="Commodity">Commodity</option>
                        <option value="Packing">Packing</option>
                        <option value="Both Commodity And Packing">Both Commodity And Packing</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="consignment" class="form-label">Consignment:</label>
                      <input type="text" class="form-control" id="consignment" name="consignment"
                        value="{{ $record->consignment }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="country" class="form-label">Country:</label>
                      <input type="text" class="form-control" id="country" name="country" value="{{ $record->country }}"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="pol" class="form-label">POL:</label>
                      <input type="text" class="form-control" id="pol" name="pol" value="SEMARANG, INDONESIA" readonly
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="id_order" class="form-label">ID Order:</label>
                      {{-- <input type="number" class="form-control" id="id_order" name="id_order" required> --}}
                      <select class="form-control form-select-lg" name="id_order" id="id_order">
                        <option value="{{ $record->id_order }}">{{ $record->detailOrder->id_detailorder }}</option>
                        @foreach ($dataOrder as $item)
                        <option value="{{ $item->id }}">{{ $item->id_detailorder }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="attn" class="form-label">ATTN :</label>
                      <input type="text" class="form-control" id="attn" name="attn" value="{{ $record->attn }}"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="tin" class="form-label">TIN :</label>
                      <input type="number" class="form-control" id="tin" name="tin" value="{{ $record->tin }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_importer" class="form-label">ID Importer:</label>
                      {{-- <input type="number" class="form-control" id="id_importer" name="id_importer" required> --}}
                      <select class="form-control form-select-lg" name="id_importer" id="id_importer">
                        <option value="{{ $record->id_importer }}">{{ $record->dataImporter->id_importer }}</option>
                        @foreach ($dataImporter as $item)
                        <option value="{{ $item->id }}">{{ $item->id_importer }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="id_recordsheet" class="form-label">ID Recordsheet:</label>
                      {{-- <input type="number" class="form-control" id="id_recordsheet" name="id_recordsheet" required>
                      --}}
                      <select class="form-control form-select-lg" name="id_recordsheet" id="id_recordsheet">
                        <option value="{{ $record->id_recordsheet }}">{{ $record->dataRecordsheet->id_recordsheet }}
                        </option>
                        @foreach ($metilRecordsheet as $item)
                        <option value="{{ $item->id }}">{{ $item->id_recordsheet }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="wrapping" class="form-label">Wrapping :</label>
                      <select class="form-control" id="wrapping" name="wrapping" required>
                        <option value="{{ $record->wrapping }}">{{ $record->wrapping }}</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_sertif" class="form-label">Tanggal Sertifikat:</label>
                      <input type="date" class="form-control" id="tanggal_sertif" name="tanggal_sertif"
                        value="{{ $record->tanggal_sertif }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="no_reg" class="form-label">Nomor Registrasi:</label>
                      <input type="text" class="form-control" id="no_reg" name="no_reg" value="{{ $record->no_reg }}"
                        required>
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
          <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Delete -->
          <div class="modal fade" id="deleteRecord{{ $record->id }}" tabindex="-1" aria-labelledby="deleteRecordLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <form method="POST" action="{{ route('Hapus Sertifikat', $record->id) }}">
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

          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Sertifikat</h6> <!-- EDIT NAMA -->
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Tambah dengan Icon -->
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#addModal">
                      Tambah
                    </button>
                    <!-- Tombol Filter Tanggal dengan Icon -->
                    <div class="input-group">
                      <form action="{{ route('Sertifikat') }}">
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
                    <a href="{{ route('Sertifikat') }}?export=pdf{{ (request()->tanggalMulai)? '&tanggalMulai='.request()->tanggalMulai : '' }}{{ (request()->tanggalAkhir)? '&tanggalAkhir='.request()->tanggalAkhir : '' }}"
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
                  <table class="table align-items-center table-flush table-hover text-nowrap" id="dataTableHover">
                    <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
                    <thead class="thead-light">
                      <tr>
                        <th>Id Sertifikat</th>
                        <th>Id Reg</th>
                        <th>Target of Fumigation</th>
                        <th>Commodity</th>
                        <th>Consignment</th>
                        <th>Country</th>
                        <th>Port of Loading</th>
                        <th>Destination</th>
                        <th>Id Order</th>
                        <th>Id Detail Order</th>
                        <th>Nama Customer</th>
                        <th>Telp Customer</th>
                        <th>ATTN</th>
                        <th>TIN</th>
                        <th>Id Importer</th>
                        <th>Nama Importer</th>
                        <th>Alamat Importer</th>
                        <th>Telp Importer</th>
                        <th>Fax Importer</th>
                        <th>USCI Importer</th>
                        <th>PIC Importer</th>
                        <th>Id Recordsheet</th>
                        <th>Tanggal Selesai</th>
                        <th>Daff Prescribed Doses Rate</th>
                        <th>Forecast Minimum Temperature</th>
                        <th>Exposure Period</th>
                        <th>Applied Dose Rate</th>
                        <th>Fumigation Conducted</th>
                        <th>Container</th>
                        <th>Wrapping</th>
                        <th>Tanggal Sertif</th>
                        <th>No Reg</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sertifikat as $record)
                      <tr>
                        <td>{{ $record->id_sertif }}</td>
                        <td>{{ $record->id_reg }}</td>
                        <td>{{ $record->target }}</td>
                        <td>{{ $record->detailOrder->commodity }}</td>
                        <td>{{ $record->consignment }}</td>
                        <td>{{ $record->country }}</td>
                        <td>{{ $record->pol }}</td>
                        <td>{{ $record->detailOrder->destination }}</td>
                        <td>{{ $record->detailOrder->dataOrder->id_order }}</td>
                        <td>{{ $record->detailOrder->id_detailorder }}</td>
                        <td>{{ $record->detailOrder->dataOrder->dataCustomer->nama_customer }}</td>
                        <td>{{ $record->detailOrder->dataOrder->dataCustomer->telepon_customer }}</td>
                        <td>{{ $record->attn }}</td>
                        <td>{{ $record->tin }}</td>
                        <td>{{ $record->dataImporter->id_importer }}</td>
                        <td>{{ $record->dataImporter->nama_importer }}</td>
                        <td>{{ $record->dataImporter->alamat_importer }}</td>
                        <td>{{ $record->dataImporter->telp_importer }}</td>
                        <td>{{ $record->dataImporter->fax }}</td>
                        <td>{{ $record->dataImporter->usci }}</td>
                        <td>{{ $record->dataImporter->pic }}</td>
                        <td>{{ $record->dataRecordsheet->id_recordsheet }}</td>
                        <td>{{ $record->dataRecordsheet->tanggal_selesai }}</td>
                        <td>{{ $record->dataRecordsheet->daff_prescribed_doses_rate }}</td>
                        <td>{{ $record->dataRecordsheet->forecast_minimum_temperature }}</td>
                        <td>{{ $record->dataRecordsheet->exposure_period }}</td>
                        <td>{{ $record->dataRecordsheet->applied_dose_rate }}</td>
                        <td>{{ $record->dataRecordsheet->dokumen_metil_recordsheet }}</td>
                        <td>{{ $record->detailOrder->container }}</td>
                        <td>{{ $record->wrapping }}</td>
                        <td>{{ $record->tanggal_sertif }}</td>
                        <td>{{ $record->no_reg }}</td>
                        <td>
                          <?php
                    if($item->detailOrder->verifikasi <= 3){ 
                      echo '<span class="badge-pill badge-info">Process' ; 
                    }else if($item->detailOrder->verifikasi >= 4){
                      echo '<span class="badge-pill badge-success">Finish';
                    }
                    ?>
                        </td>
                        <td>
                          <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                            data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                          <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                            data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                          <a href='generate_pdf.php?id_order_container=" . htmlspecialchars($data['
                            id_order_container']) . "' class='btn btn-primary btn-sm' target='_blank' role='button'><i class='fas fa-print'></i></a>
                    <a href=" {{ route('Sertifikat') }}?verif={{ $record->id_order }}"
                            class='btn btn-info btn-sm' style='width: 30px; height: 30px;'><i
                              class='fas fa-check'></i></a>
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
      <footer>
        <p id="tanggalJam"
          style="font-size: 12px; margin: 0; justify-content: flex-end; display: flex; background-color: #f8f9fa;">
        </p>
      </footer>
    </div>
  </div>
  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js">
  </script>
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