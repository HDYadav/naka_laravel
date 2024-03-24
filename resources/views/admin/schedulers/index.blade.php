@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Schedulers
        </h3>
    </div>

    <div class="mt-2">
        @include('admin.layouts.partials.messages')
    </div>

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Schedulers Managment System <span> <a href="{{ route('schedulers.saved_scheduler') }}" class="btn btn-primary btn-sm float-right">Show Scheduled</a></span> </h4>
                @if (session('sucess'))
                <div class="alert"><span style="color: green;"> {{ session('sucess') }} </span> </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th class="form-label"> Select the Year</th>
                            <th>
                                <select name="year" id="year" class="btn btn-sm btn-outline-primary dropdown-toggle">
                                    <option value="" class="dropdown-item">Select Year</option>
                                    @foreach($years as $year)
                                    <option value="{{ $year->id}}" class="dropdown-item"> {{ $year->year}} </option>
                                    @endforeach
                                </select>
                            </th>
                            <th class="form-label"> Select the Month</th>
                            <th>
                                <select class="btn btn-sm btn-outline-primary dropdown-toggle" id="month_id" name="month_id">
                                    <option value="" class="dropdown-item">Select Month</option>
                                </select>
                            </th>

                        </tr>
                    </thead>
                </table>
                <div id="index_scheduler">

                </div>

            </div>
        </div>
    </div>

</div>

<script src="{{asset('admin/assets/js/ajaxRequest.js')}}"></script>




@stop