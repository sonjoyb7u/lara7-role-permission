@extends('errors.layouts.errors-master')

@section('error-title', '403-Access Denied | Lara Role-Permission')

@section('errors-content')
    <div class="error-content">
        <h2>403</h2>
        <p>Access to this resource on the server is denied</p>
        <hr>
        <p class="mt-2 font-weight-bolder font-italic">{{ $exception->getMessage() }}</p>
        <a href="{{ route('admin.index') }}">Back to Dashboard</a>
        @if(!Auth::guard('admin')->user() || Auth::guard())
            <a href="{{ route('admin.login') }}">Again Login</a>
        @endif
    </div>
@endsection
