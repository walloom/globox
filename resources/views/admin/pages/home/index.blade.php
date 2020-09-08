@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => 'Panel administrativo'])

@section('content')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Administrador</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Panel de control</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3">
          <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-building"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Empresas</span>
              <span class="info-box-number">
                10
                <small>%</small>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Usuarios</span>
              <span class="info-box-number">
                10
                <small>%</small>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-box-open"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Bodegas</span>
              <span class="info-box-number">
                10
                <small>%</small>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-truck-moving"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Inventarios</span>
              <span class="info-box-number">
                10
                <small>%</small>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Movimientos de inventarios</h3>
                <a href="javascript:void(0);">Ver reporte</a>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">820</span>
                  <span>Movimientos de mercancia</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success">
                    <i class="fas fa-arrow-up"></i> 12.5%
                  </span>
                  <span class="text-muted">Desde la última semana</span>
                </p>
              </div>
              <!-- /.d-flex -->

              <div class="position-relative mb-4">
                <canvas id="visitors-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> Esta semana
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> Semana pasada
                </span>
              </div>
            </div>
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Productos</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-striped table-valign-middle">
                <thead>
                <tr>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Entradas</th>
                  <th>Detalle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>
                    <img src="{{ asset('img/default-150x150.png') }}" alt="Product 1" class="img-circle img-size-32 mr-2">
                    Some Product
                  </td>
                  <td>$13 COP</td>
                  <td>
                    <small class="text-success mr-1">
                      <i class="fas fa-arrow-up"></i>
                      12%
                    </small>
                    12,000
                  </td>
                  <td>
                    <a href="#" class="text-muted">
                      <i class="fas fa-search"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <img src="{{ asset('img/default-150x150.png') }}" alt="Product 1" class="img-circle img-size-32 mr-2">
                    Another Product
                  </td>
                  <td>$29 COP</td>
                  <td>
                    <small class="text-warning mr-1">
                      <i class="fas fa-arrow-down"></i>
                      0.5%
                    </small>
                    123,234
                  </td>
                  <td>
                    <a href="#" class="text-muted">
                      <i class="fas fa-search"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <img src="{{ asset('img/default-150x150.png') }}" alt="Product 1" class="img-circle img-size-32 mr-2">
                    Amazing Product
                  </td>
                  <td>$1,230 COP</td>
                  <td>
                    <small class="text-danger mr-1">
                      <i class="fas fa-arrow-down"></i>
                      3%
                    </small>
                    198
                  </td>
                  <td>
                    <a href="#" class="text-muted">
                      <i class="fas fa-search"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <img src="{{ asset('img/default-150x150.png') }}" alt="Product 1" class="img-circle img-size-32 mr-2">
                    Perfect Item
                    <span class="badge bg-danger">NEW</span>
                  </td>
                  <td>$199 COP</td>
                  <td>
                    <small class="text-success mr-1">
                      <i class="fas fa-arrow-up"></i>
                      63%
                    </small>
                    87
                  </td>
                  <td>
                    <a href="#" class="text-muted">
                      <i class="fas fa-search"></i>
                    </a>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Movimientos</h3>
                <a href="javascript:void(0);">Ver reporte</a>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">$18,230.00</span>
                  <span>Uso de bodega por año</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success">
                    <i class="fas fa-arrow-up"></i> 33.1%
                  </span>
                  <span class="text-muted">Desde el mes pasado</span>
                </p>
              </div>
              <!-- /.d-flex -->

              <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> Este año
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> Año pasado
                </span>
              </div>
            </div>
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Control Global Bodega 1</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-sm btn-tool">
                  <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-sm btn-tool">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                <p class="text-success text-xl">
                  <i class="ion ion-ios-refresh-empty"></i>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    <i class="ion ion-android-arrow-up text-success"></i> 82%
                  </span>
                  <span class="text-muted">Ocupación total</span>
                </p>
              </div>
              <!-- /.d-flex -->
              <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                <p class="text-warning text-xl">
                  <i class="ion ion-ios-cart-outline"></i>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    <i class="ion ion-android-arrow-up text-warning"></i> 8%
                  </span>
                  <span class="text-muted">Espacio disponible</span>
                </p>
              </div>
              <!-- /.d-flex -->
              <div class="d-flex justify-content-between align-items-center mb-0">
                <p class="text-danger text-xl">
                  <i class="ion ion-ios-people-outline"></i>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    <i class="ion ion-android-arrow-down text-danger"></i> 10%
                  </span>
                  <span class="text-muted">Espacio reservado</span>
                </p>
              </div>
              <!-- /.d-flex -->
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>

@endsection

@push('js')
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('js/pages/dashboard3.js') }}"></script>
  <script>
    $(document).ready(function(evt){
      // $('#profileModal').modal();
    })
  </script>
  
@endpush
