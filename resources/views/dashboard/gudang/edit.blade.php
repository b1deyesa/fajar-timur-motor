<x-dashboard>
    <x-edit title="Gudang - {{ $gudang->nama }}" route="{{ route('gudang.update', compact('gudang')) }}">

        {{-- Button --}}
        <x-slot:button>
            @livewire('delete-gudang', compact('gudang'))
        </x-slot:button>

        {{-- Slot --}}
        <x-input 
            label="Kode Gudang" 
            type='text' 
            :value="$gudang->kode" 
            :disabled="true" 
            :required="true" 
            />
        <x-input 
            label="Nama Gudang" 
            type='text' 
            name='nama' 
            placeholder='Nama Gudang' 
            :value="$gudang->nama" 
            :required="true" 
            />
        <x-input 
            label="Alamat Gudang" 
            type='text' 
            name='alamat' 
            placeholder='Alamat Gudang' 
            :value="$gudang->alamat" 
            />
        <x-input 
            label="Kapasitas" 
            type='text' 
            name='kapasitas' 
            placeholder='Kapasitas Gudang' 
            :value="$gudang->kapasitas" 
            :required="true" 
            />

        {{-- Navigation --}}
        <x-slot:navigation>
            <button type="submit" class="update"><i class="fa-solid fa-pen"></i>Update</button>
        </x-slot:navigation>
    </x-edit>
</x-dashboard>