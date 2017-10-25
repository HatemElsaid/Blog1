<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
 
use App\Category;
use App\Post;

class ArrangLikedController extends Controller
{
    public function mostLiked(){
        
         
        $posts= DB::table('posts')
        ->orderBy('like_dislike', 'desc')
        
        ->take(10)->get();
        $categories = Category::all();

      

       
      
        return view('arrangLiked',['posts'=>$posts , 'categories'=>$categories ]);
    }
}
