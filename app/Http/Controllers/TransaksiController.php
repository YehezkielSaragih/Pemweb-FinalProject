<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    //
    function show(){
        $data = Transaksi::all();
        return view('transaksi', ['transaksi' => $data]);
    }
}
