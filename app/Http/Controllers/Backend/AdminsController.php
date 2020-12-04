<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
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
        if(is_null($this->admin) || !$this->admin->can('admin.show')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        $admins = Admin::all();
        return view('admin.pages.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->admin) || !$this->admin->can('admin.create')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        $roles = Role::all();
        return view('admin.pages.admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->admin) || !$this->admin->can('admin.create')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        // Validation...
        $this->validate($request, [
            'name' => 'required|max:80',
            'email' => 'required|max:150|email|unique:admins',
            'username' => 'required|max:100|string|unique:admins',
            'password' => 'required|max:6|confirmed',

        ], $message = [
            'name.required' => 'The Admin name field is required!',
            'name.max' => 'The Admin name must be less than 80 characters!',
            'email.required' => 'The Admin email field is required!',
            'email.max' => 'The Admin email must be less than 150 characters!',
            'email.unique' => 'The Admin email has already been taken!',
            'username.required' => 'The Admin username field is required!',
            'username.max' => 'The Admin username must be less than 100 characters!',
            'username.unique' => 'The Admin username has already been taken!',
            'password.required' => 'The Password field is required!',
            'password.max' => 'The Password must be at least 6 characters!',
            'password.confirmed' => 'The Password and confirm password does\'t matched!',
        ]);

        // Create new Admin...
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = strtolower($request->email);
        $admin->username = strtolower($request->username);
        $admin->password = Hash::make($request->password);
        if($request->role) {
            // As an array
            $admin->assignRole($request->role);
        }
        if($admin->save()) {
            $msg = ucwords($admin->name) . 'admin has been created success.';
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
        if(is_null($this->admin) || !$this->admin->can('admin.edit')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        $admin = Admin::findOrFail($id);
        $roles = Role::all();
        return view('admin.pages.admin.edit', compact('admin', 'roles'));
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
        if(is_null($this->admin) || !$this->admin->can('admin.edit')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        $admin = Admin::findOrFail($id);
        // Validation...
        $this->validate($request, [
            'name' => 'required|max:80',
            'email' => 'nullable|max:150|email|unique:admins,email,'.$id,
            'username' => 'nullable|max:100|string|unique:admins,username,'.$id,
            'password' => 'nullable|max:6|confirmed',

        ], $message = [
            'name.required' => 'The Admin name field is required!',
            'name.max' => 'The Admin name must be less than 80 characters!',
            'email.required' => 'The Admin email field is required!',
            'email.max' => 'The Admin email must be less than 150 characters!',
            'email.unique' => 'The Admin email has already been taken!',
            'username.required' => 'The Admin username field is required!',
            'username.max' => 'The Admin username must be less than 100 characters!',
            'username.unique' => 'The Admin username has already been taken!',
            'password.max' => 'The Password must be at least 6 characters!',
            'password.confirmed' => 'The Password and confirm password does\'t matched!',
        ]);

        $admin->name = $request->name;
        $admin->email = strtolower($request->email);
        $admin->username = Str::slug(strtolower($request->username));
        if($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->roles()->detach();
        if($request->role) {
            // As an array...
            $admin->assignRole($request->role);
        }
        if($admin->save()) {
            $msg = ucwords($admin->name) . ' has been updated success.';
            setMessage('success',  $msg);
            return redirect()->route('admin.admins.index');
        } else {
            setMessage('success', 'Something went wrong!');
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
        if(is_null($this->admin) || !$this->admin->can('admin.delete')) {
            abort(403, 'Sorry, You are unauthorized to access this action !!');
        }
        $admin = Admin::findOrFail($id);
        if(!is_null($admin)) {
            $admin->delete();
            setMessage('danger', 'admin has been deleted.');
            return redirect()->back();
        } else {
            setMessage('danger', 'Something went wrong!');
            return redirect()->back();
        }
    }
}
