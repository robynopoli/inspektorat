<?php

namespace App\Http\Controllers\Admin\McpKpk;

use App\Http\Controllers\Controller;
use App\Models\McpDocument;
use App\Models\McpIndikator;
use App\Models\McpSubIndikator;
use Illuminate\Http\Request;

class DocumentSubIndikatorController extends Controller
{
    public function showSubIndikator(McpSubIndikator $subIndikator)
    {
        // return $subIndikator->mcp_document;
        // $data = $subIndikator
        //     ->with(['mcp_indikator', 'mcp_indikator.area_intervensi', 'obrik', 'mcp_document'])
        //     ->first();
        // return $data;
        return view('admin.mcp-kpk.sub-indikator.dokumen.index')
            ->with('sub_indikator', $subIndikator);
    }

    public function store(McpSubIndikator $subIndikator, Request $request)
    {
        $request['mcp_sub_indikator_id'] = $subIndikator->id;
        McpDocument::create($request->except(['_token']));
        return redirect()->route('admin.mcp-kpk.show-document', $subIndikator->id);
    }

    public function destroy(McpSubIndikator $subIndikator, McpDocument $mcpDocument)
    {
        $mcpDocument->delete();
        return redirect()->route('admin.mcp-kpk.show-document', $subIndikator->id);
    }
}
