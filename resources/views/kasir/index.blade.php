<x-kasir>

  {{-- Alert --}}
  <x-alert />

  {{-- Title Bar --}}
  <div class="title-bar">
    <h3>Kasir Fajar Timur Motor</h3>
    <small>Selamat {{ $day }}, {{ Auth::user()->nama }}</small>
  </div>

  {{-- Kasir Form --}}
  @livewire('kasir')
</x-kasir>