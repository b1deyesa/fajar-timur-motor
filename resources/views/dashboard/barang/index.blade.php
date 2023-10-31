<x-dashboard>
    
    {{-- Alert --}}
    <x-alert />

    {{-- Table --}}
    <x-table title="Semua Barang - {{ $gudang->nama }}" color="red">
        <x-slot:button>
            @livewire('create-barang', compact('gudang'))
        </x-slot:button>
        <x-slot:head>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Merek</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Action</th>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @foreach ($barangs as $key => $barang)
            <tr>
                <td align="center">{{ $barang->kode }}</td>
                <td>{{ $barang->nama }}</td>
                <td>{{ $barang->merek }}</td>
                <td>Rp {{ number_format($barang->harga_beli, 2, ',', '.') }}</td>
                <td align="center">{{ $barang->supplier_barangs->sum('stok') - $barang->detail_transaksis->sum('jumlah') }}</td>
                <td align="center">
                    <a href="{{ route('barang.show', compact('gudang', 'barang')) }}">Detail Barang</a>
                </td>
            </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-dashboard>
