@extends('imaxd.layouts.puente')
@section('title', 'IMAxD')
@section('title-imaxd-home', 'active-menu')
@section('content')

@include('imaxd.partials.menu')

<div class="config">
    <h3>Completar registro IMAxD</h3>
    <form method="POST" action="{{ route('imaxd-config') }}" @submit="checkForm" id="config_form">
        {{ csrf_field() }}
        <div class="form_group">
            <label for="full_name">Nombre Completo</label>
            <p class="errors" v-if="hasErrors['full_name']">@{{ hasErrors['full_name'] }}</p>
            <input type="text" name="full_name" v-model="full_name">
        </div>
        <div class="form_group">
            <label for="rut">Rut (ej. 12.345.678-9)</label>
            <p class="errors" v-if="hasErrors['rut']">@{{ hasErrors['rut'] }}</p>
            <input type="text" name="rut" v-model="rut">
        </div>
        <div class="form_group">
            <label for="type">Tipo de persona</label>
            <p class="errors" v-if="hasErrors['type']">@{{ hasErrors['type'] }}</p>
            <label class="container">Persona natural
                <input type="radio" name="radio" value="1" v-model="type">
                <span class="checkmark_radio"></span>
            </label>
            <label class="container">Persona jurídica
                <input type="radio" name="radio" value="2" v-model="type">
                <span class="checkmark_radio"></span>
            </label>
        </div>
        <div class="form_group">
            <label for="company_name">Razón social empresa</label>
            <p class="errors" v-if="hasErrors['company_name']">@{{ hasErrors['company_name'] }}</p>
            <input type="text" name="company_name" v-model="company_name">
        </div>
        <div class="form_group">
            <label for="company_rut">Rut empresa (ej. 12.345.678-9)</label>
            <p class="errors" v-if="hasErrors['company_rut']">@{{ hasErrors['company_rut'] }}</p>
            <input type="text" name="company_rut" v-model="company_rut" >
        </div>
        <div class="form_group">
            <label for="ocupation">Cargo en la empresa</label>
            <p class="errors" v-if="hasErrors['ocupation']">@{{ hasErrors['ocupation'] }}</p>
            <input type="text" name="ocupation" v-model="ocupation">
        </div>
        <div class="form_group">
            <label for="address">Dirección</label>
            <p class="errors" v-if="hasErrors['address']">@{{ hasErrors['address'] }}</p>
            <input type="text" name="address" v-model="address" >
        </div>
        <div class="form_group select_group">
            <label for="region">Región</label>
            <p class="errors" v-if="hasErrors['region']">@{{ hasErrors['region'] }}</p>
            <select name="region" v-model="region" @change="getComunas">
                <option selected>Seleccionar...</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" >{{ $city->region }}</option>
                @endforeach
            </select>
        </div>
        <div class="form_group">
            <label for="communa">Comuna</label>
            <p class="errors" v-if="hasErrors['comuna_id']">@{{ hasErrors['comuna_id'] }}</p>
            <select name="comuna" v-model="comuna_id">
                <option v-if="region_selected" value="">Seleccionar...</option>
                <option v-else value="0">Seleccionar región...</option>
                <option v-for="comuna in comunas" :value="comuna.id" name="comuna">@{{ comuna.commune }}</option>
            </select>
        </div>
        <div class="form_group">
            <label for="city">Ciudad</label>
            <p class="errors" v-if="hasErrors['city']">@{{ hasErrors['city'] }}</p>
            <input type="text" name="city" v-model="city" >
        </div>
        <div class="form_group">
            <label for="phone">Teléfono fijo</label>
            <input type="text" name="phone" v-model="phone" >
        </div>
        <div class="form_group">
            <label for="mobile_phone">Teléfono celular</label>
            <p class="errors" v-if="hasErrors['mobile_phone']">@{{ hasErrors['mobile_phone'] }}</p>
            <input type="text" name="mobile_phone" v-model="mobile_phone" >
        </div>
        <div class="form_group">
            <label for="web">Sitio web</label>
            <input type="text" name="web" v-model="web" >
        </div>
        <div class="form_group">
            <label for="notification_email">Correo electrónico para notificaciones</label>
            <p class="errors" v-if="hasErrors['notification_email']">@{{ hasErrors['notification_email'] }}</p>
            <input type="email" name="notification_email" v-model="notification_email" >
        </div>
        <div class="form_group">
            <label>Califique su tamaño según sus ventas</label>
            <p class="errors" v-if="hasErrors['company_size']">@{{ hasErrors['company_size'] }}</p>
            @foreach($company_sizes as $company_size)
                <label class="container">{{ $company_size->name }}
                    <input type="radio" name="company_size" v-model="company_size" value="{{ $company_size->id }}" >
                    <span class="checkmark_radio"></span>
                </label>
            @endforeach
        </div>
        <label class="checkbox">Acepto los <a href="!#">términos y condiciones</a>
            <input type="checkbox" v-model="terms">
            <span class="checkmark"></span>
        </label>
        <p class="errors" v-if="hasErrors['terms']">@{{ hasErrors['terms'] }}</p>
        <button>Enviar registro</button>
    </form>
</div>




@include('imaxd.partials.footer')


@endsection
