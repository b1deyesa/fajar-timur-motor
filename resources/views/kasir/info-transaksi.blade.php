<x-kasir>
    <section class="transaksi-info">
        <a href="{{ route('kasir.index') }}" class="button back">Kembali</a>
        @empty($transaksi)
            <span class="empty">Transaksi tidak ditemukan!!! Periksa kembali nomor nota</span>
        @else
        <div class="container">
            <div class="card">
                <h5 class="card-title">{{ $transaksi->kode }}</h5>
                <div class="navigation">
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
        @endempty
        <script>
            function printPageArea(areaID){
                var printContent = document.getElementById(areaID).innerHTML;
                var originalContent = document.body.innerHTML;
                document.body.innerHTML = printContent;
                window.print();
                document.body.innerHTML = originalContent;
            }
        </script>
    </section>
</x-kasir>