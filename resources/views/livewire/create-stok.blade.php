<x-modal :modal="$modal" title="Tambah Stok" color="add">
    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-plus"></i>
        Tambah Stok
    </x-slot:label>

    {{-- Slot --}}
    <x-input 
        label="Supplier" 
        type='select' 
        name='data'
        >
        <option value="">Tambah Supplier</option>
        @foreach ($suppliers as $supplier)
            <option value="{{ $supplier->id }}">[{{ $supplier->kode }}] {{ $supplier->nama }}</option>
        @endforeach
    </x-input>
    <x-input 
        label="Nama Supplier" 
        type="text" 
        name="supplier.nama" 
        placeholder="Nama Supplier" 
        :disabled="$disabled ?? false" 
        :required="true"
        />
    <x-input 
        label="Alamat Supplier" 
        type="text" 
        name="supplier.alamat" 
        placeholder="Alamat Supplier" 
        :disabled="$disabled ?? false" 
        />
    <x-input 
        label="No. Telp" 
        type="text" 
        name="supplier.telp" 
        placeholder="No. Telp" 
        :disabled="$disabled ?? false" 
        />

    <tr><td colspan="3"><hr></td></tr>
    
    <x-input 
        label="Harga Beli" 
        type="text" 
        name="supplier.harga_beli" 
        placeholder="Isi angka 0 bila belum diketahui"
        :required="true"
        />
    <x-input 
        label="Stok" 
        type="text" 
        name="supplier.stok" 
        placeholder="Tambah Jumlah Stok" 
        :required="true"
        />
    
    {{-- Navigation --}}
    <x-slot:navigation>
        <button type="submit" class="create"><i class="fa-solid fa-plus"></i>Tambah</button>
    </x-slot:navigation>
</x-modal>
