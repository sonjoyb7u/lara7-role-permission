<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public $admin;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->admin = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function index() {
        if(is_null($this->admin) || !$this->admin->can('dashboard.show')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        $total_admins = count(Admin::select('id')->get());
        $total_roles = count(Role::select('id')->get());
        $total_permissions = count(Permission::select('id')->get());
        return view('admin.pages.dashboard.index', compact('total_admins', 'total_roles', 'total_permissions'));

    }

}
