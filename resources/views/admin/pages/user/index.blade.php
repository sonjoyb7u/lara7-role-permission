@extends('admin.layouts.master')

@section('title', 'All Users | Dashboard')

@push('css')
    <style>
        a.font-icon:hover i {
            color: #fff;
        }
    </style>
@endpush

@section('breadcrumb-content')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left">Users</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li><span>User Dashboard</span></li>
        </ul>
    </div>
@endsection

@section('content')
    <!-- main-content with breadcrumb area start -->
    <div class="main-content-inner">
        <div class="row">
            <!-- Primary table start -->
            <div class="col-12 mt-5">
                @includeIf('messages.get-message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title float-left">Data Table : Users Lists</h4>
                        <span class="float-right mb-4"><a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary btn-sm font-icon"><i class="ti-plus"></i> Create</a></span>
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
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($user->name) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(count($user->roles) > 0)
                                        @foreach($user->roles as $role)
                                            <span class="badge badge-info text-light p-1">{{ ucwords($role->name) }}</span>
                                        @endforeach
                                            <p class="text-muted font-weight-bold">Total : <span class="badge badge-info text-light p-2">{{ count($user->roles) }}</span></p>
                                        @else
                                            <span class="badge badge-warning text-light p-2">No Role Via User :(</span>
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="d-flex justify-content-center">
                                            <li class="mr-3"><a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-info btn-sm text-secondary font-icon"><i class="fa fa-edit"></i></a></li>
                                            <li>
                                                <a class="btn btn-outline-danger btn-sm text-danger font-icon" href="{{ route('admin.users.destroy', $user->id) }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('delete-form-{{ $user->id }}').submit();">
                                                    <i class="ti-trash"></i>
                                                </a>

                                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </li>
                                        </ul>
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

