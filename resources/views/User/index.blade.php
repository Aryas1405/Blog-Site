    @extends('layouts.master_layout')

    @section('content')

<div class="jumbotron" style="background-color:white">
<div>
<div style="margin-bottom:-15px;">

<a href="{{route('users.create')}}" class="far fa-plus-square" style="margin-left:670px;"></a>

</div>  
    <h1 style="text-align:center;">-USERS-</h1>
</div>
 
</form>
    <table class="table table-striped">
    <tr>
    <th>Users</th>
    <th>Roles</th>
    <th>Action</th>

    </tr>
    @foreach($users as $user)
    <tr>    
    <td>{{ $user->name }}</td>
    <td>

    @foreach($user->roles as $user_role)
    <a href="{{route('roles.show',$user_role)}}">{{$user_role->display_name}}</a><br>
     @endforeach
    
    </td> 

<td class="form-group row">
   
    <a href="{{route('users.show',$user)}}" class="fas fa-eye" style="color:#008B8B;text-decoration:none;margin-left:10px;"></a>
    

   
    <a href="{{route('users.edit',$user)}}"  class="fas fa-edit"style=" color:#008B8B;text-decoration:none;margin-left:10px;"></a>
    

  
        <form action="{{route('users.destroy',$user)}}" method="post">
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