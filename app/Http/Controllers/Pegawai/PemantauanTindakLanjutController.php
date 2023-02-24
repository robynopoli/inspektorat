<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Finding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PemantauanTindakLanjutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
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
        // dd($data);
        function convert($s) {

            //A regular expression to find the URLs
            $url_regex = '<https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)>';
        
            //The preg_replace() function applies the links by using the captured groups of the URL regex
            return preg_replace($url_regex, '<a href="$0" target="blank" title="$0">$0</a>', $s);
        
        }
        // dd(convert('Forma Surat Teguran download di : https://tinyurl.com/2oo32may'));
        // dd(count($data));
        for ($i=0; $i < count($data) ; $i++) { 
            // dd(htmlentities(convert($data[$i]['Memo_Rekomendasi'].'https://google.com')));
            $test=['Memo_Rekomendasi'=>htmlentities(convert('<td>'.$data[$i]['Memo_Rekomendasi'].'</td>'))];
            // dd($test);
            $data[$i]=array_replace($data[$i],$test);
        }
        // dd($data);
        return view('pegawai.pemantauan-tindak-lanjut.index')
            ->with('data', $data);
    }

    public function tindak_lanjut()
    {
        $user = Auth::user();
        $data = $user->findings;

        return view('pegawai.pemantauan-tindak-lanjut.tindak-lanjut')
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
        return view('pegawai.pemantauan-tindak-lanjut.create')
            ->with('data_pegawai', $data_pegawai)
            ->with('data', $response->collect());
    }

    public function tindak_lanjut_store(Request $request)
    {
        $request->validate(
          ['tindak_lanjut' => 'url']
        );
        if (!$request->nip)
        {
            Session::flash('status', 'Anda harus memilih Penanggung Jawab');
            return redirect()->back();
        }

        $responseUser = Http::withoutVerifying()->get(env('APP_SIMUTIARA').'/api/searching-by-nip?nip=' . $request->nip);

        $request['user_id'] = Auth::id();
        $request['status'] = 'belum diproses';
        $request['nama'] = $responseUser['nama'];
        $request['jabatan'] = $responseUser['jabatan'];
        $request['opd'] = $responseUser['opd'];
        Finding::create($request->except(['_token', 'q']));

        return redirect()->route('tindak_lanjut');
    }
}
