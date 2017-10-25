@extends('layouts.app')
@section('content')
<style>
.red{
    background:red;
}
</style>
<div class="container">
    <div class='row'>
            <div class="col-sm-4 side-bar"> 
                 <h2 class='text-center'>Categories</h2>

                                    @if(count($categories)>0)
                                            @foreach($categories->all() as $category)
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                        <a href='{{url("category/{$category->id}")}}'>{{$category->category}}</a>
                                        </li>
                                    </ul>
                                             @endforeach
                                    @endif
            </div><!--sm-4-->
                             
                                                    
    <div class='col-sm-8'>
            @if(count($posts)>0)

            @foreach($posts as $post)
        
            <div class=' post-content'>
                <h4 class='text-center'>{{$post->post_title}}</h4>
                <div class='text-center'>
                <img src="{{$post->post_image}}" alt="" class=" img-responsive img-thumbnail" style='display:block;margin:auto'>
                </div>
                <!-- using markdown package in this code -->
                <p >{!! Michelf\Markdown::defaultTransform($post->post_body)!!}</p>
                <div style="margin:10px;border: 1px solid #a3b9e0;padding: 20px;border-radius: 19px;">
                    <div class='pull-right'>viewed :<span style='color: #30a3dc;font-size: 20px;border-bottom: 2px solid red;'> {{$post->page_visits}} times</span></div>
                        <i class='fa fa-user '></i> Written By : {{$post->user_name}}
                </div>
                            <ul class="nav nav-pills">
                     
                        <li>
                        <a href='{{url("/like/{$post->id}")}}' role='presentation' class='like' id='like'> <i class='fa fa-thumbs-up '></i>LIKE({{$likeCount}})</a>
                        </li>
                        <li>
                        <a href='{{url("/dislike/{$post->id}")}}' role='presentation' class='like'> <i class='fa fa-thumbs-down '></i>DISLIKE({{$disLikeCount}})</a>
                        </li>

                            
                        <li>
                        <a href='#' role='presentation'> <i class='fa fa-comment-o '></i>comment()</a>
                        </li>
                        <li class="pull-right"> <i class="fa fa-calendar"></i> Posted On : {{date('M j, Y H:i' , strtotime($post->created_at))}}</li>
                        
                    </ul>

            </div>
            
        
            @endforeach
    @else
    <h3 style='border-left:3px solid red'>No Posts Available</h3>
    @endif 
    </div>
                   
       

</div> <!--row-->
</div>
<?php
$views = $post->page_visits;
$likes = $likeCount;
$disLikes = $disLikeCount;
$recommended = $views + $likes -$disLikes;
echo $views.'<br>';
echo $disLikes.'<br>';
echo $likes.'<br>';
echo $recommended.'<br>';
 
?>
<h1>{{$post->page_visits}} </h1>
<script>
//for ajax request of like and dislike

</script>
<script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('js/mine.js') }}"></script>


@endsection