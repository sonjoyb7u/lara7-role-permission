<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.pages.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation...
        $this->validate($request, [
            'name' => 'required|max:80',
            'email' => 'required|max:150|email|unique:users',
            'password' => 'required|max:6|confirmed',

        ], $message = [
            'name.required' => 'The User name field is required!',
            'name.max' => 'The User name must be less than 80 characters!',
            'email.required' => 'The User email field is required!',
            'email.max' => 'The User email must be less than 150 characters!',
            'email.unique' => 'The User email has already been taken!',
            'password.required' => 'The Password field is required!',
            'password.max' => 'The Password must be at least 6 characters!',
            'password.confirmed' => 'The Password and confirm password does\'t matched!',
        ]);

        // Create new user...
        $user = new User();
        $user->name = $request->name;
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        if($request->role) {
            // As an array
            $user->assignRole($request->role);
        }
        if($user->save()) {
            $msg = ucwords($user->name) . ' has been created success.';
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
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.pages.user.edit', compact('user', 'roles'));
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
        $user = User::findOrFail($id);
        // Validation...
        $this->validate($request, [
            'name' => 'required|max:80',
            'email' => 'required|max:150|email|unique:users,email,'.$id,
            'password' => 'nullable|max:6|confirmed',

        ], $message = [
            'name.required' => 'The User name field is required!',
            'name.max' => 'The User name must be less than 80 characters!',
            'email.required' => 'The User email field is required!',
            'email.max' => 'The User email must be less than 150 characters!',
            'email.unique' => 'The User email has already been taken!',
            'password.max' => 'The Password must be at least 6 characters!',
            'password.confirmed' => 'The Password and confirm password does\'t matched!',
        ]);

        $user->name = $request->name;
        $user->email = strtolower($request->email);
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->roles()->detach();
        if($request->role) {
            // As an array
            $user->assignRole($request->role);
        }
        if($user->save()) {
            $msg = ucwords($user->name) . ' has been updated success.';
            setMessage('success',  $msg);
            return redirect()->route('admin.users.index');
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
        $user = User::findOrFail($id);
        if(!is_null($user)) {
            $user->delete();
            setMessage('danger', 'User has been deleted.');
            return redirect()->back();
        } else {
            setMessage('danger', 'Something went wrong!');
            return redirect()->back();
        }
    }
}
