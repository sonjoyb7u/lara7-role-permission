@extends('errors.layouts.errors-master')

@section('error-title', '404-Page Not Found | Lara Role-Permission')

@section('errors-content')
    <div class="error-content">
        <h2>404</h2>
        <p>Ooops! Page Not Found .</p>
        <a href="{{ route('admin.index') }}">Back to Dashboard</a>
        @if(!Auth::guard('admin')->user())
            <a href="{{ route('admin.login') }}">Again Login</a>
        @endif
    </div>
@endsection
