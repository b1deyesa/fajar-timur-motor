<x-dashboard>
    
    {{-- Alert --}}
    <x-alert />

    {{-- Table --}}
    <x-table title="Detail Transaksi - {{ $transaksi->kode }}" color="yellow">
        <x-slot:button>
        Print
        </x-slot:button>
        <x-slot:head>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Quantity</th>
                <th>Harga Jual</th>
                <th>Diskon</th>
                <th style="min-width: 9em">Total</th>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @foreach ($detail_transaksis as $key => $detail_transaksi)
            @php
                $total = ($detail_transaksi->jumlah * $detail_transaksi->harga_jual) - (($detail_transaksi->jumlah * $detail_transaksi->harga_jual) * $detail_transaksi->diskon / 100);
            @endphp
            <tr>
                <td align="center">{{ $key + 1 }}</td>
                <td>{{ $detail_transaksi->barang->nama }}</td>
                <td align="center">{{ $detail_transaksi->jumlah }}</td>
                <td>Rp {{ number_format($detail_transaksi->harga_jual, '2', ',', '.') }}</td>
                <td align="center">{{ $detail_transaksi->diskon }}%</td>
                <td>Rp {{ number_format($total, '2', ',', '.') }}</td>
            </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-dashboard>