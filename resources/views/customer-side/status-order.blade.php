@extends('layouts.customer')

@section('section')
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <h1>Status Order</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

@foreach ($order as $record)
<div class="status-order-container mt-50 mb-50">
  <div class="container">
    <div class="order-info">
      <p class="order-date">{{ $record->tanggal_order }}</p>
      <p class="order-number">Nomor Order: {{ $record->id_order }} </p>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="single-product-img2">
          <img src="assets/img/products/product-img-5.jpg" alt="">
        </div>
      </div>
      <div class="col-md-3">
        <div class="single-product-content">
          <p class="single-product-pricing"><span>{{ $record->dataHarga->volume }} {{
              $record->dataHarga->standarHPP->id_standar }}</span>{{ ($record->dataHarga->treatment == "FCL")? "Full
            Container Load":
            "Less Container Load" }} ({{ $record->dataHarga->treatment }})
          </p>
          <p>Rp {{ number_format($record->dataHarga->harga_jual ) }}</p>
          <p><a href="#" class="upload-btn"><i class="fas fa-cloud-upload-alt"></i> Draft Pelayaran</a></p>
          <a href="#" class="download-btn"><i class="fas fa-cloud-download-alt"></i> Sertifikat</a>
          <a href="#" class="download-btn"><i class="fas fa-cloud-download-alt"></i> Invoice</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="step-wrapper">
          <div class="step">
            <button class="step-btn">1</button>
            <p>Verifikasi dokumen order</p>
          </div>
          <div class="step">
            <button class="step-btn">2</button>
            <p>Menunggu kedatangan kontainer</p>
          </div>
          <div class="step">
            <button class="step-btn">3</button>
            <p>Verifikasi kelayakan kontainer</p>
          </div>
          <div class="step">
            <button class="step-btn">4</button>
            <p>Proses fumigasi</p>
          </div>
          <div class="step">
            <button class="step-btn">5</button>
            <p>Fumigasi selesai</p>
          </div>
          <div class="step">
            <button class="step-btn">6</button>
            <p>Upload draft pelayaran</p>
          </div>
          <div class="step">
            <button class="step-btn">7</button>
            <p>Sertifikat</p>
          </div>
          <div class="step">
            <button class="step-btn">8</button>
            <p>Invoice</p>
          </div>
          <div class="step">
            <button class="step-btn">9</button>
            <p>Bukti pembayaran</p>
          </div>
          <div class="step">
            <button class="step-btn">10</button>
            <p>Selesai</p>
          </div>
        </div>
      </div>
    </div>
    <div class="order-info">
      <p class="order-status">Sedang diverifikasi</p>
      <p><a href="data_order.html" class="status-btn">Kembali</a></p>
    </div>
  </div>
</div>
@endforeach

@endsection