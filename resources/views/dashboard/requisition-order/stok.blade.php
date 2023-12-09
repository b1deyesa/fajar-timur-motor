<x-dashboard>
    <x-edit title="Detail Request" route="{{ route('requisition-order.status_diterima_update', ['supplierBarang' => $requisition_order->supplier_barang]) }}">

        <x-slot:button>
            <div class="detail">
                <table>
                    <tr>
                        <td>No. Request</td>
                        <td>:</td>
                        <td>{{ $requisition_order->kode }}</td>
                    </tr>
                    <tr>
                        <td>Nama Barang</td>
                        <td>:</td>
                        <td>{{ $requisition_order->supplier_barang->barang->nama }}</td>
                    </tr>
                    <tr>
                        <td>Supplier</td>
                        <td>:</td>
                        <td>{{ $requisition_order->supplier_barang->supplier->nama }}</td>
                    </tr>
                </table>
            </div>
        </x-slot:button>
        
        {{-- Slot --}}
        <x-input
            label="Stok yang diminta" 
            type='number' 
            name='stok'
            :value="$requisition_order->supplier_barang->stok"
            :required="true" 
            />
        <x-input
            label="Stok yang diterima" 
            type='number' 
            name='stok_diterima'
            :value="$requisition_order->stok_diterima" 
            :required="true" 
            />

        {{-- Navigation --}}
        <x-slot:navigation>
            <button type="submit" class="update"><i class="fa-solid fa-pen"></i>Update</button>
        </x-slot:navigation>
    </x-edit>
</x-dashboard>
