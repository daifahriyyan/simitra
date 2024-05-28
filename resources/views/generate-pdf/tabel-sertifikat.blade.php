<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar ORDER</title>
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
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">DAFTAR SERTIFIKAT</h3>
      <table>
        <tr>
          <th>Id Sertifikat</th>
          <th>Id Reg</th>
          <th>Target of Fumigation</th>
          <th>Commodity</th>
          <th>Consignment</th>
          <th>Country</th>
          <th>Port of Loading</th>
          <th>Destination</th>
          <th>Id Order</th>
          <th>Id Detail Order</th>
          <th>Nama Customer</th>
          <th>Telp Customer</th>
          <th>ATTN</th>
          <th>TIN</th>
          <th>Id Importer</th>
          <th>Nama Importer</th>
          <th>Alamat Importer</th>
          <th>Telp Importer</th>
          <th>Fax Importer</th>
          <th>USCI Importer</th>
          <th>PIC Importer</th>
          <th>Id Recordsheet</th>
          <th>Tanggal Selesai</th>
          <th>Daff Prescribed Doses Rate</th>
          <th>Forecast Minimum Temperature</th>
          <th>Exposure Period</th>
          <th>Applied Dose Rate</th>
          <th>Fumigation Conducted</th>
          <th>Container</th>
          <th>Wrapping</th>
          <th>Tanggal Sertif</th>
          <th>No Reg</th>
          <th>Status</th>
        </tr>
        @foreach ($sertifikat as $record)
        <tr>
          <td>{{ $record->id_sertif }}</td>
          <td>{{ $record->id_reg }}</td>
          <td>{{ $record->target }}</td>
          <td>{{ $record->detailOrder->commodity }}</td>
          <td>{{ $record->consignment }}</td>
          <td>{{ $record->country }}</td>
          <td>{{ $record->pol }}</td>
          <td>{{ $record->detailOrder->destination }}</td>
          <td>{{ $record->detailOrder->dataOrder->id_order }}</td>
          <td>{{ $record->detailOrder->id_detailorder }}</td>
          <td>{{ $record->detailOrder->dataOrder->dataCustomer->nama_customer }}</td>
          <td>{{ $record->detailOrder->dataOrder->dataCustomer->telepon_customer }}</td>
          <td>{{ $record->attn }}</td>
          <td>{{ $record->tin }}</td>
          <td>{{ $record->dataImporter->id_importer }}</td>
          <td>{{ $record->dataImporter->nama_importer }}</td>
          <td>{{ $record->dataImporter->alamat_importer }}</td>
          <td>{{ $record->dataImporter->telp_importer }}</td>
          <td>{{ $record->dataImporter->fax }}</td>
          <td>{{ $record->dataImporter->usci }}</td>
          <td>{{ $record->dataImporter->pic }}</td>
          <td>{{ $record->dataRecordsheet->id_recordsheet }}</td>
          <td>{{ $record->dataRecordsheet->tanggal_selesai }}</td>
          <td>{{ $record->dataRecordsheet->daff_prescribed_doses_rate }}</td>
          <td>{{ $record->dataRecordsheet->forecast_minimum_temperature }}</td>
          <td>{{ $record->dataRecordsheet->exposure_period }}</td>
          <td>{{ $record->dataRecordsheet->applied_dose_rate }}</td>
          <td>{{ $record->dataRecordsheet->dokumen_metil_recordsheet }}</td>
          <td>{{ $record->detailOrder->container }}</td>
          <td>{{ $record->wrapping }}</td>
          <td>{{ $record->tanggal_sertif }}</td>
          <td>{{ $record->no_reg }}</td>
          <td>
            <?php
              if($record->detailOrder->verifikasi <= 3){ 
                echo '<span class="badge-pill badge-info">Process' ; 
              }else if($record->detailOrder->verifikasi >= 4){
                echo '<span class="badge-pill badge-success">Finish';
              }
              ?>
          </td>
        </tr>
        @endforeach
      </table>
    </div>
    <br>
    <div class="signature" style="text-align: right; margin-left: 400px">
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