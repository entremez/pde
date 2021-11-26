@extends('imaxd.layouts.puente')
@section('title', 'IMAxD')
@section('title-imaxd-home', 'active-menu')
@section('content')

@include('imaxd.partials.menu')

<div class="dashboard evaluation-design">
    <h3>Auto-evaluación IMAxD</h3>
    <div class="stages">
        <div class="stages__wrapper">
            <ul class="stages__content">
                <li>
                    <div class="title ready">
                        <span>Datos empresa</span>
                        <span class="dashed"></span>
                    </div>
                    <div class="description">Ingresar información de la empresa</div>
                </li>
                <li>
                    <div class="title @if($evaluation->status == 2) warning @endif">
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
    
    <form method="POST" action="{{ route('imaxd-evaluation-design') }}" id="evaluation_design_form">
        {{ csrf_field() }}
        <p class="section_title">Antecedentes de Diseño en la Empresa</p>
        <p class="section_subtitle">En las siguientes preguntas relacionadas con DISEÑO. Marque la opción que corresponda a la realidad de su empresa.</p>
        
        @foreach($statements as $statement)
            @if($statement->statement_type_id == 1)

                <label class="type-{{ $statement->statement_type_id }}">{{ $statement->statement}}</label>
                @foreach($statement->options as $option)
                    <label class="checkbox">{{ $option->option }}
                        <input type="checkbox" name="design_types[]" value="{{ $option->id }}" id="{{ $option->id }}">
                        <span class="checkmark"></span>
                    </label>
                @endforeach      

            @elseif($statement->statement_type_id == 2)
                
                <div class="form_group">
                    <label for="type">{{ $statement->statement}}</label>
                    @foreach($statement->options as $option)    
                        <label class="container">{{ $option->option }}
                            <input type="radio" name="{{ $statement->id}}" value="{{ $option->id }}" id="{{ $option->id }}">
                            <span class="checkmark_radio"></span>
                        </label>
                    @endforeach
                </div> 

            @elseif($statement->statement_type_id == 3)
                <div class="form_group">
                    <label for="type">{{ $statement->statement}}</label>
                    @foreach($statement->options as $option)    
                        <label>{{ $option->option }}</label>
                        <div class="range">
                            <p>Para nada</p>
                            <div class="range_wrapper">
                                @foreach([1,2,3,4,5] as $suboption)
                                    <label class="container">{{$suboption}}
                                        <input type="radio" name="{{$option->id}}" value="{{$suboption}}" id="{{$option->id}}-{{$suboption}}">
                                        <span class="checkmark_radio"></span>
                                    </label>
                                @endforeach
                            </div>
                            <p>Absolutamente</p>
                        </div>
                    @endforeach
                </div>   
            @elseif($statement->statement_type_id == 4)
                <div class="form_group">
                    <label for="type">{{ $statement->statement}}</label>
                    <div class="order" v-for="(option, key) in order">
                        <label class="key">@{{ key + 1 }}</label>
                        <div  class="order-wrapper">
                            <label class="option">@{{ option['option'] }}</label>
                            <div class="arrows" v-if="key === 0">
                                <p class="up"></p>
                                <p class="down arrow_down" @click="move(order, key, key+1)"></p>
                            </div>
                            <div class="arrows" v-else-if="key === 3">
                                <p class="up arrow_up" @click="move(order, key, key-1)"></p>
                                <p class="down"></p>
                            </div>
                            <div class="arrows" v-else>
                                <p class="up arrow_up" @click="move(order, key, key-1)"></p>
                                <p class="down arrow_down" @click="move(order, key, key+1)"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="order" value="{{ $order }}">
            @endif
        @endforeach
        <input type="hidden" id="responses" class="responses" value="{{$responses}}">
        <input type="hidden" name="order_end" :value="getOrder"> 
        <input type="hidden" name="just_save" :value="justSave" v-bind="justSave">
        <input type="hidden" value="{{ $user_id }}" id="user_id">
        <div class="evaluate">
            <button @click="save">Guardar</button>
            <button @click="submit">Continuar</button>
        </div>
    </form>



</div>




@include('imaxd.partials.footer')


@endsection
