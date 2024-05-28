<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Penyusutan Aset Tetap</title> <!-- EDIT NAMA -->

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
            <h1 class="h3 mb-0 text-gray-800">Penyusutan Aset Tetap</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Akuntansi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Penyusutan Aset Tetap</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Penyusutan Aset Tetap</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Penyusutan Aset Tetap') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="kode_penyusutan_at" class="form-label">Kode Penyusutan Aset Tetap:</label>
                      <input type="text" class="form-control" id="kode_penyusutan_at" name="kode_penyusutan_at"
                        value="PAT{{ str_pad($id_PAT, 6, 0, STR_PAD_LEFT) }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="kode_at" class="form-label">Kode Aset Tetap:</label>
                      <select class="custom-select form-select-lg mb-3" aria-label="Large select example" id="kode_at"
                        name="kode_at">
                        <option selected>Pilih Kode Aset Tetap</option>
                        @foreach ($asetTetap as $item)
                        <option value="{{ $item->id }}">{{ $item->kode_at }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_penyusutan" class="form-label">Tanggal Penyusutan:</label>
                      <input type="date" class="form-control" id="tanggal_penyusutan" name="tanggal_penyusutan"
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
          @foreach ($penyusutanAt as $record)
          <!-- Modal Edit Data -->
          <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Aset Tetap</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Ubah Penyusutan Aset Tetap', $record->id) }}">
                    @method('put')@csrf
                    <div class="mb-3">
                      <label for="kode_penyusutan_at" class="form-label">Kode Penyusutan Aset Tetap:</label>
                      <input type="text" class="form-control" id="kode_penyusutan_at" name="kode_penyusutan_at"
                        value="{{ $record->kode_penyusutan_at }}" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="kode_at" class="form-label">Kode Aset Tetap:</label>
                      <select class="custom-select form-select-lg mb-3" aria-label="Large select example" id="kode_at"
                        name="kode_at">
                        <option value="{{ $record->asetTetap->id }}">{{ $record->asetTetap->kode_at }}
                          @foreach ($asetTetap as $item)
                        <option value="{{ $item->id }}">{{ $item->kode_at }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_penyusutan" class="form-label">Tanggal Penyusutan:</label>
                      <input type="date" class="form-control" id="tanggal_penyusutan" name="tanggal_penyusutan"
                        value="{{ $record->tanggal_penyusutan }}" required>
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
                <form method="POST" action="{{ route('Hapus Penyusutan Aset Tetap', $record->id) }}">
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
                  <h6 class="m-0 font-weight-bold text-primary">Penyusutan Aset Tetap</h6> <!-- EDIT NAMA -->
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
                      <form action="{{ route('Penyusutan Aset Tetap') }}">
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
                      <a href="{{ route('Penyusutan Aset Tetap') }}?export=pdf{{ (request()->tanggalMulai)? '&tanggalMulai='.request()->tanggalMulai : '' }}{{ (request()->tanggalAkhir)? '&tanggalAkhir='.request()->tanggalAkhir : '' }}"
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
                        <th>Kode Penyusutan Aset Tetap</th>
                        <th>Kode Aset Tetap</th>
                        <th>Jenis Aset Tetap</th>
                        <th>Nama Aset Tetap</th>
                        <th>Total Perolehan</th>
                        <th>Tanggal Penyusutan</th>
                        <th>Tahun Ke</th>
                        <th>Beban Penyusutan</th>
                        <th>Akumulasi Penyusutan</th>
                        <th>Nilai Buku</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($penyusutanAt as $record)
                      <tr>
                        <td>{{ $record->kode_penyusutan_at }}</td>
                        <td>{{ $record->asetTetap->kode_at }}</td>
                        <td>{{ $record->asetTetap->jenis_at }}</td>
                        <td>{{ $record->asetTetap->nama_at }}</td>
                        <td>{{ number_format($record->asetTetap->harga_perolehan, 2, ',', '.') }}</td>
                        <td>{{ $record->tanggal_penyusutan }}</td>
                        <td>{{ $record->tahun_ke }}</td>
                        <td>{{ number_format($record->beban_penyusutan, 2, ',', '.') }}</td>
                        <td>{{ number_format($record->akumulasi_penyusutan, 2, ',', '.') }}</td>
                        <td>{{ number_format($record->nilai_buku, 2, ',', '.') }}</td>
                        <td>
                          <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                            data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                          <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                            data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                          <a href="{{ route('Penyusutan Aset Tetap') }}?export=pdf-detail&id={{ $record->id }}"
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
          style="font-size: 12px; margin: 0; justify-content: flex-end; display: flex; background-color: #f8f9fa;"></p>
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
      <!-- Footer -->
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
    <script>
      function openEditModal(kode_penyusutan_at, kode_at, jenis_at, nama_at, total_perolehan, tanggal_penyusutan, tahun_ke, beban_penyusutan, akumulasi_penyusutan, nilai_buku) {
        document.getElementById("edit_kode_penyusutan_at").value = kode_penyusutan_at;
        document.getElementById("edit_kode_at").value = kode_at;
        document.getElementById("edit_jenis_at").value = jenis_at;
        document.getElementById("edit_nama_at").value = nama_at;
        document.getElementById("edit_total_perolehan").value = total_perolehan;
        document.getElementById("edit_tanggal_penyusutan").value = tanggal_penyusutan;
        document.getElementById("edit_tahun_ke").value = tahun_ke;
        document.getElementById("edit_beban_penyusutan").value = beban_penyusutan;
        document.getElementById("edit_akumulasi_penyusutan").value = akumulasi_penyusutan;
        document.getElementById("edit_nilai_buku").value = nilai_buku;
    }

    function openDeleteModal(kode_penyusutan_at) {
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
            keyboard: false
        });
        deleteModal.show();
        
        // Tambahkan event listener pada tombol konfirmasi hapus
        document.getElementById('confirmDeleteBtn').onclick = function() {
            window.location.href = "?kode_penyusutan_at=" + kode_penyusutan_at;
        };
    }
    </script>
    <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
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
</body>

</html>