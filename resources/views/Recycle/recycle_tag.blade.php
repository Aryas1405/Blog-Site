@extends('layouts.master_layout')

@section('content')
<div class="jumbotron">
<div class="row">
<a class="btn btn-success" href="" style="margin-left:700px;">Deleted Categories()</a>
<a class="btn btn-success" href="" style="margin-left:10px;">Deleted Blogs()</a>
</div>
<h3 stlye="text-align:center">Deleted-Tags()</h3>
<table class="col-sm-10">
<tr>
<td>Title</td>
<td>Actions</td>
@foreach($tags as $tag)
</tr>
<td>{{$tag->name}}</td>
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