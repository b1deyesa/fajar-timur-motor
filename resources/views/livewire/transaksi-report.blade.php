<div class="transaksi-report">
    <table>
        <tr class="label">
            <td class="input">
                <select name="filter" wire:model.lazy="filter">
                    <option value="all">Semua</option>
                    <option value="day">Hari Ini</option>
                    <option value="week">Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
                    <option value="year">Tahun Ini</option>
                    <option value="custom">Custom</option>
                </select>
                @if ($filter == 'custom')
                    <input type="date" wire:model.lazy="start">
                    <input type="date" wire:model.lazy="end">      
                @endif
            </td>
            <td colspan="2">
                <button class="info" onclick="printPageArea('printableArea')">Cetak Laporan</button>
            </td>
        </tr>
    </table>

    <div id="printableArea" style="display: none">
        @forelse($transaksis as $transaksi)
            <x-invoice :transaksi="$transaksi" :title="['RANGKAP 1', 'RANGKAP 2']" />
        @empty
            <p style="width:100%; text-align:center; margin-top:100px">Kosong</p>
        @endforelse
    </div>
    <script>
        function printPageArea(areaID){
            var printContent = document.getElementById(areaID).innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            return location.reload()
        }
    </script>
</div>
