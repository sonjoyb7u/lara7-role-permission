@extends('admin.layouts.master')

@section('title', 'Create Role | Dashboard')

@push('css')

@endpush

@section('breadcrumb-content')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left">Roles</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
            <li><span>Create Role</span></li>
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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title float-left">Create Role</h4>
                                <span class="float-right mb-4"><a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary btn-sm font-icon"><i class="ti-list-ol"></i> All Roles</a></span>
                                <div class="clearfix"></div>
                                <form action="{{ route('admin.roles.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Role Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter role name">
                                        @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <label class="custom-control-label mb-3">Permissions </label>
                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkedAllPermission">
                                            <label class="custom-control-label" for="checkedAllPermission">All Permissions</label>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            @php $i = 1; @endphp
                                            @foreach($permission_groups as $permission_group)
                                            <div class="col-md-2 col-lg-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input check-group-name" id="permission-group-name-{{ $i }}" value="{{ $permission_group->group_name }}" onclick="checkGroupWisePermission('group-wise-permission-checkbox-{{ $i }}', this)">
                                                    <label class="custom-control-label" for="permission-group-name-{{ $i }}">{{ ucwords($permission_group->group_name) }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4 group-wise-permission-checkbox-{{ $i }}">
                                                @php
                                                    $permissions = App\Models\User::getPermissionByGroupName($permission_group->group_name);
                                                    $j = 1;
                                                @endphp
                                                @foreach($permissions as $permission)
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" onclick="checkGroupWiseSinglePermission('group-wise-permission-checkbox-{{ $i }}', 'permission-group-name-{{ $i }}', {{ count($permissions) }})" class="custom-control-input check-group-item-name @error('permission_name') is-invalid @enderror" id="permission_{{ $permission->id }}" name="permission_name[]" value="{{ $permission->id }}">
                                                        <label class="custom-control-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                                    </div>
                                                    @php $j++; @endphp
                                                @endforeach
                                                <br>
                                                <hr>
                                            </div>
                                            @php $i++; @endphp
                                            @endforeach

                                            @error('permission_name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Create Role</button>
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
    @includeIf('admin.pages.role.partials.scripts')
@endpush

