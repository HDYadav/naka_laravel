@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Year
        </h3>
    </div>

    <div class="bg-light p-4 rounded">
        <h2>Add new year</h2>
        <div class="lead">
            Add new year.
        </div>

        <div class="container mt-4">

            <form method="POST" id="year_info">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Year</label>
                        <input type="text" class="form-control" name="year" id="year" placeholder="Enter Year">
                        <span id="year" class="text-danger text-left"></span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('years.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>

</div>


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="{{asset('admin/assets/js/validation.js')}}"></script>


@stop