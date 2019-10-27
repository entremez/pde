@extends('layouts.puente')

@section('title', 'Recursos')
@section('title-providers', 'title-resources-crud')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>

<div class="col-md-10 offset-md-1 mt-5  section">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Link</th>
                <th>Imagen</th>
                <th>Acciónes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($links as $link)
            <tr>
                <td>{{ $link->title }}</td>
                <td>{{ $link->description }}</td>
                <td>{{ $link->link }}</td>
                <td>{{ $link->image }}</td>
                <td>
                    <a class="btn" id="edit-link" data-id="{{ $link->id }}" data-data="{{ $link }}"><i class="fas fa-pen"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="modal fade" role="dialog" id="myModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        @csrf
        <div class="modal-body">

        
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nameEdit">Nombre</label>
                <input type="text" class="form-control" id="nameEdit" name="name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="descriptionEdit">Descripción</label>
                <textarea class="form-control" id="descriptionEdit" name="description">
                </textarea>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="categoryEdit">Categoría</label>
                <input type="text" class="form-control" id="categoryEdit" name="category" disabled="disabled">
              </div>
            </div>
          </div>            
          <input type="hidden" id="linkId" name="linkId" value="">

        


        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit"  class="btn btn-primary">Guardar cambios</button>
      </div>
    </form>
    </div>
  </div>
</div>


@include('partials/footer')

@endsection

@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable(
            {
                "columns": [
                    { "width": "20%"},
                    { "width": "20%"},
                    { "width": "20%"},
                    { "width": "20%"},
                    { "width": "20%"},
               ]
            }
        );
} );
</script>
@endsection