<x-dashboard>
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush

    {{-- Alert --}}
    <x-alert />
    
    {{-- Table --}}
    <x-table title="Semua Gudang" color="red">
        <x-slot:button>
            @livewire('create-gudang')
            {{-- Status Barang --}}
            <button id="btn-status-barang" class="info">Status Barang</button>
            <section id="status-barang" class="modal-form">
                <div class="container">
                    <div class="header">
                        <p class="title">Status Barang</p>
                        <button id="close-status-barang" class="close">X</button>
                    </div>
                    <form method="POST" action="{{ route('barang.info') }}">
                        @csrf
                        <table>
                            <tr>
                                <td colspan="3">
                                    <select class="select" name="barang[]" style="width: 100%" multiple="multiple">
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}">[{{ $barang->kode }}] {{ $barang->nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="navigation">
                                        <button type="submit">Cari</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </section>
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
                <td align="center" class="action">
                    <a href="{{ route('gudang.edit', compact('gudang')) }}" id="edit"><i class="fa-solid fa-pen"></i>Edit</a>
                    <a href="{{ route('barang.index', compact('gudang')) }}" id="info"><i class="fa-solid fa-eye"></i>Lihat</a>
                </td>
            </tr>
            @endforeach
        </x-slot:body>
    </x-table>

    @push('script')   
        <script>
            if(performance.navigation.type == 2){
                location.reload(true);
            }
            $("#status-barang").hide();
            $(document).ready(function(){
                $("#btn-status-barang").click(function(){
                    $("#status-barang").toggle();
                });
                $("#close-status-barang").click(function(){
                    $("#status-barang").toggle();
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.select').select2({
                    placeholder: "Pilih barang",
                });
            });
        </script>create
    @endpush
</x-dashboard>


