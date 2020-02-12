@extends('layouts.master_layout')

@section('content')
<head>

</head>
<div class="jumbotron">
    <form method='POST' action="{{route('users.update',$user)}}">
      @csrf()
      @method('PUT')
        <h3 style="margin-top:-60px;">Edit User</h3>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">User Name</label>
            <div class="col-sm-10">
                <input type="text" value="{{$user->name}}" name="name" class="form-control">
                @error('name')
                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" value="{{$user->email}}">
                    @error('display_name')
                    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="text" placeholder="update password or leave blank" name="password" class="form-control">
                @error('name')
                <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <div class="form-check">
                    @if($user->type=='admin')
                    <input type="radio" name="type" value="admin" checked>Admin<br>
                    <input type="radio" name="type" value="user"> User<br>
                    @else
                    <input type="radio" name="type" value="admin" >Admin<br>
                    <input type="radio" name="type" value="user"check> User<br>
                    @endif
                    </div>
                </div>
        </div>  

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Roles</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-multiple" name="role_id[]" multiple="multiple" style="width:100%">
                        @foreach($roles as $role)
                            <option
                                @foreach($user->roles as $user_role)
                                    @if($role->id==$user_role->id)
                                        selected
                                    @endif
                                @endforeach
                                value="{{$role->id}}">{{$role->display_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
        </div>
        <button class="btn btn-info" type="submit">Update User</button> 
    </form>
</div>
@endsection