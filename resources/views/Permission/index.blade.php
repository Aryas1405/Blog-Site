@extends('layouts.master_layout')

@section('content')

<div class="jumbotron" style="background-color:white">
<div>
<div style="margin-bottom:-30px;">



</div>  
    <h1 style="text-align:center;">Permissions</h1>
</div>
 
</form>
    <table class="table table-striped">
    <tr>
    <th>Permission</th>
    <th>Display Name</th>
    <th>Description</th>
    </tr>
    @foreach($permissions as $permission)
    <tr>    
    <td>{{ $permission->name }}</td>
    <td>{{ $permission->display_name}}</td>
    <td>
    {{$permission->description}}
    </td> 
    </tr>
@endforeach
    </table>
 
    </div>
@endsection