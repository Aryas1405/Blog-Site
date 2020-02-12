@extends('layouts.master_layout')

@section('content')
    <div class="jumbotron">

    <form class="form-inline" method="post" action="{{route('tags.store')}}">
    @csrf()

  <div class="form-group mx-sm-3 mb-2">
    <input type="text" class="form-control"  placeholder=" Enter New Tag" name="tag_name">
@error('name')
<small class="form-text text-danger">{{$message}}</small>
@enderror
  </div>
  <button class="btn btn-primary mb-2">Add Tag</button>
  <a  href="{{route('tags.index')}}" class="btn btn-info mb-2" style="margin-left:15px;">Show Tags</a><br>  

</form>
    </div>
    @endsection