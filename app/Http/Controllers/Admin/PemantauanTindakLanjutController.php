<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Finding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemantauanTindakLanjutController extends Controller
{

    public function cekRoot()
    {
        $user = Auth::user();
        if (!$user->role == 'root'){
            return redirect()->route('home');
        }
    }

    public function index()
    {
        $this->cekRoot();
        return view('admin.pemantauan-tindak-lanjut.index')
            ->with('data', Finding::orderBy('updated_at', 'desc')->get());
    }

    public function pengajuan_tindak_lanjut()
    {
        $this->cekRoot();
        return view('admin.pemantauan-tindak-lanjut.pengajuan-tl')
            ->with('data', Finding::where('status', 'belum diproses')->get());
    }

    public function pengajuan_tindak_lanjut_edit($id)
    {
        $this->cekRoot();
        return view('admin.pemantauan-tindak-lanjut.edit')
            ->with('data', Finding::findOrFail($id));
    }

    public function pengajuan_tindak_lanjut_update($id, Request $request)
    {
        $this->cekRoot();
        Finding::where('id', $id)->update($request->except('_token'));
        return redirect()->route('admin.pemantauan-tindak-lanjut.index');
    }
}
