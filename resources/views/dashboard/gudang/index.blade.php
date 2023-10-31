<x-dashboard>
    
    {{-- Alert --}}
    <x-alert />

    {{-- Table --}}
    <x-table title="Semua Gudang" color="red">
        <x-slot:button>
            @livewire('create-gudang')
            @livewire('status-barang')
        </x-slot:button>
        <x-slot:head>
            <tr>
                <th>No</th>
                <th>Kode Gudang</th>
                <th>Nama Gudang</th>
                <th>Alamat Gudang</th>
                <th>Total Kapasitas</th>
                <th>Sisa Kapasitas</th>
                <th>Action</th>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @foreach ($gudangs as $key => $gudang)
            <tr>
                <td align="center">{{ $key + 1 }}</td>
                <td align="center">{{ $gudang->kode }}</td>
                <td>{{ $gudang->nama }}</td>
                <td>{{ $gudang->alamat }}</td>
                <td align="center">{{ $gudang->kapasitas }}</td>
                <td align="center">{{ $gudang->kapasitas - $gudang->barangs->count() }}</td>
                <td align="center">
                    <a href="{{ route('gudang.edit', compact('gudang')) }}">Edit</a>
                    <a href="{{ route('barang.index', compact('gudang')) }}">Lihat</a>
                </td>
            </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-dashboard>
