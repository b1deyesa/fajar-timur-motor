<x-dashboard>
    
    {{-- Alert --}}
    <x-alert />

    {{-- Table --}}
    <x-table title="Semua Supplier" color="light-blue">
        <x-slot:button>
            @livewire('create-supplier')
        </x-slot:button>
        <x-slot:head>
            <tr>
                <th>No</th>
                <th>Kode Supplier</th>
                <th>Nama Supplier</th>
                <th>Alamat Supplier</th>
                <th>No Telp</th>
                <th>Action</th>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @foreach ($suppliers as $key => $supplier)
                <tr>
                    <td align="center">{{ $key + 1 }}</td>
                    <td align="center">{{ $supplier->kode }}</td>
                    <td>{{ $supplier->nama }}</td>
                    <td>{{ $supplier->alamat }}</td>
                    <td>{{ $supplier->telp }}</td>
                    <td align="center">
                        <a href="{{ route('supplier.edit', compact('supplier')) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-dashboard>
