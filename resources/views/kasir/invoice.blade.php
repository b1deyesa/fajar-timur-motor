<!DOCTYPE html>
<html>
<head>
    <title>Invoice {{ $transaksi->kode }}</title>
    <style>
        * {
            box-sizing: border-box;
        }
        .invoice {
            display: flex;
            justify-content: center;
            padding: 4em 2em;
            background-size: cover;
        }
        .invoice .container {
            display: flex;
            flex-direction: column;
            gap: 5em;
            width: 100%;
            max-width: 60em;
            font-size: .9em;
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
            padding: .9em 1em;
            border-top: 1px solid #777;
            border-bottom: 1px solid #777;
            background-color: #d3e7fe;
        }
        .invoice .container .content tr td {
            padding: .8em 1em;
            border-bottom: 1px solid #777;
        }
        .invoice .container {
            display: flex;
            justify-content: space-between;
        }
        .invoice .container .info {
            display: flex;
            flex-direction: column;
            gap: .8em;
            width: 80%;
            max-width: 30em;
        }
        .invoice .container .info hr {
            width: 100%;
        }
        .invoice .container tr table {
            border-collapse: collapse;
            width: 100%;
            max-width: 18em;
        }
        .invoice .container tr table td {
            padding: .4em .7em;
            border: 1px solid #777
        }
        .invoice .container tr table td:last-child {
            text-align: end;
        }
        .invoice .container tr table td h4 {
            margin: 0;
        }
        .invoice .container tr table td:has( > h4) {
            background-color: #d3e7fe
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
                        <h3>INVOICE</h3>
                        <table>
                            <tr>
                                <td>Invoice</td>
                                <td>{{ $transaksi->kode }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>{{ $transaksi->created_at->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td>Tgl. Jatuh Tempo</td>
                                <td>-</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <table class="content">
            <tr>
                <th>Nama Barang</th>
                <th>Quantity</th>
                <th>Harga</th>
                <th>Diskon</th>
                <th>Total</th>
            </tr>
            @foreach ($transaksi->detail_transaksis as $detail_transaksi)
            <tr>
                <td>{{ $detail_transaksi->barang->nama }}</td>
                <td align="center">{{ $detail_transaksi->jumlah }}</td>
                <td>Rp {{ number_format($detail_transaksi->harga_jual, '2', ',', '.') }}</td>
                <td align="center">{{ $detail_transaksi->diskon }}%</td>
                <td>Rp {{ number_format(($detail_transaksi->jumlah * $detail_transaksi->harga_jual) - (($detail_transaksi->jumlah * $detail_transaksi->harga_jual) * $detail_transaksi->diskon / 100), '2', ',', '.') }}</td>
            </tr>
            @endforeach
        </table>
        <table>
            <tr>
                <td>
                    <div class="info">
                        <span>Tagihan Kepada</span>
                        <b>{{ $transaksi->nama_pembeli }}</b>
                        <hr>
                    </div>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>Subtotal</td>
                            <td>
                                @php
                                    $subtotal = 0;
                                    foreach ($transaksi->detail_transaksis as $detail_transaksi) {
                                        $subtotal += ($detail_transaksi->jumlah * $detail_transaksi->harga_jual) - (($detail_transaksi->jumlah * $detail_transaksi->harga_jual) * $detail_transaksi->diskon / 100);
                                    }
        
                                    echo 'Rp ' . number_format($subtotal, '2', ',', '.');
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <td>Biaya Pengiriman</td>
                            <td>Rp {{ number_format($transaksi->harga_pengiriman, '2', ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Agen Pengiriman</td>
                            <td>{{ $transaksi->agen_pengiriman }}</td>
                        </tr>
                        <tr>
                            <td><h4>Total</h4></td>
                            <td><h4>Rp {{ number_format($transaksi->total, '2', ',', '.') }}</h4></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>