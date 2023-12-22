<x-modal :modal="$modal" title="Hapus Barang" class="modal-confirm" color="delete">

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-trash"></i>
        Hapus
    </x-slot:label>

    {{-- Slot --}}
    <p>Yakin ingin menghapus <b>{{ $detail_ro->supplier_barang->barang->nama }}</b> ?</p>

    {{-- Navigation --}}
    <x-slot:navigation>
        <button type="button" wire:click="close" class="cancel">Batal</button>
        <button type="button" wire:click="delete({{ $detail_ro }})" class="delete">Hapus</button>
    </x-slot:navigation>
</x-modal>