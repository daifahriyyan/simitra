<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sertifikat</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
    }

    .container {
      padding: 20px;
      margin: 0 auto;
      max-width: 800px;
      border: 2px solid #000;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .letterhead {
      text-align: center;
      border-bottom: 4px solid #000;
      padding-bottom: 40px;
      margin-bottom: 20px;
    }

    .letterhead h1 {
      font-size: 18px;
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

    .request-details {
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 8px;
    }

    th {
      background-color: lightgray;
      text-align: center;
    }

    .declaration {
      margin-bottom: 20px;
    }

    .additional-declarations {
      margin-bottom: 20px;
    }

    .additional-declarations ul {
      list-style-type: square;
      padding-left: 20px;
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

    <div class="request-details">
      <h2 style="text-align: center; font-weight: bold; text-decoration: underline; font-size: 16px;">AFAAS-METHYL
        BROMIDE FUMIGATION CERTIFICATE</h2>
      <table>
        <tr>
          <td colspan="4" style="font-size: 12px;">
            <strong> Certificate No:</strong>{{ $detail->sertifikat->id_sertif}} <br>
            <strong> ID Registration Number:</strong> {{ $detail->sertifikat->id_reg }}
          </td>
        </tr>

        <tr>
          <th colspan="4" style="font-size: 14px;">TARGET OF FUMIGATION DETAILS</th>
        </tr>
        <tr>
          <td colspan="4" style="font-size: 12px;">
            <strong>Target of fumigation:</strong>{{ $detail->sertifikat->target }} &nbsp;
          </td>
        </tr>
        <tr>
          <td colspan="4" style="font-size: 12px;">
            <strong>Commodity: {{ $detail->commodity }} </strong><br>
          </td>
        </tr>
        <tr>
          <td style="font-size: 12px;"><strong> Consignment link:</strong> {{ $detail->sertifikat->consignment }}</td>
          <td style="font-size: 12px;"><strong>Country of origin:</strong> {{ $detail->sertifikat->country }} </td>
          <td style="font-size: 12px;"><strong> Port of loading:</strong> {{ $detail->sertifikat->pol }}</td>
          <td style="font-size: 12px;"><strong>Country of destination:</strong>{{ $detail->destination }} </td>
        </tr>
        <tr>
          <td colspan="2" style="font-size: 12px;">
            <strong>Name and address of exporter:</strong><br>
            {{ $detail->dataOrder->dataCustomer->nama_customer }} <br>
            {{ $detail->dataOrder->dataCustomer->alamat_customer }} <br>
            TEL {{ $detail->dataOrder->dataCustomer->telepon_customer }} <br>
          </td>
          <td colspan="2" style="font-size: 12px;">
            <strong>Name and address of importer:</strong><br>
            {{ $detail->sertifikat->dataImporter->nama_importer }} <br>
            {{ $detail->sertifikat->dataImporter->alamat_importer }} <br>
            FAX: {{ $detail->sertifikat->dataImporter->fax }} <br>
            USCI: {{ $detail->sertifikat->dataImporter->usci }} <br>
            PIC: {{ $detail->sertifikat->dataImporter->pic }}
          </td>
        </tr>
      </table>

      <table>
        <tr>
          <th colspan="4" style="font-size: 14px;">TREATMENT DETAILS</th>
        </tr>
        <tr>
          <td style="font-size: 12px;"><strong>Date fumigation completed:</strong> {{
            $detail->sertifikat->dataRecordsheet->tanggal_selesai }} </td>
          <td style="font-size: 12px;"><strong>Place of fumigation :</strong> {{ $detail->sertifikat->pol }} </td>
          <td style="font-size: 12px;"><strong> DAFT prescribed dose rate (g/m³):</strong> {{
            $detail->sertifikat->dataRecordsheet->daff_prescribed_doses_rate }} </td>
          <td style="font-size: 12px;"><strong>Exposure Period (hrs):</strong> {{
            $detail->sertifikat->dataRecordsheet->exposure_period }} </td>
        </tr>
        <tr>
          <td colspan="2" style="font-size: 12px;">
            <strong>Applied dose rate (g/m³):</strong> {{ $detail->sertifikat->dataRecordsheet->applied_dose_rate }}
          </td>
          <td colspan="2" style="font-size: 12px;">
            <strong>Are containers wrapped?</strong><br>
            {{ $detail->sertifikat->wrapping }}
          </td>
        </tr>
      </table>
    </div>
    <div class="declaration">
      <h2 style="text-align: center; font-size: 14px;">DECLARATION</h2>
      <p style="text-align: justify; font-size: 12px;">By signing below, I, the AFAS accredited fumigator responsible,
        declare that these details are true and correct and the fumigation has been carried out in accordance with all
        the requirements in the AFAS Methyl Bromide Fumigation Standard.</p>
    </div>
    <div class="additional-declarations">
      <h2 style="text-align: center; font-size: 14px;">ADDITIONAL DECLARATIONS</h2>
      <ul style="font-size: 12px;">
        <li>The container / cargo should beloaded on board the vessel within 21 days after fumigation.</li>
        <li>The fumigation has no residual effect to prevent re-infestation, therefore we can offer no guarantee in this
          respect.</li>
        <li>We fumigated commodity and packing / free air space.</li>
      </ul>
    </div>
  </div>
</body>

</html>