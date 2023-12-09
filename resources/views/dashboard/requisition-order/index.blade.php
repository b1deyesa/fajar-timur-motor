<x-dashboard>
    
    {{-- Alert --}}
    <x-alert />

    {{-- Table --}}
    <x-table title="Semua Requisition Order" color="blue">
        <x-slot:button>
            @livewire('create-requisition-order')
        </x-slot:button>
        <x-slot:head>
            <tr>
                <th>Kode RO</th>
                <th>Barang</th>
                <th>Requestor</th>
                <th>Supplier</th>
                <th>Stok yang diminta</th>
                <th>Stok yang diterima</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @foreach ($requisition_orders as $requisition_order)
            <tr>
                <td align="center">{{ $requisition_order->kode }}</td>
                <td style="min-width: 14em">[{{ $requisition_order->supplier_barang->barang->kode }}] {{ $requisition_order->supplier_barang->barang->nama }}</td>
                <td>{{ $requisition_order->user->nama }}</td>
                <td>{{ $requisition_order->supplier_barang->supplier->nama }}</td>
                <td align="center">{{ $requisition_order->supplier_barang->stok }}</td>
                <td align="center">{{ $requisition_order->stok_diterima }}</td>
                <td align="center" style="min-width:7em; color: 
                    @if ($requisition_order->supplier_barang->status == 'Dalam Proses')
                        orange
                    @elseif ($requisition_order->supplier_barang->status == 'Telah Dikirim')
                        green
                    @elseif ($requisition_order->supplier_barang->status == 'Dibatalkan')
                        red
                    @endif
                    "
                >{{ $requisition_order->supplier_barang->status }}</td>
                <td align="center" class="action">
                    @if ($requisition_order->supplier_barang->status != 'Dibatalkan')
                        <a href="{{ route('requisition-order.status_diterima', ['supplierBarang' => $requisition_order->supplier_barang->id]) }}" id="add">Diterima</a>
                        <a href="{{ route('requisition-order.status_batalkan', ['supplierBarang' => $requisition_order->supplier_barang->id]) }}" id="delete">Batal</a>
                    @else
                        <a href="{{ route('requisition-order.status_proses', ['supplierBarang' => $requisition_order->supplier_barang->id]) }}" id="edit">Proses</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-dashboard>
