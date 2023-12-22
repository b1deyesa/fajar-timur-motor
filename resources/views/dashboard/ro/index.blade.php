<x-dashboard>
    
    {{-- Alert --}}
    <x-alert />

    {{-- Table --}}
    <x-table title="Requisition Order" color="blue">
        <x-slot:button>
            <a href="{{ route('ro.create') }}"><i class="fa-solid fa-plus"></i>Buat Request</a>
        </x-slot:button>
        <x-slot:head>
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Supplier</th>
                <th>Admin</th>
                <th>Barang</th>
                <th style="max-width: 60px">Action</th>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @foreach ($ros as $ro)
            <tr>
                <td align="center">{{ $ro->kode }}</td>
                <td>{{ $ro->created_at->format('d M Y - H:i') }}</td>
                <td>{{ $ro->supplier->nama }}</td>
                <td>{{ $ro->user->nama }}</td>
                <td>
                    @foreach ($ro->detail_ros as $detail_ro)
                        {{ $detail_ro->supplier_barang->barang->nama }},
                    @endforeach
                </td>
                <td align="center" class="action">
                    <form method="POST" action="{{ route('ro.destroy', compact('ro')) }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin menghapus?')" id="delete"><i class="fa-solid fa-trash"></i>Hapus</button>
                    </form>
                    <a href="{{ route('ro.show', compact('ro')) }}" id="edit"><i class="fa-solid fa-eye"></i>Lihat Detail</a>
                </td>
            </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-dashboard>
