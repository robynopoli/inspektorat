<?php

namespace App\Http\Controllers\Admin\McpKpk;

use App\Http\Controllers\Controller;
use App\Models\AreaIntervensi;
use App\Models\McpIndikator;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    public function index(Request $request)
    {
        $indikator = McpIndikator::query()
            ->withCount('mcp_sub_indikator')
            ->with('area_intervensi');

        if ($request->get('area_intervensi_id')) {
            $indikator = $indikator->where('area_intervensi_id', $request->get('area_intervensi_id'));
        }

        return view('admin.mcp-kpk.indikator.index')
            ->with('data', $indikator->get());
    }

    public function create()
    {
        return view('admin.mcp-kpk.indikator.create')
            ->with('area_intervensi', AreaIntervensi::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'area_intervensi_id' => 'required',
            'keterangan' => 'required'
        ]);
        McpIndikator::create($request->except(['_token']));
        return redirect()->route('admin.mcp-kpk.indikator.index');
    }

    public function edit(McpIndikator $indikator)
    {
        return view('admin.mcp-kpk.indikator.edit')
            ->with('area_intervensi', AreaIntervensi::all())
            ->with('data', $indikator);
    }

    public function update(McpIndikator $indikator, Request $request)
    {
        $request->validate([
            'keterangan' => 'required'
        ]);
        $indikator->update($request->except(['_token', '_method']));
        return redirect()->route('admin.mcp-kpk.indikator.index');
    }

    public function destroy(McpIndikator $indikator)
    {
        $indikator->delete();
        return redirect()->route('admin.mcp-kpk.indikator.index');
    }
}
