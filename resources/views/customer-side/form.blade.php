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

<div class="dual-form-container row">
  <div class="form-container-order left">
    <form action="#" method="post">
      <h4>Data Order</h4>
      <p class="input-order-label">
        <label for="id_order">ID Order</label>
        <input type="text" id="id_order" name="id_order" value="ORD000{{ $id_order }}" form="order" readonly>
      </p>
      <p class="input-order-label">
        <label for="tanggal_order">Tanggal</label>
        <input type="text" id="tanggal_order" name="tanggal_order"
          value="{{ Carbon\Carbon::now()->isoFormat('Y-M-D') }}" form="order" readonly>
      </p>
      <p class="input-order-label">
        <label for="id_customer">ID Customer</label>
        <input type="text" id="id_customer" value="C_00{{ Auth::user()->id }}" form="order" readonly>
        <input type="hidden" id="id_customer" name="id_customer" value="{{ Auth::user()->id }}" form="order" readonly>
      </p>
      <p class="input-order-label">
        <label for="customer_name">Nama</label>
        <input type="text" id="customer_name" name="customer_name"
          value="{{ Auth::user()->dataCustomer->nama_customer }}" form="order" readonly>
      </p>
      <p class="input-order-label">
        <label for="customer_tel">No. Telp</label>
        <input type="tel" id="customer_tel" name="customer_tel"
          value="{{ Auth::user()->dataCustomer->telepon_customer }}" form="order" readonly>
      </p>
      <p class="input-order-label">
        <label for="customer_address">Alamat</label>
        <input type="text" id="customer_address" name="customer_address"
          value="{{ Auth::user()->dataCustomer->alamat_customer }}" form="order" readonly>
      </p>
      <p class="input-order-label">
        <label for="customer_pic">PIC</label>
        <input type="text" id="customer_pic" name="customer_pic" value="{{ Auth::user()->dataCustomer->pic }}"
          form="order" readonly>
      </p>
      <p class="input-order-label">
        <label for="pic_phone">Phone PIC</label>
        <input type="tel" id="pic_phone" name="pic_phone" value="{{ Auth::user()->dataCustomer->phone_pic }}"
          form="order" readonly>
      </p>
      <p class="input-order-label">
        <label for="treatment">Treatment</label>
        <input type="text" id="treatment" name="treatment" value="{{ request()->treatment }}" form="order" readonly>
      </p>
      <p class="input-order-label">
        <label for="volume">Volume</label>
        <input type="text" id="volume" name="volume" value="{{ request()->volume }}" form="order" readonly>
      </p>
      <p class="input-order-label">
        <label for="place_fumigation">Place Fumigation</label>
        <input type="text" id="place_fumigation" name="place_fumigation" value="Depo Pelindo Semarang" form="order"
          readonly>
      </p>
    </form>
  </div>
  <div class="row d-flex justify-content-center">
    <input type="hidden" name="id_data_harga" value="{{ request()->id_data_harga }}" form="order">
    <input type="hidden" name="jumlah_order" value="{{ request()->jumlah_order }}" form="order">
    <form action="{{ route('Order') }}" method="post" id="order" enctype="multipart/form-data">@csrf </form>
    @for ($i = 1; $i <= $jumlah_order; $i++) <div class="col-12">
      <div class="form-container-order">
        <form>
          <h4>Data Detail Order {{ $i }} </h4>
          <p class="input-order-label">
            <label for="id_detailorder">ID Detail Order</label>
            <input type="text" id="id_detailorder" name="id_detailorder{{ $i }}" value="ORD000{{ $id_order }}-{{ $i }}"
              form="order" readonly>
          </p>
          <p class="input-order2-label">
            <label for="stuffing_date{{ $i }}">Stuffing Date</label>
            <input type="date" id="stuffing_date{{ $i }}" name="stuffing_date{{ $i }}" form="order" required>
          </p>
          <p class="input-order2-label">
            <label for="container{{ $i }}">Container</label>
            <input type="text" id="container{{ $i }}" name="container{{ $i }}" placeholder="Container" form="order"
              required>
          </p>
          <p class="input-order2-label">
            <label for="container_volume{{ $i }}">Container Volume</label>
            <input type="text" id="container_volume{{ $i }}" name="container_volume{{ $i }}"
              placeholder="Container Volume" form="order" required>
          </p>
          <p class="input-order2-label">
            <label for="commodity{{ $i }}">Commodity</label>
            <input type="text" id="commodity{{ $i }}" name="commodity{{ $i }}" placeholder="Commodity" form="order"
              required>
          </p>
          <p class="input-order2-label">
            <label for="vessel{{ $i }}">Vessel</label>
            <input type="text" id="vessel{{ $i }}" name="vessel{{ $i }}" placeholder="Vessel" form="order" required>
          </p>
          <p class="input-order2-label">
            <label for="closing_time{{ $i }}">Closing Time</label>
            <input type="datetime-local" id="closing_time{{ $i }}" name="closing_time{{ $i }}" form="order" required>
          </p>
          <p class="input-order2-label">
            <label for="destination{{ $i }}">Destination</label>
            <input type="text" id="destination{{ $i }}" name="destination{{ $i }}" placeholder="Destination"
              form="order" required>
          </p>
          <p class="input-order2-label">
            <label for="nama_driver{{ $i }}">Nama Driver</label>
            <input type="text" id="nama_driver{{ $i }}" name="nama_driver{{ $i }}" placeholder="Nama Driver"
              form="order" required>
          </p>
          <p class="input-order2-label">
            <label for="telp_driver{{ $i }}">No. Telp Driver</label>
            <input type="tel" id="telp_driver{{ $i }}" name="telp_driver{{ $i }}" placeholder="No. Telp Driver"
              form="order" required>
          </p>
          <div class="container-columns">
            <div>
              <p>Shipment Instruction</p>
              <input type="file" name="shipment_instruction{{ $i }}" form="order" class="border-0" required>
            </div>
            <div>
              <p>Packing List</p>
              <input type="file" name="packing_list{{ $i }}" form="order" class="border-0" required>
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