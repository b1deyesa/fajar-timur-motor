<x-layout>
  <section class="kasir">

    {{-- Header --}}
    <x-header>
      <x-slot:side>
        <a href="{{ route('logout') }}" class="button logout">Logout</a>
      </x-slot:side>
    </x-header>

    {{-- Slot --}}
    {{ $slot }}
  </section>
</x-layout>