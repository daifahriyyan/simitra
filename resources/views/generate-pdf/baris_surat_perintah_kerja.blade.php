<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Perintah Kerja</title>
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
      font-weight: normal;
    }

    .request-info th {
      text-align: left;
      width: 200px;
      font-weight: normal;
    }

    .request-details th {
      text-align: left;
      padding-bottom: 10px;
      font-weight: normal;
      width: 150px;
    }

    .request-details td {
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
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">SURAT PERINTAH KERJA</h3>
      <p style="text-align: center;">NO. {{ substr($record->id_spk, -3) }}/SPK/MIMM/II/2024</p>
      <table>
        <tr>
          <td style="text-decoration: underline">Bersama ini kami akan mengadakan Fumigasi Standar Badan Karantina
            Pertanian dengan keterangan sebagai berikut:</td>
        </tr>
      </table>
    </div>
    <div class="request-details">
      <table>
        <tr>
          <th>Tanggal</th>
          <td>: {{ $record->tanggal }}</td>
        </tr>
        <tr>
          <th>Lokasi</th>
          <td>: Depo Pelindo Semarang</td>
          <td></td>
        </tr>
        <tr>
          <th>Jumlah</th>
          <td>: {{ $record->detailOrder->volume }} Kontainer</td>
          <td></td>
        </tr>
        <tr>
          <th>No.</th>
          <td>: {{ $record->detailOrder->container }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Fumigan</th>
          <td>: Methyl Bromide</td>
          <td></td>
        </tr>
        <tr>
          <th>Dosis</th>
          <td>: {{ $record->dosis }}</td>
          <td></td>
        </tr>
      </table>
      <br>
      <table>
        <tr>
          <td>Sehubungan dengan kegiatan di atas, menetapkan dan menunjuk petugas dan penanggung jawab teknis lapangan :
          </td>
        </tr>
      </table>
      <table>
        <tr>
          <td>1. {{ $record->fumigator }}</td>
        </tr>
        <tr>
          <td>2. {{ $record->helper1 }}</td>
        </tr>
        <tr>
          <td>3. {{ $record->helper2 }}</td>
        </tr>
        <tr>
          <td>4. {{ $record->helper3 }}</td>
        </tr>
        <td>Demikian surat ini kami buat, atas perhatiannya kami ucapkan terima kasih</td>
      </table>
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