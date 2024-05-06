<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMITRA - Pembelian</title> <!-- EDIT NAMA -->

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
            <h1 class="h3 mb-0 text-gray-800">Pembelian</h1> <!-- EDIT NAMA -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Akuntansi</a></li>
              <li class="breadcrumb-item active" aria-current="page">Pembelian</li> <!-- EDIT NAMA -->
            </ol>
          </div>
          <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
          <!-- Modal Tambah Data -->
          <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Tambah Data Pembelian</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST">
                    <div class="mb-3">
                      <label for="id_beli" class="form-label">ID Pembelian:</label>
                      <input type="text" class="form-control" id="id_beli" name="id_beli" required>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_beli" class="form-label">Tanggal Pembelian:</label>
                      <input type="date" class="form-control" id="tanggal_beli" name="tanggal_beli" required>
                    </div>
                    <div class="mb-3">
                      <label for="termin_pembayaran" class="form-label">Termin Pembayaran:</label>
                      <input type="text" class="form-control" id="termin_pembayaran" name="termin_pembayaran" required>
                    </div>
                    <div class="mb-3">
                      <label for="id_supplier" class="form-label">ID Supplier:</label>
                      <input type="text" class="form-control" id="id_supplier" name="id_supplier" required>
                    </div>
                    <div class="mb-3">
                      <label for="nama_supplier" class="form-label">Nama Supplier:</label>
                      <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" required>
                    </div>
                    <div class="mb-3">
                      <label for="metode_beli" class="form-label">Metode Pembelian:</label>
                      <br>
                      <select class="form-select" id="metode_beli" name="metode_beli" required>
                        <option value="">Pilih Metode</option>
                        <option value="Tunai">Tunai</option>
                        <option value="Kredit">Kredit</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="id_persediaan" class="form-label">ID Persediaan:</label>
                      <input type="text" class="form-control" id="id_persediaan" name="id_persediaan" required>
                    </div>
                    <div class="mb-3">
                      <label for="nama_persediaan" class="form-label">Nama Persediaan:</label>
                      <input type="text" class="form-control" id="nama_persediaan" name="nama_persediaan" required>
                    </div>
                    <div class="mb-3">
                      <label for="jumlah_beli" class="form-label">Jumlah Pembelian:</label>
                      <input type="number" class="form-control" id="jumlah_beli" name="jumlah_beli">
                    </div>
                    <div class="mb-3">
                      <label for="harga_beli" class="form-label">Harga Pembelian:</label>
                      <input type="number" class="form-control" id="harga_beli" name="harga_beli">
                    </div>
                    <div class="mb-3">
                      <label for="total_beli" class="form-label">Total Pembelian:</label>
                      <input type="number" class="form-control" id="total_beli" name="total_beli">
                    </div>
                    <div class="mb-3">
                      <label for="ppn_masukan" class="form-label">PPN Masukan:</label>
                      <input type="number" class="form-control" id="ppn_masukan" name="ppn_masukan">
                    </div>
                    <div class="mb-3">
                      <label for="total_bayar" class="form-label">Total Bayar:</label>
                      <input type="number" class="form-control" id="total_bayar" name="total_bayar">
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
          <!-- Modal Edit Data -->
          <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Data Pembelian</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST">
                    <div class="mb-3">
                      <label for="edit_id_beli" class="form-label">ID Pembelian:</label>
                      <input type="text" class="form-control" id="edit_id_beli" name="edit_id_beli" readonly required>
                    </div>
                    <div class="mb-3">
                      <label for="edit_tanggal_beli" class="form-label">Tanggal Pembelian:</label>
                      <input type="date" class="form-control" id="edit_tanggal_beli" name="edit_tanggal_beli" required>
                    </div>
                    <div class="mb-3">
                      <label for="edit_termin_pembayaran" class="form-label">Termin Pembayaran:</label>
                      <input type="text" class="form-control" id="edit_termin_pembayaran" name="edit_termin_pembayaran"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="edit_id_supplier" class="form-label">ID Supplier:</label>
                      <input type="text" class="form-control" id="edit_id_supplier" name="edit_id_supplier" required>
                    </div>
                    <div class="mb-3">
                      <label for="edit_nama_supplier" class="form-label">Nama Supplier:</label>
                      <input type="text" class="form-control" id="edit_nama_supplier" name="edit_nama_supplier"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="edit_metode_beli" class="form-label">Metode Pembelian:</label>
                      <br>
                      <select class="form-select" id="edit_metode_beli" name="edit_metode_beli" required>
                        <option value="">Pilih Metode</option>
                        <option value="Tunai">Tunai</option>
                        <option value="Kredit">Kredit</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="edit_id_persediaan" class="form-label">ID Persediaan:</label>
                      <input type="text" class="form-control" id="edit_id_persediaan" name="edit_id_persediaan"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="edit_nama_persediaan" class="form-label">Nama Persediaan:</label>
                      <input type="text" class="form-control" id="edit_nama_persediaan" name="edit_nama_persediaan"
                        required>
                    </div>
                    <div class="mb-3">
                      <label for="edit_jumlah_beli" class="form-label">Jumlah Pembelian:</label>
                      <input type="number" class="form-control" id="edit_jumlah_beli" name="edit_jumlah_beli">
                    </div>
                    <div class="mb-3">
                      <label for="edit_harga_beli" class="form-label">Harga Pembelian:</label>
                      <input type="number" class="form-control" id="edit_harga_beli" name="edit_harga_beli">
                    </div>
                    <div class="mb-3">
                      <label for="edit_total_beli" class="form-label">Total Pembelian:</label>
                      <input type="number" class="form-control" id="edit_total_beli" name="edit_total_beli">
                    </div>
                    <div class="mb-3">
                      <label for="edit_ppn_masukan" class="form-label">PPN Masukan:</label>
                      <input type="number" class="form-control" id="edit_ppn_masukan" name="edit_ppn_masukan">
                    </div>
                    <div class="mb-3">
                      <label for="edit_total_bayar" class="form-label">Total Bayar:</label>
                      <input type="number" class="form-control" id="edit_total_bayar" name="edit_total_bayar">
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
          <!-- Modal Hapus -->
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan Data</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">Apakah Anda Yakin Ingin Menghapus Data Ini?</div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                  <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
                </div>
              </div>
            </div>
          </div>
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
                  <h6 class="m-0 font-weight-bold text-primary">Pembelian</h6> <!-- EDIT NAMA -->
                  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <!-- Tombol Tambah dengan Icon -->
                    <div>
                      <button type="button" class="btn btn-sm btn-info" style='width: 70px; height: 30px;'
                        data-bs-toggle="modal" data-bs-target="#addModal">
                        Tambah
                      </button>
                    </div>
                    <!-- Tombol Filter Id Supplier dan Tanggal dengan Icon -->
                    <div class="input-group">
                      <label for="id_supplier" class="mb-0 mr-2">Id Supplier:</label>
                      <select class="form-control-sm border-1" style="width: 100px; height: 30px;" id="id_supplier"
                        onchange="filterData()">
                        <option value="">Supplier</option>
                        <?php echo $id_supplier_options; ?>
                      </select>
                      <input type="date" class="form-control-sm border-1" id="tanggalMulai"
                        aria-describedby="tanggalMulaiLabel">
                      <input type="date" class="form-control-sm border-1" id="tanggalAkhir"
                        aria-describedby="tanggalAkhirLabel">
                      <button type="button" class="btn btn-secondary btn-sm" style="width: 60px; height: 30px;"
                        onclick="filterData()">
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
                        <th>ID Pembelian</th>
                        <th>Tanggal Pembelian</th>
                        <th>Termin Pembayaran</th>
                        <th>ID Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Metode Pembelian</th>
                        <th>ID Persediaan</th>
                        <th>Nama Persediaan</th>
                        <th>Jumlah Pembelian</th>
                        <th>Harga Pembelian</th>
                        <th>Total Pembelian</th>
                        <th>PPN Masukan</th>
                        <th>Total Bayar</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM keu_pembelian";
                      $result = mysqli_query($conn, $query);
                      while ($data = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<td>".$data['id_beli']."</td>";
                          echo "<td>".$data['tanggal_beli']."</td>";
                          echo "<td>".$data['termin_pembayaran']."</td>";
                          echo "<td>".$data['id_supplier']."</td>";
                          echo "<td>".$data['nama_supplier']."</td>";
                          echo "<td>".$data['metode_beli']."</td>";
                          echo "<td>".$data['id_persediaan']."</td>";
                          echo "<td>".$data['nama_persediaan']."</td>";
                          echo "<td>".$data['jumlah_beli']."</td>";
                          echo "<td>".number_format($data['harga_beli'], 2, ',', '.')."</td>";
                          echo "<td>".number_format($data['total_beli'], 2, ',', '.')."</td>";
                          echo "<td>".number_format($data['ppn_masukan'], 2, ',', '.')."</td>";
                          echo "<td>".number_format($data['total_bayar'], 2, ',', '.')."</td>";
                          echo "<td>";
                          echo "<button type='button' class='btn btn-success btn-sm' style='width: 30px; height: 30px;' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"".$data['id_beli']."\", \"".$data['tanggal_beli']."\", \"".$data['termin_pembayaran']."\", \"".$data['id_supplier']."\", \"".$data['nama_supplier']."\", \"".$data['metode_beli']."\", \"".$data['id_persediaan']."\", \"".$data['nama_persediaan']."\", \"".$data['jumlah_beli']."\", \"".$data['harga_beli']."\", \"".$data['total_beli']."\", \"".$data['ppn_masukan']."\", \"".$data['total_bayar']."\")'><i class='fas fa-edit'></i></button>";
                          echo "<button type='button' class='btn btn-danger btn-sm' style='width: 30px; height: 30px;' onclick='openDeleteModal(\"".$data['id_beli']."\")'><i class='fas fa-trash'></i></button>";
                          echo "<a href='generate_pdf.php?id_beli=".htmlspecialchars($data['id_beli'])."' class='btn btn-primary btn-sm' style='width: 30px; height: 30px;' target='_blank' role='button'><i class='fas fa-print'></i></a>";
                          echo "</td>";
                          echo "</tr>";
                      }
                      ?>
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
      function openEditModal(idBeli, tanggalBeli, idSupplier, terminPembayaran, namaSupplier, metodeBeli, idPersediaan, namaPersediaan, jumlahBeli, hargaBeli, totalBeli, ppnMasukan, totalBayar) {
        document.getElementById("edit_id_beli").value = idBeli;
        document.getElementById("edit_tanggal_beli").value = tanggalBeli;
        document.getElementById("edit_termin_pembayaran").value = terminPembayaran;
        document.getElementById("edit_id_supplier").value = idSupplier;
        document.getElementById("edit_nama_supplier").value = namaSupplier;
        document.getElementById("edit_metode_beli").value = metodeBeli;
        document.getElementById("edit_id_persediaan").value = idPersediaan;
        document.getElementById("edit_nama_persediaan").value = namaPersediaan;
        document.getElementById("edit_jumlah_beli").value = jumlahBeli;
        document.getElementById("edit_harga_beli").value = hargaBeli;
        document.getElementById("edit_total_beli").value = totalBeli;
        document.getElementById("edit_ppn_masukan").value = ppnMasukan;
        document.getElementById("edit_total_bayar").value = totalBayar;
    }

    function openDeleteModal(idBeli) {
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
            keyboard: false
        });
        deleteModal.show();
        
        // Tambahkan event listener pada tombol konfirmasi hapus
        document.getElementById('confirmDeleteBtn').onclick = function() {
            window.location.href = "?id_beli=" + idBeli;
        };
    }
    </script>
    <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->

    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js">
    </script>
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