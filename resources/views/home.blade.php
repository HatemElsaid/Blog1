@extends('layouts.app')

@section('content')
<div class="container home-page">
        
        <div class="row">
                 
                 <div class="col-sm-4 side-bar"> 
                      <!-- showing profile details if it exsists else showing blank -->
                      <div class='profile'>
                                <div class="col-sm-6">
                                    @if(!empty($profile))
                                    <a href="{{ url('/profile') }}"><img class='avatar' src="{{$profile->profile_pic}}" alt=""></a>
                                    @else
                                    <a href="{{ url('/profile') }}"> <img class='avatar' src="{{url('https://avatars.io/platform/userId')}}" alt="" ></a>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    @if(!empty($profile))
                                    <a href="{{ url('/profile') }}"><h3 >{{$profile->name}}</h3></a>
                                    @else
                                    <p></p>
                                    @endif
                                    @if(!empty($profile))
                                    <p>{{$profile->designation}}</p>
                                    @else
                                    <p></p>
                                    @endif
                                </div>
                        </div>
                         
                    <!-- showing recommends details if it exsists else showing blank -->
                        <div class='categories col-sm-12 recommends'>
                          <h2 class='text-center'>Recommended</h2>
                              @if(count($recommends)>0)
                                            @foreach($recommends as $recommend)
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                        <a href='{{url("/view/{$recommend->id}")}}'>{{$recommend->post_title}}</a>
                                        </li>
                                            <div>
                                                        
                                                             
                                                             
                                                <div class='text-center'>
                                                <img src="{{$recommend->post_image}}" alt="" class=" img-responsive img-thumbnail" style='display:block;margin:auto'>
                                                </div>
                                                <!-- using markdown package in this code -->
                                                 {!! Michelf\Markdown::defaultTransform(substr($recommend->post_body , 0 , 70 ))!!} 
                                            </div>
                                    </ul>
                                    <hr class='separator'>
                                         @endforeach
                                @endif
                        </div>
                        <hr class='separator'>
                        <!-- showing Categories details if it exsists else showing blank -->
                        <div class='categories col-sm-12'>
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
                        </div>
                                             
                </div>
                <div class="col-sm-8">
                  <h2 class='text-center'> Home Page</h2>
                
                    <!-- validate Profile input && make user back to home--> 
                    @if(count($errors)>0)
                        @foreach($errors->all() as $error)
                            
                                <div class="alert alert-danger">{{$error}}</div>
                            
                        @endforeach
                    @endif
                    @if(session('response'))
                        <div class="alert alert-success">{{session('response')}}</div>
                    @endif

                    <!--End validate category input -->
                     
                                        

                                        

                                                @if(count($posts)>0)

                                                        @foreach($posts as $post)
                                                    
                                                        <div class=' post-content'>
                                                        
                                                            <h4 class='text-center'><a  href='{{url("/view/{$post->id}")}}'>{{$post->post_title}}</a></h4>
                                                             
                                                            <div class='text-center'>
                                                            <img src="{{$post->post_image}}" alt="" class=" img-responsive img-thumbnail" style='display:block;margin:auto'>
                                                            </div>
                                                            <!-- using markdown package in this code -->
                                                            <p >{!! Michelf\Markdown::defaultTransform(substr($post->post_body , 0 , 300 ))!!}</p>
                                                           <div style="margin:10px;border: 1px solid #a3b9e0;padding: 20px;border-radius: 19px;">
                                                                    <div class='pull-right'>viewed :<span style='color: #30a3dc;font-size: 20px;border-bottom: 2px solid red;'> {{$post->page_visits}} times</span></div>
                                                                        <i class='fa fa-user '></i> Written By : {{$post->user_name}}
                                                            </div>
                                                                <ul class="nav nav-pills">
                                                                 
                                                                    <li>
                                                                    <a href='{{url("/view/{$post->id}")}}' role='presentation'> <i class='fa fa-eye'></i> VIEW POST</a>
                                                                    </li> 
                                                                    @if ($post->user_id === Auth::user()->id ) <!--  delete and update only for author -->
                                                                    <li>
                                                                    <a href='{{url("/edit/{$post->id}")}}' role='presentation'> <i class='fa fa-pencil '></i> EDIT</a>
                                                                    </li>
                                                                    <li>
                                                                    <a href='{{url("/deletePost/{$post->id}")}}' role='presentation' > <i class='fa fa-trash'></i> DELETE</a>
                                                                    </li>
                                                                    @endif
                                                                    <li class="pull-right"> <i class="fa fa-calendar"></i> Posted On : {{date('M j, Y H:i' , strtotime($post->created_at))}}</li>
                                                                    
                                                                </ul>

                                                               
                                                        </div>
                                                        @endforeach
                                                        <div class='pagination-block'>
                                                        

                                                                {{$posts->links()}}
                                                                </div>
                                                        

                                                @else
                                                <h3 style='border-left:3px solid red'>No Posts Available</h3>
                                                @endif
                                             
                                                
                     
        </div><!--col-sm-8-->
                   
                
                 
        </div><!--row-->
</div><!--container-->
@endsection
<!-- <script>
setTimeout(function() {
  var visitCount = document.getElementById('postCountValue');
var visitCountPlus = parseInt(visitCount)+1;
document.getElementById('postCountValue').value =visitCountPlus;

  var $formVar = $('form');

  $.ajax({
      url: $formVar.prop("{{url('view/{id}')}}"),
      method:'PUT',
      data:$formVar.serialize()


  })
    
}, 1000);


</script> -->