<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'root'){
            return redirect()->route('admin.pemantauan-tindak-lanjut.index');
        }

        return redirect()->route('pemantauan-tindak-lanjut.index');
    }

}
