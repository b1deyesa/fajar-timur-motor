<x-dashboard>
    <x-edit title="Barang - {{ $barang->nama }}" route="{{ route('barang.update', compact('gudang', 'barang')) }}">

        {{-- Button --}}
        <x-slot:button>
            @livewire('delete-barang', compact('gudang', 'barang'))
        </x-slot:button>

        {{-- Slot --}}
        <x-input
            label="Kode Barang" 
            type="text" 
            name="kode"
            :value="$barang->kode" 
            :disabled="true"
            :required="true" 
            />
        <x-input 
            label="Lokasi Barang"
            type="select" 
            name="gudang_id">
            <option value="{{ $gudang->id }}" disabled selected>[{{ $gudang->kode }}] {{ $gudang->nama }}</option>
            @foreach ($gudangs as $gudang)
                <option value="{{ $gudang->id }}">[{{ $gudang->kode }}] {{ $gudang->nama }}</option>
            @endforeach
        </x-input>
        <x-input
            label="Nama Barang" 
            type='text' 
            name='nama' 
            placeholder='Nama Barang' 
            :value="$barang->nama" 
            :required="true" 
            />
        <x-input
            label="Merek" 
            type='text' 
            name='merek' 
            placeholder='Merek' 
            :value="$barang->merek" 
            />
        <x-input
            label="Deskripsi" 
            type='textarea' 
            name='deskripsi' 
            placeholder='Deskripsi' 
            :value="$barang->deskripsi" 
            />

        {{-- Navigation --}}
        <x-slot:navigation>
            <button type="submit" class="update"><i class="fa-solid fa-pen"></i>Update</button>
        </x-slot:navigation>
    </x-edit>
</x-dashboard>