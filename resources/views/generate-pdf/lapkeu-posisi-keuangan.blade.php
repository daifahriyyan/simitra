<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Posisi Keuangan</title>
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
      <h3 style="text-align: center; font-weight: bold; text-decoration: underline;">LAPORAN POSISI KEUANGAN</h3>
      <p style="text-align: center;">Untuk Periode yang Berakhir {{ $bulan[request()->bulan] ?? 'Belum Dipilih' }} {{
        request()->tahun ??
        'Belum Dipilih' }}</p>
      <table>
        <tr>
          <th>Keterangan</th>
          <th>Jumlah</th>
          <th>Total</th>
        </tr>
        @if ($asetLancar != null || $asetTetap != null)
        <tr>
          <th style="text-align: left">Aktiva</th>
          <th></th>
          <th></th>
        </tr>

        {{-- Aset Lancar --}}
        @if ($asetLancar != null)
        <tr>
          <th style="text-align: left">Aset Lancar</th>
          <th></th>
          <th></th>
        </tr>
        @foreach ($asetLancar as $record)
        @php
        $jumlah_aset_lancar += $record->saldo_akun;
        @endphp
        <tr>
          <td>{{ $record->nama_akun }}</td>
          <td>Rp. {{ number_format($record->saldo_akun) }}</td>
          <td></td>
        </tr>
        @endforeach
        <tr>
          <th style="text-align: left;">Jumlah Aset Lancar</th>
          <th></th>
          <th>Rp. {{ number_format($jumlah_aset_lancar) }}</th>
        </tr>
        @endif

        {{-- Aset Tetap --}}
        @if ($asetTetap != null)
        <tr>
          <th style="text-align: left">Aset Tetap</th>
          <th></th>
          <th></th>
        </tr>
        @foreach ($asetTetap as $record)
        @php
        $jumlah_aset_tetap += $record->saldo_akun;
        @endphp
        <tr>
          <td>{{ $record->nama_akun }}</td>
          <td>Rp. {{ number_format($record->saldo_akun) }}</td>
          <td></td>
        </tr>
        @endforeach
        <tr>
          <th style="text-align: left;">Jumlah Aset Tetap</th>
          <th></th>
          <th>Rp. {{ number_format($jumlah_aset_tetap) }}</th>
        </tr>
        @endif
        <tr>
          <th style="text-align: left;">Jumlah Aktiva</th>
          <th></th>
          <th>Rp. {{ number_format($jumlah_aset_tetap + $jumlah_aset_lancar) }}</th>
        </tr>

        <tr>
          <th style="text-align: left"><br></th>
          <th></th>
          <th></th>
        </tr>
        @endif

        @if ($kewajibanJkPdk != null || $kewajibanJkPjg != null || $ekuitas != null)
        <tr>
          <th style="text-align: left">Passiva</th>
          <th></th>
          <th></th>
        </tr>
        @if ($kewajibanJkPdk != null || $kewajibanJkPjg != null)
        <tr>
          <th style="text-align: left">Kewajiban</th>
          <th></th>
          <th></th>
        </tr>
        @endif
        {{-- Kewajiban Jangka Pendek --}}
        @if ($kewajibanJkPdk != null)
        <tr>
          <th style="text-align: left">Kewajiban Jangka Pendek</th>
          <th></th>
          <th></th>
        </tr>
        @foreach ($kewajibanJkPdk as $record)
        @php
        $jumlah_kewajiban_jkpdk += $record->saldo_akun;
        @endphp
        <tr>
          <td>{{ $record->nama_akun }}</td>
          <td>Rp. {{ number_format($record->saldo_akun) }}</td>
          <td></td>
        </tr>
        @endforeach
        <tr>
          <th style="text-align: left;">Jumlah Kewajiban Jangka Pendek</th>
          <th></th>
          <th>Rp. {{ number_format($jumlah_kewajiban_jkpdk) }}</th>
        </tr>
        @endif

        {{-- Kewajiban Jangka Panjang --}}
        @if ($kewajibanJkPjg != null)
        <tr>
          <th style="text-align: left">Kewajiban Jangka Panjang</th>
          <th></th>
          <th></th>
        </tr>
        @foreach ($kewajibanJkPjg as $record)
        @php
        $jumlah_kewajiban_jkpjg += $record->saldo_akun;
        @endphp
        <tr>
          <td>{{ $record->nama_akun }}</td>
          <td>Rp. {{ number_format($record->saldo_akun) }}</td>
          <td></td>
        </tr>
        @endforeach
        <tr>
          <th style="text-align: left;">Jumlah Kewajiban Jangka Panjang</th>
          <th></th>
          <th>Rp. {{ number_format($jumlah_kewajiban_jkpjg) }}</th>
        </tr>
        @endif
        <tr>
          <th style="text-align: left;">Jumlah Kewajiban</th>
          <th></th>
          <th>Rp. {{ number_format($jumlah_kewajiban_jkpjg + $jumlah_kewajiban_jkpdk) }}</th>
        </tr>

        {{-- Ekuitas --}}
        @if ($ekuitas != null)
        <tr>
          <th style="text-align: left">Ekuitas</th>
          <th></th>
          <th></th>
        </tr>
        @foreach ($ekuitas as $record)
        @php
        $jumlah_ekuitas += $record->saldo_akun;
        @endphp
        <tr>
          <td>{{ $record->nama_akun }}</td>
          <td>Rp. {{ number_format($record->saldo_akun) }}</td>
          <td></td>
        </tr>
        @endforeach
        <tr>
          <th style="text-align: left;">Jumlah Ekuitas</th>
          <th></th>
          <th>Rp. {{ number_format($jumlah_ekuitas) }}</th>
        </tr>
        @endif
        <tr>
          <th style="text-align: left;">Jumlah Passiva</th>
          <th></th>
          <th>Rp. {{ number_format($jumlah_ekuitas + $jumlah_kewajiban_jkpjg + $jumlah_kewajiban_jkpdk) }}
          </th>
        </tr>
        @else
        <tr>
          <th style="text-align: left" class="text-center">Data Tidak Ada</th>
          <th></th>
          <th></th>
        </tr>
        @endif
      </table>
    </div>
    <br>
    <div class="signature" style="text-align: right; margin-left: 400px">
      <table>
        <tr>
          <th>Semarang, {{ date('d M Y') }}</th>
        </tr>
        <tr>
          <th>Bagian Keuangan</th>
        </tr>
        <tr>
          <td>
            <br>
            <br>
            <br>
            (Sita Permatasari)
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