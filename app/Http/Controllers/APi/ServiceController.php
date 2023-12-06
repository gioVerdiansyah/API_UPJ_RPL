<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryPembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    // Service Printer
    public function katrid(Request $request){
        try {
            DB::beginTransaction();

            $history = new HistoryPembelian;
            $history->user_id = $request->user_id;
            $history->jenis = 'katrid';
            $history->harga_bahan = $request->harga_bahan;
            $history->harga_jasa = $request->harga_jasa;
            $history->total = intval($request->harga_bahan) + intval($request->harga_jasa);
            $history->save();

            DB::commit();
            return response()->json(['service' => ['success' => true]],201);
        } catch (\Exception $e) {
            return response()->json(['service' => ['success' => false, 'message' => "Error: $e"]], 500);
        }
    }
}
