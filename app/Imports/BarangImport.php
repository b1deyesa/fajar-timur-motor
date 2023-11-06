<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Gudang;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    public Gudang $gudang;
    
    public function __construct(Gudang $gudang)
    {
        $this->gudang = $gudang;
    }
    
    public function model(array $row)
    {
        Validator::make($row, [
            'kode' => 'required',
            'nama' => 'required',
            'harga_beli' => 'required|numeric',
        ], [
            'kode.required' => 'Kolom [ kode ] tidak terdeteksi',
            'nama.required' => 'Kolom [ nama ] tidak terdeteksi',
            'harga_beli.required' => 'Kolom [ harga_beli ] tidak terdeteksi',
            'harga_beli.numeric' => 'Kolom [ harga_beli ] harus berupa angka',
        ])->validate();
        
        return new Barang([
            'kode' => $row['kode'],
            'gudang_id' => $this->gudang->id,
            'nama' => $row['nama'],
            'deskripsi' => $row['deskripsi'] ?? '',
            'merek' => $row['merek'] ?? '',
            'harga_beli' => $row['harga_beli'],
        ]);
    }
    
    public function headingRow(): int
    {
        return 1;
    }
}
