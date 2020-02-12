@extends('layouts.master_layout')

@section('content')

<div class="jumbotron">
<form method='POST' action="{{route('blogs.store')}}" enctype="multipart/form-data">
@csrf()

<h3 style="margin-top:-60px;">Create Your Blog Here </h3>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Add a Title Here..." name="title" >
      @error('title')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="description" placeholder="Type Your Description Here.." style="height:250px"></textarea>
      @error('description')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror
    </div>

    <label class="col-sm-2 col-form-label">Image:</label>
    <div class="col-sm-10">
      <input type="file"  name="image" style="margin-top:10px;">

    </div>


    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Category</label>

    <div class="col-sm-10" style="margin-top:15px;">

<select class="custom-select" name="blog_category" >
    <option selected disabled>--Select Category--</option>
    @foreach($categories as $category)
    <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
</select>
@error('blog_category')
<small id="emailHelp" class="form-text text-danger">{{$message}}</small>
@enderror

</div class="form-group row">
    <label class="col-sm-2 col-form-label" style="margin-left:30px;">Tags:</label>
    <div class="col-sm-10" style="margin-top:-27px;margin-left:220px;">
    <select multiple class="js-example-basic-multiple" name="tag_id[]"style="margin-left:210px;margin-top:-40px;width:300px; ">
    <option selected disabled>---Select Tag/Tags---</option>
    @foreach($tags as $tag)
    <option value="{{$tag->id }}">{{ $tag->name }}</option>
  @endforeach
  </select>

</div>


<button type="submit" class="btn btn-success" style="margin-left:900px;margin-top:10px;">Add Blog</button>
<a href="{{route('blogs.index')}}" class="btn btn-outline-success" style="margin-left:700px;margin-top:-36px;">Back to all Blogs</a>






  </div>
</form>
</div>



@endsection