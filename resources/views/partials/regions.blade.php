        <div class="row pt-4">
            <div class="col-md-12">
                <label>¿En que región(es) opera su empresa?</label>
                <div class="errorTxt"></div>   
                <div class="row">             
                @foreach($cities as $city)
                <div class="col-md-4">
                    <div class="form-check docepx">
                        <input class="form-check-input" type="checkbox" value="{{ $city->id }}" name="cities[]" id="city-{{ $city->id }}">
                        <label class="form-check-label" for="city-{{ $city->id }}">
                            {{ $city->region }}
                        </label>
                    </div>
                </div> 
                @endforeach
                </div> 
            </div>
        </div>