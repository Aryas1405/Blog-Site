@extends('layouts.master_layout')

@section('content')
<h1>Role Display</h1>
<table class="table table-striped table-dark">
<tr>
<th>Name</th>

<th>Description</th>
<th>Permissions({{$role->permissions->count()}})</th>
</tr>
<tr>
<td>{{ $role->name }}</td>
<td>{{ $role->description }}</td>
<td>
@foreach($role->permissions as $permission)
-<a style="text-decoration:none; color:#6495ED;font-family:calibri" href="">{{$permission->display_name}}</a>
<br>
@endforeach
</td>
</tr>
</table>
<a href="{{route('roles.index')}}" class="btn btn-outline-success">Back to all Roles</a>
@endsection
