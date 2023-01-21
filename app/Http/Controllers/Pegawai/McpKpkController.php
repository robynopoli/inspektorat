<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\McpDocument;
use App\Models\McpSubIndikator;
use App\Models\McpTindakLanjut;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class McpKpkController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::id())
            ->with('pegawai', 'pegawai.obriks')
            ->first();

        // return $user->pegawai->obriks->pluck('id');
        $subIndikator = McpSubIndikator::whereIn('obrik_id', $user->pegawai->obriks->pluck('id'))
            ->with(['mcp_indikator', 'obrik', 'mcp_document'])
            ->get();
        // return $user;
        // return $subIndikator;
        return view('pegawai.mpc-kpk.index')
            ->with('sub_indikator', $subIndikator);

    }

    public function upload_bukti(Request $request)
    {
        $dokumen_id = $request->get('dokumen_id');
        if ($dokumen_id) {
            $mcp_dokument = McpDocument::where('id', $dokumen_id)->first();
            return view('pegawai.mpc-kpk.upload-bukti')
                ->with('mcp_dokument', $mcp_dokument);
        }
        return abort(404);
    }

    public function store_upload_bukti(Request $request)
    {
        // return $request;
        $request->validate(
            ['link_tindak_lanjut' => 'required|url']
        );

        McpTindakLanjut::create($request->except(['_token']));
        return redirect()->route('pegawai.mcp-kpk.index');
    }

    public function destroy_upload_bukti(Request $request)
    {
        $id = $request->get('id');
        if ($id) {
            McpTindakLanjut::where('id', $id)->delete();
            return redirect()->route('pegawai.mcp-kpk.index');
        }
        return abort(404);
    }
}
