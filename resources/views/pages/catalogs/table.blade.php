<?php 
    use App\Helpers\Files;
?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-12">
                <h4 class="my-3">
                    <i class="fas fa-globe"></i> {{ $customer->name }}
                </h4>
            </div>
        </div>
        <div class="row invoice-info mb-5">
            <div class="col-sm-5 invoice-col">
                <div class="text-left float-left mr-4">
                    @if($customer->picture)
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset( Files::route('users',$customer->picture) ) }}" />
                    @else
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/default.jpg') }}" />
                    @endif
                </div>
                <b>Tipo de identificación:</b> {{ $customer->documentType->code }} - {{ $customer->documentType->description }} <br>
                <b>Identificación:</b> {{ $customer->identification }}<br>
                <b>Celular:</b> {{ $customer->cell_number }}<br>
                <b>Teléfono:</b> {{ $customer->phone_number }}<br>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>Ciudad:</b> {{ $customer->city->name }}<br>
                <b>Departamento:</b> {{ $customer->state->name }}<br>
                <b>País:</b> {{ $customer->country->name }}<br>
                <b>Zona:</b> {{ $customer->zone }}<br>
            </div>
           
        </div>
        <div class="row">
            <div class="col-6 col-lg-8 d-flex">
                <h3 class="mb-0 align-self-center d-inline card-title">Artículos</h3>
            </div>
            <div class="col-6 col-lg-4">
                <form method="get" action="{{ url('empresa/customers/'.$customer_id.'/catalogs') }}" autocomplete="off">
                    <div class="form-group row mb-0">
                        <input class="form-control rounded-pill" name="search" type="search" value="{{ $search??'' }}" placeholder="Buscar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>EAN</th>
                    <th>Talla</th>
                    <th>Peso</th>
                    <th>Volumen</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($catalogs as $catalog)
                <tr>
                    <td>{{ $catalog->name }}</td>
                    <td>{{ $catalog->ean }}</td>
                    <td>{{ $catalog->size->description??'' }} 
                        @if(isset($catalog->size->id)) 
                        <span class="text-muted">({{ $catalog->size->code??'' }})</span>
                        @endif
                    </td>
                    <td>{{ $catalog->weight }}</td>
                    <td>{{ $catalog->volume }}</td>

                    <td></td>
                    <td class="project-actions text-center">
                        <a class="px-2" href="{{ url('empresa/customers/'.$customer_id.'/catalogs/'.$catalog->id.'/edit') }}">
                            <i class="fas fa-pencil-alt text-dark text-lg"></i>
                        </a>
                        <a class="px-2" href="#" data-click="delete" data-customer="{{ $customer_id }}" data-id="{{ $catalog->id }}">
                            <i class="fas fa-trash text-muted text-lg"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $catalogs->links() }}
    </div>
</div>