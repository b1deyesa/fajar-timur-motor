<x-modal :modal="$modal" title="Tambah Admin" color="add">

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-plus"></i>
        Tambah Admin
    </x-slot:label>

    {{-- Slot --}}
    <x-input 
        label="Nama Admin" 
        type='text' 
        name='value.nama' 
        placeholder='Nama Admin' 
        :required="true" 
        />
    <x-input 
        label="Alamat Admin" 
        type='text' 
        name='value.alamat' 
        placeholder='Alamat Admin' 
        />
    <x-input 
        label="No. Telp" 
        type='text' 
        name='value.telp' 
        placeholder='No. Telp' 
        />
    <x-input 
        label="Password" 
        type='password' 
        name='value.password'
        placeholder='Password' 
        :required="true" 
        />

    {{-- Navigation --}}
    <x-slot:navigation>
        <button type="submit" class="create"><i class="fa-solid fa-plus"></i>Tambah</button>
    </x-slot:navigation>
</x-modal>
