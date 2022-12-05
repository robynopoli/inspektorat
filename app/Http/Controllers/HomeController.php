<?php

namespace App\Http\Controllers;

use App\Models\Finding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public string $api_simhapnas = 'https://simhpnas.inspektorat.mataramkota.go.id/backend/api/';

    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'root'){
            return redirect()->route('pengajuan_tl');
        }

//        return $user->pegawai->obriks;
        $data = [];
        foreach ($user->pegawai->obriks as $obrik){
            $response = Http::withoutVerifying()->get($this->api_simhapnas.'integrasitltpb?Kode_Bidang_Obrik='.$obrik->kode_bidang_obrik);
            if ($response->status() == 200){
                foreach ($response->collect() as $item){

                $data[] = $item;
                }
//                array_push($data, );
            }
        }

//        return $data;

//        $response = Http::withoutVerifying()->get($this->api_simhapnas.'integrasitltpb?Kode_Bidang_Obrik=527102004');
        return view('home')
            ->with('data', $data);
//            ->with('data', $response->collect());
    }

    public function tindak_lanjut()
    {
        $user = Auth::user();

        if ($user->role == 'root'){
            $data = Finding::all();
        }else{
            $data = $user->findings;
        }

        return view('tindak-lanjut')
            ->with('data', $data);
    }

    public function tindak_lanjut_create(Request $request)
    {
        $kode_rekomendasi = $request->kode_rekomendasi;

        $response = Http::withoutVerifying()->get($this->api_simhapnas.'integrasitltpb/create?kode_rekomendasi='.$kode_rekomendasi);
        return view('form_tindak_lanjut.create')
            ->with('data', $response->collect());
    }

    public function tindak_lanjut_store(Request $request)
    {
        $request['user_id'] = Auth::id();
        $request['status'] = 'proses';
        Finding::create($request->except('_token'));

        return redirect()->route('tindak_lanjut');
    }

    public function pengajuan_tl()
    {
        $user = Auth::user();
        if (!$user->role == 'root'){
            return redirect()->route('home');
        }

        return view('pengajuan-tl')
            ->with('data', Finding::where('status', 'proses')->get());
    }

    public function pengajuan_tl_edit($id)
    {
        return view('pengajua-tl.edit')
            ->with('data', Finding::findOrFail($id));
    }

    public function pengajuan_tl_update($id, Request $request)
    {
        Finding::where('id', $id)->update($request->except('_token'));
        return redirect()->route('tindak_lanjut');
    }
}
