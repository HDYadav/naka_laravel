@extends('admin.layouts.app')
@section('content')

@include('admin.includes.datatablejs')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Scheduler Draft
        </h3>


        <!-- <div class="lead">
            Manage Scheduler here.
            <a href="{{ route('schedulers.index') }}" class="btn btn-primary btn-sm float-right">Add Schedule</a>
        </div> -->
        <span id="msg" class="text-sucess text-left"></span>
    </div>

    <div class="mt-2">
        @include('admin.layouts.partials.messages')
        <p id="msg" style="display:none">Saved</p>
    </div>

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Unpublised Message Giver <a href="{{ route('schedulers.list') }}" class="btn btn-primary btn-sm float-right">Published</a> </h4>

                <table class="table table-bordered data-table">
                    <thead>
                        <tr>

                            <th>Message Giver </th>
                            <th>Place</th>
                            <th>Date</th>
                            <th width="100px">Action</th>
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
    function deletess(id) {
        // console.log(id);

        var hitURL = baseUrlAdmin + '/schedulers/delete';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        swal({
            title: 'Are you sure ',
            text: "want to delete?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f51b5',
            cancelButtonColor: '#ff4081',
            confirmButtonText: 'Great ',
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: false,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true,
                },
                confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                    className: "btn btn-primary",
                    closeModal: true
                }
            }
        }).then((willDelete) => {
            if (willDelete) {

                jQuery.ajax({
                    type: "POST",
                    dataType: "json",
                    url: hitURL,
                    data: {
                        id: id,
                        IsDeleted: status
                    }
                }).done(function(data) {

                    if (data.status == true) {
                        swal({
                            text: "Records sucessfully deleted",
                            icon: "success",
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            } else {

                            }
                        });
                    }

                });

            } else {

                //swal("Your imaginary file is safe!");
            }
        });

    }

    jQuery(document).ready(function($) {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('schedulers.draft') }}",
            columns: [{
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'city_name',
                    name: 'city_name'
                }, {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        if (localStorage.getItem("message")) {

            swal({
                text: localStorage.getItem("message"),
                icon: "success",
            });

            localStorage.clear();
        }


    });
</script>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideModal()"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">User Details</h4>
            </div>
            <div class="modal-body" id="response">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="hideModal()">Close</button>

            </div>
        </div>
    </div>
</div>


<script>
    function showModal(modalId) {
        // console.log(modalId)

        var city_id = modalId

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: baseUrlAdmin + '/schedulers/get_city_modal',
            method: "GET",
            data: {
                'city_id': city_id
            },
            success: function(data) {
                $('#myModal').modal('show'); // Show modal 
                $("#response").html(data.html);
            }
        });



    }

    function hideModal() {
        $('#myModal').modal('hide'); // Hide modal
    }
</script>


@stop