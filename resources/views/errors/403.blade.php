@extends('admin.layouts.app')
@section('content')
  
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> ERROR
        </h3>

        <div class="lead">
        ERROR.
        
       </div> 
    </div>

    <div class="mt-2">
        @include('admin.layouts.partials.messages')
    </div>
    
    <div class="col-lg-12 stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">403 | USER DOES NOT HAVE THE RIGHT PERMISSIONS.</h4>
                    
                
                  </div>  
                </div>
    </div>

</div>


@stop