<div class="wrapper" id="app">
  @include('layouts.navbars.top-sidebar')
  @include('layouts.navbars.sidebar')

  <div class="content-wrapper">
    @yield('content')
  </div>

  @include('layouts.footers.auth')

</div>
