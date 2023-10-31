<div class="modal">
    {{-- Button --}}
    <button wire:click="open" class="info"><i class="fa-regular fa-clipboard"></i></i>Status Barang</button>

    {{-- Modal --}}
    @if ($modal)
        <section class="modal-form">
            <div class="container">
                <div class="head">
                    <p class="title">Status Barang</p>
                    <button wire:click="close" class="close">X</button>
                </div>
                <div class="content">
                    <select wire:modal.lazy="data">
                        <option value="Halo">Halo</option>
                    </select>
                    {{ $data }}
                </div>
            </div>
        </section>
    @endif
</div>
