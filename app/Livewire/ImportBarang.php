<?php

namespace App\Livewire;

use App\Models\Gudang;
use Livewire\Component;
use App\Imports\BarangImport;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportBarang extends Component
{
    use WithFileUploads;
    public $file;
    
    public Gudang $gudang;
    public $modal = false;

    public function open()
    {
        $this->modal = true;
    }

    public function close()
    {
        $this->modal = false;
    }
    
    public function submit()
    {
        $this->validate([
            'file' => 'required|mimes:csv,xlx,xls'
        ], [
            'file.required' => 'File perlu di-upload',
            'file.mimes' => 'Hanya untuk file .csv, .xlx, dan xls'
        ]);
        
        // Import function
        Excel::import(new BarangImport($this->gudang), $this->file);

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Import Data Barang'
        ]);
        
        return redirect()->route('barang.index', ['gudang' => $this->gudang])->with('message', 'Berhasil import barang');
    }
    
    public function render()
    {
        return view('livewire.import-barang', [
            'gudang' => $this->gudang
        ]);
    }
}
