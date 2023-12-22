<x-modal :modal="$modal" title="Hapus Detail Transaksi" class="modal-confirm" color="delete">

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-trash"></i>
        Hapus
    </x-slot:label>

    {{-- Slot --}}
    <p>Yakin ingin menghapus?</p>

    {{-- Navigation --}}
    <x-slot:navigation>
        <button type="button" wire:click="close" class="cancel">Batal</button>
        <button type="button" wire:click="delete({{ $detail_transaksi }})" class="delete">Hapus</button>
    </x-slot:navigation>
</x-modal>