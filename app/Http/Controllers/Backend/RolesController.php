<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public $admin;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->admin = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null($this->admin) || !$this->admin->can('roles.show')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        $roles = Role::all();
        return view('admin.pages.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->admin) || !$this->admin->can('roles.create')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('admin.pages.role.create', compact('permissions', 'permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->admin) || !$this->admin->can('roles.create')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        // Validation...
        $this->validate($request, [
            'name' => 'required|max:80|unique:roles',
            'permission_name' => 'required',
        ], $message = [
            'name.required' => 'The Role name field is required!',
            'name.max' => 'The Role name must be less than 80 characters!',
            'name.unique' => 'The Role name has already been taken!',
            'name.permission_name' => 'The Permission name field is required!',
        ]);
        // Create Role & Role wise permissions...
        $role_name = $request->name;
        $permissions = $request->input('permission_name');
        if(!empty($permissions)) {
            $role = Role::create(['name' => $role_name, 'guard_name' => 'admin']);
            $role->syncPermissions($permissions);
            $msg = ucwords($role->name) . ' role has been created.';
            setMessage('success',  $msg);
            return redirect()->back();
        } else {
            setMessage('success', 'Something went wrong!');
            return redirect()->back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->admin) || !$this->admin->can('roles.edit')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        $role = Role::findById($id, 'admin');
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('admin.pages.role.edit', compact('role', 'permissions', 'permission_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(is_null($this->admin) || !$this->admin->can('roles.edit')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        $role = Role::findById($id, 'admin');
        // Validation...
        $this->validate($request, [
            'name' => 'required|max:80|unique:roles,name,'.$id,
            'permission_name' => 'required',
        ], $message = [
            'name.required' => 'The Role name field is required!',
            'name.max' => 'The Role name must be less than 80 characters!',
            'name.permission_name' => 'The Permission name field is required!',
        ]);
        // Update Role & Role wise permissions...
        $role->name = $request->name;
        $permissions = $request->input('permission_name');
        if(!empty($permissions)) {
            $role->save();
            $role->syncPermissions($permissions);
            $msg = ucwords($role->name) . ' role has been updated.';
            setMessage('success',  $msg);
            return redirect()->route('admin.roles.index');
        } else {
            setMessage('danger', 'Something went wrong!');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->admin) || !$this->admin->can('roles.delete')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        $role = Role::findById($id, 'admin');
        if(!is_null($role)) {
            $role->delete();
            setMessage('danger', 'Role has been deleted.');
            return redirect()->back();
        } else {
            setMessage('danger', 'Something went wrong!');
            return redirect()->back();
        }
    }
}
