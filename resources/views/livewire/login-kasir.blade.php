<x-modal :modal="$modal" title="Login Kasir">

    {{-- Failed Message --}}
    @if ($failed)
        <div class="failed-message">ID atau Password yang anda masukkan salah</div>
    @endif

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-list-check"></i>
        <p>Akses Menu Transaksi</p>
    </x-slot:label>

    {{-- Slot --}}
    <x-input 
        label="ID Kasir" 
        type='text' 
        name='value.username' 
        placeholder='Masukkan ID Kasir' 
        :required="true" 
        />
    <x-input 
        label="Password" 
        type='password' 
        name='value.password' 
        placeholder='Masukkan Password'
        :required="true" 
        />
        
    {{-- Navigation --}}
    <x-slot:navigation>
        <button type="submit">LOGIN</button>
    </x-slot:navigation>
</x-modal>