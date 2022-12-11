<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImtakPengawasanController extends Controller
{
    public function index()
    {
        return view('pegawai.imtak-pengawasan.index')
            ->with('data', Event::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get());
    }

    public function create()
    {
        return view('pegawai.imtak-pengawasan.create')
            ->with('event_problem_choice', Event::CHOICE_EVENT_PROBLEM)
            ->with('user', Auth::user());
    }

    public function store(Request $request)
    {
        $request->validate([
           'email' => 'required',
           'number_phone' => 'required|numeric',
           'detail' => 'required',
           'date_event' => 'required',
        ]);

        $request['user_id'] = Auth::id();
        $request['status'] = Event::CHOICE_STATUS[0];
        Event::create($request->except(['_token']));
        return redirect()->route('pegawai.imtak-pengawasan.index');
    }

    public function edit($id)
    {
        return view('pegawai.imtak-pengawasan.edit')
            ->with('data', Event::where('id', $id)->first())
            ->with('event_problem_choice', Event::CHOICE_EVENT_PROBLEM)
            ->with('user', Auth::user());
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'email' => 'required',
            'number_phone' => 'required|numeric',
            'detail' => 'required',
            'date_event' => 'required',
        ]);

        $request['user_id'] = Auth::id();
        $request['status'] = Event::CHOICE_STATUS[0];
        Event::where('id', $id)->update($request->except(['_token', '_method']));
        return redirect()->route('pegawai.imtak-pengawasan.index');
    }

    public function destroy($id)
    {
        Event::where('id', $id)->delete();
        return redirect()->route('pegawai.imtak-pengawasan.index');
    }

}
