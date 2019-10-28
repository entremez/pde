@extends('layouts.puente')

@section('title', 'Encuesta')
@section('title-providers', 'title-survey-crud')

@section('content')

@include('partials/menu')

<div class="after-menu"></div>

<div class="col-md-10 offset-md-1 mt-5  section">

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Sentencia</th>
                <th>Tipo</th>
                <th>Acciónes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statements as $statement)
            <tr>
                <td>{{ $statement->statement }}</td>
                <td>{{ $statement->statement_type->description }}</td>
                <td>
                    <a class="btn" id="edit-statement" data-id="{{ $statement->id }}" data-data="{{ $statement }}" data-type="{{ $statement->statement_type->type }}" data-options="{{ $statement->options }}"><i class="fas fa-pen"></i></a>
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
        <h5 class="modal-title">Editar sentencia</h5>
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
                <label for="statementEdit">Sentencia</label>
                <textarea class="form-control" id="statementEdit" name="statement"></textarea>
              </div>
            </div>
          </div>

          <div class="mb-3 dm-uploader mt-5" >
            <div class="form-row">
              <div class="col-md-9 col-sm-12 align-grid-r">
                <div class="from-group mb-2">
                  <label>Cambia la imagen de fondo de la pregunta&nbsp;&nbsp;&nbsp;<small>(Formatos permitidos: jpeg, png, bmp, gif o svg)</small></label>
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

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="typeEdit">Tipo</label>
                <input class="form-control" id="typeEdit" disabled> 
              </div>
            </div>
          </div>

        <div class="row mt-3">
          <div class="col">
            <div class="form-group">
              <label for="linkEdit">Opciones</label>
              <div id="options"></div>
            </div>
          </div>
        </div>         
          <input required type="hidden" id="id" name="id" value="">
        
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
    $('#myTable').removeAttr('width').DataTable({
      "order": []
    });

    $(document).on('click', '#edit-statement', function(event) {

      var public_path = window.location.host+'/images/'+$(this).data('data')['background'];
      $('#statementEdit').val($(this).data('data')['statement']);
      $('#typeEdit').val($(this).data('type'));
      $('#id').val($(this).data('id'));
      var out = `
          <div class="row">
            <div class="col">
              <div class="form-group">`;

      for (var i = 0; i < $(this).data('options').length; i++) {
          out += '<textarea name="option['+ $(this).data('options')[i]['id'] +']" class="form-control">'+$(this).data('options')[i]['option'] + '</textarea>';
      }
      out+=` </div>
            </div>
          </div>`;
      $('#options').html(out);
      $('#imgSalida').removeAttr('src');
      $('#imgSalida').attr("src", 'http://'+public_path);
      $('#myModal').modal('show');
    });

} );
</script>
@endsection