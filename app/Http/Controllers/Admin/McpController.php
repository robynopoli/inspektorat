<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class McpController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.mcp-kpk.area-intervensi.index');
        return view('admin.mcp-kpk.layout');
    }
}
