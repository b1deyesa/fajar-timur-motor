<x-modal :modal="$modal" title="Request" color="add">

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-plus"></i>
        Request
    </x-slot:label>

    {{-- Slot --}}
    @if ($step == 1)
    <tr class="label">
        <td>Barang</td>
        <td>:</td>
        <td class="input">
            <select wire:model.lazy="databar" id="select2">
                <option value="">Tambah Barang</option>
                @foreach ($barangs as $barang)    
                    <option value="{{ $barang->id }}">[{{ $barang->kode }}] {{ $barang->nama }}</option>
                @endforeach
            </select>
        </td>
    </tr>
    <x-input 
        label="Nama Barang"
        type="text"
        name="barang.nama"
        placeholder="Nama Barang"
        :required="true"
        :disabled="$disabled_barang ?? false"
        />
    @if (!$disabled_barang)
        <x-input 
            label="Gudang"
            type="select"
            name="barang.gudang_id"
            :required="true"
            >
            <option value="">Pilih Gudang</option>
            @foreach ($gudangs as $gudang)    
                <option value="{{ $gudang->id }}">[{{ $gudang->kode }}] {{ $gudang->nama }}</option>
            @endforeach
        </x-input>
    @endif
    <x-input 
        label="Merek"
        type="text"
        name="barang.merek"
        placeholder="Merek"
        :disabled="$disabled_barang ?? false"
        />
    <x-input 
        label="Deskripsi"
        type="textarea"
        name="barang.deskripsi"
        placeholder="Deskripsi"
        :disabled="$disabled_barang ?? false"
        />
    
    <tr><td colspan="3"><hr></td></tr>
        
    <x-input 
        label="Harga Beli"
        type="text"
        name="barang.harga_beli"
        placeholder="Isi angka 0 bila belum diketahui"
        :required="true"
        />
    <x-input 
        label="Stok Diminta"
        type="text"
        name="barang.stok"
        placeholder="Isi angka 0 bila belum diketahui"
        :required="true"
        />
        
    @elseif ($step == 2)
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