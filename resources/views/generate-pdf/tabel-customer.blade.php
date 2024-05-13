<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Customer</title>
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

    .request-info {
      text-align: left;
      margin-bottom: 20px;
    }

    .request-info table {
      border: none;
    }

    .request-info th {
      text-align: left;
      width: 100px;
      border: none;
    }

    .request-info td {
      text-align: left;
      width: 200px;
      border: none;
    }

    .request-details table {
      font-size: 10px;
      width: 100%;
      max-width: 800px;
      border-collapse: collapse;
      border: 1px solid black;
    }

    .request-details th {
      padding: 8px;
      padding-bottom: 10px;
      text-align: center;
      border-bottom: 1px solid black;
      border-right: 1px solid black;
    }

    .request-details td {
      padding: 8px;
      padding-bottom: 10px;
      text-align: left;
      border-bottom: 1px solid black;
      border-right: 1px solid black;
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
      <img src="{{ public_path('assets/img/logo-surat.jpg') }}" alt="Company Logo" class="logo">
      <h1>PT MITRA INDO MAJU MANDIRI<br>Fumigation, Termite & Pest Control</h1>
      <div class="address">
        <p>Jl. Pakis II Blok C No. 60 Perum Ardhimas Bumi Mulya</p>
        <p>Kel. Sendangmulyo Kec. Tembalang Kota Semarang, Kode Pos 50272</p>
        <p>Telp./Fax. (024) 6705285 - Email: mitra.indomandiri@gmail.com</p>
      </div>
    </div>
    <hr>
    <div class="request-details">
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">DAFTAR CUSTOMER</h3>
      <table>
        <tr>
          <th>Id Customer</th>
          <th>Nama Customer</th>
          <th>Alamat Customer</th>
          <th>Telepon Customer</th>
          <th>Email Customer</th>
          <th>ATTN</th>
          <th>TIN</th>
          <th>Nama PIC</th>
          <th>Telp PIC</th>
        </tr>
        @foreach ($records as $record)
        <tr>
          <td>{{ $record->id_customer }}</td>
          <td>{{ $record->nama_customer }}</td>
          <td>{{ $record->alamat_customer }}</td>
          <td>{{ $record->telepon_customer }}</td>
          <td>{{ $record->email_customer }}</td>
          <td>{{ $record->attn }}</td>
          <td>{{ $record->tin }}</td>
          <td>{{ $record->pic }}</td>
          <td>{{ $record->phone_pic }}</td>
        </tr>
        @endforeach
      </table>
    </div>
    <br>
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
          <div class="signature" style="text-align: right;">
            <table>
              <tr>
                <th>Semarang, {{ date('d / M / Y') }}</th>
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
        </td>
      </tr>
    </table>
  </div>
</body>

</html>