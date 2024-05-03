<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <table class="table align-items-center table-flush table-hover text-nowrap">
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
        <td>{{ $item->id_datastandar }}</td>
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
        <td>{{ $item->shipment_instruction }}</td>
        <td>{{ $item->packing_list }}</td>
        @endforeach
    </tbody>
    <!-- AKHIR EDIT SESUAIKAN TABEL DATABASE -->
  </table>
</body>

</html>