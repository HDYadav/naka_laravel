@extends('admin.layouts.app')
@section('content')

<style>
    .table-schedule tr th {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }
</style>

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
                <h4 class="card-title">Scheduler Edit </h4>
                @if (session('error'))
                <div class="alert"><span style="color: red;"> {{ session('error') }} </span> </div>
                @endif

                <form method="post" action="{{route('schedulers.update')}}">
                    @csrf


                    <table class="table table-bordered">
                        <thead>
                            <tr>

                                <th class="form-label">Select the Year</th>
                                <th>
                                    <select name="year" id="year" class="form-control form-control-sm" disabled>
                                        <option value="">Select Year</option>
                                        @foreach($years as $year)
                                        <option value="{{ $year->id}}" <?php if ($year->id == $scheduler['0']->year_id) {
                                                                            echo "selected";
                                                                        } ?>> {{ $year->year}} </option>
                                        @endforeach
                                    </select>
                                </th>
                                <th class="form-label">Select the Month</th>
                                <th>
                                    <select class="form-control form-control-sm" id="month_id" name="month_id" disabled>
                                        <option value="">Select Month</option>
                                        <option value="">Select Year</option>
                                        @foreach($months as $month)
                                        <option value="{{ $month->id}}" <?php if ($month->id == $scheduler['0']->month_id) {
                                                                            echo "selected";
                                                                        } ?>> {{ $month->month}} </option>
                                        @endforeach
                                    </select>
                                </th>

                            </tr>
                        </thead>
                    </table>

                    <div id="scheduler">


                        <?php
                        $x = 1;
                        foreach ($days as $key => $day) {
                            $i = 0;

                        ?>

                            <table class="table table-bordered table-schedule">
                                <tbody>

                                    <tr class="table-info">
                                        <th colspan="2" align="center"><strong> Week {{$x}}, Sunday <?php echo $day->date; ?> </strong> <span id="show<?php echo $x; ?>" style="cursor:pointer">Show/Hide</span> </th>
                                        </th>

                                    <tr id="tbd<?php echo $x ?>" <?php if ($x > 1) { ?> style="display:none" <?php } ?>>

                                        <td colspan="2">
                                            <table width="100%">
                                                <tr>
                                                    <td><strong>SN.</strong> </td>
                                                    <td><strong>Place</strong> </td>
                                                    <td><strong>Speaker</strong> </td>
                                                </tr>
                                                <?php

                                                $n = 0;

                                                foreach ($cities as $key => $city) {

                                                    $members = json_decode(getUsers());
                                                    $userID =   getUserID($day->id, $city->id);

                                                ?>
                                                    <tr>
                                                        <td> <?php echo $city->id; ?> </td>
                                                        <td>

                                                            <a data-toggle="modal" data-target="#myModal" id="<?php echo "cityId_" . $city->id; ?>" onclick="showModal(this.id)" data-num="0"><?php echo $city->city_name; ?> </a>

                                                            <input type="hidden" name="city[]" value="{{ $city->id}}">
                                                            <input type="hidden" value="{{$day->id}}" name="dayIDs[]">

                                                        </td>

                                                        <td>
                                                            <select name="member[]" id="member" class="btn btn-sm btn-outline-primary dropdown-toggle">

                                                                <option value="" class="dropdown-item">Select speaker</option>
                                                                <?php
                                                                foreach ($members as $member) {
                                                                ?>
                                                                    <option value="<?php echo $member->id ?>" class="dropdown-item" <?php if ($member->id == @$userID->user_id) { echo "selected"; } ?>><?php echo $member->name ?></option>
                                                                <?php } ?>

                                                            </select>
                                                        </td>
                                                    </tr>

                                                <?php $n++;
                                                    $i++;
                                                } ?>

                                            </table>
                                        </td>

                                    </tr>

                                </tbody>
                            </table>

                        <?php $x++;
                        } ?>

                        <input type="hidden" name="month_id" value="{{$scheduler['0']->month_id}}">
                        <br>
                        <br>

                        <button type="submit" name="update" value="save" class="btn btn-primary">Save Publish</button>
                        <button type="submit" name="draft" value="draft" class="btn btn-primary">Save Draft</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="{{asset('admin/assets/js/ajaxRequest.js')}}"></script>


<script>
    $(function() {

        $("#show1").click(function() {

            $("#tbd1").toggle();

            $("#tbd2").css("display", "none");
            $("#tbd3").css("display", "none");
            $("#tbd4").css("display", "none");

        });


        $("#show2").click(function() {

            $("#tbd2").toggle();
            $("#tbd1").css("display", "none");
            $("#tbd3").css("display", "none");
            $("#tbd4").css("display", "none");

        });


        $("#show3").click(function() {
            $("#tbd3").toggle();
            $("#tbd1").css("display", "none");
            $("#tbd2").css("display", "none");
            $("#tbd4").css("display", "none");

        });

        $("#show4").click(function() {
            $("#tbd4").toggle();
            $("#tbd1").css("display", "none");
            $("#tbd2").css("display", "none");
            $("#tbd3").css("display", "none");
        });

    });
</script>


@stop