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
                    <div class="invoice">
                        <div class="container">
                            <header>
                                <div class="info">
                                    <div class="banner">
                                        <img src="{{ asset('img/logo.png') }}" alt="">
                                    </div>
                                    <div class="address">
                                        <h3>Fajar Timur Motor</h3>
                                        <h4>Khusus Berdagang Alat2 Mobil</h4>
                                        <h5>Jeep C7, CHEROKKE, WRANGLER, RUBICON</h5>
                                        <h5>SERVICE BERBAGAI MEREK ECU</h5>
                                        <p>Pasar Mobil Kemayoran Block S, 91 GH, Jakarta Pusat</p>
                                        <p>Telp.: 021-6540864-6542339</p>
                                        <p>Mega Glodok Kemayoran Lt.VI Block D5 No.5</p>
                                        <p>Hp.: 08161620400 - 081283223607</p>
                                        <p>08595327362410 - 081932082876</p>
                                    </div>
                                </div>
                                <div class="order">
                                    <p><b>Nama Pembeli: </b>{{ $transaksi->nama_pembeli }}</p>
                                    <p><b>Tanggal Pembelian: </b>{{ $transaksi->created_at->format('d-M-Y') }}</p>
                                    <p><b>Pembayaran: </b>{{ $transaksi->metode_pembayaran }}</p>
                                    <span style="color: red">BON ASLI</span>
                                </div>
                            </header>
                            <table class="detail">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Quantity</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                                @foreach ($transaksi->detail_transaksis as $key => $detail_transaksi)                                    
                                <tr>
                                    <td align="center">{{ $key + 1 }}</td>
                                    <td>{{ $detail_transaksi->barang->nama }}</td>
                                    <td>{{ $detail_transaksi->jumlah }}</td>
                                    <td>Rp. {{ number_format($detail_transaksi->harga_jual, '2', ',', '.') }}</td>
                                    <td>Rp. {{ number_format(($detail_transaksi->harga_jual * $detail_transaksi->jumlah), '2', ',', '.') }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="end"><b>Harga Pengiriman</b></td>
                                    <td>Rp. {{ number_format($transaksi->harga_pengiriman, '2', ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="end"><b>Jumlah Pembayaran</b></td>
                                    <td>Rp. {{ number_format($transaksi->sum() + $transaksi->harga_pengiriman, '2', ',', '.') }}</td>
                                </tr>
                            </table>
                            <footer>
                                <p>SEMOGA TETAP<br>JADI PELANGGAN</p>
                                <p>Dikirm oleh: {{ $transaksi->agen_pengiriman  }}</p>
                                <p>Hormat Kami,</p>
                            </footer>
                        </div>
                        <div class="container">
                            <header>
                                <div class="info">
                                    <div class="banner">
                                        <img src="{{ asset('img/logo.png') }}" alt="">
                                    </div>
                                    <div class="address">
                                        <h3>Fajar Timur Motor</h3>
                                        <h4>Khusus Berdagang Alat2 Mobil</h4>
                                        <h5>Jeep C7, CHEROKKE, WRANGLER, RUBICON</h5>
                                        <h5>SERVICE BERBAGAI MEREK ECU</h5>
                                        <p>Pasar Mobil Kemayoran Block S, 91 GH, Jakarta Pusat</p>
                                        <p>Telp.: 021-6540864-6542339</p>
                                        <p>Mega Glodok Kemayoran Lt.VI Block D5 No.5</p>
                                        <p>Hp.: 08161620400 - 081283223607</p>
                                        <p>08595327362410 - 081932082876</p>
                                    </div>
                                </div>
                                <div class="order">
                                    <p><b>Nama Pembeli: </b>{{ $transaksi->nama_pembeli }}</p>
                                    <p><b>Tanggal Pembelian: </b>{{ $transaksi->created_at->format('d-M-Y') }}</p>
                                    <p><b>Pembayaran: </b>{{ $transaksi->metode_pembayaran }}</p>
                                    <span style="color: blue">COPY</span>
                                </div>
                            </header>
                            <table class="detail">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Quantity</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                                @foreach ($transaksi->detail_transaksis as $key => $detail_transaksi)                                    
                                <tr>
                                    <td align="center">{{ $key + 1 }}</td>
                                    <td>{{ $detail_transaksi->barang->nama }}</td>
                                    <td>{{ $detail_transaksi->jumlah }}</td>
                                    <td>Rp. {{ number_format($detail_transaksi->harga_jual, '2', ',', '.') }}</td>
                                    <td>Rp. {{ number_format(($detail_transaksi->harga_jual * $detail_transaksi->jumlah), '2', ',', '.') }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="end"><b>Harga Pengiriman</b></td>
                                    <td>Rp. {{ number_format($transaksi->harga_pengiriman, '2', ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="end"><b>Jumlah Pembayaran</b></td>
                                    <td>Rp. {{ number_format($transaksi->sum() + $transaksi->harga_pengiriman, '2', ',', '.') }}</td>
                                </tr>
                            </table>
                            <footer>
                                <p>SEMOGA TETAP<br>JADI PELANGGAN</p>
                                <p>Dikirm oleh: {{ $transaksi->agen_pengiriman  }}</p>
                                <p>Hormat Kami,</p>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        function printPageArea(areaID){
            var printContent = document.getElementById(areaID).innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
</div>
