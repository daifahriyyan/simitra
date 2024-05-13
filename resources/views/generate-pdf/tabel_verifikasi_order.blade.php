<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekap Verifikasi Order</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      padding: 20px;
      margin: 0 auto;
      max-width: 1000px;
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

    .request-info {
      text-align: left;
      margin-bottom: 20px;
    }

    .request-info table {
      border: none;
    }

    .request-info th {
      text-align: left;
    }

    .request-details th {
      text-align: center;
      padding-bottom: 10px;
    }

    .custom-table {
      border: 1px solid black;
      border-collapse: collapse;
    }

    .custom-table th,
    .custom-table td {
      border: 1px solid black;
      padding: 4px;
      text-align: center;
      font-size: 8px;
    }

    .signature {
      display: flex;
      justify-content: flex-end;
    }

    .signature th {
      text-align: center;
      width: 50px;
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
      <img src="{{ public_path('assets/img/logo-surat.jpg') }}" alt="Company Logo" class="logo">
      <h1>PT MITRA INDO MAJU MANDIRI<br>Fumigation, Termite & Pest Control</h1>
      <div class="address">
        <p>Jl. Pakis II Blok C No. 60 Perum Ardhimas Bumi Mulya</p>
        <p>Kel. Sendangmulyo Kec. Tembalang Kota Semarang, Kode Pos 50272</p>
        <p>Telp./Fax. (024) 6705285 - Email: mitra.indomandiri@gmail.com</p>
      </div>
    </div>
    <hr>
    <div class="request-info" style="margin-left: -55px">
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">REKAP VERIFIKASI ORDER</h3>
      <br>
      <table class="custom-table">
        <tr>
          <th style="width: 3%;">No</th>
          <th>Id Verifikasi</th>
          <th>Id Order</th>
          <th style="width: 6%;">Detail Order</th>
          <th>Tanggal Order</th>
          <th>Id Customer</th>
          <th style="width: 5%;">Nama Cust</th>
          <th style="width: 8%;">Alamat Cust</th>
          <th>Commodity</th>
          <th>Stuffing Date</th>
          <th>Closing Timer</th>
          <th>Waktu</th>
          <th>Tujuan</th>
          <th>Destination</th>
          <th>Kondisi</th>
          <th>Packing</th>
          <th>Tempat Fumigasi</th>
          <th style="width: 12%;">Kesimpulan</th>
        </tr>
        @foreach ($verifikasi as $record)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $record->id_verifikasi }}</td>
          <td>{{ $record->detailOrder->dataOrder->id_order }}</td>
          <td>{{ $record->detailOrder->id_detailorder }}</td>
          <td>{{ $record->detailOrder->dataOrder->tanggal_order }}</td>
          <td>{{ $record->detailOrder->dataOrder->dataCustomer->id_customer }}</td>
          <td>{{ $record->detailOrder->dataOrder->dataCustomer->nama_customer }}</td>
          <td>{{ $record->detailOrder->dataOrder->dataCustomer->alamat_customer }}</td>
          <td>{{ $record->detailOrder->commodity }}</td>
          <td>{{ $record->detailOrder->stuffing_date }}</td>
          <td>{{ $record->detailOrder->closing_time }}</td>
          <td>{{ $record->waktu }}</td>
          <td>{{ $record->tujuan }}</td>
          <td>{{ $record->destination }}</td>
          <td>{{ $record->kondisi_status }}</td>
          <td>{{ $record->packing }}</td>
          <td>{{ $record->place_fumigation }}</td>
          <td>{{ $record->kesimpulan }}</td>
        </tr>
        @endforeach
      </table>
      <br>
      <br>
      <br>
    </div>
    <div class="signature" style="text-align: right; margin-left: 400px">
      <table>
        <tr>
          <th>Semarang, {{ date('d M Y') }}</th>
        </tr>
        <tr>
          <th>Manajer Teknik,</th>
        </tr>
        <tr>
          <td>
            <br>
            <br>
            <br>
            (DIDIK SETIAWAN)
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
</body>

</html>