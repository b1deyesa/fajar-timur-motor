<x-dashboard>
    <x-form :title="'Supplier - ' . $barang->nama">
        <x-slot:button>
            @livewire('delete-barang', compact('gudang', 'barang'))
        </x-slot:button>
        <form method="POST" action="{{ route('barang.update', compact('gudang','barang')) }}">
            @csrf
            @method('PUT')
            <table>
                <tr>
                    <td>Kode Barang</td>
                    <td>:</td>
                    <td><x-input type='text' :value="$barang->kode" :disabled="true" /></td>
                </tr>
                <tr>
                    <td>Lokasi Barang</td>
                    <td>:</td>
                    <td>
                        <x-input type="select" name="gudang_id">
                            <option value="{{ $barang->gudang_id }}" selected disabled>[{{ $barang->gudang->kode }}] {{ $barang->gudang->nama }}</option>
                            @foreach ($gudangs as $gudang)
                                <option value="{{ $gudang->id }}">[{{ $gudang->kode }}] {{ $gudang->nama }}</option>
                            @endforeach
                        </x-input>
                    </td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td>:</td>
                    <td> <x-input type='text' name='nama' placeholder="Nama Barang" :value="$barang->nama" /></td>
                </tr>
                <tr>
                    <td>Merek</td>
                    <td>:</td>
                    <td><x-input type='text' name='merek' placeholder="Merek" :value="$barang->merek" /></td>
                </tr>
                <tr>
                    <td>Harga Beli</td>
                    <td>:</td>
                    <td><x-input type='text' name='harga_beli' placeholder="Isi angka 0 bila belum diketahui" :value="$barang->harga_beli" /></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td><small>{{ $barang->deskripsi }}</small></td>
                </tr>
                <tr>
                    <td colspan="3"><button type="submit" class="update"><i class="fa-solid fa-pen"></i>Update</button></td>
                </tr>
            </table>
        </form>
    </x-form>
</x-dashboard>
