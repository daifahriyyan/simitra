<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Request Order</title>
  <link rel="stylesheet" href="{{ asset('assets/img/logo-surat.jpg') }}">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 3cm;
    }

    .container {
      border: 1px solid #000;
      padding: 20px;
      margin: 0 auto;
      max-width: 800px;
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
      padding-bottom: 20px;
    }

    .signature {
      margin-top: 20px;
      text-align: right;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="letterhead">
      <img src="{{ public_path('assets/img/logo-surat.jpg') }}" alt="Company Logo" class="logo">
      <h1>PT MITRA INDO MAJU MANDIRI<br>Fumigation & Pest Control</h1>
      <div class="address">
        <p>Perumahan Mutiara Cluster 5A, Jl. Pedurungan Kidul V RT. 1/RW. 4</p>
        <p>Kelurahan Gemah - Semarang, Telp./Fax. (024) 6705285</p>
        <p>Email: mitra.Indomandiri@gmail.com</p>
      </div>
    </div>
    <hr>
    <div class="request-info">
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">REQUEST ORDER</h3>
      <p style="text-align: center;">NO. 00001/RO/MIMM/II/2024</p>
      <table>
        <tr>
          <th>Date</th>
          <td>: 07-02-2020</td>
        </tr>
        <tr>
          <th>Request By</th>
          <td>: Pak Arick<br>Jonggrangan klaten</td>
        </tr>
      </table>
    </div>
    <hr>
    <div class="request-details">
      <table>
        <tr>
          <th style="width: 250px;">TREATMENT AQIS FUMIGATION</th>
          <td>: FCL</td>
          <td>: LCL</td>
        </tr>
        <tr>
          <th>STUFFING DATE</th>
          <td>: 09-02-2020</td>
          <td></td>
        </tr>
        <tr>
          <th>VOLUME</th>
          <td>: 1 x 20'</td>
          <td></td>
        </tr>
        <tr>
          <th>CONTAINER / VOLUME</th>
          <td>: PCIU2344174/SG507934465</td>
          <td></td>
        </tr>
        <tr>
          <th>COMMODITY</th>
          <td>: SONOKELING</td>
          <td></td>
        </tr>
        <tr>
          <th>VESSEL</th>
          <td>: HIGHWAY 0978</td>
          <td></td>
        </tr>
        <tr>
          <th>CLOSING TIME</th>
          <td>: 15/02/2020 14:00 WIB</td>
          <td></td>
        </tr>
        <tr>
          <th>DESTINATION</th>
          <td>: CHINA</td>
          <td></td>
        </tr>
        <tr>
          <th>PLACE FUMIGATION</th>
          <td>: DEPO PELINDO SEMARANG</td>
          <td></td>
        </tr>
        <tr>
          <th>PIC</th>
          <td>: Pak Arick</td>
          <td></td>
        </tr>
        <tr>
          <th>PHONE</th>
          <td>: 0812-1537-4664</td>
          <td></td>
        </tr>
      </table>
    </div>
    <div class="signature">
      <p>ADMINISTRASI,</p>
      <img src="ttd.jpg" alt="Signature">
      <p>(ASMAUL HUDA)</p>
    </div>
  </div>
</body>

</html>