<x-modal :modal="$modal" title="Hapus Supplier" class="modal-confirm" color="delete">

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-trash"></i>
        Hapus Supplier
    </x-slot:label>

    {{-- Slot --}}
    <p>Yakin ingin menghapus data <b>{{ $supplier->nama }}</b> ?</p>

    {{-- Navigation --}}
    <x-slot:navigation>
        <button type="button" wire:click="close" class="cancel">Batal</button>
        <button type="button" wire:click="delete({{ $supplier }})" class="delete">Hapus</button>
    </x-slot:navigation>
</x-modal>

