<div class="row">
  <div class="col-md-12 mainCustomMessages">
    @if (Session::has('message'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
        <span>
          {!! Session::get('message') !!}
        </span>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
        <span>
          <b>Por favor válida </b> la siguiente información:</span>
          <br>
          <ul class="itemsErrors">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>

    @endif
  </div>
</div>


