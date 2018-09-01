@extends('layouts.app')
@section('providers', 'active')

@section('content')

    <div class="row" >
        <div class="col-md-12">
            <h2>Proveedores</h2>
            <table id="table_id" class="display">
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
                    <a  data-toggle="modal" data-target="#{{ $provider->id }}">
                      <i class="material-icons" style="color:yellow">info_outline</i>
                    </a>
                    <i class="material-icons" style="color:green">mode_edit</i>
                    <i class="material-icons" style="color:red">delete</i>
                  </td>
                </tr>
                <div class="modal fade" id="{{ $provider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $provider->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>{{ $provider->id }}</p>
                    <p>{{ $provider->rut }}-{{ $provider->dv_rut }}</p>
                    <p>{{ $provider->name }}</p>
                    <p>{{ $provider->address }}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>



@endsection
