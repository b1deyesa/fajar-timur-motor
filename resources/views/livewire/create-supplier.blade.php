<x-modal :modal="$modal" title="Tambah Supplier" color="add">

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-plus"></i>
        Tambah Supplier
    </x-slot:label>

    {{-- Slot --}}
    <x-input 
        label="Nama Supplier" 
        type='text' 
        name='value.nama' 
        placeholder='Nama Supplier' 
        :required="true"
        />
    <x-input 
        label="Alamat Supplier" 
        type='text' 
        name='value.alamat' 
        placeholder='Alamat Supplier' 
        />
    <x-input 
        label="No. Telp" 
        type='text' 
        name='value.telp' 
        placeholder='No. Telp' 
        />

    {{-- Navigation --}}
    <x-slot:navigation>
        <button type="submit" class="create"><i class="fa-solid fa-plus"></i>Tambah</button>
    </x-slot:navigation>
</x-modal>
