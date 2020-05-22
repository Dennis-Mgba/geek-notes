<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ URL::to('css/main.css') }}"/>
        <title>@yield('title')</title> {{--each page can insert their  individual page title--}}
    </head>
    <body>
        <div class="nav">
          <input type="checkbox" id="nav-check">
          <div class="nav-header">
            <div class="nav-title">
              Geek-Notes
            </div>
          </div>
          <div class="nav-btn">
            <label for="nav-check">
              <span></span>
              <span></span>
              <span></span>
            </label>
          </div>

          <div class="nav-links">
            <a href="#">Github</a>
            <a href="#">Twitter</a>
            <a href="#">LinkedIn</a>
          </div>
        </div>
        <div class="main">
            @yield('content')    {{--As a template layout the @yeild('content') specifyes where the individual file contents goes--}}
        </div>

        <script src="{{ URL::asset('js/main.js') }}"></script>
    </body>
</html>
