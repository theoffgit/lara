<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CreateNewsController extends Controller
{
    //
    public function create(Request $request)
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:25'],
            'text' => ['required', 'string', 'min:10' ,'max:255'],
        ]);


        $resp = Http::asForm()->post('http://127.0.0.1/api/index.php?alef_action=createNews',  [
            'alef_action' => 'createNews',
            'title' => $request->input('title'),
            'text' => $request->input('text'),
        ]);

        $respArr = json_decode($resp->body());
        //dd($respArr->status);
        if($respArr->status > 0 ) {
            return back()->withInput()->withErrors($errors[] = 'something went wrong');
        }
        return redirect()->route('news.read', [$respArr->id]);
    }

}
