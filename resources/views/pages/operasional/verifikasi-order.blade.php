<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Verifikasi Order</title>

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
          @if (session()->has('success'))
          <div class="row">
            <div class="col d-flex justify-content-center">
              <div class="alert alert-success alert-dismissible fade show" style="min-height: 50px; width:500px;"
                role="alert">
                <div>
                  {{ session('success') }}
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
            <h1 class="h3 mb-0 text-gray-800">Verifikasi Order</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Operasional</a></li>
              <li class="breadcrumb-item active" aria-current="page">Verifikasi Order</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Verifikasi Order</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Verifikasi Order') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="id_verifikasi" class="form-label">ID Verifikasi:</label>
                      <input type="text" class="form-control" id="id_verifikasi" name="id_verifikasi"
                        value="VO00{{ ($id_verif)? $id_verif + 1 : 1 }}" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="id_order" class="form-label">ID Order:</label>
                      {{-- <input type="number" class="form-control" id="id_order" name="id_order" required> --}}
                      <select class="form-control form-select-lg" name="id_order" id="id_order" required>
                        <option selected>Pilih ID Order</option>
                        @foreach ($dataOrder as $item)
                        <option value="{{ $item->id }}">{{ $item->id_detailorder }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="waktu" class="form-label">Waktu:</label>
                      <select class="form-control" id="waktu" name="waktu" required>
                        <option value="">Pilih Waktu</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Tidak Cukup">Tidak Cukup</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tujuan" class="form-label">Tujuan:</label>
                      <select class="form-control" id="tujuan" name="tujuan" required>
                        <option value="">Pilih Tujuan</option>
                        <option value="Export">Export</option>
                        <option value="Import">Import</option>
                      </select>
                    </div>
                    <div>
                      <label for="kondisi_status" class="form-label">Kondisi:</label>
                      <select class="form-control" id="kondisi_status" name="kondisi_status" required>
                        <option value="">Pilih Kondisi</option>
                        <option value="Finish">Finish</option>
                        <option value="Unfinish">Unfinish</option>
                        <option value="Asalan">Asalan</option>
                        <option value="Sudah Diproses">Sudah Diproses</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="packing" class="form-label">Packing:</label>
                      <select class="form-control" id="packing" name="packing" required>
                        <option value="">Pilih Packing</option>
                        <option value="Plastik Wrapping">Plastik Wrapping</option>
                        <option value="Karung Goni">Karung Goni</option>
                        <option value="Single Face">Single Face</option>
                        <option value="Karung Plastik">Karung Plastik</option>
                        <option value="Lainnya">Lainnya</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="place_fumigation" class="form-label">Tempat Fumigasi:</label>
                      <select class="form-control" id="place_fumigation" name="place_fumigation" required>
                        <option value="">Pilih Tempat Fumigasi</option>
                        <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                        <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="kesimpulan" class="form-label">Kesimpulan:</label>
                      <select class="form-control" id="kesimpulan" name="kesimpulan" required>
                        <option value="">Pilih Kesimpulan</option>
                        <option value="Bisa Dilakukan Fumigasi">Bisa Dilakukan Fumigasi</option>
                        <option value="Tidak Bisa Dilakukan Fumigasi">Tidak Bisa Dilakukan Fumigasi</option>
                      </select>
                    </div>
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
        @foreach ($verifikasi as $record)
        <!-- Modal Edit Data -->
        <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Verifikasi Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('Ubah Verifikasi Order', $record->id) }}">
                  @csrf @method('put')
                  <div class="mb-3">
                    <label for="id_verifikasi" class="form-label">ID Verifikasi:</label>
                    <input type="text" class="form-control" id="id_verifikasi" name="id_verifikasi"
                      value="VO00{{ ($id_verif)? $id_verif + 1 : 1 }}" readonly required>
                  </div>
                  <div class="mb-3">
                    <label for="id_order" class="form-label">ID Order:</label>
                    {{-- <input type="number" class="form-control" id="id_order" name="id_order" required> --}}
                    <select class="form-control form-select-lg" name="id_order" id="id_order" required>
                      <option value="{{ $record->id_order }}">{{ $record->detailOrder->id_detailorder }}</option>
                      @foreach ($dataOrder as $item)
                      <option value="{{ $item->id }}">{{ $item->id_detailorder }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu:</label>
                    <select class="form-control" id="waktu" name="waktu" required>
                      <option value="{{ $record->waktu }}">{{ $record->waktu }}</option>
                      <option value="Cukup">Cukup</option>
                      <option value="Tidak Cukup">Tidak Cukup</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="tujuan" class="form-label">Tujuan:</label>
                    <select class="form-control" id="tujuan" name="tujuan" required>
                      <option value="{{ $record->tujuan }}">{{ $record->tujuan }}</option>
                      <option value="Export">Export</option>
                      <option value="Import">Import</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="kondisi_status" class="form-label">Kondisi:</label>
                    <select class="form-control" id="kondisi_status" name="kondisi_status" required>
                      <option value="{{ $record->kondisi_status }}">{{ $record->kondisi_status }}</option>
                      <option value="Finish">Finish</option>
                      <option value="Unfinish">Unfinish</option>
                      <option value="Asalan">Asalan</option>
                      <option value="Sudah Diproses">Sudah Diproses</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="packing" class="form-label">Packing:</label>
                    <select class="form-control" id="packing" name="packing" required>
                      <option value="{{ $record->packing }}">{{ $record->packing }}</option>
                      <option value="Plastik Wrapping">Plastik Wrapping</option>
                      <option value="Karung Goni">Karung Goni</option>
                      <option value="Single Face">Single Face</option>
                      <option value="Karung Plastik">Karung Plastik</option>
                      <option value="Lainnya">Lainnya</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="place_fumigation" class="form-label">Tempat Fumigasi:</label>
                    <select class="form-control" id="place_fumigation" name="place_fumigation" required>
                      <option value="{{ $record->place_fumigation }}">{{ $record->place_fumigation }}</option>
                      <option value="Memenuhi Syarat">Memenuhi Syarat</option>
                      <option value="Tidak Memenuhi Syarat">Tidak Memenuhi Syarat</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="kesimpulan" class="form-label">Kesimpulan:</label>
                    <select class="form-control" id="kesimpulan" name="kesimpulan" required>
                      <option value="{{ $record->kesimpulan }}">{{ $record->kesimpulan }}</option>
                      <option value="Bisa Dilakukan Fumigasi">Bisa Dilakukan Fumigasi</option>
                      <option value="Tidak Bisa Dilakukan Fumigasi">Tidak Bisa Dilakukan Fumigasi</option>
                    </select>
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
              <form method="POST" action="{{ route('Hapus Verifikasi Order', $record->id) }}">
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
                <h6 class="m-0 font-weight-bold text-primary">Verifikasi Order</h6> <!-- EDIT NAMA -->
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
                    <form action="{{ route('Verifikasi Order') }}">
                      <input type="date" class="form-control-sm border-1" id="tanggalMulai"
                        value="{{ request()->tanggalMulai }}" name="tanggalMulai" aria-describedby="tanggalMulaiLabel">
                      <input type="date" class="form-control-sm border-1" id="tanggalAkhir"
                        value="{{ request()->tanggalAkhir }}" name="tanggalAkhir" aria-describedby="tanggalAkhirLabel">
                      <button type="subnit" class="btn btn-secondary btn-sm" style="width: 60px; height: 30px;">
                        Filter
                      </button>
                    </form>
                  </div>
                  <!-- Tombol Cetak Tabel dengan Icon -->
                  <div>
                    <a href="{{ route('Verifikasi Order') }}?export=pdf{{ (request()->tanggalMulai)? '&tanggalMulai='.request()->tanggalMulai : '' }}{{ (request()->tanggalAkhir)? '&tanggalAkhir='.request()->tanggalAkhir : '' }}"
                      class="btn btn-sm btn-warning" style='width: 60px; height: 30px;'>
                      Cetak
                    </a>
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
                      <th>Id Verifikasi</th>
                      <th>Id Order</th>
                      <th>Id Detail Order</th>
                      <th>Tanggal Order</th>
                      <th>Id Customer</th>
                      <th>Nama Customer</th>
                      <th>Alamat Customer</th>
                      <th>Commodity</th>
                      <th>Stuffing Date</th>
                      <th>Closing Time</th>
                      <th>Waktu</th>
                      <th>Tujuan</th>
                      <th>Destination</th>
                      <th>Kondisi Status</th>
                      <th>Packing</th>
                      <th>Tempat Fumigasi</th>
                      <th>Kesimpulan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($verifikasi as $record)
                    <tr>
                      <td>{{ $record->id_verifikasi }}</td>
                      <td>{{ $record->detailOrder->dataOrder->id_order }}</td>
                      <td>{{ $record->detailOrder->id_detailorder }}</td>
                      <td>{{ $record->detailOrder->dataOrder->tanggal_order }}</td>
                      <td>{{ $record->detailOrder->dataOrder->dataCustomer->id_customer }}</td>
                      <td>{{ $record->detailOrder->dataOrder->dataCustomer->nama_customer }}</td>
                      <td>{{ $record->detailOrder->dataOrder->dataCustomer->alamat_customer }}</td>
                      <td>{{ $record->detailOrder->commodity }}</td>
                      <td>{{ $record->detailOrder->stuffing_date }}</td>
                      <td>{{ $record->detailOrder->closing_time }}</td>
                      <td>{{ $record->waktu }}</td>
                      <td>{{ $record->tujuan }}</td>
                      <td>{{ $record->detailOrder->destination }}</td>
                      <td>{{ $record->kondisi_status }}</td>
                      <td>{{ $record->packing }}</td>
                      <td>{{ $record->place_fumigation }}</td>
                      <td>{{ $record->kesimpulan }}</td>
                      <td class="d-flex">
                        <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                          data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                        {{-- <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                          data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button> --}}
                        <a href="{{ route('Verifikasi Order') }}?export=pdf-detail&id={{ $record->id }}"
                          class='btn btn-primary btn-sm' style='width: 30px; height: 30px;' target='_blank'
                          role='button'><i class='fas fa-print'></i></a>
                        <a href="{{ route('Verifikasi Order') }}?verif={{ $record->id_order }}"
                          class='btn btn-info btn-sm' style='width: 30px; height: 30px;'><i
                            class='fas fa-check'></i></a>
                        <a href="{{ route('Verifikasi Order') }}?reject={{ $record->id_order }}"
                          class='btn btn-danger btn-sm' style='width: 30px; height: 30px;'><i
                            class='fas fa-times'></i></a>
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