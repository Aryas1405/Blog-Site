@extends('layouts.master_layout')

@section('content')

<div class="jumbotron">

        <div class="col-md-8" style="" >
            
                <form method='POST' action="{{route('blogs.update',$blog)}}"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                      <h1>Edit Your Blog Here </h1>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                  <input type="text" class="form-control"  value="{{ $blog->title }}" name="title">
                                  @error('title')
                                  <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                  @enderror
                            </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                  <textarea class="form-control" name="description" style="height:250px">{{ $blog->description }}</textarea>
                                  @error('description')
                                  <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                  @enderror
                            </div>
                      </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10" style="margin-top:15px;">
                                <select class="custom-select" name="blog_category" >
                                    <option disabled>--Select Category--</option>
                                        @foreach($categories as $category)
                                    <option
                                        @if($category->id==$blog->category_id)
                                                selected
                                        @endif
                                                value="{{ $category->id }}">{{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('blog_category')
                                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                @enderror
                              </div>
                          </div>


                      </div class="form-group row">
                          <label class="col-sm-2 col-form-label" style="margin-left:px;">Tags:</label>
                          <div class="col-sm-10" style="margin-top:-15px;margin-left:135px;">
                              <select multiple class="js-example-basic-multiple" name="tag_id[]" style="margin-left:190px;margin-top:-40px;width:800px; ">
                                        <option  disabled>---Select Tag/Tags---</option>
                                             @foreach($tags as $tag)
                                           
                                        <option 
                                            @foreach($blog->tags as $blog_tag)
                                             @if($tag->id==$blog_tag->id)
                                                selected 
                                            @endif
                                            @endforeach
                                                value="{{$tag->id }}">{{ $tag->name }}
                                        </option>
                                        
                                    @endforeach
                              </select>
                              @error('name')
                              <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                              @enderror
                          </div>
                      </div>
                      <div class="form-group row">

                          <label class="col-sm-2 col-form-label">Image:</label>
                              <div class="col-sm-10">
                                  <input type="file"  name="image" style="margin-top:10px;">
                              </div> 
                          
                      </div>

                      </div class="form-group row">
                          <button type="submit" class="btn btn-success" style="margin-left:900px;margin-top:10px;">Update Blog</button>
                          <a href="{{route('blogs.index')}}" class="btn btn-outline-success" style="margin-left:200px;margin-top:-76px;">Back to all Blogs</a>

                      
                      </div> 
             </form>
        </div>
        

            <div class="col-md-4" style="">
                <form action="{{route('blogs.deleteOnlyImage',$blog)}}" method="post">
                    @csrf
                    @method('DELETE')
                    @if($blog->image)
                      <img class="img-thumbnail" src="{{asset('image/'.$blog->image)}}" width="100px" height="auto">
                    @else
                      No Image
                    @endif
                    <button class="fa fas-trash" type="submit">button</button>
                </form>
            </div>
    
</div>
@endsection