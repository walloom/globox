@extends('layouts.app', ['activePage' => 'bodegas', 'titlePage' => 'Panel administrativo'])

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Mis bodegas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Bodegas</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 p-0">
          <a href="{{ route('nuevaBodega') }}" class="btn btn-app">
            <i class="fas fa-plus"></i> Crear Bodega
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          @include('pages.partials.messages')
        </div>
      </div>
      <div class="row">
        @foreach ($bodegas as $bodega)
          <?php
            $className = "success";
            
            if ($bodega->occupation >= 50 && $bodega->occupation < 90){
              $className = "warning";
            }else if ( $bodega->occupation >= 90 ){
              $className = "danger";
            }

            $classText = "text-" . $className;
            $classBg = "bg-" . $className;
          ?>        
          <div class="col-sm-4">
            <div class="card">
              <div class="card-header border-0 p-0">
                <a href="{{ asset('storage/companies') }}/{{ $bodega->company_id }}/bodegas/{{ $bodega->photo }}" data-fancybox="gallery">
                  <img src="{{ asset('storage/companies') }}/{{ $bodega->company_id }}/bodegas/{{ $bodega->photo }}" class="img-fluid" alt="">
                </a>
                <div class="progress progress-xs">
                  <div class="progress-bar progress-bar-danger {{ $classBg }} progress-bar-striped" role="progressbar"
                       aria-valuenow="{{ $bodega->occupation }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $bodega->occupation }}%">
                    <span class="sr-only">60% Complete (warning)</span>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">{{ $bodega->name }}</span>
                    <span>{{ $bodega->notes }}</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="{{ $classText }}">
                      <i class="fas fa-arrow-up"></i> {{ $bodega->occupation }}%
                    </span>
                    <span class="{{ $classText }}">Ocupación</span>
                  </p>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <a href="{{ route('detalleBodega', $bodega->id ) }}">
                    Ver Detalle >
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

@endsection

@push('js')
  <link rel="stylesheet" href="{{ asset('plugins/fancybox/jquery.fancybox.min.css') }}" />
  <script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>
@endpush
