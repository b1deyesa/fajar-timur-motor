<div class="container">
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
                <x-input 
                    label="Kode Barang" 
                    type="select" 
                    name="barang.{{ $key }}">
                    <option value="">Pilih Barang</option>
                    @foreach ($barangs as $barang)    
                        <option value="{{ $barang->id }}">[{{ $barang->kode }}] {{ $barang->nama }}</option>
                    @endforeach
                </x-input>
                <x-input
                    label="Nama Barang" 
                    type='text' 
                    name='values.{{ $key }}.nama' 
                    placeholder='Masukkan Nama Barang' 
                    :required="true" 
                    :disabled="true"
                    />
                <x-input
                    label="Quantity" 
                    type='text' 
                    name='values.{{ $key }}.jumlah' 
                    placeholder='Masukkan Quantity' 
                    :required="true" 
                    />
                <x-input
                    label="Harga Jual" 
                    type='text' 
                    name='values.{{ $key }}.harga_jual' 
                    placeholder='Masukkan Harga Jual' 
                    :required="true" 
                    />
                <x-input
                    label="Diskon" 
                    type='text' 
                    name='values.{{ $key }}.diskon' 
                    placeholder='Masukkan Diskon' 
                    :required="true" 
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
            <button type="button" class="info" wire:click="submit">Cetak<i class="fa-solid fa-print"></i></button>
        </div>
        @endif
    </form>
    
    @if ($invoice)
        <div class="alert">
            <div class="container">
                <div class="head">
                    <p class="title">Notifikasi</p>
                    <button class="close" wire:click="close" autofocus>X</button>
                </div>
                <div class="content">
                    <p>Berhasil di Tambahkan</p>
                    <form method="GET" action="{{ route('kasir.invoice', ['id' => $transaksi_id]) }}">
                        @csrf
                        <button type="submit" class="info">Cetak</button>
                        <button type="button" wire:click="refresh">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
