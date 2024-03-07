@extends('layouts.main')

@section('container-fluid')

<div class="container-fluid" id="container-wrapper">
    <!-- Your container content -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Harga Jasa</h1> <!-- EDIT NAMA -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Harga Jasa</li> <!-- EDIT NAMA -->
        </ol>
    </div>
    <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
    <!-- Modal Tambah Data -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Harga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="id_datastandar" class="form-label">ID Data Standar:</label>
                            <input type="text" class="form-control" id="id_datastandar" name="id_datastandar" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_standar" class="form-label">ID Standar:</label>
                            <input type="text" class="form-control" id="id_standar" name="id_standar" required>
                        </div>
                        <div class="mb-3">
                            <label for="volume" class="form-label">Volume:</label>
                            <input type="text" class="form-control" id="volume" name="volume" required>
                        </div>
                        <div class="mb-3">
                            <label for="treatment" class="form-label">Treatment:</label>
                            <select class="form-select" id="treatment" name="treatment" required>
                                <option value="FCL">FCL</option>
                                <option value="LCL">LCL</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bbb_standar" class="form-label">BBB Standar:</label>
                            <input type="number" class="form-control" id="bbb_standar" name="bbb_standar" required>
                        </div>
                        <div class="mb-3">
                            <label for="btk_standar" class="form-label">BTK Standar:</label>
                            <input type="number" class="form-control" id="btk_standar" name="btk_standar" required>
                        </div>
                        <div class="mb-3">
                            <label for="bop_standar" class="form-label">BOP Standar:</label>
                            <input type="number" class="form-control" id="bop_standar" name="bop_standar" required>
                        </div>
                        <div class="mb-3">
                            <label for="hpp" class="form-label">HPP:</label>
                            <input type="number" class="form-control" id="hpp" name="hpp" required>
                        </div>
                        <div class="mb-3">
                            <label for="markup" class="form-label">Markup:</label>
                            <input type="number" class="form-control" id="markup" name="markup" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual:</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Data Harga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="edit_id_datastandar" class="form-label">ID Data Standar:</label>
                            <input type="text" class="form-control" id="edit_id_datastandar" name="edit_id_datastandar"
                                readonly required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_id_standar" class="form-label">ID Standar:</label>
                            <input type="text" class="form-control" id="edit_id_standar" name="edit_id_standar"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_volume" class="form-label">Volume:</label>
                            <input type="text" class="form-control" id="edit_volume" name="edit_volume" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_treatment" class="form-label">Treatment:</label>
                            <select class="form-select" id="edit_treatment" name="edit_treatment" required>
                                <option value="FCL">FCL</option>
                                <option value="LCL">LCL</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_bbb_standar" class="form-label">BBB Standar:</label>
                            <input type="number" class="form-control" id="edit_bbb_standar" name="edit_bbb_standar"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_btk_standar" class="form-label">BTK Standar:</label>
                            <input type="number" class="form-control" id="edit_btk_standar" name="edit_btk_standar"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_bop_standar" class="form-label">BOP Standar:</label>
                            <input type="number" class="form-control" id="edit_bop_standar" name="edit_bop_standar"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_hpp" class="form-label">HPP:</label>
                            <input type="number" class="form-control" id="edit_hpp" name="edit_hpp" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_markup" class="form-label">Markup:</label>
                            <input type="number" class="form-control" id="edit_markup" name="edit_markup" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_harga_jual" class="form-label">Harga Jual:</label>
                            <input type="number" class="form-control" id="edit_harga_jual" name="edit_harga_jual"
                                required>
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
                    <h6 class="m-0 font-weight-bold text-primary">Harga Jasa</h6> <!-- EDIT NAMA -->
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <!-- Tombol Tambah dengan Icon -->
                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                            data-bs-target="#addModal">
                            Tambah
                        </button>
                        <!-- Tombol Cetak Tabel dengan Icon -->
                        <button type="button" class="btn btn-sm btn-warning" onclick="cetakTabel()">
                            Cetak
                        </button>
                    </div>

                    <!-- Skrip JavaScript untuk Cetak Tabel -->
                    <script>
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
                                <th>Id Data Standar</th>
                                <th>Id Standar</th>
                                <th>Volume</th>
                                <th>Treatment</th>
                                <th>Biaya Bahan Baku</th>
                                <th>Biaya Tenaga Kerja</th>
                                <th>Biaya Overhead Pabrik</th>
                                <th>Harga Pokok Penjualan</th>
                                <th>MarkUp</th>
                                <th>Harga Jual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--
                            <?php
              $query = "SELECT * FROM data_harga";
              $result = mysqli_query($conn, $query);
              while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$data['id_datastandar']."</td>";
                echo "<td>".$data['id_standar']."</td>";
                echo "<td>".$data['volume']."</td>";
                echo "<td>".$data['treatment']."</td>";
                echo "<td>".number_format($data['bbb_standar'], 2, ',', '.')."</td>";
                echo "<td>".number_format($data['btk_standar'], 2, ',', '.')."</td>";
                echo "<td>".number_format($data['bop_standar'], 2, ',', '.')."</td>";
                echo "<td>".number_format($data['hpp'], 2, ',', '.')."</td>";
                echo "<td>".number_format($data['markup'], 2, ',', '.')."</td>";
                echo "<td>".number_format($data['harga_jual'], 2, ',', '.')."</td>";
                echo "<td>";
                echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"".$data['id_datastandar']."\", \"".$data['id_standar']."\", \"".$data['volume']."\", \"".$data['treatment']."\", \"".$data['bbb_standar']."\", \"".$data['btk_standar']."\", \"".$data['bop_standar']."\", \"".$data['hpp']."\", \"".$data['markup']."\", \"".$data['harga_jual']."\")'><i class='fas fa-edit'></i></button>";
                echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData(\"".$data['id_datastandar']."\")'><i class='fas fa-trash'></i></button>";
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

    <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
    <script>
        function openEditModal(idDataStandar, idStandar, volume, treatment, bbbStandar, btkStandar, bopStandar, hpp, markup, hargaJual) {
      document.getElementById("edit_id_datastandar").value = idDataStandar;
      document.getElementById("edit_id_standar").value = idStandar;
      document.getElementById("edit_volume").value = volume;
      document.getElementById("edit_treatment").value = treatment;
      document.getElementById("edit_bbb_standar").value = bbbStandar;
      document.getElementById("edit_btk_standar").value = btkStandar;
      document.getElementById("edit_bop_standar").value = bopStandar;
      document.getElementById("edit_hpp").value = hpp;
      document.getElementById("edit_markup").value = markup;
      document.getElementById("edit_harga_jual").value = hargaJual;
    }

    function deleteData(idDataStandar) {
      if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = "?id_datastandar=" + idDataStandar;
      }
    }
    
	// Ajax Data Table 
	$(document).ready(function () {
	  $('#dataTableHover').DataTable();
	});
    </script>
    <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->
    @endsection