 <!DOCTYPE html>
<!-- saved from url=(0053)https://getbootstrap.com/docs/4.1/examples/dashboard/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Selesta Admin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/additional.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>




    </style>

  <style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>

  <body>

    <noscript>
      <h1 style="padding:25px; border: 1px solid red;">
          Ця сторінка потребує увімкнений Javascript.
        <br/>
        <br/>
        <br/>
        <br/>
         Увімкніть Javascript щоб переглянути сторінку !
      </h1>
    </noscript>

    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
          <img src="{{ asset('pictures/logo.png') }}" alt="logo" id="logo">
          <h3>Адмінська панель</h3>

      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">

          <a class="nav-link" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Вийти') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>

        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a  @if (($selected ?? '') == 1) class="nav-link active" @else  class="nav-link" @endif href="{{ url('admin/') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                  Головна <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a @if (($selected ?? '') == 2) class="nav-link active" @else  class="nav-link" @endif href="{{ url('admin/products') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                  Продукція
                </a>
              </li>
              <li class="nav-item">
                <a @if (($selected ?? '') == 3) class="nav-link active" @else  class="nav-link" @endif href="{{ url('admin/sliders') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                  Слайди
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"   onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  <svg style="margin-right:4px;" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13.34 8.17C12.41 8.17 11.65 7.4 11.65 6.47C11.65 6.02178 11.8281 5.59193 12.145 5.27499C12.4619 4.95805 12.8918 4.78 13.34 4.78C14.28 4.78 15.04 5.54 15.04 6.47C15.04 7.4 14.28 8.17 13.34 8.17V8.17ZM10.3 19.93L4.37 18.75L4.71 17.05L8.86 17.9L10.21 11.04L8.69 11.64V14.5H7V10.54L11.4 8.67L12.07 8.59C12.67 8.59 13.17 8.93 13.5 9.44L14.36 10.79C15.04 12 16.39 12.82 18 12.82V14.5C16.14 14.5 14.44 13.67 13.34 12.4L12.84 14.94L14.61 16.63V23H12.92V17.9L11.14 16.21L10.3 19.93V19.93ZM21 23H19V3H6V16.11L4 15.69V1H21V23ZM6 23H4V19.78L6 20.2V23Z" fill="#999999"/>
                  </svg>
                  Вихід
                </a>
              </li>

            </ul>

            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>


          <main class="py-4">
              @yield('content')
              @stack('changeStatus')
          </main>

        </main>
      </div>
    </div>





    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


</body>

</html>
