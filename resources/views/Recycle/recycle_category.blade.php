@extends('layouts.master_layout')

@section('content')
<div class="jumbotron">
<div class="row">
<a class="btn btn-success" href="{{route('blogs.recycle')}}" style="margin-left:700px;">Deleted Blogs()</a>
<a class="btn btn-success" href="{{route('tags.recycle')}}" style="margin-left:10px;">Deleted Tags()</a>
</div>
<h3 stlye="text-align:center">Deleted-categories()</h3>
<table class="col-sm-10">
<tr>
<td>Title</td>
<td>Actions</td>
@foreach($categories as $category)
</tr>
<td>{{$category->name}}</td>
<td class="form-group row">
    <a href=""><button class="btn btn-success" style="margin-left:10px;">Restore</button></a>

<form action="" method="">
   @csrf
   @method('delete')
    <button type="submit" class="btn btn-danger"style="margin-left:10px;">Delete</button></td>
    </form>
</td>
<tr>
@endforeach
</tr>
</table>
</div>

@endsection