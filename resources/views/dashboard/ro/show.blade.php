<x-dashboard>
    
    {{-- Alert --}}
    <x-alert />

    {{-- Table --}}
    <x-table title="Requisition Order - {{ $ro->kode }}" color="yellow">
        <x-slot:button>
            {{-- @livewire('create-user') --}}
        </x-slot:button>
        <x-slot:head>
            <tr>
                <th style="max-width: 60px">Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stok Diminta</th>
                <th>Stok Diterima</th>
                <th>Status</th>
                <th style="max-width: 60px">Action</th>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @foreach ($detail_ros as $detail_ro)
            <tr>
                <td align="center">{{ $detail_ro->supplier_barang->barang->kode }}</td>
                <td>{{ $detail_ro->supplier_barang->barang->nama }}</td>
                <td align="center">{{ $detail_ro->stok_diminta }}</td>
                <td align="center">{{ $detail_ro->supplier_barang->stok }}</td>
                <td  align="center" style="color: 
                    @if ($detail_ro->status == 'Dalam Proses')
                        orange
                    @elseif ($detail_ro->status == 'Selesai')
                        green
                    @elseif ($detail_ro->status == 'Dibatalkan')
                        red
                    @endif
                    ">
                    {{ $detail_ro->status }}
                </td>
                <td align="center" class="action">
                    <a href="{{ route('ro.stok', compact('ro', 'detail_ro')) }}" id="edit"><i class="fa-solid fa-pencil"></i>Edit</a>
                </td>
            </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-dashboard>
