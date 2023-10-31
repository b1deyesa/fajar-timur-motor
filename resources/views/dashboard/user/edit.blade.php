<x-dashboard>
    <x-edit title="Admin - {{ $user->nama }}" route="{{ route('user.update', compact('user')) }}">

        {{-- Button --}}
        <x-slot:button>
            @if (Auth::id() != $user->id)
                @livewire('delete-user', compact('user'))
            @endif
        </x-slot:button>

        {{-- Slot --}}
        <x-input
            label="ID" 
            type='text' 
            :value="$user->username" 
            :disabled="true" 
            :required="true" 
            />
        <x-input
            label="Nama Admin" 
            type='text' 
            name='nama' 
            placeholder='Nama Admin' 
            :value="$user->nama" 
            :required="true" 
            />
        <x-input
            label="Alamat Admin" 
            type='text' 
            name='alamat' 
            placeholder='Alamat Admin' 
            :value="$user->alamat" 
            />
        <x-input
            label="No. Telp" 
            type='text' 
            name='telp' 
            placeholder='No. Telp' 
            :value="$user->telp" 
            />
        <x-input
            label="Ubah Password" 
            type='text' 
            name='password' 
            placeholder='password' 
            />

        {{-- Navigation --}}
        <x-slot:navigation>
            <button type="submit" class="update"><i class="fa-solid fa-pen"></i>Update</button>
        </x-slot:navigation>
    </x-edit>
</x-dashboard>
