@extends('layouts.main')

@section('container-fluid')
<div class="container-fluid" id="container-wrapper">
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
          <form method="POST">
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
              <select class="form-select" id="jenis_akun" name="jenis_akun" required>
                <option value="">Pilih Jenis Akun</option>
                <option value="debet">Debet</option>
                <option value="kredit">Kredit</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="kelompok_akun" class="form-label">Kelompok Akun:</label>
              <br>
              <select class="form-select" id="kelompok_akun" name="kelompok_akun" required>
                <option value="">Pilih Kelompok Akun</option>
                <option value="aset">Aset</option>
                <option value="liabilitas">Liabilitas</option>
                <option value="ekuitas">Ekuitas</option>
                <option value="modal">Modal</option>
                <option value="pendapatan">Pendapatan</option>
                <option value="bebas">Beban</option>
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
  <!-- Modal Edit Data -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data Akun</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="edit_kode_akun" class="form-label">Kode Akun:</label>
              <input type="text" class="form-control" id="edit_kode_akun" name="edit_kode_akun" readonly required>
            </div>
            <div class="mb-3">
              <label for="edit_nama_akun" class="form-label">Nama Akun:</label>
              <input type="text" class="form-control" id="edit_nama_akun" name="edit_nama_akun" required>
            </div>
            <div class="mb-3">
              <label for="edit_jenis_akun" class="form-label">Jenis Akun:</label>
              <br>
              <select class="form-select" id="edit_jenis_akun" name="edit_jenis_akun" required>
                <option value="">Pilih Jenis Akun</option>
                <option value="debet">Debet</option>
                <option value="kredit">Kredit</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="edit_kelompok_akun" class="form-label">Kelompok Akun:</label>
              <br>
              <select class="form-select" id="edit_kelompok_akun" name="edit_kelompok_akun" required>
                <option value="">Pilih Kelompok Akun</option>
                <option value="aset">Aset</option>
                <option value="liabilitas">Liabilitas</option>
                <option value="ekuitas">Ekuitas</option>
                <option value="modal">Modal</option>
                <option value="pendapatan">Pendapatan</option>
                <option value="beban">Beban</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="edit_saldo_akun" class="form-label">Saldo Akun:</label>
              <input type="number" class="form-control" id="edit_saldo_akun" name="edit_saldo_akun" required>
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
            <!-- Tombol Filter Tanggal dengan Icon -->
            <div class="input-group">
              <input type="date" class="form-control-sm border-0" id="tanggalMulai"
                aria-describedby="tanggalMulaiLabel">
              <input type="date" class="form-control-sm border-0" id="tanggalAkhir"
                aria-describedby="tanggalAkhirLabel">
              <button type="button" class="btn btn-secondary btn-sm" onclick="filterTanggal()">
                Filter
              </button>
            </div>
            <!-- Tombol Cetak Tabel dengan Icon -->
            <button type="button" class="btn btn-sm btn-warning" onclick="cetakTabel()">
              Cetak
            </button>
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
                <th>Kode AKun</th>
                <th>Nama Akun</th>
                <th>Jenis Akun</th>
                <th>Kelompok Akun</th>
                <th>Saldo Akun</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              {{--
              <?php
              $query = "SELECT * FROM keu_akun";
              $result = mysqli_query($conn, $query);
              while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $data['kode_akun'] . "</td>";
                echo "<td>" . $data['nama_akun'] . "</td>";
                echo "<td>" . $data['jenis_akun'] . "</td>";
                echo "<td>" . $data['kelompok_akun'] . "</td>";
                echo "<td>" . number_format($data['saldo_akun'], 2, ',', '.') . "</td>";
                echo "<td>";
                echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"" . $data['kode_akun'] . "\", \"" . $data['nama_akun'] . "\", \"" . $data['jenis_akun'] . "\", \"" . $data['kelompok_akun'] . "\", \"" . $data['saldo_akun'] . "\")'><i class='fas fa-edit'></i></button>";
                echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData(\"" . $data['kode_akun'] . "\")'><i class='fas fa-trash'></i></button>";
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
@endsection