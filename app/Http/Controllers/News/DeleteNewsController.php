<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use  Illuminate\Support\Facades\Validator;

class DeleteNewsController extends Controller
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


        return view('news.delete', ['id' => $id]);
    }

    public function delete(Request $request)
    {

        $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        $resp = Http::asForm()->post('http://127.0.0.1/api/index.php?alef_action=deleteNews',  [
            'alef_action' => 'deleteNews',
            'id' => $request->input('id'),
        ]);

        $respArr = json_decode($resp->body());
        //dd($respArr);
        if($respArr->status > 0 ) {
            return back()->withInput()->withErrors($errors[] = $respArr->user_message);
        }

        return redirect('news/error');
    }

}
