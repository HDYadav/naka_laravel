@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper">
    <h2>Permissions</h2>
     
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> permissions
        </h3>

        <div class="lead">
        Manage permissions here.
        <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right">Add permissions</a>
       </div> 
    </div>

    <div class="mt-2">
        @include('admin.layouts.partials.messages')
    </div>



    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" width="25%">Name</th>
            <th scope="col">Guard</th> 
            <th scope="col" colspan="2" width="1%"></th> 
        </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td><a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                    <td>
                        {!! Form::open(['method' => 'POST','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
       
        </tbody>
        
    </table>
     
   
         
  

</div>


@stop