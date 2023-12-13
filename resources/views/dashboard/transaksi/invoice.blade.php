<x-dashboard>
    <section class="info-invoice">
        <div class="container">
            <div class="card">
                <h5 class="card-title">{{ $transaksi->kode }}</h5>
                <div class="navigation">
                    <button type="button" class="info" onclick="printPageArea('printableArea')">Print</button>
                </div>
                <div id="printableArea">
                    <x-invoice :transaksi="$transaksi" :title="['BON ASLI', 'BON COPY']"/>
                </div>
            </div>
        </div>
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
</x-dashboard>