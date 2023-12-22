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
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Action</th>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @foreach ($supplier_barangs as $supplier_barang)
            <tr>
                <td align="center">{{ $supplier_barang->created_at }}</td>
                <td align="center">{{ $supplier_barang->supplier->kode }}</td>
                <td align="center">{{ $supplier_barang->supplier->nama }}</td>
                <td>Rp {{ number_format($supplier_barang->harga_beli, 2, ',', '.') }}</td>
                <td align="center">{{ $supplier_barang->stok }}</td>
                <td align="center" class="action">
                    <a href="{{ route('supplier-barang.edit', compact('gudang', 'barang', 'supplier_barang')) }}" id="edit"><i class="fa-solid fa-pen"></i>Edit</a>
                </td>
            </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-dashboard>
