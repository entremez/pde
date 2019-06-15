<section class="travel" style="background-color: #000033">
<form action="{{ route('response.travel') }}" method="post" id="survey-form">
@csrf 
<input type="hidden" id="istravel" value="1">
@php
    $letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l'];
@endphp

<input type="hidden" id="order" data-order="{{ $survey->order()}}">
<div class="row noselect">

    @foreach($statements as $key=>$statement)
    <div class="wrapper-stmt wrapper-stmt-{{$statement->id}} w-100">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color: white">&times;</span>
        </button>
        <div class="travel-wrapper backgrounds-travel row full-stmts-{{$statement->id}} w-100"  data-type="{{ $statement->statement_type_id }}"  data-total="{{ $statement->options->count() }}" data-last="{{ $statement->last() }}" data-first="{{ $statement->first() }}" style="background-image: url('{{ asset('images/'.$statement->background ) }}')">
            <div class="col-md-6 offset-md-1" >
                <div>
                    <p class="stmts stmts-{{$key}}"> {{ $key+1 }}. {{ $statement->statement }}</p>
                </div>
                @foreach($statement->options as $key=>$option)
                    <div class="@if($statement->statement_type_id ==4)wrapper @endif 
                        @if($statement->statement_type_id ==3)wrapper-type-3 @endif
                        @if($statement->statement_type_id ==1)wrapper-type-1 @endif wrapper-{{ $option->id }}" data-stmnt="{{ $option->id }}">
                        <div class="name-type name-type-{{ $statement->statement_type_id }}">
                            <span>@if($statement->statement_type_id ==3){{ $letters[$key] }}) @endif{{ ucfirst($option->option) }}</span>
                            @if( $option->info != null)
                                <span data-toggle="tooltip" data-placement="right" title="{{ $option->info }}"><i class="fas fa-info-circle"></i></span>
                            @endif
                        </div>
                        <div class="type type-{{ $statement->statement_type_id }}">@if($statement->statement_type_id == 4)-@endif</div>
                        <input type="hidden" name="survey[]" id="{{ $option->id }}">

                    </div>
                @endforeach
                @if($statement->statement_type_id == 4)
                <div class=" mt-4">
                    <span class="ml-2 message" style="display: none">*Para continuar se deben emuerar todas las áreas</span>
                </div>
                @endif
            </div>
            <div class="col-md-5 bar">
            <!--    <div class="dfcr">
                    <div class="btn btn-danger avanzar">seguir</div>
                </div>-->
                @if($statement->id != 1 )
                    <div class="dfcr mr-3">
                        <div class="btn btn-danger reverse" data-type="{{ $statement->statement_type_id }}">Volver</div>
                    </div>
                @endif
                @if($statement->statement_type_id == 4)
                <div class="dfcr">
                    <div class="mt-4">
                        <div class="btn btn-danger submit-type-4">Continuar</div>
                    </div>
                </div>
                @endif
                @if($statement->statement_type_id == 1)
                <div class="dfcr">
                    <div class="mt-4">
                        <div class="btn btn-danger submit-type-2">Continuar</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    <div class="wrapper-stmt wrapper-stmt-{{$statement->id + 1}} w-100 final">
        <div class="travel-wrapper backgrounds-travel row full-stmts-{{ $statement->id + 1 }} w-100" style="background-image: url('{{ asset('images/FONDOS-08.png') }}')">
                <div class="col-md-7 offset-md-1">
                    <p class="message-final">Muchas gracias por evaluar a su empresa. A continuación se le entregarán una serie de recomendaciones sobre cómo optimizar y mejorar sus servicios a través del diseño.</p>
                    <div class="image-final-survey">
                        <img style="width:100%" src="{{ asset('images/logo-PDE-invertido-grande.png') }}" alt="pde">
                    </div>
                </div>
                <div class="col btn-send-survey">
                    <button id="send-survey" class="btn btn-danger">Enviar respuestas</button>
                </div>
        </div>
    </div>
</div>
<div class="row py-2 progress-wrapper" style="background-color: white">
    <div class="col-md-2 offset-md-8">
        <div class="custom-progress">
          <div class="custom-progress-bar"  style="width: 0"></div>
        </div>
    </div>
    <div class="col ml-0"><span id="actualStatement">0</span> de <span id="totalStatement">{{ $statements->count()}}</span> respondidas</div>

</div>


</form>   
</section>

