<?php

namespace App\Http\Controllers\Admin\McpKpk;

use App\Http\Controllers\Controller;
use App\Models\AreaIntervensi;
use Illuminate\Http\Request;

class AreaIntervensiController extends Controller
{
    public function index()
    {
        return view('admin.mcp-kpk.area-intervensi.index')
        ->with('data', AreaIntervensi::withCount('mcpIndikator')->get());
    }

    public function create()
    {
        return view('admin.mcp-kpk.area-intervensi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required'
        ]);
        AreaIntervensi::create($request->except(['_token']));
        return redirect()->route('admin.mcp-kpk.area-intervensi.index');
    }

    public function edit(AreaIntervensi $areaIntervensi)
    {
        return view('admin.mcp-kpk.area-intervensi.edit')
        ->with('data', $areaIntervensi);

    }

    public function update(AreaIntervensi $areaIntervensi, Request $request)
    {
        $request->validate([
            'keterangan' => 'required'
        ]);
        $areaIntervensi->update($request->except(['_token', '_method']));
        return redirect()->route('admin.mcp-kpk.area-intervensi.index');
    }

    public function destroy(AreaIntervensi $areaIntervensi)
    {
        $areaIntervensi->delete();
        return redirect()->route('admin.mcp-kpk.area-intervensi.index');
    }
}
