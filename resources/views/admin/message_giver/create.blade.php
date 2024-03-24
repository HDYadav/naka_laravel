@extends('admin.layouts.app')
@section('content')


<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Task
        </h3>
    </div>

    <div class="bg-light p-4 rounded">
        <h2>Add new Task</h2>
        <div class="lead">
            Add new Task.
        </div>

        <div class="container mt-4">

            <form method="POST" id="task_info">
                @csrf 

                <div class="row">
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Subject (Heading)</label> 
                            <input type="text" name="subject" id="subject" class="form-control form-control-sm">
                            <span id="subject" class="text-danger text-left"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Message</label>
                            <textarea rows="3"   name="message" id="message" class="form-control form-control-sm"></textarea> 
                            <span id="message" class="text-danger text-left"></span>
                        </div>
                    </div>  

                </div> 



                <div class="row">
                   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Message Giver</label>

                            <select name="message_giver_id" id="message_giver_id" class="form-control form-control-sm">
                                <option value=""> Select the Message Giver </option>
                                @foreach($message_givers as $key=>$message_giver)
                                <option value="{{ $message_giver->id}}"> {{ $message_giver->name}} </option>
                                @endforeach
                            </select>
                            <span id="message_giver_id" class="text-danger text-left"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Care Taker</label>

                            <select name="care_taker_id" id="care_taker_id" class="form-control form-control-sm">
                                <option value=""> Select the Care Taker </option>
                                @foreach($careTakers as $key=>$careTaker)
                                <option value="{{ $careTaker->id}}"> {{ $careTaker->name}} </option>
                                @endforeach
                            </select>
                            <span id="care_taker_id" class="text-danger text-left"></span>
                        </div>
                    </div> 

                </div>
                
                
                <div class="row">
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Event start date</label> 
                            <input type="text" name="start_date" id="start_date" class="form-control form-control-sm">
                            <span id="start_date" class="text-danger text-left"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Event end date</label>
                            <input type="text" name="end_date" id="end_date" class="form-control form-control-sm">
                            <span id="end_date" class="text-danger text-left"></span>
                        </div>
                    </div> 

                </div>  


                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>

</div> 

 <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>  
<script src="{{asset('admin/assets/js/validation.js')}}"></script> 



@stop