<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's Admin Auth login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ], $message = [
//            'email.required' => 'Email field is required!',
//            'password' => 'Password field is required!',
        ]);

        if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password, 'status'=>'active'], $request->remember)) {
            setMessage('success', 'You are successfully loggedin...');
            return redirect()->intended(route('admin.index'));
        } elseif(Auth::guard('admin')->attempt(['username'=>$request->email, 'password'=>$request->password, 'status'=>'active'], $request->remember)) {
            setMessage('success', 'You are successfully loggedin...');
            return redirect()->intended(route('admin.index'));
        } elseif (Auth::guard('admin')->attempt(['phone'=>$request->email, 'password'=>$request->password, 'status'=>'active'], $request->remember)) {
            setMessage('success', 'You are successfully loggedin...');
            return redirect()->intended(route('admin.index'));
        } else {
            setMessage('danger', 'Invailed Credantials, please check...');
            return redirect()->route('admin.login');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        setMessage('success', 'You are succefully loggedout.');
        return redirect()->route('admin.login');
    }
}
