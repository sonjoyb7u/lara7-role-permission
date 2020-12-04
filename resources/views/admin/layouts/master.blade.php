<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Lara Role-Permission Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @includeIf('admin.layouts.partials.style')
    @stack('css')
</head>

<body>
<!--[if lt IE 8]> -->
{{--<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>--}}
<!-- [endif]-->
<!-- preloader area start -->
<div id="preloader">
    <div class="loader"></div>
</div>
<!-- preloader area end -->
<!-- page container area start -->
<div class="page-container">
    <!-- sidebar menu area start -->
    @includeIf('admin.layouts.partials.sidebar')
    <!-- sidebar menu area end -->
    <!-- main content area start -->
    <div class="main-content">
        <!-- header area start -->
        @includeIf('admin.layouts.partials.header')
        <!-- header area end -->

        <!-- main-content with breadcrumb area start -->
        <!-- page title area start -->
        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    @yield('breadcrumb-content')
                </div>
                <div class="col-sm-6 clearfix">
                    @includeIf('admin.layouts.partials.logout')
                </div>
            </div>
            @includeIf('messages.get-message')
        </div>
        <!-- page title area end -->
        @yield('content')
        <!-- main-content with breadcrumb area end -->
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    @includeIf('admin.layouts.partials.footer')
    <!-- footer area end-->
</div>
<!-- page container area end -->


    @includeIf('admin.layouts.partials.scripts')
    @stack('js')
</body>
</html>
