<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .letterhead {
            text-align: center;
            border-bottom: 4px solid #000;
            padding-bottom: 10px;
            margin-bottom: 2px;
            overflow: auto;
        }

        .container {
            padding: 20px;
            margin: 0 auto;
            max-width: 1000px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .invoice-number {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .notes {
            font-style: italic;
            margin-bottom: 20px;
        }

        .terbilang {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .general-info {
            margin-bottom: 20px;
        }

        .general-info ol {
            padding-left: 20px;
        }

        .signature {
            text-align: right;
        }

        .signature img {
            max-width: 150px;
        }

        .payment-info {
            border-collapse: collapse;
            border: 1px solid #000;
        }

        .payment-info {
            border-collapse: collapse;
            border: 1px solid #000;
            width: 100%;
        }

        .payment-info th,
        .payment-info td {
            padding: 5px;
            border: 1px solid #000;
            text-align: left;
        }

        .payment-info th {
            background-color: #f2f2f2;
            font-weight: bold;
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

        <div class="invoice-container">
            <h2>INVOICE</h2>
            <p class="invoice-number">No. Tagihan / Invoice Number: {{ substr($detail->id_invoice, 3) }}/058/MIMM/1/2024
            </p>
            <table class="customer-info">
                <tr>
                    <td>Customer Nama / Name</td>
                    <td>{{ $detail->dataOrder->dataCustomer->nama_customer }}</td>
                </tr>
                <tr>
                    <td>Alamat / Address</td>
                    <td>{{ $detail->dataOrder->dataCustomer->alamat_customer }}
                    </td>
                </tr>
                <tr>
                    <td>Certificate No</td>
                    <td>{{ $detail->sertifikat->id_sertif }}</td>
                </tr>
                <tr>
                    <td>B/L No</td>
                    <td>{{ $detail->no_bl }}</td>
                </tr>
                <tr>
                    <td>Shipper</td>
                    <td>{{ $detail->shipper }}</td>
                </tr>
                <tr>
                    <td>Destination</td>
                    <td>{{ $detail->detailOrder->destination }}</td>
                </tr>
                <tr>
                    <td>Commodity</td>
                    <td>{{ $detail->detailOrder->commodity }}</td>
                </tr>
                <tr>
                    <td>In/Out Date</td>
                    <td>{{ $detail->stuffing_date }} - {{ $detail->closing_time }}</td>
                </tr>
                <tr>
                    <td>Dosage</td>
                    <td>{{ $detail->methylRecordsheet->applied_dose_rate }} Grams/M3</td>
                </tr>
            </table>
            <table class="service-info">
                <tr>
                    <th>JENIS JASA / TYPE OF SERVICE</th>
                    <th>QTY</th>
                    <th>SIZE</th>
                    <th>NO. CONTAINER / CONTAINER NUMBER</th>
                    <th>HARGA SATUAN / UNIT PRICE</th>
                    <th>JUMLAH / TOTAL</th>
                </tr>
                <tr>
                    <td>1. {{ ($detail->dataOrder->treatment == 'FCL')? 'Full Container Load' : 'Less Container Load' }}
                    </td>
                    <td>{{ $detail->dataOrder->jumlah_order }}</td>
                    <td>{{ $detail->dataOrder->volume }}' GP</td>
                    <td>{{ $detail->detailOrder->container }}</td>
                    <td>Rp {{ number_format($detail->dataHarga->harga_jual / $detail->dataHarga->volume) }}</td>
                    <td>Rp {{ number_format($detail->dataHarga->harga_jual) }}</td>
                </tr>
            </table>
            <p class="notes">Notes :<br>* Over Storage Fee/ Container : Rp. 50.000/Hari</p>
            <table class="payment-info">
                <tr>
                    <th>REKENING PEMBAYARAN / PAYMENT ACCOUNT</th>
                    <th>JUMLAH / TOTAL</th>
                    <th>Rp {{ number_format($detail->total_penjualan) }}</th>
                </tr>
                <tr>
                    <th>BANK MANDIRI SEMARANG</th>
                    <th>PPN {{ number_format($detail->ppn) }}% / VAT {{ number_format($detail->ppn) }}%</th>
                    <th>Rp {{ number_format($detail->total_penjualan * $detail->ppn / 100) }}</th>
                </tr>
                <tr>
                    <th>AN : PT. MITRA INDO MAJU MANDIRI</th>
                    <th>JUMLAH HARUS DIBAYAR / AMOUNT TO BE PAID</th>
                    <th>Rp {{ number_format($detail->jumlah_dibayar) }}</th>
                </tr>

                <td>AC : 135-00-1970208-1</td>
                <td></td>
                <td></td>
                </tr>

            </table>
            {{-- <p class="terbilang">Terbilang / in words: <b>Dua Juta Lima Puluh Tiga Ribu Lima Ratus Rupiah / Two
                    Million
                    Fifty Three Thousand Five Hundred Rupiah</b></p> --}}
            <div class="general-info">
                <p>Informasi Umum / General Information</p>
                <ol>
                    <li>Pembayaran dilakukan maksimal 2 minggu setelah invoice diberikan</li>
                    <li>Bukti pembayaran harap di konfirmasi melalui web ini
                    <li>Invoice ini bukan sebagai bukti pembayaran.</li>
                </ol>
            </div>
            <div class="signature">
                <p>Semarang, {{ date('d M Y') }}<br>Divisi Keuangan & Perpajakan</p>
            </div>
        </div>
</body>

</html>