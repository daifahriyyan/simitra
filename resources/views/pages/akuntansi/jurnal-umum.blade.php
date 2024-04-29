<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Jurnal Umum</title> <!-- EDIT NAMA -->

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
            <h1 class="h3 mb-0 text-gray-800">Jurnal Umum</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Akuntansi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Jurnal Umum</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Jurnal</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Tambah Jurnal Umum') }}">
                    @csrf
                    <!-- Form fields for keu_jurnal -->
                    <div class="mb-3">
                      <label for="no_jurnal" class="form-label">No Jurnal:</label>
                      <input type="text" class="form-control" id="no_jurnal" name="no_jurnal"
                        value="JU00{{ $jurnalUmum->count() + 1 }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_jurnal" class="form-label">Tanggal Jurnal:</label>
                      <input type="date" class="form-control" id="tanggal_jurnal" name="tanggal_jurnal" required>
                    </div>
                    <div class="mb-3">
                      <label for="no_bukti" class="form-label">No Bukti:</label>
                      <input type="text" class="form-control" id="no_bukti" name="no_bukti" required>
                    </div>
                    <div class="mb-3">
                      <label for="uraian_jurnal" class="form-label">Uraian Jurnal:</label>
                      <input type="text" class="form-control" id="uraian_jurnal" name="uraian_jurnal" required>
                    </div>
                    <div class="debet-kredit">
                      <div class="mb-3">
                        <h5>Debet</h5>
                        <label for="noAkunDebet">No. Akun:</label>
                        <input type="text" id="noAkunDebet" class="form-control">
                        <label for="namaAkunDebet">Nama Akun:</label>
                        <input type="text" id="namaAkunDebet" class="form-control">
                        <label for="jumlahDebet">Jumlah Debet:</label>
                        <input type="number" id="jumlahDebet" class="form-control">
                        <button id="tambahDebet" class="btn btn-sm btn-info"
                          style="width: 70px; height: 30px;">Tambah</button>
                      </div>
                      <div class="mb-3">
                        <h5>Kredit</h5>
                        <label for="noAkunKredit">No. Akun:</label>
                        <input type="text" id="noAkunKredit" class="form-control">
                        <label for="namaAkunKredit">Nama Akun:</label>
                        <input type="text" id="namaAkunKredit" class="form-control">
                        <label for="jumlahKredit">Jumlah Kredit:</label>
                        <input type="number" id="jumlahKredit" class="form-control">
                        <button id="tambahKredit" class="btn btn-sm btn-info"
                          style="width: 70px; height: 30px;">Tambah</button>
                      </div>
                    </div>
                    <!-- Form fields for keu_detail_jurnal Debit -->
                    <div class="mb-3">
                      <label for="kode_akun_debit" class="form-label">Kode Akun (Debit):</label>
                      <select class="custom-select form-select-lg mb-3" aria-label="Large select example"
                        id="kode_akun_debit" name="kode_akun_debit">
                        <option selected>Pilih Kode Akun (Debit)</option>
                        @foreach ($kodeAkunDebet as $item)
                        <option value="{{ $item->id }}">{{ $item->kode_akun }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="nama_akun_debit" class="form-label">Nama Akun (Debit):</label>
                      <input type="text" class="form-control" id="nama_akun_debit" name="nama_akun_debit" required>
                    </div>
                    <div class="mb-3">
                      <label for="debet" class="form-label">Debet:</label>
                      <input type="number" class="form-control" id="debet" name="debet" required>
                    </div>
                    <!-- Form fields for keu_detail_jurnal Kredit -->
                    <div class="mb-3">
                      <label for="kode_akun_kredit" class="form-label">Kode Akun (Kredit):</label>
                      <select class="custom-select form-select-lg mb-3" aria-label="Large select example"
                        id="kode_akun_kredit" name="kode_akun_kredit">
                        <option selected>Pilih Kode Akun (Kredit)</option>
                        @foreach ($kodeAkunKredit as $item)
                        <option value="{{ $item->id }}">{{ $item->kode_akun }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="nama_akun_kredit" class="form-label">Nama Akun (Kredit):</label>
                      <input type="text" class="form-control" id="nama_akun_kredit" name="nama_akun_kredit" required>
                    </div>
                    <div class="mb-3">
                      <label for="kredit" class="form-label">Kredit:</label>
                      <input type="number" class="form-control" id="kredit" name="kredit" required>
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
          @foreach ($jurnalUmum as $record)
          <!-- Modal Edit Data -->
          <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Jurnal</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('Ubah Jurnal Umum', $record->id) }}">
                    @method('put')@csrf
                    <!-- Form fields for keu_jurnal -->
                    <div class="mb-3">
                      <label for="edit_no_jurnal" class="form-label">No Jurnal:</label>
                      <input type="text" class="form-control" id="edit_no_jurnal" name="edit_no_jurnal" readonly
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="edit_tanggal_jurnal" class="form-label">Tanggal Jurnal:</label>
                      <input type="date" class="form-control" id="edit_tanggal_jurnal" name="edit_tanggal_jurnal"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="edit_no_bukti" class="form-label">No Bukti:</label>
                      <input type="text" class="form-control" id="edit_no_bukti" name="edit_no_bukti" required>
                    </div>
                    <div class="mb-3">
                      <label for="edit_uraian_jurnal" class="form-label">Uraian Jurnal:</label>
                      <input type="text" class="form-control" id="edit_uraian_jurnal" name="edit_uraian_jurnal"
                        required>
                    </div>
                    <!-- Form fields for keu_detail_jurnal Debit -->
                    <div class="mb-3">
                      <label for="edit_kode_akun_debit" class="form-label">Kode Akun (Debit):</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="edit_kode_akun_debit" name="edit_kode_akun_debit"
                          required>
                        <button type="button" onclick="displayDataOrder()" class="btn btn-warning" id="search_button">
                          <img src="https://www.freeiconspng.com/uploads/search-icon-png-0.png" alt="Search"
                            style="width: 20px; height: 20px;">
                        </button>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="edit_nama_akun_debit" class="form-label">Nama Akun (Debit):</label>
                      <input type="text" class="form-control" id="edit_nama_akun_debit" name="edit_nama_akun_debit">
                    </div>
                    <div class="mb-3">
                      <label for="edit_debet" class="form-label">Debet:</label>
                      <input type="number" class="form-control" id="edit_debet" name="edit_debet">
                    </div>
                    <!-- Form fields for keu_detail_jurnal Kredit -->
                    <div class="mb-3">
                      <label for="edit_kode_akun_kredit" class="form-label">Kode Akun (Kredit):</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="edit_kode_akun_kredit" name="edit_kode_akun_kredit"
                          required>
                        <button type="button" onclick="displayDataOrder()" class="btn btn-warning" id="search_button">
                          <img src="https://www.freeiconspng.com/uploads/search-icon-png-0.png" alt="Search"
                            style="width: 20px; height: 20px;">
                        </button>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="edit_nama_akun_kredit" class="form-label">Nama Akun (Kredit):</label>
                      <input type="text" class="form-control" id="edit_nama_akun_kredit" name="edit_nama_akun_kredit">
                    </div>
                    <div class="mb-3">
                      <label for="edit_kredit" class="form-label">Kredit:</label>
                      <input type="number" class="form-control" id="edit_kredit" name="edit_kredit">
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
                <form method="POST" action="{{ route('Hapus Jurnal Umum', $record->id) }}">
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
                  <h6 class="m-0 font-weight-bold text-primary">Jurnal Umum</h6> <!-- EDIT NAMA -->
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
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
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
                      <tr>
                        <td>{{ $record->no_jurnal }}</td>
                        <td>{{ $record->tanggal_jurnal }}</td>
                        <td>{{ $record->no_bukti }}</td>
                        <td>{{ $record->uraian_jurnal }}</td>
                        <td>{{ $record->kode_akun }}</td>
                        <td>{{ $record->nama_akun }}</td>
                        <td>{{ number_format($record->debet, 2, ',', '.') }}</td>
                        <td>{{ number_format($record->kredit, 2, ',', '.') }}</td>
                        <td>
                          <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                            data-bs-target='#editModal{{ $record->id }}'><i class='fas fa-edit'></i></button>
                          <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                            data-bs-target="#deleteRecord{{ $record->id }}"><i class='fas fa-trash'></i></button>
                          <a href='generate_pdf.php?no_jurnal=".htmlspecialchars($data[' no_jurnal'])."'
                            class='btn btn-primary btn-sm' target='_blank' role='button'><i
                              class='fas fa-print'></i></a>
                        </td>
                      </tr>
                      @endforeach
                      {{--
                      <?php
                          $query = "SELECT keu_jurnal.no_jurnal, keu_jurnal.tanggal_jurnal, keu_jurnal.no_bukti, keu_jurnal.uraian_jurnal, keu_detail_jurnal.kode_akun, keu_detail_jurnal.nama_akun, keu_detail_jurnal.debet, keu_detail_jurnal.kredit FROM keu_jurnal INNER JOIN keu_detail_jurnal ON keu_jurnal.no_jurnal = keu_detail_jurnal.no_jurnal";
                          $result = mysqli_query($conn, $query);
                          while ($data = mysqli_fetch_assoc($result)) {
                              echo "<tr>";
                              echo "<td>".$data['no_jurnal']."</td>";
                              echo "<td>".$data['tanggal_jurnal']."</td>";
                              echo "<td>".$data['no_bukti']."</td>";
                              echo "<td>".$data['uraian_jurnal']."</td>";
                              echo "<td>".$data['kode_akun']."</td>";
                              echo "<td>".$data['nama_akun']."</td>";
                              echo "<td>".number_format($data['debet'], 2, ',', '.')."</td>";
                              echo "<td>".number_format($data['kredit'], 2, ',', '.')."</td>";
                              echo "<td>";
                              // Adjust the buttons and links as needed for editing and deleting based on the new structure
                              echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"".$data['no_jurnal']."\", \"".$data['tanggal_jurnal']."\", \"".$data['no_bukti']."\", \"".$data['uraian_jurnal']."\", \"".$data['kode_akun']."\", \"".$data['nama_akun']."\", \"".$data['debet']."\", \"".$data['kredit']."\")'><i class='fas fa-edit'></i></button>";
                              echo "<button type='button' class='btn btn-danger btn-sm' onclick='openDeleteModal(\"".$data['no_jurnal']."\")'><i class='fas fa-trash'></i></button>";
                              echo "<a href='generate_pdf.php?no_jurnal=".htmlspecialchars($data['no_jurnal'])."' class='btn btn-primary btn-sm' target='_blank' role='button'><i class='fas fa-print'></i></a>";
                              echo "</td>";
                              echo "</tr>"; 
                          }
                      ?> --}}
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
      function openEditModal(noJurnal, tanggalJurnal, noBukti, uraianJurnal, kodeAkunDebit, namaAkunDebit, debet, kodeAkunKredit, namaAkunKredit, kredit) {
        document.getElementById("edit_no_jurnal").value = noJurnal;
        document.getElementById("edit_tanggal_jurnal").value = tanggalJurnal;
        document.getElementById("edit_no_bukti").value = noBukti;
        document.getElementById("edit_uraian_jurnal").value = uraianJurnal;
        document.getElementById("edit_kode_akun_debit").value = kodeAkunDebit;
        document.getElementById("edit_nama_akun_debit").value = namaAkunDebit;
        document.getElementById("edit_debet").value = debet;
        document.getElementById("edit_kode_akun_kredit").value = kodeAkunKredit;
        document.getElementById("edit_nama_akun_kredit").value = namaAkunKredit;
        document.getElementById("edit_kredit").value = kredit;
    }

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
    </script>
</body>

</html>