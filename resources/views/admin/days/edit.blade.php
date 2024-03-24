@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Days
        </h3>
    </div>

    <div class="bg-light p-4 rounded">
        <h2>Edit new Day</h2>
        <div class="lead">
            Edit new day.
        </div>

        <div class="container mt-4">

            <form method="POST" id="day_edit_info">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Year</label>
                            <select name="year_id" id="year_id" class="form-control form-control-sm">
                                <option value=""> Pleas select year </option>
                                @foreach($years as $key=>$year)
                                <option value="{{ $year->id}}" @if($year->id == $days->year_id) selected @endif> {{ $year->year}} </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Month</label>
                            <select name="month_id" id="month_id" class="form-control form-control-sm">
                                <option value=""> Pleas select month </option>
                                @foreach($months as $key=>$month)
                                <option value="{{ $month->id}}" @if($month->id == $days->month_id) selected @endif> {{ $month->month}} </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Date</label>
                            <select name="date" id="date" class="form-control form-control-sm">
                                <option value=""> Pleas select date </option>
                                @foreach($date as $key=>$day)
                                <option value="{{$day}}" @if($day==$day_id) selected @endif> {{$day}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Week</label>
                            <select name="week" id="week" class="form-control form-control-sm">
                                <option value=""> Pleas select Week </option>
                                @foreach($weekDays as $key=>$weekDay)
                                <option value="{{ $weekDay}}" @if($weekDay==$days->day) selected @endif > {{ $weekDay}} </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                </div>

                <input type="hidden" name="dayID" value="{{$days->id}}">


                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('years.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>

</div>


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="{{asset('admin/assets/js/validation.js')}}"></script>


@stop