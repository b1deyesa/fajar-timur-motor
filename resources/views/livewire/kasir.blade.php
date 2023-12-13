<div class="container">
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush
    <form class="kasir-form">
        @if ($step == 1)
        @foreach ($values as $key => $value)
        <div class="bar">
            <h6>Barang {{ $key + 1 }}</h6> 
            @if (count($values) != 1)
                <button type="button" wire:click="hapus({{ $key }})" class="delete"><i class="fa-solid fa-trash"></i>Hapus</button>
            @endif
        </div>
        <table>
            <tr class="label">
                <td>Barang</td>
                <td>:</td>
                <td>
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
            <x-input
                label="Nama Barang" 
                type='text' 
                name='values.{{ $key }}.nama' 
                placeholder='Masukkan Nama Barang' 
                :required="true" 
                :disabled="$barang[$key] != null ? true : false"
                />
            <tr class="label ">
                <td>Quantity <span class="required" /></td>
                <td>:</td>
                <td class="input">
                    <div class="quantity">
                        <input 
                            type="text" 
                            name='values.{{ $key }}.jumlah' 
                            placeholder="Masukkan Quantity"
                            value="{{ old('values.'.$key.'.jumlah') }}" 
                            autocomplete="off" 
                            wire:model.lazy="values.{{ $key }}.jumlah"
                        >
                        <select wire:model.lazy="values.{{ $key }}.satuan">
                            <option value="pcs">pcs</option>
                            <option value="set">set</option>
                        </select>
                    </div>
                    @error("values.". $key .".jumlah")
                        <small>{{ $message }}</small>
                    @enderror
                </td>
            </tr>
            <x-input
                label="Harga Jual" 
                type='text' 
                name='values.{{ $key }}.harga_jual' 
                placeholder='Masukkan Harga Jual' 
                :required="true" 
                />
            <x-input
                label="Deskripsi" 
                type='textarea' 
                name='values.{{ $key }}.deskripsi' 
                placeholder='Deskripisi' 
                />
        </table>
        <hr>
        @endforeach
        <div class="navigation">
            <button type="button" class="add" wire:click="tambah"><i class="fa-solid fa-plus"></i>Tambah Barang</button>
            <button type="button" class="update" wire:click="next">Selanjutnya<i class="fa-solid fa-angle-right"></i></button>
        </div>
    
        @elseif ($step == 2)
        <div class="bar">
            <h6>Data Pembeli</h6>
        </div>
        <table>
            <x-input 
                label="Nama Pembeli"
                type="text"
                name="data_pembeli.nama_pembeli"
                placeholder='Masukkan Nama Pembeli'
                />
            <x-input 
                label="Metode Pembayaran"
                type="text"
                name="data_pembeli.metode_pembayaran"
                placeholder='Masukkan Metode Pembayaran'
                />
            <x-input 
                label="Agen Pengiriman"
                type="text"
                name="data_pembeli.agen_pengiriman"
                placeholder='Masukkan Agen Pengiriman'
                />
            <x-input 
                label="Harga Pengiriman"
                type="text"
                name="data_pembeli.harga_pengiriman"
                placeholder='Masukkan Harga Pengiriman'
                />
        </table>
        <hr>
        <h6 class="total">Subtotal : Rp{{ number_format($total, '2', ',', '.') }}</h6>
        <div class="navigation last">
            <button type="button" class="update" wire:click="previous"><i class="fa-solid fa-angle-left"></i>Sebelumnya</button>
            <button type="button" class="info" wire:click="submit"><i class="fa-solid fa-check"></i>Selesai</button>
        </div>
        @endif
    </form>
    
    @if ($invoice)
        <div class="invoice-popup">
            <div class="overlay">
                <div class="navigation">
                    <button type="button" onclick="window.location.reload();">Kembali</button>
                    <button type="button" class="info" onclick="printPageArea('printableArea')">Print</button>
                </div>
                <div id="printableArea">
                    <x-invoice :transaksi="$transaksi" :title="['BON ASLI', 'BON COPY']" />
                </div>
            </div>
        </div>
    @endif
</div>

@push('script')
    <script>
        function printPageArea(areaID){
            var printContent = document.getElementById(areaID).innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
        $(".barang0").select2({ dropdownCssClass: "myFont" });
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
