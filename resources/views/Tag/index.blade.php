@extends('layouts.master_layout')

@section('content')
<div class="jumbotron" style="background-color:white;">
    <h1>All Tags</h1>
    <a  href="{{route('tags.create')}}" class="btn btn-info" style="margin-left:900px;margin-top:-48px;">Create New Tag</a>
    <table class="table table-striped">
    <form action="" method="get">
    <input type="text" placeholder="search tag" name="searchT" value="{{$searchT}}" style=" margin-left:800px;margin-bottom:8px; border-bottom:2px solid black; border-top:none;border-left:none;border-right:none;" >
    <button type="submit" class="fas fa-search"></button> 
    </form>
    <tr>
    <th>Name</th>
    <th>Created By</th>
    <th>Action</th>

    </tr>
    @foreach($tags as $tag)
    
    <tr>    
    <td>{{ $tag->name }}</td>
    <td>
    @if($tag->user)
    {{ $tag->user->name}}
    @else
    None
    @endif
    </td>
    
    <td class="form-group row">
   
    <a href="{{route('tags.edit',$tag)}}"><button class="btn btn-warning"style="margin-left:10px;">Edit</button></a>
<form action="{{route('tags.destroy',$tag)}}" method="post">
   @csrf
   @method('delete')
    <button type="submit" class="btn btn-danger"style="margin-left:10px;">Delete</button></td>
    </form>


    </tr>
    @endforeach
    </table>
    {{$tags->appends($_GET)->links()}}
    </div>

    @endsection