<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteHistoryRequest;
use App\Http\Requests\RiwayatRequest;
use App\Http\Requests\StoreHistoryRequest;
use App\Models\HistoryPembelian;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function addHistory(StoreHistoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $history = new HistoryPembelian;
            $history->user_id = $request->user_id;
            $history->jenis = $request->jenis;
            $history->harga_bahan = $request->harga_bahan;
            $history->harga_jasa = $request->harga_jasa;
            $history->jumlah_barang = $request->jumlah_barang;
            $history->total = (intval($request->harga_bahan) + intval($request->harga_jasa)) * intval($request->jumlah_barang);
            $history->jumlah_bayar = $request->jumlah_bayar;
            $history->kembalian = ($request->jumlah_bayar - (intval($request->harga_bahan) + intval($request->harga_jasa)) * intval($request->jumlah_barang));
            $history->tipe_pembayaran = $request->tipe_pembayaran;
            $history->save();

            DB::commit();
            return response()->json(['payment' => ['success' => true, 'message' => "Berhasil menyimpan traksaksi"]], 201);
        } catch (\Exception $e) {
            return response()->json(['payment' => ['success' => false, 'message' => "Error: $e"]], 500);
        }
    }
    public function riwayatPembelian(RiwayatRequest $request){
        try{
            $user = User::where('id', $request->user_id)->first();
            if(!$user){
                return response()->json(['riwayat' => ['success' => false, 'message' => "ID user tidak di temukan, cobalah untuk login ulang!"]], 403);
            }
            $data = HistoryPembelian::where('user_id', $user->id)->get();

            return response()->json(['riwayat' => ['success' => true, 'data' => $data]], 200);
        }catch(\Exception $e){
            return response()->json(['riwayat' => ['success' => false, 'message' => "Error: $e"]], 500);
        }
    }

    public function deleteHistory(DeleteHistoryRequest $request){
        try {
            DB::beginTransaction();

            $dataPayment = HistoryPembelian::where('user_id', $request->user_id)->get();
            if($dataPayment->isEmpty()){
                return response()->json(['payment' => ['success' => false, 'message' => "ID User tidak ditemukan!"]]);
            }

            foreach($dataPayment as $item){
                $item->delete();
            }

            DB::commit();
            return response()->json(['payment' => ['success' => true, "message" => 'Berhasil menghapus semua data!']]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['payment' => ['success' => false, 'message' => "Error: $e"]]);
        }
    }
}
