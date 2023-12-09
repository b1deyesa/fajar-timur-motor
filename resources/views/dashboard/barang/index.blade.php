<x-dashboard>
    
    {{-- Alert --}}
    <x-alert />

    {{-- Table --}}
    <x-table title="Semua Barang - {{ $gudang->nama }}" color="red">
        <x-slot:button>
            @livewire('import-barang', compact('gudang'))
            @livewire('create-barang', compact('gudang'))
        </x-slot:button>
        <x-slot:head>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Merek</th>
                <th>Stok</th>
                <th>Action</th>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @foreach ($barangs as $key => $barang)
            <tr 
                @if ($barang->kode == 'Barang Baru') 
                    @if ($barang->created_at == $barang->updated_at)
                        @if (now()->diffInDays(\Carbon\Carbon::parse($barang->created_at)) < 2)
                            style="background: #d7fffa" 
                        @endif
                    @endif
                @endif
            >
                <td align="center">{{ $barang->kode }}</td>
                <td>{{ $barang->nama }}</td>
                <td>{{ $barang->merek }}</td>
                <td align="center">{{ $barang->supplier_barangs->sum('stok') - $barang->detail_transaksis->sum('jumlah') }}</td>
                <td align="center" class="action">
                    <a href="{{ route('barang.edit', compact('gudang', 'barang')) }}" id="edit"><i class="fa-solid fa-pen"></i>Edit</a>
                    <a href="{{ route('barang.show', compact('gudang', 'barang')) }}" id="info"><i class="fa-solid fa-eye"></i>Detail Barang</a>
                </td>
            </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-dashboard>
