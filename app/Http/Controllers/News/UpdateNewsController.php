<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use  Illuminate\Support\Facades\Validator;

class UpdateNewsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {

        $id = intval($id);
        if($id < 1){
           $id = 'zasada';
        }
        $request->merge(['id' => $id]);

        $validator = Validator::make($request->all(), [
            'id' => [ 'required', 'numeric' ]
        ]);

        if ($validator->fails()) {
            return redirect('news/error')
                        ->withErrors($validator)
                        ->withInput();
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
        return view('news.update', ['title' => $respArr->title, 'text' => $respArr->text, 'id' => $id]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'id' => ['required', 'numeric'],
            'title' => ['required', 'string', 'max:25'],
            'text' => ['required', 'string', 'min:10' ,'max:255'],
        ]);


        $resp = Http::asForm()->post('http://127.0.0.1/api/index.php?alef_action=updateNews',  [
            'alef_action' => 'updateNews',
            'id' => $request->input('id'),
            'title' => $request->input('title'),
            'text' => $request->input('text'),
        ]);

        $respArr = json_decode($resp->body());
        //dd($respArr);
        if($respArr->status > 0 ) {
            $errors[] = $respArr->user_message;
            return back()->withInput()->withErrors($errors[] = $respArr->user_message);
        }
        return redirect()->route('news.read', [$respArr->id]);
    }

}
