
@php($usr = Auth::guard('admin')->user())
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.index') }}"><img width="100" src="{{ asset('admin/assets/images/icon/logo1.png') }}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
{{--                DASHBOARD... --}}
                    <li class="{{ Route::is('admin.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                    </li>
{{--                ROLES... --}}
                    @if($usr->can('roles.show') || $usr->can('roles.create') || $usr->can('roles.edit') || $usr->can('roles.delete'))
                    <li class="{{ Route::is('admin.roles.index') || Route::is('admin.roles.create') || Route::is('admin.roles.show') || Route::is('admin.roles.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i><span>
                            Roles
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.roles.index') || Route::is('admin.roles.create') || Route::is('admin.roles.show') || Route::is('admin.roles.edit') ? 'in' : '' }}">
                            @if($usr->can('roles.create'))
                            <li class="{{ Route::is('admin.roles.create') ? 'active' : '' }}"><a href="{{ route('admin.roles.create') }}">Create Role</a></li>
                            @endif
                            @if($usr->can('roles.show') || $usr->can('roles.edit') || $usr->can('roles.delete'))
                            <li class="{{ Route::is('admin.roles.index') || Route::is('admin.roles.edit') ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}">Manage Role</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
{{--                USERS... --}}
                    @if($usr->can('user.show') || $usr->can('user.create') || $usr->can('user.edit') || $usr->can('user.delete'))
                    <li class="{{ Route::is('admin.users.index') || Route::is('admin.users.create') || Route::is('admin.users.show') || Route::is('admin.users.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>
                            Users
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.users.index') || Route::is('admin.users.create') || Route::is('admin.users.show') || Route::is('admin.users.edit') ? 'in' : '' }}">
                            @if($usr->can('user.create'))
                            <li class="{{ Route::is('admin.users.create') ? 'active' : '' }}"><a href="{{ route('admin.users.create') }}">Create User</a></li>
                            @endif
                            @if($usr->can('user.show') || $usr->can('user.edit') || $usr->can('user.delete'))
                            <li class="{{ Route::is('admin.users.index') || Route::is('admin.users.show') || Route::is('admin.users.edit') ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}">Manage User</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
{{--                ADMINS... --}}
                    @if($usr->can('admin.show') || $usr->can('admin.create') || $usr->can('admin.edit') || $usr->can('admin.delete'))
                    <li class="{{ Route::is('admin.admins.index') || Route::is('admin.admins.create') || Route::is('admin.admins.show') || Route::is('admin.admins.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>
                            Admins
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.admins.index') || Route::is('admin.admins.create') || Route::is('admin.admins.show') || Route::is('admin.admins.edit') ? 'in' : '' }}">
                            @if($usr->can('admin.create'))
                            <li class="{{ Route::is('admin.admins.create') ? 'active' : '' }}"><a href="{{ route('admin.admins.create') }}">Create Admin</a></li>
                            @endif
                            @if($usr->can('admin.show') || $usr->can('admin.edit') || $usr->can('admin.delete'))
                            <li class="{{ Route::is('admin.admins.index') || Route::is('admin.admins.show') || Route::is('admin.admins.edit') ? 'active' : '' }}"><a href="{{ route('admin.admins.index') }}">Manage Admin</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
