<div>
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush

    @if ($step == 1)
    <table>
        <tr class="label">
            <td>Supplier</td>
            <td>:</td>
            <td>
                <div wire:ignore>
                    <select class="datasup" wire:model="datasup" style="width: 100%;">
                        <option value="">Tambah Supplier</option>
                        @foreach($suppliers as $item)
                            <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </td>
        </tr>
        <x-input 
            label="Nama Supplier" 
            type="text" 
            name="supplier.nama" 
            placeholder="Nama Supplier" 
            :disabled="$disabled_supplier ?? false" 
            :required="true"
            />
        <x-input 
            label="Alamat Supplier" 
            type="text" 
            name="supplier.alamat" 
            placeholder="Alamat Supplier" 
            :disabled="$disabled_supplier ?? false" 
            />
        <x-input 
            label="No. Telp" 
            type="text" 
            name="supplier.telp" 
            placeholder="No. Telp" 
            :disabled="$disabled_supplier ?? false" 
            />
        <tr>
            <td colspan="3">
                <div class="navigation">
                    <button type="button" class="info" wire:click="next" style="min-width: 100%"><i class="fa-solid fa-angle-right"></i>Selanjutnya</button>
                </div>
            </td>
        </tr>
    </table>

    @elseif ($step == 2)
        <table>
            @foreach ($values as $key => $value)
                <tr class="label">
                    <td colspan="3">
                        <div wire:ignore>
                            <select class="barang{{ $key }}" wire:model="barang.{{ $key }}" style="width: 100%;">
                                <option value="">Tambah Barang</option>
                                @foreach($barangs as $item)
                                    <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right" colspan="3">
                        @if (count($values) != 1)
                            <button type="button" wire:click="hapus({{ $key }})" class="delete"><i class="fa-solid fa-trash"></i>Hapus</button>
                        @endif
                    </td>
                </tr>
                <x-input
                    label="Nama Barang" 
                    type='text' 
                    name='values.{{ $key }}.nama' 
                    placeholder='Masukkan Nama Barang' 
                    :required="true" 
                    :disabled="$barang[$key] != null ? true : false"
                    />
                <x-input
                    label="Merek" 
                    type='text' 
                    name='values.{{ $key }}.merek' 
                    placeholder='Masukkan Merek' 
                    :disabled="$barang[$key] != null ? true : false"
                    />
                <x-input
                    label="Deskripsi" 
                    type='textarea' 
                    name='values.{{ $key }}.deskripsi' 
                    placeholder='Masukkan Deskripsi' 
                    :disabled="$barang[$key] != null ? true : false"
                    />
                <x-input
                    label="Harga Beli" 
                    type='text' 
                    name='values.{{ $key }}.harga_beli' 
                    placeholder='Masukkan Harga Beli' 
                    :required="true"
                    />
                <x-input
                    label="Stok Diminta" 
                    type='number' 
                    name='values.{{ $key }}.stok_diminta' 
                    placeholder='Masukkan Request Stok' 
                    :required="true"
                    />
                <tr>
                    <td colspan="3">
                        <hr>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3">
                    <div class="navigation">
                        <button type="button" class="update" wire:click="tambah" style="min-width: 100%"><i class="fa-solid fa-plus"></i>Tambah Barang</button>
                    </div>
                    <div class="navigation">
                        <button type="button" class="info" wire:click="previous" style="width: 100%"><i class="fa-solid fa-angle-left"></i>Kembali</button>
                        <button type="button" class="add" wire:click="submit" style="width: 100%">SUBMIT</button>
                    </div>
                </td>
            </tr>
        </table>
    @endif
</div>

@push('script')
    <script>
        window.addEventListener('selectl', event => {
            $(document).ready(function() {
                $(".datasup").select2();
                $('.datasup').on('change', function (e) {
                    var data = $('.datasup').select2("val");
                    @this.set('datasup', data);
                });
            });
        });
    </script>
    <script>
        for (let i = 0; i < 100; i++) {
        window.addEventListener('selectl', event => {
            $(document).ready(function() {
                $(".barang" + i).select2();
                $('.barang' + i).on('change', function (e) {
                    var data = $('.barang' + i).select2("val");
                    @this.set('barang.' + i, data);
                });
            });
        });
        }
    </script>
@endpush
