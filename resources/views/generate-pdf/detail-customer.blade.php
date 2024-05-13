<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Customer</title>

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
      width: 100px;
      border: none;
    }

    .request-info td {
      text-align: left;
      width: 200px;
      border: none;
    }

    .request-details table {
      width: 100%;
      border-collapse: collapse;
    }

    .request-details th {
      padding: 8px;
      width: 250px;
      padding-bottom: 10px;
      text-align: left;
    }

    .request-details td {
      padding: 8px;
      width: 300px;
      padding-bottom: 10px;
      text-align: left;
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
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">DETAIL CUSTOMER</h3>
      <table>
        <tr>
          <th>Id Detail Customer</th>
          <td>: {{ $detailCustomer->id_detail_customer }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Id Customer</th>
          <td>: {{ $detailCustomer->dataCustomer->id_customer }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Nama Customer</th>
          <td>: {{ $detailCustomer->dataCustomer->nama_customer }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Termin Pembayaran</th>
          <td>: {{ $detailCustomer->termin }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Tanggal Input</th>
          <td>: {{ $detailCustomer->tanggal_input }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Penjualan</th>
          <td>: Rp. {{ number_format($detailCustomer->total_penjualan) }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Penerimaan</th>
          <td>: Rp. {{ number_format($detailCustomer->total_penerimaan) }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Saldo Akhir</th>
          <td>: Rp. {{ number_format($detailCustomer->saldo_akhir) }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Tanggal Jatuh Tempo</th>
          <td>: {{ $detailCustomer->tanggal_jatuh_tempo }}</td>
          <td></td>
        </tr>
        <tr>
          <th>Status</th>
          <td>:
            @if($detailCustomer->status == 'Lunas')
            <span class='badge badge-success'>Lunas</span>
            @elseif ($detailCustomer->tanggal_jatuh_tempo > date('Y-m-d') && isset($detailCustomer->saldo_akhir))
            <span class='badge badge-warning'>Masa Hutang</span>
            @elseif($detailCustomer->tanggal_jatuh_tempo > date('Y-m-d') && is_null($detailCustomer->saldo_akhir))
            <span class='badge badge-success'>Lunas</span>
            @elseif($detailCustomer->tanggal_jatuh_tempo < date('Y-m-d') && isset($detailCustomer->saldo_akhir))
              <span class='badge badge-danger'>Jatuh Tempo</span>
              @elseif($detailCustomer->tanggal_jatuh_tempo < date('Y-m-d') && is_null($detailCustomer->saldo_akhir))
                <span class='badge badge-danger'>Lunas</span>
                @endif
          </td>
          <td></td>
        </tr>
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
                <th>Manager Administrasi</th>
              </tr>
              <tr>
                <td>
                  <br>
                  <br>
                  <br>
                  (Rizky Nur Yulianti)
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