<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Penggajian</title> <!-- EDIT NAMA -->

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
            <h1 class="h3 mb-0 text-gray-800">Penggajian</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Akuntansi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Penggajian</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Penggajian</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Penggajian') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="id_penggajian" class="form-label">ID Penggajian:</label>
                      <input type="text" class="form-control" id="id_penggajian" name="id_penggajian"
                        value="PG00{{ $penggajian->count() + 1 }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_input" class="form-label">Tanggal Input:</label>
                      <input type="date" class="form-control" id="tanggal_input" name="tanggal_input" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_pegawai" class="form-label">ID Pegawai:</label>
                      <select class="custom-select form-select-lg mb-3" aria-label="Large select example"
                        id="id_pegawai" name="id_pegawai">
                        <option selected>Pilih ID Pegawai</option>
                        @foreach ($pegawai as $item)
                        <option value="{{ $item->id }}">{{ $item->id_pegawai }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="bonus" class="form-label">Bonus:</label>
                      <input type="number" class="form-control" id="bonus" name="bonus">
                    </div>
                    <div class="mb-3">
                      <label for="tunjangan_lembur" class="form-label">Tunjangan Lembur:</label>
                      <input type="number" class="form-control" id="tunjangan_lembur" name="tunjangan_lembur">
                    </div>
                    <div class="mb-3">
                      <label for="iuran" class="form-label">Iuran:</label>
                      <input type="number" class="form-control" id="iuran" name="iuran">
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
          @foreach ($penggajian as $record)
          <!-- Modal Edit Data -->
          <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Penggajian</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Ubah Penggajian', $record->id) }}">
                    @method('put')@csrf
                    <div class="mb-3">
                      <label for="id_penggajian" class="form-label">ID Penggajian:</label>
                      <input type="text" class="form-control" id="id_penggajian" name="id_penggajian"
                        value="{{ $record->id_penggajian }}" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_input" class="form-label">Tanggal Input:</label>
                      <input type="date" class="form-control" id="tanggal_input" name="tanggal_input"
                        value="{{ $record->tanggal_input }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_pegawai" class="form-label">ID Pegawai:</label>
                      <select class="custom-select form-select-lg mb-3" aria-label="Large select example"
                        id="id_pegawai" name="id_pegawai">
                        <option value="{{ $record->id_pegawai }}">{{ $record->pegawai->id_pegawai }}</option>
                        @foreach ($pegawai as $item)
                        <option value="{{ $item->id }}">{{ $item->id_pegawai }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="bonus" class="form-label">Bonus:</label>
                      <input type="number" class="form-control" id="bonus" name="bonus" value="{{ $record->bonus }}">
                    </div>
                    <div class="mb-3">
                      <label for="tunjangan_lembur" class="form-label">Tunjangan Lembur:</label>
                      <input type="number" class="form-control" id="tunjangan_lembur" name="tunjangan_lembur"
                        value="{{ $record->tunjangan_lembur }}">
                    </div>
                    <div class="mb-3">
                      <label for="iuran" class="form-label">Iuran:</label>
                      <input type="number" class="form-control" id="iuran" name="iuran" value="{{ $record->iuran }}">
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
                <form method="POST" action="{{ route('Hapus Penggajian', $record->id) }}">
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
                      <form action="{{ route('Penggajian') }}">
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
                      <a href="{{ route('Penggajian') }}?export=pdf{{ (request()->tanggalMulai)? '&tanggalMulai='.request()->tanggalMulai : '' }}{{ (request()->tanggalAkhir)? '&tanggalAkhir='.request()->tanggalAkhir : '' }}"
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
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
                    <thead class="thead-light">
                      <tr>
                        <th>ID Penggajian</th>
                        <th>Tanggal Input</th>
                        <th>ID Pegawai</th>
                        <th>Nama Pegawai</th>
                        <th>Gaji Pokok</th>
                        <th>Bonus</th>
                        <th>Tunjangan Lembur</th>
                        <th>Iuran</th>
                        <th>Gaji Bersih</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($penggajian as $record)
                      <tr>
                        <td>{{ $record->id_penggajian }}</td>
                        <td>{{ $record->tanggal_input }}</td>
                        <td>{{ $record->pegawai->id_pegawai }}</td>
                        <td>{{ $record->pegawai->nama_pegawai }}</td>
                        <td>{{ number_format($record->pegawai->gaji_pokok, 2, ',', '.') }}</td>
                        <td>{{ number_format($record->bonus, 2, ',', '.') }}</td>
                        <td>{{ number_format($record->tunjangan_lembur, 2, ',', '.') }}</td>
                        <td>{{ number_format($record->iuran, 2, ',', '.') }}</td>
                        <td>{{ number_format($record->gaji_bersih, 2, ',', '.') }}</td>
                        <td>
                          <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                            data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                          <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                            data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                          <a href="{{ route('Penggajian') }}?export=pdf-detail&id={{ $record->id }}"
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