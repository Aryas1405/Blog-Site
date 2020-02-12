@extends('layouts.master_layout')

@section('content')

<div class="jumbotron" style="background-color:white">
<div>
<div style="margin-bottom:-30px;">

<a href="{{route('roles.create')}}" class="far fa-plus-square" style="margin-left:642px;"></a>

</div>  
    <h1 style="text-align:center;">Roles</h1>
</div>
 
</form>
    <table class="table table-striped">
    <tr>
    <th>Role</th>
    <th>Display Name</th>
    <th>Permission</th>
    <th>Action</th>

    </tr>
    @foreach($roles as $role)
    <tr>    
    <td>{{ $role->name }}</td>
    <td>{{ $role->display_name}}</td>
    <td>
    {{$role->permissions->count()}}
    </td> 

<td class="form-group row">
   
    <a href="{{route('roles.show',$role)}}" class="fas fa-eye" style="color:#008B8B;text-decoration:none;margin-left:10px;"></a>
    

   
    <a href="{{route('roles.edit',$role)}}"  class="fas fa-edit"style=" color:#008B8B;text-decoration:none;margin-left:10px;"></a>
    

  
        <form action="{{route('roles.destroy',$role)}}" method="post">
        @csrf
        @method('DELETE')
            <button type="submit" class= "fas fa-trash  "style="color:#008B8B;margin-left:10px;background-color:transparent;border:none;"></button>
        </form>


</td>
    </tr>
    @endforeach
    </table>
 
    </div>
@endsection