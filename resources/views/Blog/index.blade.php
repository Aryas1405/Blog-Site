@extends('layouts.master_layout')

@section('content')
<div class="jumbotron" style="background-color:white">
<div>
<div style="margin-bottom:-30px;">
@permission('create-blogs')
<a href="{{route('blogs.create')}}" class="far fa-plus-square" style="margin-left:642px;"></a>
@endpermission
</div>  
    <h1 style="text-align:center;">Blogs</h1>
</div>
<form action="" method="get">
   <input type="text" placeholder="search blog" name="searchB" value="{{$searchB}}" style="margin-left:600px;border-bottom:2px solid black; border-top:none;border-left:none;border-right:none;" >
   <input type="text" placeholder="search category" name="searchC" value="{{$category}}" style=" margin-left:10px;margin-bottom:8px; border-bottom:2px solid black; border-top:none;border-left:none;border-right:none;" >
    <button type="submit" class="fas fa-search" style="background-color:transparent;border:none;"></button> 
    <br>
</form>
    <table class="table table-striped">
    <tr>
    <th>Blog Title</th>
    <th>Image</th>
    <th>Comments</th>
    <th>Category</th>
    <th>Created By</th>
    <th>Action</th>

    </tr>
    @foreach($blogs as $blog)
    <tr>    
    <td>{{ $blog->title }}</td>
    <td>
    @if($blog->image)
    <img class="img-thumbnail" src="{{asset('image/'.$blog->image)}}" width="100px" height="auto">
    @else
    No Image
@endif
    </td>
    <td>{{$blog->comments->count()}}</td>
    <td>{{ $blog->category->name}}</td> 
    <td>
    @if($blog->user)
    {{ $blog->user->name}}
    @else
    None
    @endif
    </td>

<td class="form-group row">
    @permission('read-blogs')
    <a href="{{route('blogs.show',$blog)}}" class="fas fa-eye" style="color:#008B8B;text-decoration:none;margin-left:10px;"></a>
    @endpermission

    @permission('read-blogs')
    <a href="{{route('blogs.edit',$blog)}}"  class="fas fa-edit"style=" color:#008B8B;text-decoration:none;margin-left:10px;"></a>
    @endpermission

    @permission('delete-blogs')
        <form action="{{route('blogs.destroy',$blog)}}" method="post">
        @csrf
        @method('DELETE')
            <button type="submit" class= "fas fa-trash  "style="color:#008B8B;margin-left:10px;background-color:transparent;border:none;"></button>
        </form>
    @endpermission

</td>
    </tr>
    @endforeach
    </table>
    {{$blogs->appends($_GET)->links()}}
    </div>

    @endsection