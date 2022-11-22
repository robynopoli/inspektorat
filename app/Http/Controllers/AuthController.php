<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_action(Request $request)
    {
        if ($request->email == 'admin@admin.com'){
            $user = User::where('email', $request->email)->first();
            if (Hash::check($request->password, $user->password)){
                Auth::loginUsingId($user->id);
                return redirect()->route('home');
            }else{
                session()->flash('msg_error', 'Username dan password tidak cocok');
                return redirect()->route('login')
                    ->withInput($request->all());
            }
        }

        $response = Http::post('http://pegawai.bkpsdm.mataramkota.go.id/api/login', [
            'username' => $request->email,
            'password' => $request->password,
        ]);

        if ($response['status'] == false){
            session()->flash('msg_error', $response['message']);
            return redirect()->route('login')
                ->withInput($request->all());
        }
        $apiToken = $response['token'];

        $responseUser = Http::get('http://pegawai.bkpsdm.mataramkota.go.id/api/user?api_token='.$apiToken);

        $user = User::firstOrCreate(
            [
                'email' => $responseUser['email'],
                'username' => $responseUser['username'],
            ],
            [
                'name' => $responseUser['nama'],
                'password' => bcrypt($request->password),
                'email_verified_at' => now(),
                'photo' => $responseUser['photo'],
                'role' => $responseUser['role'],
            ]);

        Auth::loginUsingId($user->id);
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
