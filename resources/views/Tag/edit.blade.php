@extends('layouts.master_layout')

@section('content')
    <div class="jumbotron">
    <h3>Edit Tag Here</h3>
<br>
    <form class="form-inline" method="post" action="{{route('tags.update',$tag)}}">
    @csrf()
    @method('put')

  <div class="form-group mx-sm-3 mb-2">
    <input type="text" class="form-control"   value="{{$tag->name}}" name="tag_name">
    @error('tag_name')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror
  </div>
  <button class="btn btn-primary mb-2">Update Tag</button>
  <a  href="{{route('tags.index')}}" class="btn btn-info mb-2" style="margin-left:15px;">Back</a>
</form>
    </div>
    @endsection 