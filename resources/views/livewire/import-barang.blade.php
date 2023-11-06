<x-modal :modal="$modal" title="Import Barang" color="info">

    {{-- Label --}}
    <x-slot:label>
        <i class="fa-solid fa-file"></i>
        Import Barang
    </x-slot:label>

    {{-- Slot --}}
    <tr class="term">
        <td colspan="3">
            <small>
                <p><b>Jenis File</b> : .csv, xlx, xls</p>
                <b>Kolom</b> : 
                <ul>
                    <li>kode (text)<span class="required" /></li> 
                    <li>nama (text)<span class="required" /></li> 
                    <li>harga_beli (number)<span class="required" /></li>
                    <li>deskripsi (text)</li>
                    <li>merek (text)</li>
                </ul>
            </small>
            <hr>
        </td>
    </tr>
    <x-input 
        label="Import Barang"
        type='file'
        name='file'
        />
    
    {{-- Navigation --}}
    <x-slot:navigation>
        <button type="submit" class="update" wire:loading.attr="disabled">Import</button>
    </x-slot:navigation>
</x-modal>