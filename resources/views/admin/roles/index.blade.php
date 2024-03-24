@extends('admin.layouts.app')
@section('content')
 

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Roles
        </h3>

        <div class="lead">
        Manage your role here.
        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Add roles</a>
       </div> 
    </div>

    <div class="mt-2">
        @include('admin.layouts.partials.messages')
    </div>
    
    <div class="col-lg-12 stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Roles Managment System</h4>
                    
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Role Name </th>                          
                          <th> Edit </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($roles as $key => $role)
                        <tr class="table-info">
                          <td>{{ $role->id }} </td>
                          <td> {{ $role->name }} </td>
                          <td> <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Edit</a> </td>
                          <td>
                          {!! Form::open(['method' => 'POST','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                         </td>                         
                        </tr>
                                          
                        
                        @endforeach  
                      </tbody>
                    </table>
                    <div class="d-flex">
                    {!! $roles->links() !!}
                    </div>

                  </div>
                </div>
    </div>

</div>


@stop