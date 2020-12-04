@extends('errors.layouts.errors-master')

@section('error-title', '500-Server Error | Lara Role-Permission')

@section('errors-content')
    <div class="error-content">
        <h2>500</h2>
        <p>Internal Server Error!</p>
        <a href="{{ route('admin.index') }}">Back to Dashboard</a>
        @if(!Auth::guard('admin')->user())
            <a href="{{ route('admin.login') }}">Again Login</a>
        @endif
    </div>
@endsection
