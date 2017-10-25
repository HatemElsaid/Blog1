@extends('layouts.app')
@section('content')
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
                                    <div style="margin:10px;border: 1px solid #a3b9e0;padding: 20px;border-radius: 19px;"> <i class='fa fa-user '></i> Written By : {{$post->user_name}}</div>

                                        <ul class="nav nav-pills">
                                        
                                            <li>
                                            <a href='{{url("/like/{$post->id}")}}' role='presentation'> <i class='fa fa-thumbs-up '></i>LIKE()</a>
                                            </li>
                                            <li>
                                            <a href='{{url("/dislike/{$post->id}")}}' role='presentation'> <i class='fa fa-thumbs-down '></i>DISLIKE()</a>
                                            </li>
                                             
                                            <li>
                                            <a href='{{url("/comment/{$post->id}")}}' role='presentation'> <i class='fa fa-comment-o '></i>comment()</a>
                                            </li>
                                            <li class="pull-right"> <i class="fa fa-calendar"></i> Posted On : {{date('M j, Y H:i' , strtotime($post->created_at))}}</li>
                                        </ul>

                                </div>
                                
                            
                                @endforeach
                        @else
                        <h3 style='border-left:3px solid red'>No Posts Available In The Category</h3>
                        @endif 
                </div>
                                                        
                                                  
                                        
                 

</div> <!--row-->
</div>

@endsection