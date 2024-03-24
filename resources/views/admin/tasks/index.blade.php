@extends('admin.layouts.app')
@section('content')

@include('admin.includes.datatablejs')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Tasks
        </h3> 

    </div>

    <div class="mt-2">
        @include('admin.layouts.partials.messages')

        <p id="msg" style="display:none">Saved</p>
    </div>

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Assigned Tasks list</h4>

                <table class="table table-bordered data-table" >
                    <thead>
                        <tr>
                            <th>id</th>                         
                            <th>Care taker</th> 
                            <th>Subject</th> 
                            <th>Message</th> 
                            <th>Event Start </th> 
                            <th>Event End</th> 
                            <th>Assigned By</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>


            </div>
        </div>
    </div>

</div>


<script type="text/javascript">

    jQuery(document).ready(function($) {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            "scrollY": 400,
            "scrollX": true,
            "bSort": false,
            "bPaginate": false,
            "autoWidth": false ,
            ajax: "{{ route('tasks.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },                
                {
                    data: 'care_taker',
                    name: 'care_taker'
                },
                {
                    data: 'subject',
                    name: 'subject'
                }, 
                {
                    data: 'message',
                    name: 'message'
                }, 
                {
                    data: 'task_start_date',
                    name: 'task_start_date'
                },
                {
                    data: 'task_end_date',
                    name: 'task_end_date'
                },
                {
                    data: 'created_by',
                    name: 'created_by'
                },
                {
                    data: 'details',
                    name: 'details',
                    orderable: false,
                    searchable: false
                },
            ]
        });

       // $(".data-table").css("width","100%");


        if (localStorage.getItem("message")) {

            swal({
                text: localStorage.getItem("message"),
                icon: "success",
            });

            localStorage.clear();
        }


    });
</script>





@stop