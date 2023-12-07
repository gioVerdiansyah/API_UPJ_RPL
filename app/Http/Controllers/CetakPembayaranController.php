<?php

namespace App\Http\Controllers;

use App\Models\HistoryPembelian;
use App\Models\User;
use Illuminate\Http\Request;

class CetakPembayaranController extends Controller
{
    public function cetak(Request $request){
        try{
            $user = User::where('id', $request->user_id)->first();

            if($user && $user->getRememberToken() == $request->rm_token){
                $dataTransaksi = HistoryPembelian::where('user_id', $user->id)->get();
                return view('cetak', compact('dataTransaksi'));
            }

            return to_route('index');
        }catch(\Exception $e){
            return to_route('index')->with('error', 'Ada kesalahan Server!');
        }
    }
}
