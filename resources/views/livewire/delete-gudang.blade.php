<x-modal :modal="$modal" title="Hapus Gudang" class="modal-confirm" color="delete">

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-trash"></i>
        Hapus Gudang
    </x-slot:label>

    {{-- Slot --}}
    <p>Yakin ingin menghapus data <b>{{ $gudang->nama }}</b> ?</p>

    {{-- Navigation --}}
    <x-slot:navigation>
        <button type="button" wire:click="close" class="cancel">Batal</button>
        <button type="button" wire:click="delete({{ $gudang }})" class="delete">Hapus</button>
    </x-slot:navigation>
</x-modal>