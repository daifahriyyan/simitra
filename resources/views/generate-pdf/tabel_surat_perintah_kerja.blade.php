<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekap Surat Perintah Kerja</title>
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
      padding: 3px;
      text-align: center;
      font-size: 9px;
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
      <img src="{{ public_path('assets/img/logo-surat.png') }}" alt="Company Logo" class="logo">
      <h1>PT MITRA INDO MAJU MANDIRI<br>Fumigation, Termite & Pest Control</h1>
      <div class="address">
        <p>Jl. Pakis II Blok C No. 60 Perum Ardhimas Bumi Mulya</p>
        <p>Kel. Sendangmulyo Kec. Tembalang Kota Semarang, Kode Pos 50272</p>
        <p>Telp./Fax. (024) 6705285 - Email: mitra.indomandiri@gmail.com</p>
      </div>
    </div>
    <hr>
    <div class="request-info">
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">REKAP SURAT PERINTAH KERJA</h3>
      <br>
      <table class="custom-table">
        <tr>
          <th style="width: 3%;">No</th>
          <th>Id SPK</th>
          <th>Tanggal</th>
          <th>Place Fumigation</th>
          <th>Jumlah Kontainer</th>
          <th>ID Order</th>
          <th>Detail Order</th>
          <th>Container</th>
          <th>Volume</th>
          <th>Fumigan</th>
          <th>Dosis</th>
          <th>Fumigator</th>
          <th>Help 1</th>
          <th>Help 2</th>
          <th>Help 3</th>
        </tr>
        @foreach ($spk as $record)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $record->id_spk }}</td>
          <td>{{ $record->tanggal }}</td>
          <td>{{ $record->place_fumigation }}</td>
          <td>{{ $record->jumlah_container }}</td>
          <td>{{ $record->detailOrder->dataOrder->id_order }}</td>
          <td>{{ $record->detailOrder->id_detailorder }}</td>
          <td>{{ $record->detailOrder->container }}</td>
          <td>{{ $record->detailOrder->dataOrder->volume }}</td>
          <td>{{ $record->fumigan }}</td>
          <td>{{ $record->dosis }}</td>
          <td>{{ $record->fumigator }}</td>
          <td>{{ $record->helper1 }}</td>
          <td>{{ $record->helper2 }}</td>
          <td>{{ $record->helper3 }}</td>
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