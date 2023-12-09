<x-modal :modal="$modal" title="Tambah Barang" color="add">

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-plus"></i>
        Tambah Barang
    </x-slot:label>

    {{-- Slot --}}
    @if ($step == 1)
    <tr class="label">
        <td>Supplier</td>
        <td>:</td>
        <td class="input">
            <select wire:model.lazy="datasup" id="select">
                <option value="">Tambah Supplier</option>
                @foreach ($suppliers as $supplier)    
                    <option value="{{ $supplier->id }}">[{{ $supplier->kode }}] {{ $supplier->nama }}</option>
                @endforeach
            </select>
        </td>
    </tr>
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

    @elseif ($step == 2)
    <x-input 
        label="Nama Barang"
        type="text"
        name="barang.nama"
        placeholder="Nama Barang"
        :required="true"
        />
    <x-input 
        label="Merek"
        type="text"
        name="barang.merek"
        placeholder="Merek"
        />
    <x-input 
        label="Harga Beli"
        type="text"
        name="barang.harga_beli"
        placeholder="Isi angka 0 bila belum diketahui"
        :required="true"
        />
    <x-input 
        label="Deskripsi"
        type="textarea"
        name="barang.deskripsi"
        placeholder="Deskripsi"
        />
    <x-input 
        label="Stok saat ini"
        type="text"
        name="barang.stok"
        placeholder="Isi angka 0 bila belum diketahui"
        :required="true"
        />
    @endif

    {{-- Navigation --}}
    <x-slot:navigation>
        @if ($step == 1)
            <button type="button" wire:click="next" class="update"><i class="fa-solid fa-angle-right"></i>Selanjutnya</button>
        @elseif ($step == 2)
            <button type="button" wire:click="previous" class="update"><i class="fa-solid fa-angle-left"></i>Kembali</button>
            <button type="button" wire:click="submit" class="create"><i class="fa-solid fa-plus"></i>Tambah</button>
        @endif
    </x-slot:navigation>
</x-modal>