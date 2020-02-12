@extends('layouts.master_layout')

@section('content')

<style>
a
{
    text-decoration:none;   
}
.post-footer-option li{
    float:left;
    margin-right:50px;
    padding-bottom:15px;
}

.post-footer-option li a{
    color:#AFB4BD;
    font-weight:500;
    font-size:1.3rem;
}

.photo-profile{
    border:1px solid #DDD;    
}

.anchor-username h4{
    font-weight:bold;    
}

.anchor-time{
    color:#ADB2BB;
    font-size:1.2rem;
}

.post-footer-comment-wrapper{
    background-color:#F6F7F8;
}
img {

  margin-left: auto;
  margin-right: auto;

}
.comment
{
    border:2px solid;
    border-top:none;
    border-left:none;
    border-right:none;
    margin-top:-5px; 
    margin-left:-5px; 
    height:50px; 
    width:550px;
    border-radious:100px;
}
</style>
<table class="table table-striped table-dark">
<!--<tr>
<th>Title</th>
<th>Image</th>
<th>Tags</th>
<th>Category</th>
<th>Blog Description</th>
</tr>
-->

<h1 style="text-align:center; font-family:poor richard;color:#008080">'{{$blog->title}} "</h1>
<h4 style="text-align:center;color: #9f6060 ;font-family:colonna mt">-{{$blog->category->name}}-</h4>
<div style="margin-left:auto;margin-right:auto;">
    @if($blog->image)
    <img class="img-thumbnail" src="{{asset('image/'.$blog->image)}}" style="margin-left:10%" width="80%" height="auto">
    @else
    No Images
    @endif
    </div>
    <div style="margin-left:30px;margin-right:30px;">
    <p class="fas fa-hashtag"></p>
@foreach($blog->tags as $tag)
<h5  class="d-inline p-2 text-grey" style="font-size:14px;" >#{{$tag->name}}</h5>

@endforeach
</div>
<br>
<div style="margin-left:30px;margin-right:30px;">
<h3 style="font-family:gabriola"> <p class="fas fa-quote-left"></p>
{{$blog->description}}
<i class="fas fa-quote-right"></i>
</h3>
</div>
<form action="{{route('comments.store',$blog)}}" method="post">

@csrf()
@method('put')
<div style="margin-left:25% ;width:50%; height:auto;">

<input class="comment" type="text" name="comment" placeholder="Post Your Comment Here...">
<button tupe="submit" style="font-size:40px; background:transparent; border:none;margin-top:4px;"class="fas fa-comment-medical"></button>
<br>
<br>

@foreach($blog->comments as $comment)
<!--comment show design--> 


        <div style="width:100%;" >
                <div class="panel panel-default">
                
                            <div class="row">
                            
                                    
                                    <div class="media-body" >
                                        <a href="#" class="anchor-username" style="text-decoration:none;font-family:Agency FB;color:#009999"><h4 class="media-heading">{{$comment->user->name}}</h4></a> 
                                       <p class="anchor-time">{{$comment->created_at->diffForHumans()}}</p>
                                    
                                    </div>
                            
                            </div>  
                                       
                        
                        <section class="post-body">
                            <p>{{$comment->comment}}</p>
                        </section>
                    
                        <section class="post-footer">
                          
                        
                      
                                    <ul class="row" style="border-bottom:1px solid  #663300">
                                        <a href="#"><i class="far fa-thumbs-up"></i> </a>
                                        <a href="#" style="margin-left:15px;"><i class="fas fa-reply"></i></a>
                                        
                                    </ul>
                                    
                           
                            
                        </section>
                  </div>  

        </div>
@endforeach
</div>
</div>
</form>
@endsection