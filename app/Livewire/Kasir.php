<?php

namespace App\Livewire;

use App\Models\Log;
use App\Models\Barang;
use Livewire\Component;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class Kasir extends Component
{
    public $step = 1; 
    public $total = 0;
    public $invoice;
    public $transaksi;
    public $barang = [];
    public $values = [
        [
            'kode' => null,
            'nama' => null,
            'jumlah' => null,
            'harga_jual' => null,
            'deskripsi' => null,
        ]
    ];
    public $data_pembeli = [
        'nama_pembeli' => null,
        'metode_pembayaran' => null,
        'harga_pengiriman' => 0,
        'agen_pengiriman' => null,
    ];
    
    public function refresh()
    {
        return redirect()->route('kasir.index');
    }
    
    public function next() 
    {   
        $this->validate([
            'values.*.nama' => 'required',
            'values.*.jumlah' => 'required|numeric',
            'values.*.harga_jual' => 'required|numeric',
        ], [
            'values.*.nama.required' => 'Pilih barang terlebih dahulu',
            'values.*.jumlah.required' => 'Quantity tidak boleh kosong',
            'values.*.harga_jual.required' => 'Harga jual tidak boleh kosong',
            'values.*.jumlah.numeric' => 'Quantity harus berupa angka',
            'values.*.harga_jual.numeric' => 'Harga jual harus berupa angka',
        ]);

        $this->total = $this->sum($this->values);
        return $this->step = 2;
    }

    public function previous() 
    {   
        return $this->step = 1;
    }
    
    public function tambah()
    {
        $this->values[] = [
            'kode' => null,
            'nama' => null,
            'jumlah' => null,
            'harga_jual' => null,
            'deskripsi' => null,
        ];
    }

    public function hapus($key)
    {
        unset($this->values[$key]);
        $this->values = array_values($this->values);

        unset($this->barang[$key]);
        $this->barang = array_values($this->barang);
    }
    
    public function updatedBarang($id, $key)
    {        
        if ($id != '') {
            $barang = Barang::find($id);
            $this->values[$key]['kode'] = $barang->kode; 
            $this->values[$key]['nama'] = $barang->nama;
        } else {
            $this->values[$key]['kode'] = null;
            $this->values[$key]['nama'] = null;
        }
    }

    public function sum($values)
    {
        $hasil = 0;
        foreach ($values as $value) {
            $hasil += ($value['harga_jual'] * $value['jumlah']);
        }

        return $hasil;
    }
    
    public function submit()
    {
        $this->validate([
            'data_pembeli.harga_pengiriman' => 'numeric'
        ], [
            'data_pembeli.harga_pengiriman.numeric' => 'Harga harus berupa angka'
        ]);
        
        // Generate kode
        $kode = 'TR-' . sprintf('%07d', Transaksi::all()->max('id') + 1);
        
        // Store transaksi
        $transaksi = Transaksi::create([
            'kode' => $kode,
            'user_id' => Auth::id(),
            'nama_pembeli' => $this->data_pembeli['nama_pembeli'],
            'metode_pembayaran' => $this->data_pembeli['metode_pembayaran'],
            'harga_pengiriman' => $this->data_pembeli['harga_pengiriman'],
            'agen_pengiriman' => $this->data_pembeli['agen_pengiriman'],
            'total' => $this->data_pembeli['harga_pengiriman'] + $this->total,
        ]);

        // Store detail transaksi
        foreach ($this->values as $value) {
            $barang = Barang::where('kode', $value['kode'])->first();
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'barang_id' => $barang->id,
                'jumlah' => $value['jumlah'],
                'harga_jual' => $value['harga_jual'],
                'deskripsi' => $value['deskripsi'],
            ]);
        }

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Melakukan transaksi ('. $transaksi->kode .')'
        ]);
        
        // Next Step
        $this->invoice = true;
        $this->transaksi = Transaksi::where('id', $transaksi->id)->first();
    }
    
    public function close()
    {
        return $this->invoice = false;
    }
    
    public function render()
    {
        $this->dispatch('selectl');
        
        return view('livewire.kasir', [
            'barangs' => Barang::orderBy('id', 'desc')->get()
        ]);
    }
}
