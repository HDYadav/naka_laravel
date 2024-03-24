@extends('admin.layouts.app')
@section('content')

@include('admin.includes.datatablejs')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Year
        </h3>

        <div class="lead">
            Manage Year here.
            <a href="{{ route('years.create') }}" class="btn btn-primary btn-sm float-right">Add Year</a>
        </div>
        <span id="msg" class="text-sucess text-left"></span>
    </div>

    <div class="mt-2">
        @include('admin.layouts.partials.messages')

        <p id="msg" style="display:none">Saved</p>
    </div>

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Year Managment System</h4>

                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Year</th>
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

        var hitURL = baseUrlAdmin + '/years/delete';
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
            ajax: "{{ route('years.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'year',
                    name: 'year'
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





@stop