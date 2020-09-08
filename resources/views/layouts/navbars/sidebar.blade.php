<?php

use App\Helpers\Permission;
?>

@if (Auth::user()->company)
<aside class="main-sidebar sidebar-dark-primary elevation-4" data-som="some">
    @else
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        @endif

        <a href="{{ route('home') }}" class="brand-link brand-globox">
            @if (Auth::user()->company)
            <img src="{{  asset('storage/companies/') }}/{{ Auth::user()->company->id }}/{{ Auth::user()->company->logo }}" alt="">
            @else
            GLOBOX
            @endif
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <span class="d-block">{{ Auth::user()->name }}</span>
                    <span class="small">{{ Auth::user()->role->name }}</span>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ $activePage == 'dashboard' ? ' active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>

                    @if (Auth::user()->hasRoles(['admin']))
                    <li class="nav-item">
                        <a href="{{ route('adminCompanies') }}" class="nav-link {{ $activePage == 'users' ? ' active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Empresas</p>
                        </a>
                    </li>
                    @endif

                    @if(Permission::action('empresa/customers'))
                    <li class="nav-item">
                        <a href="{{ url('empresa/customers') }}" class="nav-link {{ $activePage == 'customers' ? ' active' : '' }}">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Mis clientes</p>
                        </a>
                    </li>
                    @endif

                    @if(Permission::action('empresa/users'))
                    <li class="nav-item">
                        <a href="{{ url('empresa/users') }}" class="nav-link {{ $activePage == 'users' ? ' active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                    @endif

                    @if(Permission::action('empresa/bodegas'))
                    <li class="nav-item">
                        <a href="{{ route('bodegas') }}" class="nav-link {{ $activePage == 'bodegas' ? ' active' : '' }}">
                            <i class="nav-icon fas fa-box-open"></i>
                            <p>Mis bodegas</p>
                        </a>
                    </li>
                    @endif

                    <!--
                    <li class="nav-item has-treeview {{ $activePage == 'dashboard' ? ' active' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Informes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="./index.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Uso de bodega</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Entradas y salidas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="./index3.html" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mov. productos</p>
                                </a>
                            </li>
                        </ul>
                    </li>-->




                    <li class="nav-item has-treeview {{ $activePage == 'config' ? ' active menu-open' : '' }}">

                        @if(Permission::action(['empresa/units','empresa/sizes','empresa/reference-types','empresa/presentations','empresa/roles']))
                        <a href="#" class="nav-link">
                            <i class="fas fa-cogs nav-icon"></i>
                            <p>
                                Maestras
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @endif

                        <ul class="nav nav-treeview">

                            @if(Permission::action('empresa/units'))
                            <li class="nav-item">
                                <a href="{{ url('empresa/units') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Unidades</p>
                                </a>
                            </li>
                            @endif

                            @if(Permission::action('empresa/sizes'))
                            <li class="nav-item">
                                <a href="{{ url('empresa/sizes') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tallas</p>
                                </a>
                            </li>
                            @endif

                            @if(Permission::action('empresa/reference-types'))
                            <li class="nav-item">
                                <a href="{{ url('empresa/reference-types') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tipos de referencias</p>
                                </a>
                            </li>
                            @endif

                            @if(Permission::action('empresa/presentations'))
                            <li class="nav-item">
                                <a href="{{ url('empresa/presentations') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Presentaciones</p>
                                </a>
                            </li>
                            @endif

                            @if(Permission::action('empresa/roles'))
                            <li class="nav-item">
                                <a href="{{ url('empresa/roles') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            @endif

                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>
