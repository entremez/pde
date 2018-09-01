@extends('layouts.app')
@section('request', 'active')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
</ol>
<h2>Proveedores</h2>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills nav-pills-icons" role="tablist">
            <!--
            color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
        -->
            <li class="nav-item">
                <a class="nav-link active show" href="#dashboard-1" role="tab" data-toggle="tab" aria-selected="false">
                    <i class="material-icons">warning</i> Solicitudes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#schedule-1" role="tab" data-toggle="tab" aria-selected="false">
                    <i class="material-icons">done</i> Activos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#schedule-2" role="tab" data-toggle="tab" aria-selected="false">
                    <i class="material-icons">schedule</i> Creados
                </a>
            </li>
        </ul>
        <div class="tab-content tab-space">
            <div class="tab-pane active show" id="dashboard-1">
                <div class="row" >
                  <div class="col-md-12">
                      <table id="table_id" class="display">
                        <thead class="thead-dark">
                          <tr>
                            <th  scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">N° Casos</th>
                            <th scope="col">WEB</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($providers->where('status','=','1') as $provider)
                          <tr>
                            <th scope="row">{{ $provider->id }}</th>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->instances()->count() }}</td>
                            <td>{{ $provider->web }}</td>
                            <td>
                              <i class="material-icons">{{ $provider->approved ? 'visibility' : 'visibility_off'}}</i>
                              <i class="material-icons" style="color:green">mode_edit</i>
                              <i class="material-icons" style="color:red">delete</i>
                            </td>
                          </tr>
                      </div>
                          @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
            <div class="tab-pane" id="schedule-1">
                <div class="row" >
                  <div class="col-md-12">
                      <table id="table_id_2" class="display">
                        <thead class="thead-dark">
                          <tr>
                            <th  scope="col">#</th>
                            <th scope="col">Rut</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">WEB</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($providers->where('approved','=',true) as $provider)
                          <tr>
                            <th scope="row">{{ $provider->id }}</th>
                            <td>{{ $provider->rut }}-{{ $provider->dv_rut }}</td>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->address }}</td>
                            <td>{{ $provider->phone }}</td>
                            <td>{{ $provider->web }}</td>
                            <td>{{ $provider->description }}</td>
                            <td>
                              <i class="material-icons">{{ $provider->approved ? 'visibility' : 'visibility_off'}}</i>
                              <i class="material-icons" style="color:green">mode_edit</i>
                              <i class="material-icons" style="color:red">delete</i>
                            </td>
                          </tr>
                      </div>
                          @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
            <div class="tab-pane" id="schedule-2">
                <div class="row" >
                  <div class="col-md-12">
                      <table id="table_id_3" class="display">
                        <thead class="thead-dark">
                          <tr>
                            <th  scope="col">#</th>
                            <th scope="col">Rut</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">WEB</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($providers as $provider)
                          <tr>
                            <th scope="row">{{ $provider->id }}</th>
                            <td>{{ $provider->rut }}-{{ $provider->dv_rut }}</td>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->address }}</td>
                            <td>{{ $provider->phone }}</td>
                            <td>{{ $provider->web }}</td>
                            <td>{{ $provider->description }}</td>
                            <td>
                              <i class="material-icons">{{ $provider->approved ? 'visibility' : 'visibility_off'}}</i>
                              <i class="material-icons" style="color:green">mode_edit</i>
                              <i class="material-icons" style="color:red">delete</i>
                            </td>
                          </tr>
                      </div>
                          @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
