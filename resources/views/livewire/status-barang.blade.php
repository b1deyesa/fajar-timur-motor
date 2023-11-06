{{-- CSS --}}
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

<x-modal :modal="$modal" title="Status Barang" color="info">
    
    {{-- Label --}}
    <x-slot:label>
        Status Barang
    </x-slot:label>

    {{-- Slot --}}
    <tr>
        <td colspan="3">
            <select class="select" name="state" style="width: 100%">
                <option selected disabled>Silahkan dicari</option>
                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}">[{{ $barang->kode }}] {{ $barang->nama }}</option>
                @endforeach
            </select>
        </td>
    </tr>
</x-modal>

@push('script')
    <script>
        $(document).ready(function() {
            $('.select').select2();
        });
    </script>
@endpush
