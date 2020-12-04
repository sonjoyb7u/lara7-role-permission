@extends('admin.layouts.master')

@section('title', 'All Roles | Dashboard')

@push('css')
    <style>
        a.font-icon:hover i {
            color: #fff;
        }
    </style>
@endpush

@section('breadcrumb-content')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left">Roles</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li><span>Role Dashboard</span></li>
        </ul>
    </div>
@endsection

@section('content')
    @php($usr = Auth::guard('admin')->user())
    <!-- main-content with breadcrumb area start -->
    <div class="main-content-inner">
        <div class="row">
            <!-- Primary table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left">Data Table : Roles Lists</h4>
                        @if($usr->can('roles.create'))
                        <span class="float-right mb-4"><a href="{{ route('admin.roles.create') }}" class="btn btn-outline-primary btn-sm font-icon"><i class="ti-plus"></i> Create</a></span>
                        @endif
                        <div class="clearfix"></div>
                        <div class="data-tables datatable-primary">
                            <table id="dataTable2" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Role Name</th>
                                    <th>Permission</th>
                                    <th>Guard Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($role->name) }}</td>
                                    <td>
                                        @if(count($role->getAllPermissions()) > 0)
                                        @foreach($role->getAllPermissions() as $permission)
                                            <span class="badge badge-info text-light p-1">{{ $permission->name }}</span>
                                        @endforeach
                                            <p class="text-muted font-weight-bold">Total : <span class="badge badge-info text-light p-2">{{ count($role->getAllPermissions()) }}</span></p>
                                        @else
                                            <span class="badge badge-warning text-light p-2">No Permission Via Role :(</span>
                                        @endif
                                    </td>
                                    <td>{{ ucwords($role->guard_name) }}</td>
{{--                                    <td><span class="status-p bg-success">Active</span></td>--}}
                                    <td>
                                        @if($usr->can('roles.edit') || $usr->can('roles.delete'))
                                        <ul class="d-flex justify-content-center">
                                            @if($usr->can('roles.edit'))
                                            <li class="mr-3"><a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-outline-info btn-sm text-secondary font-icon"><i class="fa fa-edit"></i></a></li>
                                            @endif
                                            @if($usr->can('roles.delete'))
                                            <li>
                                                <a class="btn btn-outline-danger btn-sm text-danger font-icon" href="{{ route('admin.roles.destroy', $role->id) }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('delete-form-{{ $role->id }}').submit();">
                                                    <i class="ti-trash"></i>
                                                </a>

                                                <form id="delete-form-{{ $role->id }}" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </li>
                                            @endif
                                        </ul>
                                        @else
                                            <p class="badge badge-dark text-center">No access action</p>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Primary table end -->
        </div>
    </div>
    <!-- main-content with breadcrumb area end -->
@endsection

@push('js')

@endpush

