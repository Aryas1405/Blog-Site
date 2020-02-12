@extends('layouts.master_layout')

@section('content')
<head>

</head>
<div class="jumbotron">
    <form method='POST' action="{{route('users.store')}}">
      @csrf()
        <h3 style="margin-top:-60px;">Create Newe User</h3>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">User Name</label>
            <div class="col-sm-10">
                <input type="text" placeholder="user name" name="name" class="form-control">
                @error('name')
                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    @error('display_name')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="text" placeholder="password" name="password" class="form-control">
                @error('name')
                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <div class="form-check">
                    <input type="radio" name="type" value="admin">Admin<br>
                    <input type="radio" name="type" value="user"> User<br>
                    </div>
                </div>
        </div>  

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Roles</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-multiple" name="role_id[]" multiple="multiple" style="width:100%">
                        @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                        @endforeach
                    </select>
                </div>
        </div>
        <button class="btn btn-info" type="submit">Create User</button> 
    </form>
</div>
@endsection