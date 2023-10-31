<div class="modal">
    {{-- Button --}}
    <button wire:click="open" class="delete"><i class="fa-solid fa-trash"></i>Hapus</button>
    
    {{-- Modal --}}
    @if ($modal)
    <section class="modal-confirm">
        <div class="container">
            <div class="head">
                <p class="title">Hapus Barang</p>
            </div>
            <div class="content">
                <p>Hapus data {{ $barang->nama }}?</p>
                <span>
                    <button wire:click="close" class="cancel">Batal</button>
                    <button wire:click="delete({{ $barang }})" class="delete">Hapus</button>
                </span>
            </div>
        </div>
    </section>
    @endif
</div>