<x-modal :modal="$modal" title="Tambah Gudang" color="add">

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-plus"></i>
        Tambah Gudang
    </x-slot:label>

    {{-- Slot --}}
    <x-input 
        label="Nama Gudang" 
        type='text' 
        name='value.nama' 
        placeholder='Nama Gudang' 
        :required="true" 
        />
    <x-input 
        label="Alamat Gudang" 
        type='text' 
        name='value.alamat' 
        placeholder='Alamat Gudang' 
        />
    <x-input 
        label="Kapasitas" 
        type='text' 
        name='value.kapasitas' 
        placeholder='Isi angka 0 bila belum diketahui' 
        :required="true" 
        />

    {{-- Navigation --}}
    <x-slot:navigation>
        <button type="submit" class="create"><i class="fa-solid fa-plus"></i>Tambah</button>
    </x-slot:navigation>
</x-modal>
