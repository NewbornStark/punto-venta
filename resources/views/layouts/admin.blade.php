<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.15
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Punto de venta</title>
    <!-- Icons-->
    <link rel="icon" type="image/ico" href="./img/favicon.ico" sizes="any" />
    <link href="{{ asset('css/coreui/coreui-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/coreui/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/coreui/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/coreui/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{ asset('css/coreui/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/coreui/pace.min.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('partials.admin.header')
    <div class="app-body">
      <div class="sidebar">
        @include('partials.admin.navbar')
      </div>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          @forelse ($breadcrumbs as $item)
            @if (!$loop->last)
              <li class="breadcrumb-item">
                <a href="{{ $item['link'] }}">{{ $item['text'] }}</a>
              </li>
              @else
                <li class="breadcrumb-item active">{{ $item['text'] }}</li>
              @endif
          @empty
            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}"></a></li>  
          @endforelse
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            @yield('content')
          </div>
        </div>
      </main>
    </div>
    <footer class="app-footer">
      <div>
        <span>Newborn Studios &TRADE;</span>
      </div>
      <div class="ml-auto">
        <span>Powered by</span>
        <a href="https://coreui.io">CoreUI</a>
      </div>
    </footer>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/coreui/pace.min.js') }}"></script>
    <script src="{{ asset('js/coreui/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/coreui/coreui.min.js') }}"></script>
    @yield('pageScripts')
  </body>
</html>
