<x-modal :modal="$modal" title="Hapus Admin" class="modal-confirm" color="delete">

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-trash"></i>
        Hapus Admin
    </x-slot:label>

    {{-- Slot --}}
    <p>Yakin ingin menghapus data <b>{{ $user->nama }}</b> ?</p>

    {{-- Navigation --}}
    <x-slot:navigation>
        <button type="button" wire:click="close" class="cancel">Batal</button>
        <button type="button" wire:click="delete({{ $user }})" class="delete">Hapus</button>
    </x-slot:navigation>
</x-modal>

