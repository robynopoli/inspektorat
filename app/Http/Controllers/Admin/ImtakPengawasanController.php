<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImtakPengawasanController extends Controller
{
    public function index()
    {
        return view('admin.imtak-pengawasan.index')
            ->with('data', Event::with('user')
                ->latest()
                ->get());
    }

    public function request()
    {
        return view('admin.imtak-pengawasan.index')
            ->with('data', Event::with('user')
                ->where('status', Event::CHOICE_STATUS[0])
                ->latest()
                ->get());
    }

    public function edit($id)
    {
        return view('admin.imtak-pengawasan.edit')
            ->with('data', Event::where('id', $id)->with('user')->first())
            ->with('event_problem_choice', Event::CHOICE_EVENT_PROBLEM)
            ->with('status_choice', Event::CHOICE_STATUS);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'email' => 'required',
            'number_phone' => 'required|numeric',
            'detail' => 'required',
            'date_event' => 'required',
        ]);
        Event::where('id', $id)->update($request->except(['_token', '_method']));
        return redirect()->route('admin.imtak-pengawasan.index');
    }

    public function approve($id)
    {
        Event::where('id', $id)->update(['status' => Event::CHOICE_STATUS[1]]);
        return redirect()->route('admin.imtak-pengawasan.index');
    }

    public function destroy($id)
    {
        Event::where('id', $id)->delete();
        return redirect()->route('pegawai.imtak-pengawasan.index');
    }
}
