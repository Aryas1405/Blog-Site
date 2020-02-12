@extends('layouts.master_layout')

@section('content')
<div class="jumbotron" style="background-color:white;">
    <h1>User Categories</h1>

    <a  href="{{route('categories.create')}}" class="btn btn-info" style="margin-left:900px;margin-top:-48px;">Add Category</a>
    <table class="table table-striped">
    <form action="" method="get">
    <input type="text" placeholder="search category" name="searchC" value="{{$searchC}}" style=" margin-left:800px;margin-bottom:8px; border-bottom:2px solid black; border-top:none;border-left:none;border-right:none;" >
    <button type="submit" class="fas fa-search"></button> 
    </form>
    <br>
    <tr>
    <th>Name</th>
    <th>Created By</th>
    <th>Blogs</th>  

    <th>Created On</th>
    <th>Updated On</th>
    <th>Action</th>

    </tr>
    @foreach($categories as $category)
    
    <tr>    
    <td>{{ $category->name }}</td>
    <td>
    @if($category->user)
    {{ $category->user->name}}
    @else
    None
    @endif
    </td>
    <td>

    {{$category->blogs->count()}}

    </td>
    <td>{{ $category->created_at }}</td>
    <td>{{ $category->updated_at }}</td>
    <td class="form-group row">
    <a href="{{route('categories.show',$category)}}"><button class="btn btn-success" style="margin-left:10px;">Show</button></a>
    <a href="{{route('categories.edit',$category)}}"><button class="btn btn-warning"style="margin-left:10px;">Edit</button></a>
<form action="{{route('categories.destroy',$category)}}" method="post">
   @csrf
   @method('delete')
    <button type="submit" class="btn btn-danger"style="margin-left:10px;">Delete</button></td>
    </form>


    </tr>
    @endforeach
    </table>
    {{$categories->appends($_GET)->links()}}
    </div>
    @endsection