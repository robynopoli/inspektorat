<?php

namespace App\Http\Controllers\Admin\McpKpk;

use App\Http\Controllers\Controller;
use App\Models\AreaIntervensi;
use App\Models\McpTindakLanjut;
use Illuminate\Http\Request;

class TindakLanjutController extends Controller
{
    public function index()
    {
        $area_intervensi = AreaIntervensi::all();
        return view('admin.mcp-kpk.tindak-lanjut.index')
            ->with('area_intervensi', $area_intervensi);
    }

    public function proses_tindak_lanjut(Request $request)
    {
        McpTindakLanjut::where('id', $request->id)->update(['is_approve' => $request->is_approve]);
        return redirect()->back();
    }
}
