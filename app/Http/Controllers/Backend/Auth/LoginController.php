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


    public function showLoginForm(Request $request)
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
        } elseif (Auth::guard('admin')->attempt(['phonenumber'=>$request->email, 'password'=>$request->password, 'status'=>'active'], $request->remember)) {
            setMessage('success', 'You are successfully loggedin...');
            return redirect()->intended(route('admin.index'));
        } else {
            setMessage('danger', 'Invailed Credantials, please check...');
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        setMessage('success', 'You are succefully loggedout.');
        return redirect()->route('admin.login');
    }
}
