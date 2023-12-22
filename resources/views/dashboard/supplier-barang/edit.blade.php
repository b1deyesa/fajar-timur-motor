<x-dashboard>
    <x-edit title="Barang Supplier - {{ $supplier_barang->supplier->nama }}" route="{{ route('supplier-barang.update', compact('gudang', 'barang', 'supplier_barang')) }}">

        {{-- Button --}}
        <x-slot:button>
            @livewire('delete-supplier-barang', compact('gudang', 'barang', 'supplier_barang'))
        </x-slot:button>

        {{-- Slot --}}
        <x-input
            label="Harga Beli" 
            type='number' 
            name='harga_beli' 
            placeholder='Harga Beli'
            :value="$supplier_barang->harga_beli"
            :required="true" 
            />
        <x-input
            label="Stok Barang" 
            type='number' 
            name='stok' 
            placeholder='Stok Barang'
            :value="$supplier_barang->stok"
            :required="true" 
            />

        {{-- Navigation --}}
        <x-slot:navigation>
            <button type="submit" class="update"><i class="fa-solid fa-pen"></i>Update</button>
        </x-slot:navigation>
    </x-edit>
</x-dashboard>