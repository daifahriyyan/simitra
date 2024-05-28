@extends('layouts.main')

@section('container-fluid')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
  @if (session()->has('error'))
  <div class="row">
    <div class="col d-flex justify-content-center">
      <div class="alert alert-danger alert-dismissible fade show" style="min-height: 50px; width:500px;" role="alert">
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

  @foreach ($detailOrder as $record)
  <!-- Modal Edit Data -->
  <div class="modal fade" id="editModal{{ $record->id }}" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data Pegawai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="mb-3">
              <label for="id_order" class="form-label">ID Standar:</label>
              <input type="text" class="form-control" id="id_order" name="id_order"
                value="{{ $record->dataOrder->id_order }}" readonly required>
            </div>
            <div class="mb-3">
              <label for="tanggal_order" class="form-label">tanggal_order:</label>
              <input type="text" class="form-control" id="tanggal_order" name="tanggal_order"
                value="{{ $record->dataOrder->tanggal_order }}" readonly required>
            </div>
            <div class="mb-3">
              <label for="id_order" class="form-label">ID Order:</label>
              {{-- <input type="number" class="form-control" id="id_order" name="id_order" required> --}}
              <select class="form-control form-select-lg" name="id_order" id="id_order">
                <option selected>{{ $record->dataOrder->id_order }}</option>
                @foreach ($dataOrder as $item)
                <option value="{{ $item->id }}">{{ $item->id_order }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="id_customer" class="form-label">id_customer:</label>
              {{-- <input type="number" class="form-control" id="id_customer" name="id_customer" required> --}}
              <select class="form-control form-select-lg" name="id_customer" id="id_customer">
                <option selected>{{ $record->dataOrder->dataCustomer->nama_customer }} ({{
                  $record->dataOrder->dataCustomer->id_customer }})</option>
                @foreach ($dataCustomers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->nama_customer }} ({{ $customer->id_customer }})
                </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="stuffing_date" class="form-label">Stuffing Date:</label>
              <input type="date" class="form-control" id="stuffing_date" name="stuffing_date"
                value="{{ $record->stuffing_date }}" readonly required>
            </div>
            <div class="mb-3">
              <label for="id_datastandar" class="form-label">ID Data Standar:</label>
              <input type="text" class="form-control" id="id_datastandar" name="id_datastandar"
                value="{{ $record->id_datastandar }}" readonly required>
            </div>
            <div class="mb-3">
              <label for="container" class="form-label">Container:</label>
              <input type="text" class="form-control" id="container" name="container" value="{{ $record->container }}"
                required>
            </div>
            <div class="mb-3">
              <label for="container_volume" class="form-label"> Container Volume:</label>
              <input type="number" class="form-control" id="container_volume" name="container_volume"
                value="{{ $record->container_volume }}" required>
            </div>
            <div class="mb-3">
              <label for="commodity" class="form-label">Commodity:</label>
              <input type="text" class="form-control" id="commodity" name="commodity" value="{{ $record->commodity }}"
                required>
            </div>
            <div class="mb-3">
              <label for="vessel" class="form-label">Vessel:</label>
              <input type="text" class="form-control" id="vessel" name="vessel" value="{{ $record->vessel }}" required>
            </div>
            <div class="mb-3">
              <label for="destination" class="form-label">Destination:</label>
              <input type="text" class="form-control" id="destination" name="destination"
                value="{{ $record->destination }}" required>
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
        <form method="POST" action="{{ route('Hapus Data Order', $record->id) }}">
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
          <h6 class="m-0 font-weight-bold text-primary">Order</h6> <!-- EDIT NAMA -->
          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <!-- Tombol Tambah dengan Icon -->
            {{-- <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#addModal">
              Tambah
            </button> --}}
            <!-- Tombol Filter Tanggal dengan Icon -->
            <div class="input-group">
              <form action="{{ route('Data Order') }}">
                <input type="date" class="form-control-sm border-1" id="tanggalMulai"
                  value="{{ request()->tanggalMulai }}" name="tanggalMulai" aria-describedby="tanggalMulaiLabel">
                <input type="date" class="form-control-sm border-1" id="tanggalAkhir"
                  value="{{ request()->tanggalAkhir }}" name="tanggalAkhir" aria-describedby="tanggalAkhirLabel">
                <button type="subnit" class="btn btn-secondary btn-sm" style="width: 60px; height: 30px;">
                  Filter
                </button>
              </form>
            </div>
            <!-- Tombol Cetak Tabel dengan Icon -->
            <a href="{{ route('Data Order') }}?export=pdf{{ (request()->tanggalMulai)? '&tanggalMulai='.request()->tanggalMulai : '' }}{{ (request()->tanggalAkhir)? '&tanggalAkhir='.request()->tanggalAkhir : '' }}"
              class="btn btn-sm btn-warning">
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
          <table class="table align-items-center table-flush table-hover text-nowrap" id="dataTableHover">
            <!-- AWAL EDIT SESUAIKAN TABEL DATABASE -->
            <thead class="thead-light">
              <tr>
                <th>Id Order</th>
                <th>Id Detail Order</th>
                <th>Tanggal Order</th>
                <th>ID Customer</th>
                <th>Nama Customer</th>
                <th>Telepon Customer</th>
                <th>Alamat Customer</th>
                <th>PIC</th>
                <th>Phone PIC</th>
                <th>Jumlah Order</th>
                <th>ID Data Standar</th>
                <th>Treatment</th>
                <th>Volume</th>
                <th>Place Fumigation</th>
                <th>Stuffing Date</th>
                <th>Container</th>
                <th>Container Volume</th>
                <th>Commodity</th>
                <th>Vessel</th>
                <th>Closing Time</th>
                <th>Destination</th>
                <th>Nama Driver</th>
                <th>Telp Driver</th>
                <th>Berkas Shipment Instruction</th>
                <th>Berkas Packing List</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($detailOrder as $item)
              <tr>
                <td>{{ $item->dataOrder->id_order }}</td>
                <td>{{ $item->id_detailorder }}</td>
                <td>{{ $item->dataOrder->tanggal_order }}</td>
                <td>{{ $item->dataOrder->dataCustomer->id_customer }}</td>
                <td>{{ $item->dataOrder->dataCustomer->nama_customer }}</td>
                <td>{{ $item->dataOrder->dataCustomer->telepon_customer }}</td>
                <td>{{ $item->dataOrder->dataCustomer->alamat_customer }}</td>
                <td>{{ $item->dataOrder->dataCustomer->pic }}</td>
                <td>{{ $item->dataOrder->dataCustomer->phone_pic }}</td>
                <td>{{ $item->dataOrder->jumlah_order }}</td>
                <td>{{ $item->dataOrder->dataHarga->id_datastandar }}</td>
                <td>{{ $item->dataOrder->treatment }}</td>
                <td>{{ $item->dataOrder->volume}}</td>
                <td>{{ $item->dataOrder->place_fumigation }}</td>
                <td>{{ $item->stuffing_date }}</td>
                <td>{{ $item->container }}</td>
                <td>{{ $item->container_volume }}</td>
                <td>{{ $item->commodity }}</td>
                <td>{{ $item->vessel }}</td>
                <td>{{ $item->closing_time}}</td>
                <td>{{ $item->destination }}</td>
                <td>{{ $item->nama_driver }}</td>
                <td>{{ $item->telp_driver }}</td>
                <td><a href='{{ asset("storage/shipment_instruction/$item->shipment_instruction") }}'>{{
                    $item->shipment_instruction }}</a></td>
                <td><a href='{{ asset("storage/packing_list/$item->packing_list") }}'>{{ $item->packing_list }}</a></td>
                <td>
                  <?php
                    if ($item->verifikasi == 0){
                      echo '<span class="badge-pill badge-warning">Sedang Diverifikasi</span>';
                    } else if($item->verifikasi == 1){
                      echo '<span class="badge-pill badge-info">Menunggu Kedatangan Kontainer';
                    }else if($item->verifikasi == 2){
                      echo '<span class="badge-pill badge-primary">Kontainer Telah Diverifikasi';
                    }else if($item->verifikasi >= 3 && $item->verifikasi < 6){ 
                      echo '<span class="badge-pill badge-info">Proses Fumigasi Selesai' ; 
                    }else if($item->verifikasi >= 6){
                      echo '<span class="badge-pill badge-success">Proses Selesai';
                    }
                    ?>
                </td>
                <td>
                  {{-- <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal'
                    data-bs-target='#editModal{{ $item->id }}'><i class='fas fa-edit'></i></button> --}}
                  <button type="submit" class='btn btn-danger btn-sm' data-bs-toggle="modal"
                    data-bs-target="#deleteRecord{{ $item->id }}"><i class='fas fa-trash'></i></button>
                  <a href="{{ route('Data Order') }}?export=pdf-detail&id_detailorder={{ $item->id_detailorder }}"
                    class='btn btn-primary btn-sm' style='width: 30px; height: 30px;' target='_blank' role='button'><i
                      class='fas fa-print'></i></a>
                  <a href="{{ route('Data Order') }}?verif={{ $item->id }}" class='btn btn-info btn-sm'
                    style='width: 30px; height: 30px;'><i class='fas fa-check'></i></a>
                  <a href="{{ route('Data Order') }}?reject={{ $item->id }}" class='btn btn-danger btn-sm'
                    style='width: 30px; height: 30px;'><i class='fas fa-times'></i></a>
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