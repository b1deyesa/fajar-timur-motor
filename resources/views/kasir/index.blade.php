<x-kasir>

  {{-- Alert --}}
  <x-alert />

  {{-- Title Bar --}}
  <div class="title-bar">
    <h3>Kasir Fajar Timur Motor</h3>
    <small>Selamat {{ $day }}, {{ Auth::user()->nama }}</small>
    <form method="GET" action="{{ route('kasir.search') }}">
      <input type="search" name="search" placeholder="Cari nota disini" value="{{ request()->search }}">
      <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
  </div>

  {{-- Kasir Form --}}
  @livewire('kasir')
</x-kasir>