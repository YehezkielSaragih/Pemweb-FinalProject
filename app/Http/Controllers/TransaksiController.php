<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    //
    function index(){
        $data = Transaksi::paginate(10);
        return view('transaksi.transaksi_table', compact('data'));
        // return $data;
    }
}
