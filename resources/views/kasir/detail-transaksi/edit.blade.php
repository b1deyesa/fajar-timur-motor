<x-kasir>
    <x-edit title="{{ $transaksi->kode }}" route="{{ route('kasir.detail-transaksi.update', compact('transaksi', 'detail_transaksi')) }}">

        {{-- Button --}}
        <x-slot:button>
            @livewire('kasir-delete-detail-transaksi', compact('transaksi', 'detail_transaksi'))
        </x-slot:button>

        {{-- Slot --}}
        <x-input
            label="Barang" 
            type='text' 
            :value="$detail_transaksi->barang->nama" 
            :disabled="true"
            :required="true" 
            />
        <x-input
            label="Quantity" 
            type='text' 
            name='jumlah' 
            placeholder='Quantity' 
            :value="$detail_transaksi->jumlah" 
            :required="true" 
            />
        <x-input
            label="Harga Jual" 
            type='text' 
            name='harga_jual' 
            placeholder='Harga Jual' 
            :value="$detail_transaksi->harga_jual" 
            :required="true" 
            />
        <x-input
            label="Deskripsi" 
            type='textarea' 
            name='deskripsi' 
            placeholder='Deskripsi' 
            :value="$detail_transaksi->deskripsi" 
            />

        {{-- Navigation --}}
        <x-slot:navigation>
            <button type="submit" class="update"><i class="fa-solid fa-pen"></i>Update</button>
        </x-slot:navigation>
    </x-edit>
</x-kasir>