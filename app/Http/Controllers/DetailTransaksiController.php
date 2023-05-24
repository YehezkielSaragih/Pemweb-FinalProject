<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi;

class DetailTransaksiController extends Controller
{
    //
    function index(){
        $data = DetailTransaksi::paginate(10);
        return view('detail_transaksi', compact('data'));
        //return $data;
    }
}
