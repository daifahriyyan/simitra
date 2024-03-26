@extends('layouts.customer')

@section('section')
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <h1>Order</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<div class="dual-form-container">
  <div class="form-container-order left">
    <form action="#" method="post">
      <h4>Data Customer</h4>
      <p class="input-order-label">
        <label for="order_id">ID Order</label>
        <input type="text" id="order_id" name="order_id" placeholder="ID Order">
      </p>
      <p class="input-order-label">
        <label for="conatiner_id">ID Container</label>
        <input type="text" id="container_id" name="container_id" placeholder="ID Container">
      </p>
      <p class="input-order-label">
        <label for="order_date">Tanggal</label>
        <input type="text" id="order_date" name="order_date" placeholder="Tanggal Order">
      </p>
      <p class="input-order-label">
        <label for="customer_id">ID Customer</label>
        <input type="text" id="customer_id" name="customer_id" placeholder="ID Customer">
      </p>
      <p class="input-order-label">
        <label for="customer_name">Nama</label>
        <input type="text" id="customer_name" name="customer_name" placeholder="Nama">
      </p>
      <p class="input-order-label">
        <label for="customer_tel">No. Telp</label>
        <input type="tel" id="customer_tel" name="customer_tel" placeholder="No. Telp">
      </p>
      <p class="input-order-label">
        <label for="customer_address">Alamat</label>
        <input type="text" id="customer_address" name="customer_address" placeholder="Alamat">
      </p>
      <p class="input-order-label">
        <label for="customer_pic">PIC</label>
        <input type="text" id="customer_pic" name="customer_pic" placeholder="PIC">
      </p>
      <p class="input-order-label">
        <label for="pic_phone">Phone PIC</label>
        <input type="tel" id="pic_phone" name="pic_phone" placeholder="Phone PIC">
      </p>
      <p class="input-order-label">
        <label for="treatment">Treatment</label>
        <input type="text" id="treatment" name="treatment" placeholder="Treatment">
      </p>
      <p class="input-order-label">
        <label for="volume">Volume</label>
        <input type="text" id="volume" name="volume" placeholder="Volume">
      </p>
      <p class="input-order-label">
        <label for="place_fumigation">Place Fumigation</label>
        <input type="text" id="place_fumigation" name="place_fumigation" placeholder="Place Fumigation">
      </p>
    </form>
  </div>
  <div class="row d-flex justify-content-center">
  <input type="hidden" name="jumlah" value="{{ $jumlah_order }}" form="order">
  @for ($i = 1; $i <= $jumlah_order; $i++)
    <div class="col-12">
      <div class="form-container-order">
        <form action="{{ route('Order') }}" method="post" id="order">
          @csrf
          <h4>Data Order {{ $i }} </h4>
          <p class="input-order2-label">
            <label for="stuffing_date{{ $i }}">Stuffing Date</label>
            <input type="date" id="stuffing_date{{ $i }}" name="stuffing_date{{ $i }}" placeholder="Stuffing Date" required>
          </p>
          <p class="input-order2-label">
            <label for="container{{ $i }}">Container</label>
            <input type="text" id="container{{ $i }}" name="container{{ $i }}" placeholder="Container" required>
          </p>
          <p class="input-order2-label">
            <label for="container_volume{{ $i }}">Container Volume</label>
            <input type="text" id="container_volume{{ $i }}" name="container_volume{{ $i }}" placeholder="Container Volume" required>
          </p>
          <p class="input-order2-label">
            <label for="commodity{{ $i }}">Commodity</label>
            <input type="text" id="commodity{{ $i }}" name="commodity{{ $i }}" placeholder="Commodity" required>
          </p>
          <p class="input-order2-label">
            <label for="vessel{{ $i }}">Vessel</label>
            <input type="text" id="vessel{{ $i }}" name="vessel{{ $i }}" placeholder="Vessel" required>
          </p>
          <p class="input-order2-label">
            <label for="closing_time{{ $i }}">Closing Time</label>
            <input type="time" id="closing_time{{ $i }}" name="closing_time{{ $i }}" placeholder="Closing Time" required>
          </p>
          <p class="input-order2-label">
            <label for="destination{{ $i }}">Destination</label>
            <input type="text" id="destination{{ $i }}" name="destination{{ $i }}" placeholder="Destination" required>
          </p>
          <p class="input-order2-label">
            <label for="driver_name{{ $i }}">Nama Driver</label>
            <input type="text" id="driver_name{{ $i }}" name="driver_name{{ $i }}" placeholder="Nama Driver" required>
          </p>
          <p class="input-order2-label">
            <label for="driver_phone{{ $i }}">No. Telp Driver</label>
            <input type="tel" id="driver_phone{{ $i }}" name="driver_phone{{ $i }}" placeholder="No. Telp Driver" required>
          </p>
          <div class="container-columns">
            <div>
              <p>Shipment Instruction</p>
              <p><a href="#" class="upload-btn"><i class="fas fa-cloud-upload-alt"></i> Unggah File</a></p>
            </div>
            <div>
              <p>Packing List</p>
              <p><a href="#" class="upload-btn"><i class="fas fa-cloud-upload-alt"></i> Unggah File</a></p>
            </div>
          </div>
        </form>
      </div>
    </div>
    @endfor
    <input type="submit" class="mb-5" value="Order" form="order">
  </div>
</div>

@endsection