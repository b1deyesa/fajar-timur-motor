<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    public function index()
    {
        $hour = date('G');

        if($hour >= 5 && $hour <= 11) {
            $day = "Pagi ☕";
        } else if($hour >= 12 && $hour <= 15) {
            $day = "Siang ☀️";
        } else {
            $day = "Malam 🌙";
        }
        
        return view('kasir.index', [
            'day' => $day
        ]);
    }
    
    public function invoice($id)
    {
        // // Get transaksi data
        // $transaksi = Transaksi::where('id', $id)->first();

        // // Load invoice view
        // $pdf = PDF::loadView('kasir.invoice', [
        //     'transaksi' => $transaksi
        // ]);

        // // Download invoice
        // return $pdf->download('Struk '. $transaksi->kode .'.pdf');

        $transaksi = Transaksi::where('id', $id)->first();
        return view('kasir.invoice', [
            'transaksi' => $transaksi
        ]);
    }

    public function search(Request $request)
    {
        if($request->search == '') {
            $transaksi = Transaksi::all()->last();
        } else {
            $transaksi = Transaksi::search($request->search)->first();
        }
    
        return view('kasir.info-transaksi', [
            'transaksi' => $transaksi
        ]);
    }
}
