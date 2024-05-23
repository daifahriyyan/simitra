<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Harga Jasa</title>

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
    <div class="request-info" style="font-size: 12px">
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">DATA HARGA JASA</h3>
      <br>
      <table class="custom-table">
        <tr>
          <th>No</th>
          <th>Id Data Standar</th>
          <th>Id Standar</th>
          <th>Volume</th>
          <th>Treatment</th>
          <th>BBB</th>
          <th>BTK</th>
          <th>BOP</th>
          <th>MarkUp (%)</th>
          <th>Harga Jual</th>
        </tr>
        @foreach ($dataHarga as $record)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $record->id_datastandar }}</td>
          <td>{{ $record->standarHPP->id_standar }}</td>
          <td>{{ $record->volume }}</td>
          <td>{{ $record->treatment }}</td>
          <td>Rp. {{ number_format($record->bbb_standar) }}</td>
          <td>Rp. {{ number_format($record->btk_standar) }}</td>
          <td>Rp. {{ number_format($record->bop_standar) }}</td>
          <td>{{ $record->markup }}%</td>
          <td>Rp. {{ number_format($record->harga_jual) }}</td>
        </tr>
        @endforeach
      </table>
      <br>
      <br>
      <br>
    </div>
    <table>
      <tr>
        <td>
          <div class="request-info">
            <table>
              <tr>
                <th style="font-size: 12px;">Print by</th>
                <td style="font-size: 12px;">: {{ Auth::user()->username }}</td>
              </tr>
            </table>
          </div>
        </td>
        <td>
          <div class="signature" style="text-align: right; margin-left: 300px">
            <table>
              <tr>
                <th>Semarang, {{ date('d / M / Y') }}</th>
              </tr>
              <tr>
                <th>Manajer Teknik</th>
              </tr>
              <tr>
                <td>
                  <br>
                  <br>
                  <br>
                  (Didik Setiawan)
                </td>
              </tr>
            </table>
          </div>
        </td>
      </tr>
    </table>
</body>

</html>