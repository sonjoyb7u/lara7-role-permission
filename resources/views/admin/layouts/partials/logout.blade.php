<div class="user-profile pull-right">
    <img class="avatar user-thumb" src="{{ asset('admin/assets/images/author/avatar.png') }}" alt="avatar">
    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
        {{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->name ? ucwords(\Illuminate\Support\Facades\Auth::guard('admin')->user()->name) : 'Default Admin' }}
        <i class="fa fa-angle-down"></i>
    </h4>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Message</a>
        <a class="dropdown-item" href="#">Settings</a>
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Log out') }}
        </a>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
