@extends('layouts.master_layout')

@section('content')
<head>

</head>
<div class="jumbotron">
<form method='POST' action="{{route('roles.update',$role)}}">
@csrf()
@method('PUT')

<h3 style="margin-top:-60px;">Edit Your Role Here </h3>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="{{$role->name}}" name="name" >
      @error('name')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Display Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="{{$role->display_name}}" name="display_name">
      @error('display_name')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror
    </div>
    </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="description"  style="height:100px">{{$role->description}}</textarea>
      @error('description')
      <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
      @enderror
     
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Permissions</label>
        <div class="col-sm-10"  style="margin-left:223px;margin-top:-30px">
            <select class="js-example-basic-multiple" name="permission_id[]" multiple="multiple" style="margin-left:400px;width:100%">
           @foreach($permissions as $permission)
            <option selected value="{{$permission->id}}">{{$permission->display_name}}</option>
            @endforeach
            </select>
        <div>
        <br>
        <button class="btn btn-info" type="submit">Submit</button>
    </div>


    
</div>
@endsection