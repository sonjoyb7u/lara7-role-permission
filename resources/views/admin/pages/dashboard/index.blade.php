@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('breadcrumb-content')
    <div class="breadcrumbs-area clearfix">
        <h4 class="page-title pull-left">Dashboard</h4>
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ route('admin.index') }}">Home</a></li>
            <li><span>Admin Dashboard</span></li>
        </ul>
    </div>
@endsection

@section('content')
    <!-- main-content with breadcrumb area start -->
    <div class="main-content-inner">
        <div class="row">

            <!-- seo fact area start -->
            <div class="col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-md-4 mt-5 mb-3">
                        <div class="card">
                            <a href="{{ route('admin.admins.index') }}">
                                <div class="seo-fact sbg1">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-user"></i> Admin</div>
                                        <h2>{{ $total_admins }}</h2>
                                    </div>
                                    <canvas id="seolinechart1" height="50"></canvas>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 mt-md-5 mb-3">
                        <div class="card">
                            <a href="{{ route('admin.roles.index') }}">
                            <div class="seo-fact sbg2">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="ti-rocket"></i> Role</div>
                                    <h2>{{ $total_roles }}</h2>
                                </div>
                                <canvas id="seolinechart2" height="50"></canvas>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 mt-md-5 mb-3">
                        <div class="card">
                            <a href="{{ route('admin.roles.index') }}">
                            <div class="seo-fact sbg2">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="ti-paint-roller"></i> Permission</div>
                                    <h2>{{ $total_permissions }}</h2>
                                </div>
                                <canvas id="seolinechart2" height="50"></canvas>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- seo fact area end -->

        </div>
    </div>
    <!-- main-content with breadcrumb area end -->
@endsection
