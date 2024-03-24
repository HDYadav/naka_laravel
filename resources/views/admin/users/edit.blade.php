@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> User
        </h3>
    </div>

    <div class="bg-light p-4 rounded">
        <h2>Edit new user</h2>
        <div class="lead">
            Edit new user.
        </div>

        <div class="container mt-4">


            <!-- <form method="POST" action="{{ route('users.update', $user->id) }}"> -->

            <form method="POST" id="user_info_edit">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input value="{{ $user->name }}" type="text" class="form-control" name="name" placeholder="Name" required>

                        @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile" class="form-label">Mobile </label>
                            <input value="{{ $user->mobile }}" type="number" class="form-control" name="mobile" placeholder="mobile" required>

                            @if ($errors->has('mobile'))
                            <span class="text-danger text-left">{{ $errors->first('mobile') }}</span>
                            @endif
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label">Location</label>
                            <select name="location_id" id="location_id" class="form-control form-control-sm">
                                <option value=""> Pleas select location </option>
                                @foreach($locations as $location)
                                <option value="{{ $location->id}}" <?php if ($location->id == $user->location_id) {
                                                                        echo "selected";
                                                                    } ?>> {{ $location->name}} </option>
                                @endforeach
                            </select>
                            <span id="location_id" class="text-danger text-left"></span>
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile" class="form-label">Address </label>
                            <input value="{{ $user->address}}" type="text" class="form-control" name="address" id="address" placeholder="address">

                            <span id="address" class="text-danger text-left"></span>
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Role</label>

                            <select name="role_id" id="role_id" class="form-control form-control-sm" required>
                                <option value=""> Pleas select role </option>
                                @foreach($roles as $key=>$role)
                                <option value="{{ $role->id}}" @php if($role->id == $role_id){ echo "Selected";} @endphp > {{ $role->name}} </option>
                                @endforeach
                            </select>

                            @if ($errors->has('role_id'))
                            <span class="text-danger text-left">{{ $errors->first('role_id') }}</span>
                            @endif
                        </div>
                    </div>


                    <?php $i = 0 ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Parent</label>
                            <select name="parent_id" id="parent_id" class="form-control form-control-sm" required>
                                <option value=""> Pleas select parent </option>
                                @foreach($parents as $key=>$parent)
                                <option value="{{ $parent->id}}" <?php if ($parent->id == $parent_id) {
                                                                        echo "selected";
                                                                    } ?>> {{ $parent->name}} </option>
                                @if (count($parent->children) > 0)
                                @include('admin.users.partials.child', ['parents' => $parent->children])
                                @endif
                                @endforeach
                            </select>

                            @if ($errors->has('parent_id'))
                            <span class="text-danger text-left">{{ $errors->first('parent_id') }}</span>
                            @endif
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input value="{{ $user->email }}" type="email" class="form-control" name="email" placeholder="Email ID">

                        @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="mobile" class="form-label">User Status </label>
                        <select name="status" class="form-control form-control-sm">
                            <option value="">Select Status</option>
                            <option value="0" <?php if ($user->status == '0') {
                                                    echo "selected";
                                                } ?>>Active</option>
                            <option value="1" <?php if ($user->status == '1') {
                                                    echo "selected";
                                                } ?>>Pending</option>
                        </select>

                        <span id="mobile" class="text-danger text-left"></span>
                    </div>



                </div>

                <input name="id" type="hidden" value="{{ $user->id }}">

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>

</div>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="{{asset('admin/assets/js/validation.js')}}"></script>

@stop