@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> place
        </h3>
    </div>

    <div class="bg-light p-4 rounded">
        <h2>Add new place</h2>
        <div class="lead">
            Add new place.
        </div>

        <div class="container mt-4">

            <form method="POST" id="city_info_edit">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Place Name</label>
                        <input type="text" value="{{ $cities->name }}"  class="form-control" name="name" id="name" placeholder="Name">
                        <span id="name" class="text-danger text-left"></span>
                    </div>                     
                </div>  

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('city.index') }}" class="btn btn-default">Back</a>
                <input name="id" type="hidden" value="{{ $cities->id }}">

            </form>
        </div>

    </div>

</div>


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="{{asset('admin/assets/js/validation.js')}}"></script>


@stop