<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi Order</title>
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
      text-align: left;
      padding-bottom: 10px;
    }

    .signature {
      text-align: right;
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
    <div class="request-info">
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">VERIFIKASI ORDER</h3>
      <p style="text-align: center;">NO. {{ substr($record->detailOrder->id_detailorder , 3) }}/RO/MIMM/VO/2024</p>
      <table>
        <tr>
          <th>TANGGAL</th>
          <td>: {{ date('d M Y') }} </td>
        </tr>
      </table>
    </div>
    <hr>
    <div class="request-details">
      <table>
        <tr>
          <th style="width: 250px;">NAMA CUSTOMER</th>
          <td>: {{ $record->detailOrder->dataOrder->dataCustomer->nama_customer }} </td>
        </tr>
        <tr>
          <th>ALAMAT</th>
          <td>: {{ $record->detailOrder->dataOrder->dataCustomer->alamat_customer }} </td>
          <td></td>
        </tr>
        <tr>
          <th>NAMA KOMODITI</th>
          <td>: {{ $record->detailOrder->commodity }} </td>
          <td></td>
        </tr>
        <tr>
          <th>TANGGAL ORDER</th>
          <td>: {{ $record->detailOrder->dataOrder->tanggal_order }} </td>
          <td></td>
        </tr>
        <tr>
          <th>CLOSING</th>
          <td>: {{ $record->detailOrder->closing_time }} </td>
          <td></td>
        </tr>
        <tr>
          <th>TUJUAN</th>
          <td>: {{ $record->tujuan }} </td>
          <td></td>
        </tr>
        <tr>
          <th>NEGARA TUJUAN</th>
          <td>: {{ $record->destination }} </td>
          <td></td>
        </tr>
        <tr>
          <th>KONDISI KOMODITI</th>
          <td>: {{ $record->kondisi_status }} </td>
          <td></td>
        </tr>
        <tr>
          <th>PACKING/PEMBUNGKUS</th>
          <td>: {{ $record->packing }} </td>
          <td></td>
        </tr>
        <tr>
          <th>TEMPAT FUMIGASI</th>
          <td>: {{ $record->place_fumigation }} </td>
          <td></td>
        </tr>
        <tr>
          <th>KESIMPULAN</th>
          <td>: {{ $record->kesimpulan }} </td>
          <td></td>
        </tr>
      </table>
      <br>
      <br>
      <br>
    </div>
    <div class="signature">
      <p>MANAJER TEKNIK,</p>
      <br>
      <br>
      <br>
      <p>(DIDIK SETIAWAN)</p>
    </div>
  </div>
</body>

</html>