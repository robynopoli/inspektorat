<?php

namespace App\Http\Controllers\Admin\McpKpk;

use App\Http\Controllers\Controller;
use App\Models\AreaIntervensi;
use App\Models\McpIndikator;
use App\Models\McpSubIndikator;
use App\Models\Obrik;
use Illuminate\Http\Request;

class SubIndikatorController extends Controller
{
    public function index()
    {
        return view('admin.mcp-kpk.sub-indikator.index')
        ->with('data', McpSubIndikator::with(['mcp_indikator', 'mcp_indikator.area_intervensi', 'obrik'])->get());
    }

    public function create()
    {
        return view('admin.mcp-kpk.sub-indikator.create')
        ->with('obrik', Obrik::get())
        ->with('mcp_indikator', McpIndikator::with('area_intervensi')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'mcp_indikator_id' => 'required',
            'keterangan' => 'required'
        ]);
        McpSubIndikator::create($request->except(['_token']));
        return redirect()->route('admin.mcp-kpk.sub-indikator.index');
    }

    public function edit(McpSubIndikator $subIndikator)
    {
        return view('admin.mcp-kpk.sub-indikator.edit')
        ->with('obrik', Obrik::get())
        ->with('mcp_indikator', McpIndikator::with('area_intervensi')->get())
        ->with('data', $subIndikator);
    }

    public function update(McpSubIndikator $subIndikator, Request $request)
    {
        $request->validate([
            'keterangan' => 'required'
        ]);
        $subIndikator->update($request->except(['_token', '_method']));
        return redirect()->route('admin.mcp-kpk.sub-indikator.index');
    }

    public function destroy(McpSubIndikator $subIndikator)
    {
        $subIndikator->delete();
        return redirect()->route('admin.mcp-kpk.sub-indikator.index');
    }
}
