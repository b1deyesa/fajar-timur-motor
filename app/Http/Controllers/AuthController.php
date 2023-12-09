<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\RequisitionOrder;
use App\Models\Supplier;
use App\Models\SupplierBarang;
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
            if(Auth::user()->role == 'Admin') {
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->route('kasir.index');
            }
        }

        return view('index');
    }

    public function dashboard()
    {   
        return view('dashboard.index', [
            'total_gudang'              => Gudang        ::all()->count(),
            'total_supplier'            => Supplier      ::all()->count(),
            'total_user'                => User          ::all()->count() - 1,
            'total_barang'              => Barang        ::all()->count(),
            'total_transaksi'           => Transaksi     ::all()->count(),
            'total_requisition_order'   => SupplierBarang::where('status', 'Dalam Proses')->count(),
            'logs'                      => Log           ::orderBy('id', 'desc')->get(),
        ]);
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
            
            // Admin Login
            if (Auth::user()->role == 'Admin') {
                // Log
                Log::create([
                    'user_id' => Auth::id(),
                    'task' => 'Login'
                ]);

                return redirect()->route('dashboard.index');
            }

            // Kasir Login
            if (Auth::user()->role == 'Kasir') {
                // Log
                Log::create([
                    'user_id' => Auth::id(),
                    'task' => 'Login Menu Transaksi'
                ]);
    
                return redirect()->route('kasir.index');
            }
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
