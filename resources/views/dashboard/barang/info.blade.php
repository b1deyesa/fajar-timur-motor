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
                        <td>Lokasi Barang</td>
                        <td>:</td>
                        <td>Gudang {{ $barang->gudang->nama }} [<a href="{{ route('barang.index', ['gudang' => $barang->gudang]) }}">{{ $barang->gudang->kode }}</a>]</td>
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
                            <h6 class="stok">Stok Tersedia {{ $barang->supplier_barangs->sum('stok') - $barang->detail_transaksis->sum('jumlah') }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td class="action" colspan="3">
                            <a href="{{ route('barang.edit', ['gudang' => $barang->gudang, 'barang' => $barang]) }}" id="edit"><i class="fa-solid fa-pen"></i>Edit</a>
                            <a href="{{ route('barang.show', ['gudang' => $barang->gudang, 'barang' => $barang]) }}" id="info"><i class="fa-solid fa-eye"></i>Detail Barang</a>
                        </td>
                    </tr>
                </table>
                <ul class="navigation">
                    
                </ul>
            </div>
            @endforeach
        </div>
    </section>
</x-dashboard>