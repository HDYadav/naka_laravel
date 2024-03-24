@extends('admin.layouts.app')
@section('content')

@include('admin.includes.datatablejs')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Details
        </h3>
 
    </div>

    <div class="mt-2">
        @include('admin.layouts.partials.messages')

        <p id="msg" style="display:none">Saved</p>
    </div>

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Members Details</h4>

                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>                            
                            <th>Mobile</th> 
                            <th>Address</th>                          
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        
                       <td>{{@$user->id}}</td>
                       <td>{{@$user->name}}</td>
                       <td>{{@$user->mobile}}</td>
                       <td></td>                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>

</div>








@stop