<x-dashboard>
    <x-edit title="Detail Request" route="{{ route('ro.stok-update', compact('ro', 'detail_ro')) }}">

        <x-slot:button>
            <div class="detail">
                <table>
                    <tr>
                        <td colspan="3" align="right">
                            @livewire('delete-detail-r-o', compact('ro', 'detail_ro'))
                        </td>
                    </tr>
                    <tr>
                        <td>No. Request</td>
                        <td>:</td>
                        <td>{{ $detail_ro->ro->kode }}</td>
                    </tr>
                    <tr>
                        <td>Nama Barang</td>
                        <td>:</td>
                        <td>{{ $detail_ro->supplier_barang->barang->nama }}</td>
                    </tr>
                    <tr>
                        <td>Supplier</td>
                        <td>:</td>
                        <td>{{ $detail_ro->supplier_barang->supplier->nama }}</td>
                    </tr>
                    <tr>
                        <td>Stok Diminta</td>
                        <td>:</td>
                        <td>{{ $detail_ro->stok_diminta }}</td>
                    </tr>
                </table>
            </div>
        </x-slot:button>
        
        {{-- Slot --}}
        <x-input
            label="Stok yang diterima" 
            type='number' 
            name='stok'
            :value="$detail_ro->supplier_barang->stok"
            :required="true" 
            />

        {{-- Navigation --}}
        <x-slot:navigation>
            <button type="submit" class="update"><i class="fa-solid fa-pen"></i>Update</button>
        </x-slot:navigation>
    </x-edit>
</x-dashboard>
