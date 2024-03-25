@extends('layouts.main')

@section('container-fluid')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div class="container-fluid" id="container-wrapper">
  @if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h3>Pesan Error</h3>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <!-- Your container content -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Order</h1> <!-- EDIT NAMA -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Master</a></li>
      <li class="breadcrumb-item active" aria-current="page">Order</li> <!-- EDIT NAMA -->
    </ol>
  </div>
  <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
  <!-- Modal Tambah Data -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="id_order" class="form-label">ID Order:</label>
              <input type="text" class="form-control" id="id_order" name="id_order" required>
            </div>
            <div class="mb-3">
              <label for="id_order_container" class="form-label">ID Order Container:</label>
              <input type="text" class="form-control" id="id_order_container" name="id_order_container" required>
            </div>
            <div class="mb-3">
              <label for="tanggal_order" class="form-label">Tanggal Order:</label>
              <input type="date" class="form-control" id="tanggal_order" name="tanggal_order" required>
            </div>
            <div class="mb-3">
              <label for="id_customer" class="form-label">ID Customer:</label>
              <select class="form-control" id="id_customer" name="id_customer" onchange="addData()" required>
                <option value="">Pilih ID Customer</option>
                @foreach ($dataCustomers as $dataCustomer)
                <option value="{{ $dataCustomer->id }}">{{$dataCustomer->id_customer}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="nama_customer" class="form-label">Nama Customer:</label>
              <!-- Input ini akan diisi otomatis berdasarkan pilihan ID Customer -->
              <input type="text" class="form-control" id="vnama_customer" name="nama_customer" required readonly>
            </div>
            <div class="mb-3">
              <label for="telp_customer" class="form-label">Telepon Customer:</label>
              <!-- Input ini akan diisi otomatis berdasarkan pilihan ID Customer -->
              <input type="text" class="form-control" id="vtelp_customer" name="telp_customer" required readonly>
            </div>
            <div class="mb-3">
              <label for="jumlah_order" class="form-label">Jumlah Order:</label>
              <input type="number" class="form-control" id="jumlah_order" name="jumlah_order" required>
            </div>
            <div class="mb-3">
              <label for="treatment" class="form-label">Treatment:</label>
              <select class="form-control" id="treatment" name="treatment" required>
                <option value="">Pilih Treatment</option>
                @foreach ($hargaJasa as $harga)
                <option value="{{ $harga->treatment }}">{{$harga->treatment}}</option>
                @endforeach
                <!-- Isi dropdown dengan data dari tabel data_harga -->
                <?php
                        // Tambahkan skrip PHP untuk mengambil data dari tabel data_harga
                        // Contoh: $treatments = mysqli_query($koneksi, "SELECT DISTINCT treatment FROM data_harga");
                        // while ($row = mysqli_fetch_assoc($treatments)) {
                        //     echo "<option value='" . $row['treatment'] . "'>" . $row['treatment'] . "</option>";
                        // }
                        ?>
              </select>
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
              <label for="commodity" class="form-label">Commodity:</label>
              <input type="text" class="form-control" id="commodity" name="commodity" required>
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
              <label for="edit_id_order" class="form-label">ID Standar:</label>
              <input type="text" class="form-control" id="edit_id_order" name="edit_id_order" readonly required>
            </div>
            <div class="mb-3">
              <label for="edit_tanggal_order" class="form-label">tanggal_order:</label>
              <input type="number" class="form-control" id="edit_tanggal_order" name="edit_tanggal_order" required>
            </div>
            <div class="mb-3">
              <label for="edit_id_customer" class="form-label">id_customer:</label>
              <input type="number" class="form-control" id="edit_id_customer" name="edit_id_customer" required>
            </div>
            <div class="mb-3">
              <label for="edit_nama_customer" class="form-label">Nama Customer:</label>
              <input type="number" class="form-control" id="edit_nama_customer" name="edit_nama_customer" required>
            </div>
            <div class="mb-3">
              <label for="edit_telp_customer" class="form-label">Telepon Customer:</label>
              <input type="number" class="form-control" id="edit_telp_customer" name="edit_telp_customer" required>
            </div>
            <div class="mb-3">
              <label for="edit_jumlah_order" class="form-label">Jumlah Order:</label>
              <input type="number" class="form-control" id="edit_jumlah_order" name="edit_jumlah_order" required>
            </div>
            <div class="mb-3">
              <label for="edit_treatment" class="form-label">Treatment:</label>
              <input type="dropdown" class="form-control" id="edit_treatment" name="edit_treatment" required>
            </div>
            <div class="mb-3">
              <label for="edit_stuffing_date" class="form-label">Stuffing Date:</label>
              <input type="number" class="form-control" id="edit_stuffing_date" name="edit_stuffing_date" required>
            </div>
            <div class="mb-3">
              <label for="edit_id_datastandar" class="form-label">ID Data Standar:</label>
              <input type="number" class="form-control" id="edit_id_datastandar" name="edit_id_datastandar" required>
            </div>
            <div class="mb-3">
              <label for="edit_volume" class="form-label">Volume:</label>
              <input type="number" class="form-control" id="edit_volume" name="edit_volume" required>
            </div>
            <div class="mb-3">
              <label for="container" class="form-label">Container:</label>
              <input type="text" class="form-control" id="container" name="container" required>
            </div>
            <div class="mb-3">
              <label for="edit_container_volume" class="form-label"> Container Volume:</label>
              <input type="number" class="form-control" id="edit_container_volume" name="edit_container_volume"
                required>
            </div>
            <div class="mb-3">
              <label for="edit_commodity" class="form-label">Commodity:</label>
              <input type="text" class="form-control" id="edit_commodity" name="edit_commodity" required>
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
          <h6 class="m-0 font-weight-bold text-primary">Order</h6> <!-- EDIT NAMA -->
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
                <th>Id Order</th>
                <th>Id Order Container</th>
                <th>Tanggal Order</th>
                <th>ID Customer</th>
                <th>Nama Customer</th>
                <th>Telepon Customer</th>
                <th>Jumlah Order</th>
                <th>Treatment</th>
                <th>Stuffing Date</th>
                <th>ID Data Standar</th>
                <th>Volume</th>
                <th>Container</th>
                <th>Container Volume</th>
                <th>Commodity</th>
                <th>Vessel</th>
                <th>Closing Time</th>
                <th>Destination</th>
                <th>Place Fumigation</th>
                <th>PIC</th>
                <th>Phone PIC</th>
                <th>Status</th>
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
                  echo "<td>".$data['id_order']."</td>";
                  echo "<td>".$data['id_order_container']."</td>";
                  echo "<td>".$data['tanggal_order']."</td>";
                  echo "<td>".$data['id_customer']."</td>";
                  echo "<td>".$data['nama_customer']."</td>";
                  echo "<td>".$data['telp_customer']."</td>";
                  echo "<td>".$data['jumlah_order']."</td>";
                  echo "<td>".$data['treatment']."</td>";
                  echo "<td>".$data['stuffing_date']."</td>";
                  echo "<td>".$data['id_datastandar']."</td>";
                  echo "<td>".$data['volume']."</td>";
                  echo "<td>".$data['container']."</td>";
                  echo "<td>".$data['container_volume']."</td>";
                  echo "<td>".$data['commodity']."</td>";
                  echo "<td>".$data['vessel']."</td>";
                  echo "<td>".$data['closing_time']."</td>";
                  echo "<td>".$data['destination']."</td>";
                  echo "<td>".$data['place_fumigation']."</td>";
                  echo "<td>".$data['pic']."</td>";
                  echo "<td>".$data['phone_pic']."</td>";
                  echo "<td><span class='badge badge-success'>Delivered</span></td>";
                  echo "<td>";
                  echo "<button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' onclick='openEditModal(\"".$data['id_order_container']."\", \"".$data['tanggal_order']."\", \"".$data['id_customer']."\", \"".$data['nama_customer']."\", \"".$data['telp_customer']."\")'><i class='fas fa-edit'></i></button>";
                  echo "<button type='button' class='btn btn-danger btn-sm' onclick='deleteData(\"".$data['id_order_container']."\")'><i class='fas fa-trash'></i></button>";
                  echo "<a href='generate_pdf.php?id_order_container=".htmlspecialchars($data['id_order_container'])."' class='btn btn-primary btn-sm' target='_blank' role='button'><i class='fas fa-print'></i></a>";
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>
    function addData(){
      alert('ajsgsdukasbd');
      var id = $("#id_customer").val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        url : "ajax-order",
        method : "POST",
        data : { 
          id:id
        },
        dataType : "json",
        success : function(data){
          $('#vnama_customer').val(data.nama_customer),
          $('#vtelp_customer').val(data.telp_customer)
        }
      })
    }
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
    
    function openEditModal(idorder, idordercontainer, tanggal_order, id_customer, namacustomer, telpcustomer, jumlahorder, treatment, stuffing_date, iddatastandar) {
        document.getElementById("edit_id_order").value = idorder;
        document.getElementById("edit_id_order_container").value = idordercontainer;
        document.getElementById("edit_tanggal_order").value = tanggal_order;
        document.getElementById("edit_id_customer").value = id_customer;
        document.getElementById("edit_nama_customer").value = namacustomer;
        document.getElementById("edit_telp_customer").value = telpcustomer;
        document.getElementById("edit_jumlah_order").value = jumlahorder;
        document.getElementById("edit_treatment").value = treatment;
        document.getElementById("edit_stuffing_date").value = stuffing_date;
        document.getElementById("edit_id_datastandar").value = iddatastandar;
        document.getElementById("edit_volume").value = idorder;
        document.getElementById("edit_container").value = idordercontainer;
        document.getElementById("edit_container_volume").value = tanggal_order;
        document.getElementById("edit_commodity").value = id_customer;
        document.getElementById("edit_vessel").value = namacustomer;
        document.getElementById("edit_closing_time").value = telpcustomer;
        document.getElementById("edit_destination").value = jumlahorder;
        document.getElementById("edit_place_fumigation").value = treatment;
        document.getElementById("edit_pic").value = stuffing_date;
        document.getElementById("edit_phone_pic").value = iddatastandar;
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