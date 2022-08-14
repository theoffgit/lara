<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ErrorNewsController extends Controller
{
    //
    public function create(Request $request)
    {
        $resp = Http::asForm()->get('http://127.0.0.1/api/index.php?alef_action=allNews',  [
            'alef_action' => 'allNews',
        ]);

        $respArr = json_decode($resp->body());
        //dd($respArr->status);
        //if($respArr->status > 0 ) {
        //    return back()->withInput()->withErrors($errors[] = 'something went wrong');
        // }
        return view('news.error', ['news' => $respArr->news]);
    }

}
