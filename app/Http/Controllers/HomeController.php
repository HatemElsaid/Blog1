<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Profile;
use App\user;
use App\Category;
use App\Post;

use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $user_id = Auth::user()->id;
            $profile = DB::table('users')->join('profiles' , 'users.id','=','profiles.user_id')
            ->select('users.*','profiles.*')
            ->where(['profiles.user_id'=> $user_id])
            ->first();
            
           
          $posts = Post::paginate(2);
          
          $categories = Category::all();
          $recommends = DB::table('posts')
          ->orderBy('recommend', 'desc')
          
          ->take(2)->get();
          

        return view('home' , ['profile'=>$profile , 'posts'=>$posts , 'categories'=>$categories,'recommends'=>$recommends ]);
    }
    
    public function mostViews(){
          
        $categories = Category::all();

       $posts=DB::table('posts')
        ->orderBy('views', 'desc')
        ->take(10)->get();
         
         
      
        return view('arrang',['posts'=>$posts , 'categories'=>$categories  ]);
    }
 
}
 
// DB::table('cases')
// ->join('contacts', 'cases.id', '=', 'contacts.id')
// ->selectRaw('cases.name as cases_name, contacts.name as contacts_name')
// ->get();