<!DOCTYPE html>
<html lang="en">
  @include('plugins.header')
  <body>
    @include('plugins.nav')
    <div class="container">
        <h1>@yield('title')</h1>
        @include('plugins.status')
        @section('content')
        @yield_section
        @include('plugins.footer')
    </div> <!-- /container -->
    

    {{ Asset::scripts() }}
  </body>
</html>