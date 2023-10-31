<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi {{ now()->format('d/m/Y') }}</title>
    <style>
        * {
            box-sizing: border-box;
        }
        .invoice {
            display: flex;
            justify-content: center;
            padding: 2em 2em;
            background-size: cover;
        }
        .invoice .container {
            display: flex;
            flex-direction: column;
            gap: 5em;
            width: 100%;
            max-width: 60em;
            font-size: .55em;
        }
        .invoice .container > table {
            width: 100%;
            margin: 4em 0;
        }
        .invoice .container .banner {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .invoice .container .banner img {
            width: 10em;
        }
        .invoice .container .banner h6 {
            font-size: 1.5em;
            margin: .7em 0 0;
        }
        .invoice .container .index {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1em;
        }
        .invoice .container .index h3 {
            font-size: 3.4em;
            margin: 0;
        }
        .invoice .container .index table {
            border-collapse: collapse;
        }
        .invoice .container .index table td {
            padding: .2em .8em;
            border: 1px solid #222222;
        }
        .invoice .container .index table td:last-child {
            text-align: end;
        }
        .invoice .container .content {
            border-collapse: collapse;
        }
        .invoice .container .content tr th {
            padding: .9em .6em;
            border: 1px solid #777;
            background-color: #d3e7fe;
        }
        .invoice .container .content tr td {
            padding: .3em .6em;
            border: 1px solid #999;
        }
        .invoice .container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body class="invoice">
    <div class="container">
        <table>
            <tr>
                <td>
                    <div class="banner">
                        <img src="{{ asset('img/logo.png') }}">
                        <h6>Fajar Timur Motor</h6>
                    </div>
                </td>
                <td>
                    <div class="index">
                        <h3>Laporan Transaksi</h3>
                        <h5>Tanggal Cetak : {{ now()->format('d/m/Y - H:i:s') }}</h5>
                    </div>
                </td>
            </tr>
        </table>
        <table class="content">
            <tr>
                <th>Tgl.</th>
                <th>Nama Pembeli</th>
                <th>Metode Pembayaran</th>
                <th>Harga Pengiriman</th>
                <th>Agen Pengiriman</th>
                <th>Total</th>
                <th>Kasir</th>
            </tr>
            @foreach ($transaksis as $key => $transaksi)
            <tr>
                <td align="center">{{ $transaksi->created_at->format('d/m/Y - H:i:s') }}</td>
                <td>{{ $transaksi->nama_pembeli }}</td>
                <td align="center">{{ $transaksi->metode_pembayaran }}</td>
                <td>Rp {{ number_format($transaksi->harga_pengiriman, 0, ',', '.') }}</td>
                <td align="center">{{ $transaksi->agen_pengiriman }}</td>
                <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                <td>{{ $transaksi->user->nama }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>