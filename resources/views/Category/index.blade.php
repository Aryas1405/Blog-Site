@extends('layouts.master_layout')

@section('content')
<div class="jumbotron" style="background-color:white;">
    <h1 style="text-align:center">-Categories-</h1>
    @permission('create-categories')
    <a  href="{{route('categories.create')}}" class="btn btn-info" style="margin-left:900px;margin-top:-48px;">Add Category</a>
    @endpermission
    <table class="table table-striped">
    <form action="" method="get">
    <input type="text" placeholder="search by category" name="searchC" value="{{$searchC}}" style="margin-left:600px;border-bottom:2px solid black; border-top:none;border-left:none;border-right:none;" >
   <input type="text" placeholder="search by blog" name="searchB" value="{{$searchB}}" style=" margin-left:10px;margin-bottom:8px; border-bottom:2px solid black; border-top:none;border-left:none;border-right:none;" >
    <button type="submit" class="fas fa-search" style="background-color:transparent;border:none;"></button> 
    <br> 
    </form>
    <br>
    <tr>
    <th>Category</th>
    <th>Blogs</th> 
    <th>Created By</th>
     

    <th>Created On</th>
    <th>Updated On</th>
    <th>Action</th>

    </tr>
    @foreach($categories as $category)
    
    <tr>    
    <td>{{ $category->name }}</td>
    <td>
    @foreach($category->blogs as $blog)
-<a style="text-decoration:none; color:#6495ED;font-family:calibri" href="{{route('blogs.show',$blog)}}">{{$blog->title}}</a>
<br>
@endforeach
    </td>
    <td>
    @if($category->user)
    {{ $category->user->name}}
    @else
    None
    @endif
    </td>
    
    <td>{{ $category->created_at }}</td>
    <td>{{ $category->updated_at }}</td>
    <td class="form-group row">
    @permission('read-categories')
    <a href="{{route('categories.show',$category)}}"><button class="btn btn-success" style="margin-left:10px;">Show</button></a>
   @endpermission

    @permission('update-categories')
   <a href="{{route('categories.edit',$category)}}"><button class="btn btn-warning"style="margin-left:10px;">Edit</button></a>
@endpermission

   @permission('delete-categories')
<form action="{{route('categories.destroy',$category)}}" method="post">
   @csrf
   @method('delete')
    <button type="submit" class="btn btn-danger"style="margin-left:10px;">Delete</button></td>
    </form>
    @endpermission


    </tr>
    @endforeach
    </table>
    {{$categories->appends($_GET)->links()}}
    </div>
    @endsection