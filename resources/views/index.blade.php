@extends('layouts.main')

@php
// Mengambil data dari tabel invoice
$invoices = App\Models\Invoice::all();

// Data untuk Area Chart (total penjualan per hari)
$totalPenjualanHarian = [];
foreach ($invoices as $invoice) {
$tanggal = $invoice->tanggal_invoice;
$totalPenjualan = $invoice->total_penjualan;
if (!isset($totalPenjualanHarian[$tanggal])) {
$totalPenjualanHarian[$tanggal] = 0;
}
$totalPenjualanHarian[$tanggal] += $totalPenjualan;
}
$labelsTanggal = array_keys($totalPenjualanHarian);
$dataTotalPenjualan = array_values($totalPenjualanHarian);

// Data untuk Pie Chart (jumlah produk per jenis)
$jumlahProdukPerJenis = [];
foreach ($invoices as $invoice) {
$idDataStandar = $invoice->dataHarga->id_datastandar;
if (!isset($jumlahProdukPerJenis[$idDataStandar])) {
$jumlahProdukPerJenis[$idDataStandar] = 0;
}
$jumlahProdukPerJenis[$idDataStandar]++;
}
$labelsJenisProduk = array_keys($jumlahProdukPerJenis);
$dataJumlahProduk = array_values($jumlahProdukPerJenis);
@endphp

@section('container-fluid')
<style>
  .card.mb-4 {
    height: 100%;
  }

  .table-responsive {
    overflow-x: auto;
  }
</style>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </div>

  <div class="row mb-3">
    <!-- Total Penjualan Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Total Penjualan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ number_format(App\Models\Invoice::sum('total_penjualan'), 2) }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-credit-card fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Total HPP Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Total HPP</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                @php
                $jumlahTotalHPP = 0;
                @endphp
                @foreach (App\Models\Invoice::get() as $record)
                @php
                $jumlahTotalHPP += $record->dataHarga->hpp * $record->detailOrder->dataOrder->jumlah_order;
                @endphp
                @endforeach
                {{ number_format($jumlahTotalHPP, 2) }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calculator fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Jumlah Penjualan Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Penjualan</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                {{ App\Models\Invoice::count() }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-shopping-cart fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Jumlah Order Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Order</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ App\Models\DetailOrder::count() }}
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-list-alt fa-2x text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-2">
      <div class="card mb-4" style="height: calc(100% - 1rem);">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Daily Recap Report</h6>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart" data-labels="{{ json_encode($labelsTanggal) }}"
              data-data="{{ json_encode($dataTotalPenjualan) }}"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-2">
      <div class="card mb-4" style="height: calc(100% - 1rem);">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
        </div>
        <div class="card-body">
          @php
          $i = 1;
          @endphp
          @foreach($jumlahProdukPerJenis as $idDataStandar => $jumlah)
          <div class="mb-3">
            <div class="small text-gray-500">Jenis Produk {{ $idDataStandar }}
              <div class="small float-right"><b>{{ $jumlah }} of {{ App\Models\Invoice::count() }} Items</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-{{ ['warning', 'success', 'danger', 'info', 'success'][($i - 1) % 5] }}"
                role="progressbar" style="width: {{ ($jumlah / App\Models\Invoice::count()) * 100 }}%"
                aria-valuenow="{{ ($jumlah / App\Models\Invoice::count()) * 100 }}" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
          </div>
          @php
          $i++;
          @endphp
          @endforeach
        </div>
        <div class="card-footer text-center"></div>
      </div>
    </div>

    <!-- Order -->
    <div class="col-xl-12 col-lg-12 mb-4">
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Order</h6>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>Order ID</th>
                <th>Detail Order ID</th>
                <th>Nama Customer</th>
                <th>Volume</th>
                <th>Stuffing Date</th>
                <th>Closing Time</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @php
              $recentOrders = App\Models\DetailOrder::latest()->take(5)->get();
              @endphp
              @foreach($recentOrders as $order)
              <tr>
                <td>{{ $order->dataOrder->id_order }}</td>
                <td>{{ $order->id_detailorder }}</td>
                <td>{{ $order->dataOrder->dataCustomer->nama_customer }}</td>
                <td>{{ $order->container_volume }}</td>
                <td>{{ $order->stuffing_date }}</td>
                <td>{{ $order->closing_time }}</td>
                <td>
                  @if($order->verifikasi == 0)
                  <span class="badge badge-danger">Pending</span>
                  @elseif($order->verifikasi == 1 && $order->is_reject == '0')
                  <span class="badge badge-success">Delivered</span>
                  @elseif($order->verifikasi == 1 && $order->is_reject == '1')
                  <span class="badge badge-warning">Rejected</span>
                  @else
                  <span class="badge badge-info">Processing</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
  </div>
  <!--Row-->

  <!-- Modal Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelLogout">LOGOUT - SIMITRA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Yakin ingin logout dari sistem?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          <a href="login.html" class="btn btn-primary">Logout</a>
        </div>
      </div>
    </div>
  </div>
</div>

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
@endsection