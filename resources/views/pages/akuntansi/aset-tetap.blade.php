<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Aset Tetap</title> <!-- EDIT NAMA -->

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
            <h1 class="h3 mb-0 text-gray-800">Aset Tetap</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Akuntansi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Aset Tetap</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Aset Tetap</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Aset Tetap') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="kode_at" class="form-label">Kode Aset Tetap:</label>
                      <input type="text" class="form-control" id="kode_at" name="kode_at"
                        value="AT00{{ $asetTetap->count() + 1 }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="jenis_at" class="form-label">Jenis Aset Tetap:</label>
                      <select class="form-select" id="jenis_at" name="jenis_at" required>
                        <option value="">Pilih Jenis Aset Tetap</option>
                        <option value="Tanah">Tanah</option>
                        <option value="Bangunan">Bangunan</option>
                        <option value="Kendaraan Bermotor">Kendaraan Bermotor</option>
                        <option value="Inventaris Kantor">Inventaris Kantor</option>
                        <option value="Peralatan dan Mesin">Peralatan dan Mesin</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="nama_at" class="form-label">Nama Aset Tetap:</label>
                      <input type="text" class="form-control" id="nama_at" name="nama_at" required>
                    </div>
                    <div class="mb-3">
                      <label for="jumlah_at" class="form-label">Jumlah:</label>
                      <input type="number" class="form-control" id="jumlah_at" name="jumlah_at" required>
                    </div>
                    <div class="mb-3">
                      <label for="keberadaan_at" class="form-label">Keberadaan:</label>
                      <select class="form-select" id="keberadaan_at" name="keberadaan_at" required>
                        <option value="">Pilih Keberadaan Aset Tetap</option>
                        <option value="Kantor">Kantor</option>
                        <option value="Depo">Depo</option>
                        <option value="PF">PF</option>
                        <option value="PU">PU</option>
                        <option value="AKK">AKK</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tahun_perolehan" class="form-label">Tahun Perolehan:</label>
                      <input type="number" class="form-control" id="tahun_perolehan" name="tahun_perolehan" required>
                    </div>
                    <div class="mb-3">
                      <label for="umur_ekonomis" class="form-label">Umur Ekonomis:</label>
                      <input type="number" class="form-control" id="umur_ekonomis" name="umur_ekonomis" required>
                    </div>
                    <div class="mb-3">
                      <label for="harga_perolehan" class="form-label">Harga Perolehan:</label>
                      <input type="number" step="0.01" class="form-control" id="harga_perolehan" name="harga_perolehan"
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
          @foreach ($asetTetap as $record)
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
                  <form method="POST" action="{{ route('Ubah Aset Tetap', $record->id) }}">
                    @method('put')@csrf
                    <div class="mb-3">
                      <label for="kode_at" class="form-label">Kode Aset Tetap:</label>
                      <input type="text" class="form-control" id="kode_at" name="kode_at" value="{{ $record->kode_at }}"
                        readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="jenis_at" class="form-label">Jenis Aset Tetap:</label>
                      <select class="form-select" id="jenis_at" name="jenis_at" required>
                        <option value="{{ $record->jenis_at }}">{{ $record->jenis_at }}
                        <option value="Tanah">Tanah</option>
                        <option value="Bangunan">Bangunan</option>
                        <option value="Kendaraan Bermotor">Kendaraan Bermotor</option>
                        <option value="Inventaris Kantor">Inventaris Kantor</option>
                        <option value="Peralatan dan Mesin">Peralatan dan Mesin</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="nama_at" class="form-label">Nama Aset Tetap:</label>
                      <input type="text" class="form-control" id="nama_at" name="nama_at" value="{{ $record->nama_at }}"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="jumlah_at" class="form-label">Jumlah:</label>
                      <input type="number" class="form-control" id="jumlah_at" name="jumlah_at"
                        value="{{ $record->jumlah_at }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="keberadaan_at" class="form-label">Keberadaan:</label>
                      <select class="form-select" id="keberadaan_at" name="keberadaan_at" required>
                        <option value="{{ $record->keberadaan_at }}">{{ $record->keberadaan_at }}
                        <option value="Kantor">Kantor</option>
                        <option value="Depo">Depo</option>
                        <option value="PF">PF</option>
                        <option value="PU">PU</option>
                        <option value="AKK">AKK</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tahun_perolehan" class="form-label">Tahun Perolehan:</label>
                      <input type="number" class="form-control" id="tahun_perolehan" name="tahun_perolehan"
                        value="{{ $record->tahun_perolehan }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="umur_ekonomis" class="form-label">Umur Ekonomis:</label>
                      <input type="number" class="form-control" id="umur_ekonomis" name="umur_ekonomis"
                        value="{{ $record->umur_ekonomis }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="harga_perolehan" class="form-label">Harga Perolehan:</label>
                      <input type="number" step="0.01" class="form-control" id="harga_perolehan" name="harga_perolehan"
                        value="{{ $record->harga_perolehan }}" required>
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
                <form method="POST" action="{{ route('Hapus Aset Tetap', $record->id) }}">
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
                  <h6 class="m-0 font-weight-bold text-primary">Penggajian</h6> <!-- EDIT NAMA -->
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
                      <a href="{{ route('Aset Tetap') }}?export=pdf" class="btn btn-sm btn-warning"
                        style='width: 60px; height: 30px;'>
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
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
                    <thead class="thead-light">
                      <tr>
                        <th>Kode Aset Tetap</th>
                        <th>Jenis Aset Tetap</th>
                        <th>Nama Aset Tetap</th>
                        <th>Jumlah</th>
                        <th>Keberadaan</th>
                        <th>Tahun Perolehan</th>
                        <th>Umur Ekonomis</th>
                        <th>Harga Perolehan</th>
                        <th>Total Perolehan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($asetTetap as $record)
                      <tr>
                        <td>{{ $record->kode_at }}</td>
                        <td>{{ $record->jenis_at }}</td>
                        <td>{{ $record->nama_at }}</td>
                        <td>{{ $record->jumlah_at }}</td>
                        <td>{{ $record->keberadaan_at }}</td>
                        <td>{{ $record->tahun_perolehan }}</td>
                        <td>{{ $record->umur_ekonomis }}</td>
                        <td>{{ number_format($record->harga_perolehan, 2, ',', '.') }}</td>
                        <td>{{ number_format($record->harga_perolehan * $record->jumlah_at, 2, ',', '.') }}</td>
                        <td>
                          @php
                          date_default_timezone_set('Asia/Jakarta');

                          $tgl = explode( "-", date('Y-m-d H:i:s'));
                          $sisa_umur_ekonomis = ($record->tahun_perolehan + $record->umur_ekonomis) - intval($tgl[0])
                          @endphp
                          @if ($sisa_umur_ekonomis <= 0) <span class='badge badge-success'>Tidak Aktif</span>
                            @elseif($sisa_umur_ekonomis > 0)
                            <span class='badge badge-danger'>Aktif</span>
                            @endif
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
      function openEditModal(idPenggajian, tanggalInput, idPegawai, namaPegawai, gajiPokok, bonus, tunjanganLembur, iuran, gajiBersih) {
        document.getElementById("edit_id_penggajian").value = idPenggajian;
        document.getElementById("edit_tanggal_input").value = tanggalInput;
        document.getElementById("edit_id_pegawai").value = idPegawai;
        document.getElementById("edit_nama_pegawai").value = namaPegawai;
        document.getElementById("edit_gaji_pokok").value = gajiPokok;
        document.getElementById("edit_bonus").value = bonus;
        document.getElementById("edit_tunjangan_lembur").value = tunjanganLembur;
        document.getElementById("edit_iuran").value = iuran;
        document.getElementById("edit_gaji_bersih").value = gajiBersih;
    }

    function openDeleteModal(idPenggajian) {
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
            keyboard: false
        });
        deleteModal.show();
        
        // Tambahkan event listener pada tombol konfirmasi hapus
        document.getElementById('confirmDeleteBtn').onclick = function() {
            window.location.href = "?id_penggajian=" + idPenggajian;
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