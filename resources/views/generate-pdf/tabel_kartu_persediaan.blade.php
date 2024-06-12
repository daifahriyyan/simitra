<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kartu Persediaan</title>

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
      width: 150px;
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
      padding: 8px;
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
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">KARTU PERSEDIAAN METHYL BROMIDE
      </h3>
      <br>
      <table class="custom-table">
        <tr>
          <th style="width: 3%;" rowspan="2">No</th>
          <th style="width: 5%;" rowspan="2">Id Kartu Persediaan</th>
          <th style="width: 5%;" rowspan="2">ID Persediaan</th>
          <th style="width: 7%;" rowspan="2">Nama Persediaan</th>
          <th style="width: 5%;" rowspan="2">Tanggal Input</th>
          <th colspan="3">Masuk</th>
          <th colspan="3">Keluar</th>
          <th colspan="3">Saldo</th>
        </tr>
        <tr>
          <th style="width: 10%;">Harga</th>
          <th style="width: 5%;">Jumlah</th>
          <th style="width: 10%;">Total</th>
          <th style="width: 10%;">Harga</th>
          <th style="width: 5%;">Jumlah</th>
          <th style="width: 10%;">Total</th>
          <th style="width: 10%;">Harga</th>
          <th style="width: 5%;">Jumlah</th>
          <th style="width: 10%;">Total</th>
        </tr>
        @foreach ($kartuPersediaan as $record)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $record->id_kartu_persediaan }}</td>
          <td>{{ $record->dataPersediaan->id_persediaan }}</td>
          <td>{{ $record->dataPersediaan->nama_persediaan }}</td>
          <td>{{ $record->updated_at }}</td>
          <td>{{ $record->harga_masuk }}</td>
          <td>{{ $record->jumlah_masuk }}</td>
          <td>{{ $record->total_masuk }}</td>
          <td>{{ $record->harga_keluar }}</td>
          <td>{{ $record->jumlah_keluar }}</td>
          <td>{{ $record->total_keluar }}</td>
          <td>{{ $record->harga_saldo }}</td>
          <td>{{ $record->jumlah_saldo }}</td>
          <td>{{ $record->total_saldo }}</td>
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
          <th>Semarang, {{ date('d / M / Y') }}</th>
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
          <td style="font-size: 7px;"><b>Print by</b></td>
          <td style="font-size: 7px;">: {{ Auth::user()->username }}</td>
        </tr>
      </table>
    </div>
</body>

</html>