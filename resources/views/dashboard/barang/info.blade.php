<x-dashboard navmenu="false">
    <section class="barang-info">
        <div class="container">
            <h3 class="title">Status Barang</h3>
            @foreach ($barangs as $barang)
            <div class="card">
                <h5 class="card-title">{{ $barang->nama }}</h5>
                <table>
                    <tr>
                        <td>Kode Barang</td>
                        <td>:</td>
                        <td>{{ $barang->kode }}</td>
                    </tr>
                    <tr>
                        <td>Merek</td>
                        <td>:</td>
                        <td>{{ $barang->merek }}</td>
                    </tr>
                    <tr>
                        <td>Harga Beli</td>
                        <td>:</td>
                        <td>Rp {{ number_format($barang->harga_beli, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td>{{ $barang->deskripsi }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <h1 class="stok">Stok Tersedia {{ $barang->supplier_barangs->sum('stok') - $barang->detail_transaksis->sum('jumlah') }}</h1>
                        </td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>
    </section>
</x-dashboard>