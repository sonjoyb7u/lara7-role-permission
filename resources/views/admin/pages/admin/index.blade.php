@extends('admin.layouts.master')

@section('title', 'All Admin | Dashboard')

@push('css')
    <style>
        a.font-icon:hover i {
            color: #fff;
        }
    </style>
@endpush

@section('breadcrumb-content')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left">Admin</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li><span>Admin</span></li>
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
                        <h4 class="header-title float-left">Data Table : Admin Lists</h4>
                        @if($usr->can('admin.create'))
                        <span class="float-right mb-4"><a href="{{ route('admin.admins.create') }}" class="btn btn-outline-primary btn-sm font-icon"><i class="ti-plus"></i> Create</a></span>
                        @endif
                        <div class="clearfix"></div>
                        <div class="data-tables datatable-primary">
                            <table id="dataTable2" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($admin->name) }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        @if(count($admin->roles) > 0)
                                        @foreach($admin->roles as $role)
                                            <span class="badge badge-info text-light p-1">{{ ucwords($role->name) }}</span>
                                        @endforeach
                                            <p class="text-muted font-weight-bold">Total : <span class="badge badge-info text-light p-2">{{ count($admin->roles) }}</span></p>
                                        @else
                                            <span class="badge badge-warning text-light p-2">No Role Via admin :(</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($usr->can('admin.edit') || $usr->can('admin.delete'))
                                        <ul class="d-flex justify-content-center">
                                            @if($usr->can('admin.edit'))
                                            <li class="mr-3"><a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-outline-info btn-sm text-secondary font-icon"><i class="fa fa-edit"></i></a></li>
                                            @endif
                                            @if($usr->can('admin.delete'))
                                            <li>
                                                <a class="btn btn-outline-danger btn-sm text-danger font-icon" href="{{ route('admin.admins.destroy', $admin->id) }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('delete-form-{{ $admin->id }}').submit();">
                                                    <i class="ti-trash"></i>
                                                </a>

                                                <form id="delete-form-{{ $admin->id }}" action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" class="d-none">
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

