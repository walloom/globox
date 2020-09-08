<footer class="main-footer">
  @if (Auth::user()->company)
    Copyright &copy; 2014-2020 {{ Auth::user()->company->name }}
  @else
    <strong>Copyright &copy; 2014-2020 <a href="http://globox.com"> GLOBOX </a></strong>
  @endif

  
  Todos los derechos reservados
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0.0
  </div>
</footer>