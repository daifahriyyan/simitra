@extends('layouts.customer')

@section('section')
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <h1>Data Order</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

{{-- <br>
<div class="container-neworder">
  <div class="row">
    <div class="col-md-12 text-left">
      <div class="text-left">
        <a href="form-order" class="boxed-btn">Buat Pesanan Baru</a>
      </div>
    </div>
  </div>
</div> --}}

@foreach ($order as $record)
<div class="status-order-container mt-5 mb-5">
  <div class="container">
    <div class="order-info">
      <p class="order-date">{{ $record->tanggal_order }}</p>
      <p class="order-number">Nomor Order: {{ $record->id_order }}</p>
    </div>
    <div class="row">
      <div class="col-md-2">
        <div class="single-product-img">
          <img src="assets/img/products/product-img-5.jpg" alt="">
        </div>
      </div>
      <div class="col-md-4">
        <div class="single-product-content">
          <p class="single-product-pricing"><span>{{ $record->dataHarga->volume }} {{
              $record->dataHarga->standarHPP->id_standar }}</span>{{ ($record->dataHarga->treatment == "FCL")? "Full
            Container Load":
            "Less Container Load" }} ({{ $record->dataHarga->treatment }})
          </p>
          <p>Rp {{ number_format($record->dataHarga->harga_jual ) }}</p>
          {{-- <a href="#" class="download-btn"><i class="fas fa-cloud-download-alt"></i> Download Sertifikat</a>
          <a href="#" class="download-btn"><i class="fas fa-cloud-download-alt"></i> Download Invoice</a> --}}
        </div>
      </div>
    </div>
    <br>
    <div class="order-info">
      <p class="order-status">Sedang diverifikasi</p>
      <p><a href="{{ route('Status Order', $record->id) }}" class="status-btn">Cek Status Order</a></p>
    </div>
  </div>
</div>
@endforeach

<div class="wa-popup" id="wa-popup">
  <img src="assets/img/whatsapp_logo.png" alt="">
  <span class="close-btn" id="close-btn">&times;</span>
</div>
<a href="https://wa.me/6282137253446" class="open-btn" id="open-btn">
  <img src="assets/img/whatsapp_logo.png" alt="">
</a>
@endsection