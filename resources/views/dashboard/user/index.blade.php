<x-dashboard>
    
    {{-- Alert --}}
    <x-alert />

    {{-- Table --}}
    <x-table title="Semua Admin" color="blue">
        <x-slot:button>
            @livewire('create-user')
        </x-slot:button>
        <x-slot:head>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Action</th>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @foreach ($users as $user)
            <tr>
                <td align="center">{{ $user->username }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->alamat }}</td>
                <td>{{ $user->telp }}</td>
                <td align="center">
                    <a href="{{ route('user.edit', compact('user')) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-dashboard>
