<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Akun</title> <!-- EDIT NAMA -->

  <link href="{{ asset('img/logo/logo.png')}}" rel="icon">
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/simitra.min.css')}}" rel="stylesheet">
  <link href="{{ asset('css/simitra.css')}}" rel="stylesheet">
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
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
          @error ('kode_akun')
          <div class="row">
            <div class="col d-flex justify-content-center">
              <div class="alert alert-danger alert-dismissible fade show" style="min-height: 50px; width:500px;"
                role="alert">
                <div>
                  {{ $message }}
                </div>
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          </div>
          @enderror
          <!-- Your container content -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Akun</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Akuntansi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Akun</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Akun</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Daftar Akun') }}">
                    @csrf
                    <div class="mb-3">
                      <label for="kode_akun" class="form-label">Kode Akun:</label>
                      <input type="text" class="form-control" id="kode_akun" name="kode_akun" required>
                    </div>
                    <div class="mb-3">
                      <label for="nama_akun" class="form-label">Nama Akun:</label>
                      <input type="text" class="form-control" id="nama_akun" name="nama_akun" required>
                    </div>
                    <div class="mb-3">
                      <label for="jenis_akun" class="form-label">Jenis Akun:</label>
                      <br>
                      <select class="custom-select" id="jenis_akun" name="jenis_akun" required>
                        <option selected>Pilih Jenis Akun</option>
                        <option value="debet">Debet</option>
                        <option value="kredit">Kredit</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="kelompok_akun" class="form-label">Kelompok Akun:</label>
                      <br>
                      <select class="custom-select" id="kelompok_akun" name="kelompok_akun" required>
                        <option selected>Pilih Kelompok Akun</option>
                        <option value="aset">Aset</option>
                        <option value="liabilitas">Liabilitas</option>
                        <option value="ekuitas">Ekuitas</option>
                        <option value="modal">Modal</option>
                        <option value="pendapatan">Pendapatan</option>
                        <option value="beban">Beban</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="saldo_akun" class="form-label">Saldo Akun:</label>
                      <input type="number" class="form-control" id="saldo_akun" name="saldo_akun" required>
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
          @foreach ($keuAkun as $record)
          <!-- Modal Edit Data -->
          <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Akun</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Ubah Daftar Akun', $record->id) }}">
                    @method('put')@csrf
                    <div class="mb-3">
                      <label for="kode_akun" class="form-label">Kode Akun:</label>
                      <input type="text" class="form-control" id="kode_akun" name="kode_akun"
                        value="{{ $record->kode_akun }}" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="nama_akun" class="form-label">Nama Akun:</label>
                      <input type="text" class="form-control" id="nama_akun" name="nama_akun"
                        value="{{ $record->nama_akun }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="jenis_akun" class="form-label">Jenis Akun:</label>
                      <br>
                      <select class="form-select" id="jenis_akun" name="jenis_akun" required>
                        <option value="{{ $record->jenis_akun }}">{{ $record->jenis_akun }}
                        <option value="debet">Debet</option>
                        <option value="kredit">Kredit</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="kelompok_akun" class="form-label">Kelompok Akun:</label>
                      <br>
                      <select class="form-select" id="kelompok_akun" name="kelompok_akun" required>
                        <option value="{{ $record->kelompok_akun }}">{{ $record->kelompok_akun }}
                        <option value="aset">Aset</option>
                        <option value="liabilitas">Liabilitas</option>
                        <option value="ekuitas">Ekuitas</option>
                        <option value="modal">Modal</option>
                        <option value="pendapatan">Pendapatan</option>
                        <option value="beban">Beban</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="saldo_akun" class="form-label">Saldo Akun:</label>
                      <input type="number" class="form-control" id="saldo_akun" name="saldo_akun"
                        value="{{ $record->saldo_akun }}" required>
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
                <form method="POST" action="{{ route('Hapus Daftar Akun', $record->id) }}">
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
                  <h6 class="m-0 font-weight-bold text-primary">Akun</h6> <!-- EDIT NAMA -->
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Tambah dengan Icon -->
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#addModal">
                      Tambah
                    </button>
                    <!-- Tombol Cetak Tabel dengan Icon -->
                    <a href="{{ route('Daftar Akun') }}?export=pdf" class="btn btn-sm btn-warning">
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
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
                    <thead class="thead-light">
                      <tr>
                        <th>Kode Akun</th>
                        <th>Nama Akun</th>
                        <th>Jenis Akun</th>
                        <th>Kelompok Akun</th>
                        <th>Saldo Akun</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($keuAkun as $record)

                      <tr>
                        <td>{{ $record->kode_akun }}</td>
                        <td>{{ $record->nama_akun }}</td>
                        <td>{{ $record->jenis_akun }}</td>
                        <td>{{ $record->kelompok_akun }}</td>
                        <td>{{ number_format($record->saldo_akun, 2, ',', '.') }}</td>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js">
        </script>
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('js/simitra.min.js') }}"></script>
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
        <script>
          function openEditModal(kodeAkun, namaAkun, jenisAkun, kelompokAkun, saldoAkun) {
        document.getElementById("edit_kode_akun").value = kodeAkun;
        document.getElementById("edit_nama_akun").value = namaAkun;
        document.getElementById("edit_jenis_akun").value = jenisAkun;
        document.getElementById("edit_kelompok_akun").value = kelompokAkun;
        document.getElementById("edit_saldo_akun").value = saldoAkun;
      }

      function deleteData(kodeAkun) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
          window.location.href = "?kode_akun=" + kodeAkun;
        }
      }

      
    $(document).ready(function () {
      $('#dataTableHover').DataTable();
    });
        </script>
        <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->
</body>

</html>