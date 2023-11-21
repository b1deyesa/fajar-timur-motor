<x-dashboard>
    
    {{-- Alert --}}
    <x-alert />

    {{-- Table --}}
    <x-table title="Semua Transaksi" color="red">
        <x-slot:button>
            <a href="{{ route('transaksi.report') }}"><i class="fa-solid fa-print"></i>Cetak Laporan</a>
        </x-slot:button>
        <x-slot:head>
            <tr>
                <th>No</th>
                <th>No. Nota</th>
                <th>Nama Pembeli</th>
                <th>Metode Pembayaran</th>
                <th>Harga Pengiriman</th>
                <th>Agen Pengiriman</th>
                <th>Tanggal Transaksi</th>
                <th style="min-width: 9em">Total</th>
                <th>Kasir</th>
                <th style="min-width: 9em">Action</th>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @foreach ($transaksis as $key => $transaksi)
            <tr>
                <td align="center">{{ $key + 1 }}</td>
                <td align="center" style="min-width: 6em">{{ $transaksi->kode }}</td>
                <td>{{ $transaksi->nama_pembeli ?? '-' }}</td>
                <td>{{ $transaksi->metode_pembayaran ?? '-' }}</td>
                <td>{{ $transaksi->harga_pengiriman ? 'Rp ' . number_format($transaksi->harga_pengiriman, '2', ',', '.') : '-' }}</td>
                <td>{{ $transaksi->agen_pengiriman ?? '-' }}</td>
                <td align="center">{{ $transaksi->created_at->format('d/m/Y') }}</td>
                <td>Rp {{ number_format($transaksi->total, '2', ',', '.') }}</td>
                <td>{{ $transaksi->user->nama }}</td>
                <td align="center" class="action">
                    <form method="POST" action="{{ route('transaksi.destroy', compact('transaksi')) }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin menghapus?')" id="delete"><i class="fa-solid fa-trash"></i>Hapus</button>
                    </form>
                    <a href="{{ route('detail-transaksi.index', compact('transaksi')) }}" id="info"><i class="fa-solid fa-eye"></i>Detail</a>
                </td>
            </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-dashboard>
