@extends('layouts.customer')

@section('section')
<style>
  input[type=file]::-webkit-file-upload-button {
    display: none;
  }
</style>
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
      <p class="order-date">{{ $record->dataOrder->tanggal_order }}</p>
      <p class="order-number">Nomor Order: {{ $record->id_detailorder }} </p>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="single-product-img2">
          <img src="{{ asset('assets/img/products/product-img-5.jpg') }}" alt="">
        </div>
      </div>
      <div class="col-md-3">
        <div class="single-product-content">
          <p class="single-product-pricing"><span>{{ $record->dataOrder->dataHarga->volume }} {{
              $record->dataOrder->dataHarga->standarHPP->id_standar }}</span>{{
            ($record->dataOrder->dataHarga->treatment == "FCL")? "Full
            Container Load":
            "Less Container Load" }} ({{ $record->dataOrder->dataHarga->treatment }})
          </p>
          <p>Rp {{ number_format($record->dataOrder->dataHarga->harga_jual ) }}</p>
          @if ($record->verifikasi == 2)
          <form method="POST" action="{{ route('Tambah Draft Pelayaran') }}" enctype="multipart/form-data">
            @csrf
            <label for="draft_pelayaran" class="upload-btn"><a class="upload-btn"><i
                  class="fas fa-cloud-upload-alt"></i>Draft Pelayaran</a></label>
            <input type="hidden" name="id_order" id="id_order" value="{{ $record->id }}">
            <input type="file" name="draft_pelayaran" id="draft_pelayaran" required>
            <button class="btn btn-primary" type="submit">Upload</button>
          </form>
          @endif
          @if ($record->verifikasi >= 4)
          <a href="{{ route('Sertifikat') }}?export=pdf-detail&id={{ $record->sertif->id }}" target="_blank"
            class="download-btn"><i class="fas fa-cloud-download-alt"></i> Sertifikat</a>
          @endif
          @if ($record->verifikasi >= 5)
          <a href="{{ route('Invoice') }}?export=pdf-detail&id={{ $record->invoicee->id }}" target="_blank"
            class="download-btn"><i class="fas fa-cloud-download-alt"></i> Invoice</a>
          @endif
          @if ($record->verifikasi == 5)
          <form method="POST" action="{{ route('Tambah Bukti Pembayaran') }}" enctype="multipart/form-data">
            @csrf
            <label for="bukti_pembayaran" class="upload-btn"><a class="upload-btn"><i
                  class="fas fa-cloud-upload-alt"></i>Bukti Pembayaran</a></label>
            <input type="hidden" name="id_invoice" id="id_invoice" value="{{ $record->invoice->id }}">
            <input type="hidden" name="id_order" id="id_order" value="{{ $record->id }}">
            <input type="hidden" name="tanggal_pembayaran" id="tanggal_pembayaran" value="{{ date('Y-m-d') }}">
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" required>
            <button class="btn btn-primary" type="submit">Upload</button>
          </form>
          @endif
        </div>
      </div>
      <div class="col-md-4">
        <div class="step-wrapper">
          <div class="step">
            @if ($record->verifikasi >= 1)
            ✅
            @else
            <button class="step-btn">1</button>
            @endif
            <p>Verifikasi dokumen order</p>
          </div>
          <div class="step">
            @if ($record->verifikasi >= 1)
            ✅
            @else
            <button class="step-btn">2</button>
            @endif
            <p>Menunggu kedatangan kontainer</p>
          </div>
          <div class="step">
            @if ($record->verifikasi >= 2)
            ✅
            @else
            <button class="step-btn">3</button>
            @endif
            <p>Verifikasi kelayakan kontainer</p>
          </div>
          <div class="step">
            @if ($record->verifikasi >= 3)
            ✅
            @else
            <button class="step-btn">4</button>
            @endif
            <p>Proses fumigasi</p>
          </div>
          <div class="step">
            @if ($record->verifikasi >= 3)
            ✅
            @else
            <button class="step-btn">5</button>
            @endif
            <p>Fumigasi selesai</p>
          </div>
          <div class="step">
            @if ($record->verifikasi >= 3)
            ✅
            @else
            <button class="step-btn">6</button>
            @endif
            <p>Upload draft pelayaran</p>
          </div>
          <div class="step">
            @if ($record->verifikasi >= 4)
            ✅
            @else
            <button class="step-btn">7</button>
            @endif
            <p>Sertifikat</p>
          </div>
          <div class="step">
            @if ($record->verifikasi >= 5)
            ✅
            @else
            <button class="step-btn">8</button>
            @endif
            <p>Invoice</p>
          </div>
          <div class="step">
            @if ($record->verifikasi >= 6)
            ✅
            @else
            <button class="step-btn">9</button>
            @endif
            <p>Bukti pembayaran</p>
          </div>
          <div class="step">
            @if ($record->verifikasi >= 6)
            ✅
            @else
            <button class="step-btn">10</button>
            @endif
            <p>Selesai</p>
          </div>
        </div>
      </div>
    </div>
    <div class="order-info">
      <p class="order-status">
        <?php
        if ($record->verifikasi == 0){
          echo 'Sedang Diverifikasi';
        } else if($record->verifikasi == 1){
          echo 'Menunggu Kedatangan Kontainer';
        }else if($record->verifikasi == 2){
          echo 'Kontainer Telah Diverifikasi';
        }else if($record->verifikasi >= 3 && $record->verifikasi < 6){ 
          echo 'Proses Fumigasi Selesai' ; 
        }else if($record->verifikasi >= 6){
          echo 'Proses Selesai, Terima Kasih';
        }
        ?>
      </p>
      <p><a href="data_order.html" class="status-btn">Kembali</a></p>
    </div>
  </div>
</div>
@endforeach

@endsection