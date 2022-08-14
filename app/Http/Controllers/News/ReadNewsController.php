<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReadNewsController extends Controller
{
    //
    public function read(Request $request, $id)
    {

        $id = intval($id);
        if($id < 1){
            return view('news.read', ['title' => 'Something is wrong with ID field!', 'text' => '', 'date' => '']);                
        }


        $resp = Http::asForm()->post('http://127.0.0.1/api/index.php?alef_action=selectNews',  [
            'alef_action' => 'selectNews',
            'id' => $id,
        ]);

        $respArr = json_decode($resp->body());
        //dd($respArr);
        if($respArr->status > 0 ) {
            $errors[] = 'something went wrong';
            $respArr->title = $respArr->user_message;
            $respArr->text = '';
            $respArr->date = '';
        }
        return view('news.read', ['title' => $respArr->title, 'text' => $respArr->text, 'date' => $respArr->date]);
    }

}
