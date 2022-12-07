<?php

namespace App\Http\Controllers;

use App\Models\Finding;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'root'){
            return redirect()->route('pengajuan_tl');
        }

        $data = [];
        if ($user->pegawai){
            foreach ($user->pegawai->obriks as $obrik){
                $response = Http::withoutVerifying()->get(env('APP_SIMHPNAS').'/backend/api/integrasitltpb?Kode_Bidang_Obrik='.$obrik->kode_bidang_obrik);
                if ($response->status() == 200){
                    foreach ($response->collect() as $item){
                        $data[] = $item;
                    }
                }
            }
        }
        return view('home')
            ->with('data', $data);
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

        $q = $request->get('q');
        if ($q) {
            $data_pegawai = Http::withoutVerifying()->get(env('APP_SIMUTIARA').'/api/searching-pegawai?q=' . $q);
            $data_pegawai = $data_pegawai->collect();
        }else{
            $data_pegawai = [];
        }

        $response = Http::withoutVerifying()->get(env('APP_SIMHPNAS').'/backend/api/integrasitltpb/create?kode_rekomendasi='.$kode_rekomendasi);
        return view('form_tindak_lanjut.create')
            ->with('data_pegawai', $data_pegawai)
            ->with('data', $response->collect());
    }

    public function tindak_lanjut_store(Request $request)
    {
        $responseUser = Http::withoutVerifying()->get(env('APP_SIMUTIARA').'/api/searching-by-nip?nip=' . $request->nip);

        $request['user_id'] = Auth::id();
        $request['status'] = 'proses';
        $request['nama'] = $responseUser['nama'];
        $request['jabatan'] = $responseUser['jabatan'];
        Finding::create($request->except(['_token', 'q']));

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
