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

        if ($hour >= 5 && $hour <= 11) {
            $day = "Pagi ☕";
        } else if ($hour >= 12 && $hour <= 15) {
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
        $transaksi = Transaksi::where('id', $id)->first();
        return view('kasir.info-invoice', [
            'transaksi' => $transaksi
        ]);
    }

    public function search(Request $request)
    {
        if ($request->search == '') {
            $transaksi = Transaksi::all()->last();
        } else {
            $transaksi = Transaksi::search($request->search)->first();
        }

        return view('kasir.info-invoice', [
            'transaksi' => $transaksi
        ]);
    }
}
