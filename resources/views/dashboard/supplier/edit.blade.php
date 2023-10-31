<x-dashboard>
    <x-edit title="Supplier - {{ $supplier->nama }}" route="{{ route('supplier.update', compact('supplier')) }}">

        {{-- Button --}}
        <x-slot:button>
            @livewire('delete-supplier', compact('supplier'))
        </x-slot:button>

        {{-- Slot --}}
        <x-input
            label="Kode Supplier" 
            type='text' 
            :value="$supplier->kode" 
            :disabled="true"
            :required="true" 
            />
        <x-input
            label="Nama Supplier" 
            type='text' 
            name='nama' 
            placeholder='Nama Supplier' 
            :value="$supplier->nama" 
            :required="true" 
            />
        <x-input
            label="Alamat Supplier" 
            type='text' 
            name='alamat' 
            placeholder='Alamat Supplier' 
            :value="$supplier->alamat" 
            />
        <x-input
            label="No. telp" 
            type='text' 
            name='telp' 
            placeholder='No. Telp' 
            :value="$supplier->telp" 
            />

        {{-- Navigation --}}
        <x-slot:navigation>
            <button type="submit" class="update"><i class="fa-solid fa-pen"></i>Update</button>
        </x-slot:navigation>
    </x-edit>
</x-dashboard>
