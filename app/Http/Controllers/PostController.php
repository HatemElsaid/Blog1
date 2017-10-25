<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;//need to upload Image
use Illuminate\Support\Facades\URL;//need to upload Image
use Illuminate\Support\Facades\File;//need to upload Image
use Illuminate\Support\Facades\DB;
 
use App\post;
use App\Category;
 
use App\Like;
use App\Dislike;
use Auth;


class PostController extends Controller
{

 
   public function post(){  
       $categories = Category::all();

       return view('posts.post' , ['categories'=>$categories]);
   }
  public function addPost(Request $request){
        $this->validate($request , [
            'post_title'=>'required',
            'post_body'=>'required',
            'category_id'=>'required',
             

        ]);
    
        $posts = new Post;
        $posts->post_title = $request->input('post_title');
        $posts->user_id = Auth::user()->id;
        $posts->user_name = Auth::user()->name;
        $posts->post_body = $request->input('post_body');
        $posts->category_id = $request->input('category_id');
                if (Input::hasFile('post_image')){
                    $file = Input::file('post_image');
                $file->move(public_path().'/posts/', //posts folder we and create it in public folder
                $file->getClientOriginalName());
                $url = URL::to('/').'/posts/'.$file->getClientOriginalName();
                }

        $posts->post_image =$url;
        $posts->save();
        return redirect('/home')->with('response', 'Post Added Successfully');
  }

  public function view($post_id, Request $request){
      $posts =Post::where('id' , '=' ,$post_id)->get();
      $likePost =Post::find($post_id);
      $likeCount =Like::where(['post_id'=>$likePost->id])->count();
      $disLikeCount = Dislike::where(['post_id'=>$likePost->id])->count();
       
      $categories = Category::all();
      $post= Post::find($post_id);
      $post->addVisit(); //very important : add new view ti DB  usin(cyrildewit/laravel-page-visits-counter)
      
   $total_view=$post->page_visits;
   $likedisLikeCount=$likeCount-$disLikeCount;
   $recommend = $total_view+$likeCount-$disLikeCount;
     
    $post->recommend= $recommend;
    $post->likes = $likeCount;
    $post->dislikes = $disLikeCount;
    $post->like_dislike = $likedisLikeCount;
    $post->views = $total_view;
    $post->update();
    
   
     
 
    


    //try to send post data from view



       
      return view('posts.view',['posts'=>$posts,'categories'=>$categories,
      'likeCount'=>$likeCount, 'disLikeCount'=>$disLikeCount,'total_view'=>$total_view  ]);
       
  }
    public function edit($post_id){
        $categories=Category::all();
        $posts = Post::find($post_id);
        $category = Category::find($posts->category_id);
        return view('posts.edit',['posts'=>$posts,'categories'=>$categories,'category'=>$category]);

    }
    public function editPost(Request $request , $post_id){

     //here same mechanism of addPost function up there but change save() to => update($data) $data = all data we recive 


        $this->validate($request , [
            'post_title'=>'required',
            'post_body'=>'required',
            'category_id'=>'required',
             

        ]);
    
        $posts = new Post;
        $posts->post_title = $request->input('post_title');
        $posts->user_id = Auth::user()->id;
        $posts->user_name = Auth::user()->name;//i put this to can publish authir name
        $posts->post_body = $request->input('post_body');
        $posts->category_id = $request->input('category_id');
                if (Input::hasFile('post_image')){
                    $file = Input::file('post_image');
                $file->move(public_path().'/posts/',//posts folder we and create it in public folder
                $file->getClientOriginalName());
                $url  = URL::to('/').'/posts/'.$file->getClientOriginalName();
                }

        $posts->post_image = $url;
        $data = array(
            'post_title'    =>$posts->post_title,
            'user_id'       =>$posts->user_id,
            'post_body'     =>$posts->post_body ,
            'category_id'   =>$posts->category_id,
            'post_image'    =>$posts->post_image


        );
        Post::where('id',$post_id)
        ->update($data);
        $posts->update();
        return redirect('/home')->with('response', 'Post Updated Successfully');

    }

    public function deletePost($post_id){
        Post::where('id' , $post_id)->delete();
        
        return redirect('/home')->with('response', 'Post Deleted Successfully');
    }

    public function category($cat_id){
        $categories = Category::all();
        $posts = DB::table('posts')
        ->join('categories', 'posts.category_id', '=', 'categories.id')
        ->select('posts.*', 'categories.*')
        ->where(['categories.id'=>$cat_id])
        ->get();
        return view('categories.categoriesPosts',['posts'=>$posts,'categories'=>$categories]);

    }

    public function like($id){
        $loggedIn_user = Auth::user()->id;
        $like_user = Like::where(["user_id"=>$loggedIn_user , "post_id" =>$id])->first();
        if(empty($like_user->user_id)){
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id = $id;
            $like = new Like;
            $like->user_id = $user_id;
            $like->email= $email;
            $like->post_id = $post_id;
            $like->save();
            return redirect()->back();
            
        }else{
            $like_user->delete();
            return redirect()->back();
        }
    }
        public function disLike($id){  //like and dislike function are the same functionality
            $loggedIn_user = Auth::user()->id;
            $like_user = Dislike::where(["user_id"=>$loggedIn_user , "post_id" =>$id])->first();
            if(empty($like_user->user_id)){
                $user_id = Auth::user()->id;
                $email = Auth::user()->email;
                $post_id = $id;
                $like = new Dislike;
                $like->user_id = $user_id;
                $like->email= $email;
                $like->post_id = $post_id;
                $like->save();
                 
                
                return redirect()->back();
                
            }else{
                $like_user->delete();
                return redirect()->back();
            }
        }


        // public function show($id)
        // {
        //     $post = $this->posts->find($id);
    
        //     \Event::fire(new ArticleWasViewed($post));
    
        //     return view('home', compact('post'));
        // }

    

    // public function postLikePost(Request $request){
    //     $post_id =$request['postId'];//postId from ajax request <= mine.js
    //     $is_like = $request['isLike']==='true';//isLike from ajax request <= mine.js
    //     $update = false;
    //     $post = Post::find($post_id);
    //     if(!$post){
    //         return null;
    //     }
    //     $user = Auth::user();
    //     $like = $user->likes()->where('post_id',$post_id)->first();
    //     if($like){
    //         $already_like = $like->like;
    //         $update =true;
    //         if($already_like==$is_like){
    //             $like->delete();
    //             return null;
    //         }
    //     }else{$like = new Like();}
    //     $like->like->$is_like;
    //     $like->user_id = $user->id;
    //     $like->post_id = $post_id;
    //     if($update){
    //         $like->update();
    //     }else{
    //         $like->save();
    //     }
    //     return null;


    // }
}
