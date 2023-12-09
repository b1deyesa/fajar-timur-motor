<x-kasir>
    <section class="info-invoice">
        <span class="back">
            <a href="{{ route('kasir.index') }}" class="button">Kembali</a>
        </span>
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
                    <x-invoice :transaksi="$transaksi" />
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