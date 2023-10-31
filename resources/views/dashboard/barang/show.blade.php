<x-dashboard>
    <x-table :title="'Semua Barang - Gudang ' . $gudang->nama">
        <x-slot:button>
            @livewire('create-stok', compact('gudang', 'barang'))
        </x-slot:button>
        <x-slot:head>
            <tr>
                <th>Tanggal Masuk</th>
                <th>Supplier Kode</th>
                <th>Supplier Nama</th>
                <th>Quantity</th>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @foreach ($supplier_barangs as $supplier_barang)
            <tr>
                <td align="center">{{ $supplier_barang->created_at }}</td>
                <td align="center">{{ $supplier_barang->supplier->nama }}</td>
                <td align="center">{{ $supplier_barang->supplier->kode }}</td>
                <td align="center">{{ $supplier_barang->stok }}</td>
            </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-dashboard>
