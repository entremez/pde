<div class="col-md-3 provider-data">
                <div class="image-container">
                    <img src="{{ $personalData->imagen_logo }}" class="w-100"  alt="provider logo">
                </div>

                <div class="provider-name"></div>
                    <p>Servicios de diseño:</p>
                        @foreach($services as $service)
                        <a href="{{ route('providers-list-filtered', $service->service_id)}}" class="badge badge-success">
                            {{ $service->service()->get()->first()->name }}
                        </a>
                        @endforeach

                <hr>
                <p>{{ $personalData->contact_email }}</p>
                <hr>
                <p>{{ $personalData->phone }}</p>
                <hr>
                <p>{{ Rut::parse($personalData->rut."-".$personalData->dv_rut)->format()}}</p>
                <hr>
                <p>{{ $personalData->address() }}</p>
                <hr>
                <p>{{ $personalData->web }}</p>
                <hr>
                <p>{{ str_limit($personalData->long_description, 100, ' (...)')}}</p>
                <hr>
                <p>Caracterización de profesionales de diseño</p>
                    <ul>
                    <li>Técnicos: {{ $personalData->team->tecnics }} </li>
                    <li>Profesionales: {{ $personalData->team->professionals }} </li>
                    <li>Masters: {{ $personalData->team->masters }} </li>
                    <li>Doctores: {{ $personalData->team->doctors }} </li>
                    </ul>
                <br>
                <div class="mb-4" style="display: {{ $personalData->isBuffered() ? '':'none' }}">
                    <small>*Los últimos cambios realizados están a la espera de aprobación por parte del equipo del proyecto</small>
                </div>
                <div>
                    <a class="btn btn-danger" href="{{route('provider.settings')}}">Editar</a>
                    <a class="btn btn-danger" href="{{route('provider', $data->id)}}" target="_blank">Ver perfil</a>
                </div>
        </div>