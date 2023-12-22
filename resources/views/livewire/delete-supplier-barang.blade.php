<x-modal :modal="$modal" title="Hapus Stok Barang" class="modal-confirm" color="delete">

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-trash"></i>
        Hapus Stok Barang
    </x-slot:label>

    {{-- Slot --}}
    <p>Yakin ingin menghapus stok <b>{{ $barang->nama }}</b> ?</p>

    {{-- Navigation --}}
    <x-slot:navigation>
        <button type="button" wire:click="close" class="cancel">Batal</button>
        <button type="button" wire:click="delete({{ $supplier_barang }})" class="delete">Hapus</button>
    </x-slot:navigation>
</x-modal>