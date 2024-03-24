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
        <h2>Add new Year</h2>
        <div class="lead">
            Add new Year.
        </div>

        <div class="container mt-4">

            <form method="POST" id="year_info_edit">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Year </label>
                        <input type="text" value="{{ $years->year }}" class="form-control" name="year" id="year" placeholder="Year">
                        <span id="year" class="text-danger text-left"></span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('years.index') }}" class="btn btn-default">Back</a>
                <input name="id" type="hidden" value="{{ $years->id }}">

            </form>
        </div>

    </div>

</div>


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="{{asset('admin/assets/js/validation.js')}}"></script>


@stop