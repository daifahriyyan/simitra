<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Jurnal Umum</title> <!-- EDIT NAMA -->

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
            <h1 class="h3 mb-0 text-gray-800">Jurnal Umum</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Akuntansi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Jurnal Umum</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Jurnal Umum</h6> <!-- EDIT NAMA -->
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Tambah dengan Icon -->
                    <div>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#tambahModal">
                        Tambah
                      </button>
                    </div>
                    <!-- Tombol Filter Tanggal dengan Icon -->
                    <div class="input-group">
                      <input type="date" class="form-control-sm border-1" style='width: 150px; height: 30px;'
                        id="tanggalMulai" aria-describedby="tanggalMulaiLabel">
                      <input type="date" class="form-control-sm border-1" style='width: 150px; height: 30px;'
                        id="tanggalAkhir" aria-describedby="tanggalAkhirLabel">
                      <button type="button" class="btn btn-secondary btn-sm" style='width: 60px; height: 30px;'
                        onclick="filterTanggal()">
                        Filter
                      </button>
                    </div>
                    <!-- Tombol Cetak Tabel dengan Icon -->
                    <div>
                      <a href="{{ route('Jurnal Umum') }}?export=pdf" class="btn btn-sm btn-warning"
                        style='width: 60px; height: 30px;'>
                        Cetak
                      </a>
                    </div>
                  </div>
                  <script>
                    // Tambah Input
                    function tambahDebet(){
                      $('#debet').clone().appendTo($('#clone-debet'))
                    }
                    function tambahKredit(){
                      $('#kredit').clone().appendTo($('#clone-kredit'))
                    }

                    // Mendapatkan elemen modal
                    var modal = document.getElementById("myModal");
                    var deleteModal = document.getElementById("deleteModal");

                    // Mendapatkan elemen tombol untuk membuka modal
                    var openModalBtn = document.getElementById("openModalBtn");
                    var openDeleteModal = document.getElementById("openDeleteModal");

                    // Mendapatkan elemen <span> yang menutup modal
                    var span = document.getElementsByClassName("close")[0];
                    var spandelete = document.getElementsByClassName("close")[1];

                    // Ketika pengguna mengklik tombol, buka modal
                    openModalBtn.onclick = function() {
                      modal.style.display = "block";
                    }
                    openDeleteModal.onclick = function() {
                      deleteModal.style.display = "block";
                    }

                    // Ketika pengguna mengklik <span> (x), tutup modal
                    span.onclick = function() {
                      modal.style.display = "none";
                    }
                    spandelete.onclick = function() {
                      deleteModal.style.display = "none";
                    }

                    // Ketika pengguna mengklik di luar modal, tutup modal
                    window.onclick = function(event) {
                      if (event.target == modal) {
                        modal.style.display = "none";
                      }
                      if (event.target == deleteModal) {
                        deleteModal.style.display = "none";
                      }
                    }

                    // Set tanggal jurnal saat ini
                    document.getElementById('tanggalJurnal').value = new Date().toISOString().slice(0, 10);

                  </script>

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
                        <th>No Jurnal</th>
                        <th>Tanggal Jurnal</th>
                        <th>No Bukti</th>
                        <th>Uraian Jurnal</th>
                        <th>Kode Akun</th>
                        <th>Nama Akun</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($jurnalUmum as $record)
                      <!-- Modal Delete -->
                      <div class="modal fade" id="deleteRecord{{ $record->id }}" tabindex="-1"
                        aria-labelledby="deleteRecordLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <form method="POST" action="{{ route('Hapus Jurnal Umum', $record->no_jurnal) }}">
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
                      <tr>
                        <td>{{ $record->no_jurnal}}</td>
                        <td>{{ $record->jurnal->tanggal_jurnal }}</td>
                        <td>{{ $record->jurnal->no_bukti }}</td>
                        <td>{{ $record->jurnal->uraian_jurnal }}</td>
                        <td>{{ $record->akun->kode_akun}}</td>
                        <td>{{ $record->akun->nama_akun}}</td>
                        <td>{{ $record->debet }}</td>
                        <td>{{ $record->kredit }}</td>
                        <td>
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
          var options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
          };
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
      function openDeleteModal(noJurnal) {
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
          keyboard: false
        });
        deleteModal.show();

        // Tambahkan event listener pada tombol konfirmasi hapus
        document.getElementById('confirmDeleteBtn').onclick = function() {
          window.location.href = "?no_jurnal=" + noJurnal;
        };
      }
    </script>
    <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/simitra.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
      $(document).ready(function() {
        $('#dataTableHover').DataTable();
      });
    </script>

    <!-- Tambah Modal -->
    {{-- Diletakkan dibawah karna diatas akan mengganggu Page Layout --}}
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="{{ route('Tambah Jurnal Umum') }}">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="tambahModalLabel">Tambah Data Jurnal Umum</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <div class="mb-3">
                    <label for="no_jurnal">No. Jurnal:</label>
                    <input type="text" id="no_jurnal" name="no_jurnal" class="form-control"
                      value="JU{{ str_pad($jurnal, 6, 0, STR_PAD_LEFT) }}" required>
                  </div>
                  <div class="mb-3">
                    <label for="tanggal_jurnal">Tanggal Jurnal:</label>
                    <input type="date" id="tanggal_jurnal" name="tanggal_jurnal" class="form-control" required>
                  </div>
                </div>
                <div class="col-6">
                  <div class="mb-3">
                    <label for="uraian_jurnal">Keterangan:</label>
                    <input type="text" id="uraian_jurnal" name="uraian_jurnal" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label for="no_bukti">No. Bukti:</label>
                    <input type="text" id="no_bukti" name="no_bukti" class="form-control" required>
                  </div>
                </div>
              </div>
              <span class="btn btn-success" style="cursor: pointer" onclick="tambahDebet()">Tambah Debet</span>
              <span class="btn btn-primary" style="cursor: pointer" onclick="tambahKredit()">Tambah Kredit</span>
              <div id="debet">
                <div class="mb-3">
                  <h5 class="text-success">Debet</h5>
                  <div class="row">
                    <div class="col-6">
                      <label for="no_akun_debet">No. Akun:</label>
                      <select class="custom-select" id="no_akun_debet" name="no_akun_debet[]">
                        <option selected>Pilih Kode dan Nama Akun</option>
                        @foreach ($akun as $item)
                        <option value="{{ $item->id }}">{{ $item->kode_akun }} | {{ $item->nama_akun
                          }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-6">
                      <label for="jumlah_debet">Jumlah Debet:</label>
                      <input type="number" id="jumlah_debet" name="jumlah_debet[]" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div id="clone-debet"></div>
              <div id="kredit">
                <div class="mb-3">
                  <h5 class="text-primary">Kredit</h5>
                  <div class="row">
                    <div class="col-6">
                      <label for="no_akun_kredit">No. Akun:</label>
                      <select class="custom-select" id="no_akun_kredit" name="no_akun_kredit[]">
                        <option selected>Pilih Kode dan Nama Akun</option>
                        @foreach ($akun as $item)
                        <option value="{{ $item->id }}">{{ $item->kode_akun }} | {{ $item->nama_akun
                          }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-6">
                      <label for="jumlah_kredit">Jumlah Kredit:</label>
                      <input type="number" id="jumlah_kredit" name="jumlah_kredit[]" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div id="clone-kredit"></div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary" id="simpanBtn">Simpan</button>
              </div>
          </form>
        </div>
      </div>
    </div>

</body>

</html>