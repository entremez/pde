@extends('imaxd.layouts.puente')
@section('title', 'IMAxD')
@section('title-imaxd-home', 'active-menu')
@section('content')

@include('imaxd.partials.menu')

<div class="dashboard evaluation">
    <h3>Auto-evaluación IMAxD</h3>
    <div class="stages">
        <div class="stages__wrapper">
            <ul class="stages__content">
                <li>
                    <div class="title @if($evaluation->status == 0) warning @endif">
                        <span>Datos empresa</span>
                        <span class="dashed"></span>
                    </div>
                    <div class="description">Ingresar información de la empresa</div>
                </li>
                <li>
                    <div class="title">
                        <span>Antecedentes de Diseño</span>
                        <span class="dashed"></span>
                    </div>
                    <div class="description">Ingresar información relacionada con su vínculo con el Diseño</div>
                </li>
                <li>
                    <div class="title">
                        <span>Resultado</span>
                        <span class="dashed"></span>
                    </div>
                    <div class="description">Enviar para recibir el resultado</div>
                </li>         
            </ul>
        </div>
    </div>

    <form method="POST" action="{{ route('imaxd-evaluation') }}" id="company">
        @if($company != null)
            <input type="hidden" id="company" value="{{ json_encode($company) }}">
        @endif
        <input type="hidden" id="evaluation" value="{{ json_encode($evaluation) }}">
        {{ csrf_field() }}
        <p class="section_title">Datos empresa</p>
        <div class="form_group">
            <label for="type">¿Cuenta con inicio de actividades en un giro empresarial de primera categoría del impuesto a la renta?</label>
            <p class="errors" v-if="hasErrors['company']">@{{ hasErrors['company'] }}</p>
            <label class="container">Si
                <input type="radio" name="is_company" value="1" v-model="company"  ref="focus_1">
                <span class="checkmark_radio"></span>
            </label>
            <label class="container">No
                <input type="radio" name="is_company" value="0"  v-model="company">
                <span class="checkmark_radio"></span>
            </label>
        </div>
        <div class="form_group">
            <label for="type">¿ Cuenta con resolución sanitaria de los alimnetos vigente?</label>
            <p class="errors" v-if="hasErrors['res_sanitaria']">@{{ hasErrors['res_sanitaria'] }}</p>
            <label class="container">Si
                <input type="radio" name="food_res" value="1"  v-model = "res_sanitaria"  ref="focus_2">
                <span class="checkmark_radio"></span>
            </label>
            <label class="container">No
                <input type="radio" name="food_res" value="0" v-model = "res_sanitaria">
                <span class="checkmark_radio"></span>
            </label>
        </div>
        <div class="checkbox_group">
            <label class="title_checkboxs">Seleccione las actividades económicas a las que se dedica</label>
            <p class="errors" v-if="hasErrors['checked_actv']">@{{ hasErrors['checked_actv'] }}</p>
            @foreach($activities as $activity)
                <label class="checkbox">{{ $activity->name }}
                    <input type="checkbox" name="activity[]" value="{{ $activity->id }}" v-model="checked_actv"  ref="focus_3" id="activity-{{ $activity->id }}">
                    <span class="checkmark"></span>
                </label>
            @endforeach
        </div>
        <div class="checkbox_group">
            <label class="title_checkboxs">Seleccione las regiones donde cuente con domicilio tributario o sucursales</label>
            <p class="errors" v-if="hasErrors['checked_region']">@{{ hasErrors['checked_region'] }}</p>
            @foreach($cities as $city)
                <label class="checkbox">{{$city->region}}
                    <input type="checkbox" name="region[]" value="{{$city->id}}" v-model="checked_region"  ref="focus_4" id="region-{{ $city->id }}">
                    <span class="checkmark"></span>
                </label>
            @endforeach
        </div>
        <input type="hidden" name="just_save" :value="justSave" v-bind="justSave">
        <div class="evaluate">
            <button @click="save">Guardar</button>
            <button @click="submit">Continuar</button>
        </div>
    </form>
</div>




@include('imaxd.partials.footer')


@endsection
