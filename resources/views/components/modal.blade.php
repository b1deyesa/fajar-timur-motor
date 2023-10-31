<div class="modal">

    {{-- Button --}}
    <button wire:click="open" class="{{ $color }}">{{ $label }}</button>

    {{-- Modal --}}
    @if ($modal)
    <section class="{{ $class }}">
        <div class="container">
            <div class="header">
                <p class="title">{{ $title }}</p>
                <button wire:click="close" class="close">X</button>
            </div>
            <form wire:submit="submit">
                <table>
                    {{ $slot }}
                    <tr>
                        <td colspan="3">
                            <div class="navigation">
                                {{ $navigation }}
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </section>
    @endif
</div>
