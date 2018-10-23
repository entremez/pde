@extends('layouts.puente')
@section('title', 'PDE | Dashboard')

@section('content')

@include('partials/menu')
<div class="after-menu"></div>

<div class="col-md-10 offset-md-1">
    <center>
        <h2 class="d-inline mr-4">Casos</h2>
        <a href="{{ route('cases.create') }}" class="btn btn-primary d-inline" style="vertical-align: super;"> Agregar caso</a>
    </center>
    <table id="table_id" class="display w-100">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Descripción</th>
          <th scope="col" style="width: 100px">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cases as $key=>$case)
        <tr>
          <th scope="row">{{ $key+1 }}</th>
          <td>{{ $case->name }}</td>
          <td>{{ $case->description }}</td>
          <td>
            <form method="post" action="{{ route('cases.destroy',$case->id ) }}">
              {{ csrf_field() }}
              {{method_field('DELETE')}}
            <a href="{{ route('cases.show', $case->id) }}" >
              <i class="fas fa-search-plus"></i>
            </a>
            <a href="{{ route('cases.edit', $case->id) }}" >
              <i class="fas fa-edit"></i>
            </a>
            <a href="{{ route('images.case', $case->id) }}" >
              <i class="far fa-images"></i>
            </a>
              <button type="sumbit" class="btn btn-link btn-sm">
                <i class="far fa-trash-alt"></i>
              </button>
            </form>
          </td>
        </tr>
    </div>
        @endforeach
      </tbody>
    </table>
</div>


@include('partials/footer')

@endsection
