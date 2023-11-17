<!DOCTYPE html>
<html>
<head>
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
</body>
</html>