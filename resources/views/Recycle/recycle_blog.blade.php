@extends('layouts.master_layout')

@section('content')
<div class="jumbotron">
<div class="row">
<a class="btn btn-success" href="" style="margin-left:700px;">Deleted Categoriess()</a>
<a class="btn btn-success" href="" style="margin-left:10px;">Deleted Tags()</a>
</div>
<h3 stlye="text-align:center">Deleted-Blogs()</h3>
<table class="col-sm-10">
<tr>
<td>Title</td>
<td>Actions</td>
@foreach($blogs as $blog)
</tr>
<td>{{$blog->title}}</td>
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