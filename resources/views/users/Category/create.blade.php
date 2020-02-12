@extends('layouts.master_layout')

@section('content')
<div class="jumbotron">
<form method='POST' action="/categories/store">
@csrf()

<h1>Create Category</h1>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Add a Title Here..." name="name" >
      @error('name')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <textarea class="form-control"  name="description" placeholder="Type Your Description Here.." style="height:250px"></textarea>
      @error('description')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror
    </div>
    <button type="submit" class="btn btn-success" style="margin-left:900px;margin-top:10px;">Add Category</button>
    <a href="../../categories" class="btn btn-outline-success" style="margin-left:700px;margin-top:-36px;">Back to all Categoty</a>
  </div>
</form>
</div>




@endsection