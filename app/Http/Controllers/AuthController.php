<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Supplier;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class AuthController extends Controller
{
    public function index()
    {
        // Check if auth has login
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        return view('index');
    }

    public function dashboard()
    {   
        return view('dashboard.index', [
            'total_gudang'      => Gudang   ::all()->count(),
            'total_supplier'    => Supplier ::all()->count(),
            'total_user'        => User     ::all()->count() - 1,
            'total_barang'      => Barang   ::all()->count(),
            'total_transaksi'   => Transaksi::all()->count(),
            'logs'              => Log      ::orderBy('id', 'desc')->get(),
        ]);
    }

    public function kasir()
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
        // Get transaksi data
        $transaksi = Transaksi::where('id', $id)->first();

        // Load invoice view
        $pdf = PDF::loadView('kasir.invoice', [
            'transaksi' => $transaksi
        ]);

        // Download invoice
        return $pdf->download('Struk '. $transaksi->kode .'.pdf');
    }

    public function login(Request $request)
    {
        // Validate request
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'ID tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);
        
        // Success username and password
        $credenitials = $request->only('username','password');
        if (Auth::attempt($credenitials)) {
            // Log
            Log::create([
                'user_id' => Auth::id(),
                'task' => 'Login'
            ]);

            return redirect()->route('dashboard.index');
        }

        // Failed username or password
        return redirect()->route('login')->with('message', 'ID atau password salah');
    }

    public function logout()
    {
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Logout'
        ]);
  
        // Destroy auth
        Auth::logout();

        // Destroy session
        Session::flush();
        
        return redirect()->route('login');
    }
}
