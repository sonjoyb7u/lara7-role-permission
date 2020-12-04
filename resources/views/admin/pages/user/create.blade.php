@extends('admin.layouts.master')

@section('title', 'Create Users | Dashboard')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('breadcrumb-content')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left">Users</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.users.index') }}">All Users</a></li>
            <li><span>Create User</span></li>
        </ul>
    </div>
@endsection

@section('content')
    <!-- main-content with breadcrumb area start -->
    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-6 col-ml-12">
                <div class="row">
                    <!-- basic form start -->
                    <div class="col-12 mt-5">
                        @includeIf('messages.get-message')
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title float-left">Create User</h4>
                                <span class="float-right mb-4"><a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-sm font-icon"><i class="ti-list-ol"></i> All Users</a></span>
                                <div class="clearfix"></div>
                                <form action="{{ route('admin.users.store') }}" method="POST">
                                    @csrf

                                    <div class="form-row">
                                        <div class="form-group col-6 col-md-6 col-sm-12">
                                            <label for="name">User Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter User name">
                                            @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6 col-md-6 col-sm-12">
                                            <label for="email">User Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter user email">
                                            @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6 col-md-6 col-sm-12">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Enter User password">
                                            @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6 col-md-6 col-sm-12">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Enter confirm password">
                                            @error('password_confirmation')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6 col-md-6 col-sm-12">
                                            <label for="roles">Assign Roles</label>
                                            <select class="form-control select2" name="role[]" multiple id="roles">
                                                <option value="">Select Role</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ ucwords($role->name) }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Create User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- basic form end -->
                </div>
            </div>
        </div>
    </div>
    <!-- main-content with breadcrumb area end -->
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
