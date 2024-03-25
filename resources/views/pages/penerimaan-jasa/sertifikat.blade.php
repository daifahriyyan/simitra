@extends('layouts.main')

@section('container-fluid')
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <!-- Your container content -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sertifikat</h1> <!-- EDIT NAMA -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Master</a></li>
      <li class="breadcrumb-item active" aria-current="page">Sertifikat</li> <!-- EDIT NAMA -->
    </ol>
  </div>
  <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
  <!-- Modal Tambah Data -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data sertif</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('Sertifikat') }}">
            @csrf
            <div class="mb-3">
              <label for="id_sertif" class="form-label">ID Sertif:</label>
              <input type="text" class="form-control" id="id_sertif" name="id_sertif" required>
            </div>
            <div class="mb-3">
              <label for="id_reg" class="form-label">ID Reg:</label>
              <input type="text" class="form-control" id="id_reg" name="id_reg" required>
            </div>
            <div class="mb-3">
              <label for="target" class="form-label">Target:</label>
              <input type="number" class="form-control" id="target" name="target" required>
            </div>
            <div class="mb-3">
              <label for="commodity" class="form-label">Commodity:</label>
              <input type="text" class="form-control" id="commodity" name="commodity" required>
            </div>
            <div class="mb-3">
              <label for="consignment" class="form-label">Consignment:</label>
              <input type="text" class="form-control" id="consignment" name="consignment" required>
            </div>
            <div class="mb-3">
              <label for="country" class="form-label">Country:</label>
              <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <div class="mb-3">
              <label for="pol" class="form-label">POL:</label>
              <input type="text" class="form-control" id="pol" name="pol" required>
            </div>
            <div class="mb-3">
              <label for="destination" class="form-label">Destination:</label>
              <input type="text" class="form-control" id="destination" name="destination" required>
            </div>
            <div class="mb-3">
              <label for="id_order_container" class="form-label">ID Order Container:</label>
              <input type="text" class="form-control" id="id_order_container" name="id_order_container" required>
            </div>
            <div class="mb-3">
              <label for="nama_customer" class="form-label">Nama Customer:</label>
              <input type="text" class="form-control" id="nama_customer" name="nama_customer" required readonly>
            </div>
            <div class="mb-3">
              <label for="telp_customer" class="form-label">Telepon Customer:</label>
              <input type="text" class="form-control" id="telp_customer" name="telp_customer" required readonly>
            </div>
            <div class="mb-3">
              <label for="jumlah_order" class="form-label">Jumlah Order:</label>
              <input type="number" class="form-control" id="jumlah_order" name="jumlah_order" required>
            </div>
            <div class="mb-3">
              <label for="treatment" class="form-label">Treatment:</label>
              <input type="text" class="form-control" id="treatment" name="treatment" required>
            </div>
            <div class="mb-3">
              <label for="stuffing_date" class="form-label">Stuffing Date:</label>
              <input type="date" class="form-control" id="stuffing_date" name="stuffing_date" required>
            </div>
            <div class="mb-3">
              <label for="id_datastandar" class="form-label">ID Data Standar:</label>
              <input type="text" class="form-control" id="id_datastandar" name="id_datastandar" required>
            </div>
            <div class="mb-3">
              <label for="volume" class="form-label">Volume:</label>
              <input type="number" class="form-control" id="volume" name="volume" required>
            </div>
            <div class="mb-3">
              <label for="container" class="form-label">Container:</label>
              <input type="text" class="form-control" id="container" name="container" required>
            </div>
            <div class="mb-3">
              <label for="container_volume" class="form-label">Container Volume:</label>
              <input type="number" class="form-control" id="container_volume" name="container_volume" required>
            </div>
            <div class="mb-3">
              <label for="vessel" class="form-label">Vessel:</label>
              <input type="text" class="form-control" id="vessel" name="vessel" required>
            </div>
            <div class="mb-3">
              <label for="place_fumigation" class="form-label">Place Fumigation:</label>
              <input type="date" class="form-control" id="place_fumigation" name="place_fumigation" required>
            </div>
            <div class="mb-3">
              <label for="pic" class="form-label">PIC:</label>
              <input type="text" class="form-control" id="pic" name="pic" required>
            </div>
            <div class="mb-3">
              <label for="phone_pic" class="form-label">Phone PIC:</label>
              <input type="number" class="form-control" id="phone_pic" name="phone_pic" required>
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
          <h5 class="modal-title" id="editModalLabel">Edit Data Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="edit_id_sertif" class="form-label">ID Sertif:</label>
              <input type="text" class="form-control" id="edit_id_sertif" name="edit_id_sertif" required>
            </div>
            <div class="mb-3">
              <label for="edit_id_reg" class="form-label">ID Reg:</label>
              <input type="text" class="form-control" id="edit_id_reg" name="edit_id_reg" required>
            </div>
            <div class="mb-3">
              <label for="edit_target" class="form-label">Target:</label>
              <input type="number" class="form-control" id="edit_target" name="edit_target" required>
            </div>
            <div class="mb-3">
              <label for="edit_commodity" class="form-label">Commodity:</label>
              <input type="text" class="form-control" id="edit_commodity" name="edit_commodity" required>
            </div>
            <div class="mb-3">
              <label for="edit_consignment" class="form-label">Consignment:</label>
              <input type="text" class="form-control" id="edit_consignment" name="edit_consignment" required>
            </div>
            <div class="mb-3">
              <label for="edit_country" class="form-label">Country:</label>
              <input type="text" class="form-control" id="edit_country" name="edit_country" required>
            </div>
            <div class="mb-3">
              <label for="edit_pol" class="form-label">POL:</label>
              <input type="text" class="form-control" id="edit_pol" name="edit_pol" required>
            </div>
            <div class="mb-3">
              <label for="edit_destination" class="form-label">Destination:</label>
              <input type="text" class="form-control" id="edit_destination" name="edit_destination" required>
            </div>
            <div class="mb-3">
              <label for="edit_id_order_container" class="form-label">ID Order Container:</label>
              <input type="text" class="form-control" id="edit_id_order_container" name="edit_id_order_container"
                required>
            </div>
            <div class="mb-3">
              <label for="edit_nama_customer" class="form-label">Nama Customer:</label>
              <input type="text" class="form-control" id="edit_nama_customer" name="edit_nama_customer" required
                readonly>
            </div>
            <div class="mb-3">
              <label for="edit_telp_customer" class="form-label">Telepon Customer:</label>
              <input type="text" class="form-control" id="edit_telp_customer" name="edit_telp_customer" required
                readonly>
            </div>
            <div class="mb-3">
              <label for="edit_jumlah_order" class="form-label">Jumlah Order:</label>
              <input type="number" class="form-control" id="edit_jumlah_order" name="edit_jumlah_order" required>
            </div>
            <div class="mb-3">
              <label for="edit_treatment" class="form-label">Treatment:</label>
              <input type="text" class="form-control" id="edit_treatment" name="edit_treatment" required>
            </div>
            <div class="mb-3">
              <label for="edit_stuffing_date" class="form-label">Stuffing Date:</label>
              <input type="date" class="form-control" id="edit_stuffing_date" name="edit_stuffing_date" required>
            </div>
            <div class="mb-3">
              <label for="edit_id_datastandar" class="form-label">ID Data Standar:</label>
              <input type="text" class="form-control" id="edit_id_datastandar" name="edit_id_datastandar" required>
            </div>
            <div class="mb-3">
              <label for="edit_volume" class="form-label">Volume:</label>
              <input type="number" class="form-control" id="edit_volume" name="edit_volume" required>
            </div>
            <div class="mb-3">
              <label for="edit_container" class="form-label">Container:</label>
              <input type="text" class="form-control" id="edit_container" name="edit_container" required>
            </div>
            <div class="mb-3">
              <label for="edit_container_volume" class="form-label">Container Volume:</label>
              <input type="number" class="form-control" id="edit_container_volume" name="edit_container_volume"
                required>
            </div>
            <div class="mb-3">
              <label for="edit_vessel" class="form-label">Vessel:</label>
              <input type="text" class="form-control" id="edit_vessel" name="edit_vessel" required>
            </div>
            <div class="mb-3">
              <label for="edit_place_fumigation" class="form-label">Place Fumigation:</label>
              <input type="date" class="form-control" id="edit_place_fumigation" name="edit_place_fumigation" required>
            </div>
            <div class="mb-3">
              <label for="edit_pic" class="form-label">PIC:</label>
              <input type="text" class="form-control" id="edit_pic" name="edit_pic" required>
            </div>
            <div class="mb-3">
              <label for="edit_phone_pic" class="form-label">Phone PIC:</label>
              <input type="number" class="form-control" id="edit_phone_pic" name="edit_phone_pic" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>

        <div class="mb-3">
          <label for="id_reg" class="form-label">ID Reg:</label>
          <input type="text" class="form-control" id="id_reg" name="id_reg" required>
        </div>
        <div class="mb-3">
          <label for="target" class="form-label">Target:</label>
          <input type="number" class="form-control" id="target" name="target" required>
        </div>
        <div class="mb-3">
          <label for="commodity" class="form-label">Commodity:</label>
          <input type="text" class="form-control" id="commodity" name="commodity" required>
        </div>
        <div class="mb-3">
          <label for="consignment" class="form-label">Consignment:</label>
          <input type="text" class="form-control" id="consignment" name="consignment" required>
        </div>
        <div class="mb-3">
          <label for="country" class="form-label">Country:</label>
          <input type="text" class="form-control" id="country" name="country" required>
        </div>
        <div class="mb-3">
          <label for="pol" class="form-label">POL:</label>
          <input type="text" class="form-control" id="pol" name="pol" required>
        </div>
        <div class="mb-3">
          <label for="destination" class="form-label">Destination:</label>
          <input type="text" class="form-control" id="destination" name="destination" required>
        </div>
        <div class="mb-3">
          <label for="id_order_container" class="form-label">ID Order Container:</label>
          <input type="text" class="form-control" id="id_order_container" name="id_order_container" required>
        </div>
        <div class="mb-3">
          <label for="nama_customer" class="form-label">Nama Customer:</label>
          <input type="text" class="form-control" id="nama_customer" name="nama_customer" required readonly>
        </div>
        <div class="mb-3">
          <label for="telp_customer" class="form-label">Telepon Customer:</label>
          <input type="text" class="form-control" id="telp_customer" name="telp_customer" required readonly>
        </div>
        <div class="mb-3">
          <label for="jumlah_order" class="form-label">Jumlah Order:</label>
          <input type="number" class="form-control" id="jumlah_order" name="jumlah_order" required>
        </div>
        <div class="mb-3">
          <label for="treatment" class="form-label">Treatment:</label>
          <input type="text" class="form-control" id="treatment" name="treatment" required>
        </div>
        <div class="mb-3">
          <label for="stuffing_date" class="form-label">Stuffing Date:</label>
          <input type="date" class="form-control" id="stuffing_date" name="stuffing_date" required>
        </div>
        <div class="mb-3">
          <label for="id_datastandar" class="form-label">ID Data Standar:</label>
          <input type="text" class="form-control" id="id_datastandar" name="id_datastandar" required>
        </div>
        <div class="mb-3">
          <label for="volume" class="form-label">Volume:</label>
          <input type="number" class="form-control" id="volume" name="volume" required>
        </div>
        <div class="mb-3">
          <label for="container" class="form-label">Container:</label>
          <input type="text" class="form-control" id="container" name="container" required>
        </div>
        <div class="mb-3">
          <label for="container_volume" class="form-label">Container Volume:</label>
          <input type="number" class="form-control" id="container_volume" name="container_volume" required>
        </div>
        <div class="mb-3">
          <label for="vessel" class="form-label">Vessel:</label>
          <input type="text" class="form-control" id="vessel" name="vessel" required>
        </div>
        <div class="mb-3">
          <label for="place_fumigation" class="form-label">Place Fumigation:</label>
          <input type="date" class="form-control" id="place_fumigation" name="place_fumigation" required>
        </div>
        <div class="mb-3">
          <label for="pic" class="form-label">PIC:</label>
          <input type="text" class="form-control" id="pic" name="pic" required>
        </div>
        <div class="mb-3">
          <label for="phone_pic" class="form-label">Phone PIC:</label>
          <input type="number" class="form-control" id="phone_pic" name="phone_pic" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
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
          <h6 class="m-0 font-weight-bold text-primary">Sertifikat</h6> <!-- EDIT NAMA -->
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
                <th>ID Sertif</th>
                <th>ID Reg</th>
                <th>Target</th>
                <th>Commodity</th>
                <th>Consignment</th>
                <th>Country</th>
                <th>POL</th>
                <th>Destination</th>
                <th>ID Order Container</th>
                <th>Nama Customer</th>
                <th>Telepon Customer</th>
                <th>Jumlah Order</th>
                <th>Treatment</th>
                <th>Stuffing Date</th>
                <th>ID Data Standar</th>
                <th>Volume</th>
                <th>Container</th>
                <th>Container Volume</th>
                <th>Vessel</th>
                <th>Place Fumigation</th>
                <th>PIC</th>
                <th>Phone PIC</th>
                <th>Tanggal Sertif</th>
                <th>NoReg</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              {{--
              <?php
              $query = "SELECT * FROM data_order";
              $result = mysqli_query($conn, $query);
              while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $data['id_sertif'] . "</td>";
                echo "<td>" . $data['Id_reg'] . "</td>";
                echo "<td>" . $data['Target'] . "</td>";
                echo "<td>" . $data['commodity'] . "</td>";
                echo "<td>" . $data['Consignment'] . "</td>";
                echo "<td>" . $data['Country'] . "</td>";
                echo "<td>" . $data['POL'] . "</td>";
                echo "<td>" . $data['destination'] . "</td>";
                echo "<td>" . $data['id_order_container'] . "</td>";
                echo "<td>" . $data['nama_customer'] . "</td>";
                echo "<td>" . $data['telp_customer'] . "</td>";
                echo "<td>" . $data['jumlah_order'] . "</td>";
                echo "<td>" . $data['treatment'] . "</td>";
                echo "<td>" . $data['stuffing_date'] . "</td>";
                echo "<td>" . $data['id_datastandar'] . "</td>";
                echo "<td>" . $data['volume'] . "</td>";
                echo "<td>" . $data['container'] . "</td>";
                echo "<td>" . $data['container_volume'] . "</td>";
                echo "<td>" . $data['vessel'] . "</td>";
                echo "<td>" . $data['place_fumigation'] . "</td>";
                echo "<td>" . $data['pic'] . "</td>";
                echo "<td>" . $data['phone_pic'] . "</td>";
                echo "<td>" . $data['Tanggal_sertif'] . "</td>";
                echo "<td>" . $data['NoReg'] . "</td>";
                echo "<td><span class='badge badge-success'>Delivered</span></td>";
                echo "<td>";
                echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"" . $data['id_order_container'] . "\", \"" . $data['tanggal_order'] . "\", \"" . $data['id_customer'] . "\", \"" . $data['nama_customer'] . "\", \"" . $data['telp_customer'] . "\")'><i class='fas fa-edit'></i></button>";
                echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData(\"" . $data['id_order_container'] . "\")'><i class='fas fa-trash'></i></button>";
                echo "<a href='generate_pdf.php?id_order_container=" . htmlspecialchars($data['id_order_container']) . "' class='btn btn-primary btn-sm' target='_blank' role='button'><i class='fas fa-print'></i></a>";
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
    
    function openEditModal(id_sertif, Id_reg, Target, commodity, Consignment, Country, POL, destination, id_order_container, nama_customer, telp_customer, ATTN, TIN, id_importer, nama_importer, alamat_importer, telp_importer, fax, usci, pic, id_recorsheet, tanggal_selesai, daff_prescribed_doses_rate, forecast_minimum_temperature, exposure_period, applied_dose_rate, Fumigation_Conducted, Container, Wrapping, Tanggal_sertif, NoReg) {
      document.getElementById("edit_id_sertif").value = id_sertif;
      document.getElementById("edit_Id_reg").value = Id_reg;
      document.getElementById("edit_Target").value = Target;
      document.getElementById("edit_commodity").value = commodity;
      document.getElementById("edit_Consignment").value = Consignment;
      document.getElementById("edit_Country").value = Country;
      document.getElementById("edit_POL").value = POL;
      document.getElementById("edit_destination").value = destination;
      document.getElementById("edit_id_order_container").value = id_order_container;
      document.getElementById("edit_nama_customer").value = nama_customer;
      document.getElementById("edit_telp_customer").value = telp_customer;
      document.getElementById("edit_ATTN").value = ATTN;
      document.getElementById("edit_TIN").value = TIN;
      document.getElementById("edit_id_importer").value = id_importer;
      document.getElementById("edit_nama_importer").value = nama_importer;
      document.getElementById("edit_alamat_importer").value = alamat_importer;
      document.getElementById("edit_telp_importer").value = telp_importer;
      document.getElementById("edit_fax").value = fax;
      document.getElementById("edit_usci").value = usci;
      document.getElementById("edit_pic").value = pic;
      document.getElementById("edit_id_recorsheet").value = id_recorsheet;
      document.getElementById("edit_tanggal_selesai").value = tanggal_selesai;
      document.getElementById("edit_daff_prescribed_doses_rate").value = daff_prescribed_doses_rate;
      document.getElementById("edit_forecast_minimum_temperature").value = forecast_minimum_temperature;
      document.getElementById("edit_exposure_period").value = exposure_period;
      document.getElementById("edit_applied_dose_rate").value = applied_dose_rate;
      document.getElementById("edit_Fumigation_Conducted").value = Fumigation_Conducted;
      document.getElementById("edit_Container").value = Container;
      document.getElementById("edit_Wrapping").value = Wrapping;
      document.getElementById("edit_Tanggal_sertif").value = Tanggal_sertif;
      document.getElementById("edit_NoReg").value = NoReg;
    }


    function deleteData(idordercontainer) {
      if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = "?id_order=" + idorder;
      }
    }
    
	// Ajax Data Table 
	$(document).ready(function () {
	  $('#dataTableHover').DataTable();
	});
  </script>
  @endsection