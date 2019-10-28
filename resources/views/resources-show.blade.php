@extends('layouts.puente')

@section('title', 'Recursos')
@section('title-providers', 'title-resources-crud')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>

<div class="col-md-10 offset-md-1 mt-5  section">

  <div class="btn btn-danger mb-5" id="new_link">Nuevo recurso</div>
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
        <h5 class="modal-title">Editar Recurso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

        
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="titleEdit">Título</label>
                <textarea class="form-control" id="titleEdit" name="title"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="descriptionEdit">Descripción</label>
                <textarea class="form-control" id="descriptionEdit" name="description">
                </textarea>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="linkEdit">Link</label>
              <input type="text" class="form-control" id="linkEdit" name="link">
              <br>
              <label for="linkEdit">o subir archivo</label>
              <input type="file" name="document">
            </div>
          </div>
        </div>         
          <input required type="hidden" id="id" name="id" value="">
        
        <div class="mb-3 dm-uploader mt-5" >
          <div class="form-row">
            <div class="col-md-9 col-sm-12 align-grid-r">
              <div class="from-group mb-2">
                <label>Cambia la imagen del recurso&nbsp;&nbsp;&nbsp;<small>(Formatos permitidos: jpeg, png, bmp, gif o svg)</small></label>
                <div class="errorLogo"></div>
                <input required type="text" class="form-control" aria-describedby="fileHelp" placeholder="Selecciona una imagen..." readonly="readonly" id="image-data" />

                <div class="progress mb-2 d-none">
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
                    role="progressbar"
                    style="width: 0%;" 
                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">
                    0%
                  </div>
                </div>

              </div>
              <div class="form-group">
                <div role="button" class="btn btn-primary mr-2">
                  Examinar archivos
                  <input type="file" id="file-input" name="image" />
                </div>
                <small class="status text-muted">Busca la imagen en tus archivos</small>
              </div>
            </div>
            <div class="col-md-3  d-md-block  d-sm-none align-grid">
              <img src="" alt="sin imagen" class="img-thumbnail w-100" id="imgSalida">
            </div>
          </div>
        </div>
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
    $('#myTable').removeAttr('width').DataTable();

    $(document).on('click', '#edit-link', function(event) {

      var public_path = window.location.host+'/images/links/'+$(this).data('data')['image'];
      $('#titleEdit').val($(this).data('data')['title']);
      $('#descriptionEdit').val($(this).data('data')['description']);
      $('#linkEdit').val($(this).data('data')['link']);
      $('#id').val($(this).data('id'));
      $('#imgSalida').removeAttr('src');
      $('#imgSalida').attr("src", 'http://'+public_path);
      $('#myModal').modal('show');
    });

    $(document).on('click', '#new_link', function(event) {
      $('#titleEdit').val("");
      $('#descriptionEdit').val("");
      $('#linkEdit').val("");
      $('#imgSalida').attr("src", 'http://'+window.location.host+'/images/not-found.png');
      $('#myModal').modal('show');
    });


} );
</script>
@endsection