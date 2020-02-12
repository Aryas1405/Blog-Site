@extends('layouts.master_layout')

@section('content')
<div class="jumbotron">
<form method='POST' action="{{route('categories.update',$category)}}">
@csrf()
@method('PUT')
<h1>Edit Blog!!</h1>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="{{ $category->name }}" name="name">
      @error('name')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" >Description</label>
    <div class="col-sm-10">
      <textarea class="form-control rounded-0"  name="description" style="height:250px;" >{{ $category->description }} </textarea>
      @error('description')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror
    </div>
    <a href="{{route('categories.index')}}" class="btn btn-outline-success" style="margin-left:700px;margin-top:10px;">Back to all Categoty</a>
    <button type="submit" class="btn btn-success" style="margin-left:900px;margin-top:-38px;">Update Blog</button>
    
  </div>
</form>
</div>
@endsection