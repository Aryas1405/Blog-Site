@extends('layouts.master_layout')

@section('content')
<h1>Category Display</h1>
<table class="table table-striped table-dark">
<tr>
<th>Name</th>

<th>Description</th>
<th>Blogs({{$category->blogs->count()}})</th>
</tr>
<tr>
<td>{{ $category->name }}</td>
<td>{{ $category->description }}</td>
<td>
@foreach($category->blogs as $blog)
-<a style="text-decoration:none; color:#6495ED;font-family:calibri" href="{{route('blogs.show',$blog)}}">{{$blog->title}}</a>
<br>
@endforeach
</td>
</tr>
</table>
<a href="{{route('categories.index')}}" class="btn btn-outline-success">Back to all Categoty</a>
@endsection
