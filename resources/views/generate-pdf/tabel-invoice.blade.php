<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Invoice</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      padding: 20px;
      margin: 0 auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .letterhead {
      text-align: center;
      border-bottom: 4px solid #000;
      padding-bottom: 10px;
      margin-bottom: 2px;
      overflow: auto;
    }

    .letterhead h1 {
      font-size: 24px;
      color: #000;
      margin: 20px 0 0;
    }

    .address {
      text-align: center;
      margin-bottom: 20px;
    }

    .address p {
      margin: 5px 0;
    }

    .logo {
      float: left;
      margin-left: 40px;
      margin-right: 10px;
    }

    .logo {
      width: 100px;
    }

    .request-details table {
      width: 100%;
      font-size: 10px;
      border-collapse: collapse;
      border: 1px solid black;
    }

    .request-details th,
    .request-details td {
      padding: 8px;
      padding-bottom: 10px;
      border-bottom: 1px solid black;
      border-right: 1px solid black;
      text-align: left;
    }

    .request-details th:first-child,
    .request-details td:first-child {
      border-left: 1px solid black;
    }

    .signature {
      display: flex;
      justify-content: flex-end;
    }

    .signature th {
      text-align: center;
      width: 300px;
      font-weight: normal;
      border: none;
    }

    .signature td {
      text-align: center;
      width: 300px;
      border: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="letterhead">
      <img src="{{ public_path('assets/img/logo-surat.png') }}" alt="Company Logo" class="logo">
      <h1>PT MITRA INDO MAJU MANDIRI<br>Fumigation, Termite & Pest Control</h1>
      <div class="address">
        <p>Jl. Pakis II Blok C No. 60 Perum Ardhimas Bumi Mulya</p>
        <p>Kel. Sendangmulyo Kec. Tembalang Kota Semarang, Kode Pos 50272</p>
        <p>Telp./Fax. (024) 6705285 - Email: mitra.indomandiri@gmail.com</p>
      </div>
    </div>
    <hr>
    <div class="request-details">
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">DAFTAR INVOICE</h3>
      <table>
        <tr>
          <th>ID Invoice</th>
          <th>Tanggal Invoice</th>
          <th>ID Order</th>
          <th>Nama Customer</th>
          <th>Alamat Customer</th>
          {{-- <th>ID Sertif</th> --}}
          <th>No BL</th>
          <th>Shipper</th>
          {{-- <th>Destination</th>
          <th>Commodity</th> --}}
          <th>Stuffing Date</th>
          <th>Closing Time</th>
          {{-- <th>ID Recordsheet</th>
          <th>Dossage (g/m³)</th>
          <th>Treatment</th>
          <th>Quantity</th>
          <th>Volume</th>
          <th>No Kontainer</th>
          <th>ID Data Standar</th>
          <th>Harga Jual</th> --}}
          <th>Total Penjualan</th>
          <th>PPN</th>
          <th>Jumlah Dibayar</th>
        </tr>
        @foreach ($invoice as $record)
        <tr>
          <td>{{ $record->id_invoice }}</td>
          <td>{{ $record->tanggal_invoice }}</td>
          <td>{{ $record->detailOrder->dataOrder->id_order }}</td>
          <td>{{ $record->detailOrder->dataOrder->dataCustomer->nama_customer }}</td>
          <td>{{ $record->detailOrder->dataOrder->dataCustomer->alamat_customer }}</td>
          {{-- <td>{{ $record->sertifikat->id_sertif }}</td> --}}
          <td>{{ $record->sertifikat->consignment }}</td>
          <td>{{ $record->shipper }}</td>
          {{-- <td>{!! $record->detailOrder->destination ?? "<span class='text-danger'>Data Tidak
              Ditemukan</span>" !!}</td>
          <td>{!! $record->detailOrder->commodity ?? "<span class='text-danger'>Data Tidak
              Ditemukan</span>" !!}</td> --}}
          <td>{{ $record->stuffing_date }}</td>
          <td>{{ $record->closing_time }}</td>
          {{-- <td>{{ $record->methylRecordsheet->id_recordsheet }}</td>
          <td>{{ $record->methylRecordsheet->applied_dose_rate }}</td>
          <td>{{ $record->detailOrder->dataOrder->treatment }}</td>
          <td>{{ $record->detailOrder->dataOrder->jumlah_order }}</td>
          <td>{{ $record->detailOrder->dataOrder->volume }}</td>
          <td>{!! $record->detailOrder->container ?? "<span class='text-danger'>Data Tidak
              Ditemukan</span>" !!}</td>
          <td>{{ $record->dataHarga->id_datastandar}}</td>
          <td>{{ $record->dataHarga->harga_jual }}</td> --}}
          <td>{{ $record->total_penjualan }}</td>
          <td>{{ $record->ppn }}</td>
          <td>{{ $record->jumlah_dibayar }}</td>
        </tr>
        @endforeach
      </table>
    </div>
    <br>
    <div class="signature" style="text-align: right; margin-left: 700px">
      <table>
        <tr>
          <th>Semarang, {{ date('d M Y') }}</th>
        </tr>
        <tr>
          <th>Administrasi</th>
        </tr>
        <tr>
          <td>
            <br>
            <br>
            <br>
            (Bagus Ramadhan)
          </td>
        </tr>
      </table>
    </div>
    <div class="request-info">
      <table>
        <tr>
          <th style="font-size: 10px;">Print by</th>
          <td style="font-size: 10px;">: {{ Auth::user()->username }}</td>
        </tr>
      </table>
    </div>
  </div>
</body>

</html>