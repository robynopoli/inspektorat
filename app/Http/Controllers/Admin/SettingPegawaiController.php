<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obrik;
use App\Models\Pegawai;
use App\Models\PegawaiWithObrik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SettingPegawaiController extends Controller
{
    public function index()
    {
        $data = Pegawai::all();
        return view('admin.pemantauan-tindak-lanjut.setting-pegawai.index')
            ->with('data', $data);
    }

    public function create(Request $request)
    {
        $q = $request->get('q');
        if ($q) {
            $data_pegawai = Http::withoutVerifying()->get(env('APP_SIMUTIARA').'/api/searching-pegawai?q=' . $q);
//            return $data_pegawai;
            $data_pegawai = $data_pegawai->collect();
        }else{
            $data_pegawai = [];
        }
        $data_obrik = Http::withoutVerifying()->get(env('APP_SIMHPNAS').'/backend/api/getbidangobrik');

        return view('admin.pemantauan-tindak-lanjut.setting-pegawai.create')
            ->with('data_pegawai', $data_pegawai)
            ->with('data_obrik', $data_obrik->collect() ?? []);
    }

    public function store(Request $request)
    {
        $pegawai = Pegawai::where('nip', $request->nip)->first();

        $responseUser = Http::withoutVerifying()->get(env('APP_SIMUTIARA').'/api/searching-by-nip?nip=' . $request->nip);
        if (!$pegawai){
            $pegawai = Pegawai::create(
                [
                    'nip' => $request->nip,
                    'nama' => $responseUser['nama'],
                    'pangkat' => $responseUser['pangkat'],
                    'golongan' => $responseUser['golongan'],
                    'eselon' => $responseUser['eselon'],
                    'jabatan' => $responseUser['jabatan'],
                    'ket_jabatan' => $responseUser['ket_jabatan'],
                    'opd' => $responseUser['opd'],
                ]);
        }else{
            $pegawai->nama = $responseUser['nama'];
            $pegawai->pangkat = $responseUser['pangkat'];
            $pegawai->golongan = $responseUser['golongan'];
            $pegawai->eselon = $responseUser['eselon'];
            $pegawai->jabatan = $responseUser['jabatan'];
            $pegawai->ket_jabatan = $responseUser['ket_jabatan'];
            $pegawai->opd = $responseUser['opd'];
            $pegawai->save();
        }

        $obriks = explode("-", $request->obriks);
        $obrik = Obrik::firstOrCreate(
            [
                'kode_bidang_obrik' => $obriks[0],
            ],
            [
                'bidang_obrik' => $obriks[1],
            ]);
        $pegawai->obriks()->sync([$obrik->id]);

        return redirect()->route('setting-pegawai.index');
    }

    public function destroy(Request $request)
    {
        PegawaiWithObrik::where('pegawai_id', $request->get('pegawai_id'))
            ->where('obrik_id', $request->get('obrik_id'))
            ->delete();
        return redirect()->back();
    }
}
