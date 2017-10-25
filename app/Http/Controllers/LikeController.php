<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;


class LikeController extends Controller
{
    public function index(Request $request){

        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->post_id = $request->post_id;
        $like->like = $request->isLike;
        $like->save();




        return ['status'=>'Ok'];
    }
}
