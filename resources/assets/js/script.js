$(document).ready(function () {

    $('[data-toggle="tooltip"]').mouseover(function(event) {
    $(this).tooltip('show');
  }).mouseleave(function(event) {
    $(this).tooltip('hide');
  });

    new WOW().init();

  $("#modal-setting").modal("show");


    $('#send-survey').click(function(event){
      event.preventDefault();
      $('#survey-form').submit();
    });

    $('#provider-btn').click(function(e){
        $('.provider-contact').toggle();
        var id = $(this).data('id')
        var url = $('#form-counter').attr('action').replace(':PROVIDER_ID', id);
        var data = $('#form-counter').serialize();
        $.post(url, data);
    });

    if($('#serviceFromBadge').val() != null && $('#serviceFromBadge').val() != 0){
        var id = $('#serviceFromBadge').val();
        getProvidersByService($('#'+id));
    }


    $('.service-filter').click(function(event) {
        event.preventDefault();
        getProvidersByService($(this));
    });

    $('.btn-destroy').click(function (e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-destroy')
        var url = form.attr('action').replace(':SURVEY_ID', id)
        var data = form.serialize();

        $.post(url, data, function(result){
            row.fadeOut();
        }).fail(function(){
            row.show();
        });
    });

    $('.activate').click(function (){
        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-activate')
        var url = form.attr('action').replace(':SURVEY_ID', id)
        var data = form.serialize();
        $(this).parents('tbody').find('tr').find('.activate').each(function(){
            $(this).prop('checked', false);
        });
        $(this).prop('checked', true);
        $.post(url, data);
    });

    var rangeSlider = function(){
    var slider = $('.range-slider'),
    range = $('.range-slider__range'),
    value = $('.range-slider__value');

    slider.each(function(){

        value.each(function(){
            var value = $(this).prev().attr('value');
            $(this).html(value);
            });

            range.on('input', function(){
            $(this).next(value).html(this.value);
                });
        });
    };

    rangeSlider();

//    $('.counter-num').counterUp({
//        delay: 10,
//        time: 1000
//    });

    $('.btn-view-more').click(function(e) {
        e.preventDefault();
        $('.view-more').toggle();
        var form = $('#form-provider')
        var provider_id = form.attr('provider_id');
        var url = form.attr('action').replace(':PROVIDER_ID', provider_id);
        var data = form.serialize();
        $.post(url, data);
        $(this).fadeOut();
    });

    $(document).on('click','#view-more-home',function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var form = $('#form-load-more');
            var data = form.serialize();
            var url = form.attr('action');
            $("#view-more-home").html("Cargando....");
            $.ajax({
               url : url,
               method : "POST",
               cache: false,
               data : data,
               success : function (data)
               {
                  if(data != ''){
                    $('#remove-row').remove();
                    $('#load-data').append(data);
                  }else{
                    $(this).hide();
                  }
                }
        });
    });

    $(document).on('click','#view-more-providers',function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var form = $('#form-providers');
            var data = form.serialize();
            var url = form.attr('action');
            $("#view-more-providers").html("Cargando....");
            $.ajax({
               url : url,
               method : "POST",
                cache: false,
               data : data,
               success : function (data)
               {
                  if(data != '')
                  {
                      $('#remove-row-provider').remove();
                      $('#load-providers').append(data);
                  }
                  else
                  {
                       $(this).hide();
                  }
               }
       });
    });


  $('#file').change(function(e) {
      addImage(e); 
     });


     function addImage(e){
      var file = e.target.files[0],
      imageType = /image.*/;
    
      if (!file.type.match(imageType))
       return;
  
      var reader = new FileReader();
      reader.onload = fileOnload;
      reader.readAsDataURL(file);
     }

  
     function fileOnload(e) {
      var result=e.target.result;
      //$('#imgSalida').attr("src",result);
      $('#imgSalida').css('background-image', 'url("' + result + '")');
      $('#imgSalida').show();
     }

     $('#sector*').click(function(e){
        var id = $(this).data('id');
        if(id == $('#classification*').data('id')){

        }
     });



     //LOGIN

     $('#submit-login').validate({
          rules: {
            'email-login': { required : true, email: true},
            'password-login': {required:true}
          },
          messages: {
             'email': {
                required: "*Este campo es obligatorio.",
                email: "*El correo electrónico debe ser válido.",
             },
             'password': {
                required: "*Este campo es obligatorio."
             }
          }
        });



     //REGISTER

     $('#form-register').validate({

          rules: {
            'email-register': { required : true, email: true},
            'password-register' : { required : true, minlength: 6},
            'password-confirm-register' : { required : true, equalTo : "#password-register"}
          },
          messages: {
           'email-register': {
              required: "*Este campo es obligatorio.",
              email: "*El correo electrónico debe ser válido."
           },
           'password-register': {
              required: "*Este campo es obligatorio.",
              minlength: "*La contraseña debe tener al menos 6 caracteres."
           },
           'password-confirm-register': {
              required: "*Este campo es obligatorio.",
              equalTo: "*Las contraseñas deben coincidir."
           }
          }
     });

     //REGISTER PROVIDER



     $('#submit-config-provider').validate({

        ignore: [],
          rules: {
            'name': { required : true},
            'rut' : { required:true, rut:true},
            'address' : {required:true},
            'web' : {required:true},
            'phone' : {required:true},
            'long_description' : {required:true},
            'service[]' : {required:true},
            'region' : {required:true},
            'regions[]' : {required:true},
            'commune' : {required:true},
            'logo' : {required:true},
            'terms' : {required:true}
          },
          messages: {
           'name': {
              required: "*Ingrese su nombre o el de su empresa."
           },
           'rut' : { 
                required:'*Este campo es obligatorio.', 
                rut:'*Por favor revise que esté escrito correctamente'
            },
           'address' : { 
                required:'*Este campo es obligatorio.'
            },
           'web' : { 
                required:'*Este campo es obligatorio.'
            },
           'region' : { 
                required:'*Este campo es obligatorio.'
            },
           'commune' : { 
                required:'*Este campo es obligatorio.'
            },
           'phone' : { 
                required:'*Este campo es obligatorio.'
            },
           'long_description' : { 
                required:'*Este campo es obligatorio.'
            },
           'service[]' : { 
                required:'*Selecciona al menos un servicio.'
            },
           'regions[]' : { 
                required:'*Selecciona al menos una región donde presta sus servicios.'
            },
           'logo' : { 
                required:'*Selecciona una imagen.'
            },
           'terms' : { 
                required:'*Debes aceptar los términos y condiciones.'
            }
          },
          errorPlacement: function(error, element) {
            if (element.attr("name") == "service[]") {
              error.insertBefore('.errorTxt');
              element.parents('.servicios').find('.error').addClass('error-class');
            } else if(element.attr("name") == "logo") {
              error.insertBefore('.errorLogo');
            } else if(element.attr("name") == "regions[]") {
              error.insertBefore('.errorRegions');
              element.parents('.regiones').find('.error').addClass('error-class');
            } else if(element.attr("name") == "terms") {
              error.insertBefore('.errorTerms');
            } else {
              error.insertBefore(element);
            }
          }
      });

//EDIT PROVIDER

     $('#submit-edit-provider').validate({

        ignore: [],
          rules: {
            'name': { required : true},
            'rut' : { required:true, rut:true},
            'address' : {required:true},
            'web' : {required:true},
            'phone' : {required:true},
            'long_description' : {required:true},
            'service[]' : {required:true},
            'regions[]' : {required:true},
            'commune' : {required:true},
            'region' : {required:true}
          },
          messages: {
           'name': {
              required: "*Ingrese su nombre o el de su empresa."
           },
           'regions[]' : { 
                required:'*Selecciona al menos una región donde presta sus servicios.'
            },
           'rut' : { 
                required:'*Este campo es obligatorio.', 
                rut:'*Por favor revise que esté escrito correctamente'
            },
           'address' : { 
                required:'*Este campo es obligatorio.'
            },
           'web' : { 
                required:'*Este campo es obligatorio.'
            },
           'region' : { 
                required:'*Este campo es obligatorio.'
            },
           'phone' : { 
                required:'*Este campo es obligatorio.'
            },
           'long_description' : { 
                required:'*Este campo es obligatorio.'
            },
           'commune' : { 
                required:'*Este campo es obligatorio.'
            },
           'service[]' : { 
                required:'*Selecciona al menos un servicio.'
            }
          },
          errorPlacement: function(error, element) {
            if (element.attr("name") == "service[]") {
              error.insertBefore('.errorTxt');
              element.parents('.servicios').find('.error').addClass('error-class');
            } else if(element.attr("name") == "logo") {
              error.insertBefore('.errorLogo');
            }else if(element.attr("name") == "regions[]") {
              error.insertBefore('.errorRegions');
              element.parents('.regiones').find('.error').addClass('error-class');
            }  else {
              error.insertBefore(element);
            }
          }
      });


     //crear caso de éxito

     $('#create-form').validate({

        ignore: [],
          rules: {
            'name': { required : true},
            'company_name' : { required:true},
            'business' : { required:true},
            'year' : {required:true},
            'region' : {required:true},
            'quantity' : {required:true},
            'sentence' : {required:true},
            'sector' : {required:true},
            'long_description' : {required:true},
            'image' : {required:true},
            'quote' : {required:true},
            'company-logo' : {required:true},
            'service[]' : {required:true},
            'ragion' : {required:true},
            'terms' : {required:true},
            'business' : {required:true}
          },
          messages: {
           'name': {
              required: "*Ingrese el nombre del caso."
           },
           'company_name' : { 
                required:'*Este campo es obligatorio.',
            },
           'business' : { 
                required:'*Este campo es obligatorio.',
            },
           'region' : { 
                required:'*Este campo es obligatorio.'
            },
           'year' : { 
                required:'*Este campo es obligatorio.'
            },
           'quantity' : { 
                required:'*Este campo es obligatorio.'
            },
           'sentence' : { 
                required:'*Este campo es obligatorio.'
            },
           'sector' : { 
                required:'*Seleccione un sector y luego una actividad.'
            },
           'long_description' : { 
                required:'*Este campo es obligatorio.'
            },
           'service[]' : { 
                required:'*Selecciona al menos un servicio.'
            },
           'image' : { 
                required:'*Selecciona una imagen.'
            },
           'employees' : { 
                required:'*Este campo es obligatorio.'
            },
           'company-logo' : { 
                required:'*Este campo es obligatorio.'
            },
           'quote' : { 
                required:'*Este campo es obligatorio.'
            },
           'business' : { 
                required:'*Selecciona el tipo de negocio.'
            },
           'terms' : { 
                required:'*Debes confirmar que cuentas con autorización.'
            }
          },
          errorPlacement: function(error, element) {
            if (element.attr("name") == "service[]") {
              error.insertBefore('.errorTxt');
              element.parents('.servicios').find('.error').addClass('error-class');
            } else if(element.attr("name") == "sector") {
              error.insertBefore('.errorSector');
            } else if(element.attr("name") == "image") {
              error.insertBefore('.errorLogo');
            } else if(element.attr("name") == "company-logo") {
              error.insertBefore('.errorLogoCompany');
            } else if(element.attr("name") == "terms") {
              error.insertBefore('.errorTerms');
            } else {
              error.insertBefore(element);
            }
          },
          invalidHandler:function(event, validator) {
            $('#previewModal').modal('hide');
          }
      });

$('#edit-form').validate({

        ignore: [],
          rules: {
            'name': { required : true},
            'company_name' : { required:true},
            'year' : {required:true},
            'region' : {required:true},
            'quantity' : {required:true},
            'sentence' : {required:true},
            'sector' : {required:true},
            'long_description' : {required:true},
            'quote' : {required:true},
            'service[]' : {required:true},
            'ragion' : {required:true},
            'terms' : {required:true},
            'business' : {required:true}
          },
          messages: {
           'name': {
              required: "*Ingrese el nombre del caso."
           },
           'company_name' : { 
                required:'*Este campo es obligatorio.',
            },
           'region' : { 
                required:'*Este campo es obligatorio.'
            },
           'year' : { 
                required:'*Este campo es obligatorio.'
            },
           'quantity' : { 
                required:'*Este campo es obligatorio.'
            },
           'sentence' : { 
                required:'*Este campo es obligatorio.'
            },
           'sector' : { 
                required:'*Seleccione un sector y luego una actividad.'
            },
           'long_description' : { 
                required:'*Este campo es obligatorio.'
            },
           'service[]' : { 
                required:'*Selecciona al menos un servicio.'
            },
           'employees' : { 
                required:'*Este campo es obligatorio.'
            },
           'quote' : { 
                required:'*Este campo es obligatorio.'
            },
           'business' : { 
                required:'*Selecciona el tipo de negocio.'
            },
           'terms' : { 
                required:'*Debes confirmar que cuentas con autorización.'
            }
          },
          errorPlacement: function(error, element) {
            if (element.attr("name") == "service[]") {
              error.insertBefore('.errorTxt');
              element.parents('.servicios').find('.error').addClass('error-class');
            } else if(element.attr("name") == "sector") {
              error.insertBefore('.errorSector');
            } else if(element.attr("name") == "terms") {
              error.insertBefore('.errorTerms');
            } else {
              error.insertBefore(element);
            }
          },
          invalidHandler:function(event, validator) {
            $('#previewModal').modal('hide');
          }
      });


     //COMPANY CONFIG

    function validaRut(campo){
      if ( campo.length == 0 ){ return false; }
      if ( campo.length < 8 ){ return false; }

      campo = campo.replace('-','')
      campo = campo.replace(/\./g,'')

      var suma = 0;
      var caracteres = "1234567890kK";
      var contador = 0;    
      for (var i=0; i < campo.length; i++){
        u = campo.substring(i, i + 1);
        if (caracteres.indexOf(u) != -1)
        contador ++;
      }
      if ( contador==0 ) { return false }
      
      var rut = campo.substring(0,campo.length-1)
      var drut = campo.substring( campo.length-1 )
      var dvr = '0';
      var mul = 2;
      
      for (i= rut.length -1 ; i >= 0; i--) {
        suma = suma + rut.charAt(i) * mul
                    if (mul == 7)   mul = 2
                else  mul++
      }
      res = suma % 11
      if (res==1)   dvr = 'k'
                    else if (res==0) dvr = '0'
      else {
        dvi = 11-res
        dvr = dvi + ""
      }
      if ( dvr != drut.toLowerCase() ) { return false; }
      else { return true; }
    }
    jQuery.validator.addMethod("rut", function(value, element) { 
            return this.optional(element) || validaRut(value); 
    }, "Revise el RUT");

    $('#form-config-company').validate({
      rules : { 
                rut : { required:true, rut:true},
                'cities[]' : { required:true},
                classification : { required:true}
              } ,
      messages : { 
                rut : { 
                  required:'*Este campo es obligatorio.', 
                  rut:'*Por favor revise que esté escrito correctamente'
                  },
                'cities[]' : '*Seleccione al menos una región.',
                classification : '*Debe seleccionar el rubro de su empresa',
                name : '*Este campo es obligatorio.',
                address : '*Este campo es obligatorio.',
                phone : '*Este campo es obligatorio.',
                employees : '*Seleccione el rango.',
                gain : '*Seleccione el rango.',
                terms : '*Debe aceptar los términos y condiciones.'
                },
      errorPlacement: function(error, element) {

        if (element.attr("name") == "cities[]") {
          error.insertBefore('.errorTxt');
          element.parents('.col-md-12').find('.error').addClass('error-class');
        } else if(element.attr('name') == 'employees') {
          error.insertBefore('.employees');
        } else if(element.attr('name') == 'gain') {
          error.insertAfter('.gain');
        } else if(element.attr('name') == 'classification') {
          error.insertAfter('.classification');
        } else if(element.attr("name") == "terms") {
              error.insertBefore('.errorTerms');
            } else {
          error.insertBefore(element);
        }
    }
    });

    $(".form-check-input").click(function() {
        var cities = $(this).parents('.row');
        var todoChile = 17;
        if($("#city-"+todoChile).prop('checked')){
          for (var i = 1; i < todoChile; i++) {
            $("#city-"+i).prop('checked', false);
          }
        }

    });


    $('#video').click(function () {
     if( $("video").prop('muted') ) {
          $("video").prop('muted', false);
    } else {
      $("video").prop('muted', true);
    }
    });


//preview
var file = '';
var quote = '';
var companyLogo = '';
var sector = '';
var quantity = '';
var sentence = '';
var unit = '';

    isPreviewReady();

    $('#file-input').change(function(e) {
      addImage(e); 
      isPreviewReady();
     });

     function addImage(e){
      file = e.target.files[0];
      imageType = /image.*/;
    
      if (!file.type.match(imageType))
       return;
      $('#image-data').attr('placeholder', file.name);
      var reader = new FileReader();
      reader.onload = fileOnload;
      reader.readAsDataURL(file);
     }
  
     function fileOnload(e) {
      var result=e.target.result;
      $('#imgSalida').attr("src",result);
    } 

  $('#file-input-company').change(function(e) {
      addImageCompany(e); 
      isPreviewReady();
     });

     function addImageCompany(e){
        companyLogo = e.target.files[0],
        imageType = /image.*/;

      
        if (!companyLogo.type.match(imageType))
          return;
        $('#image-data-company').attr('placeholder', companyLogo.name);  
        var reader = new FileReader();
        reader.onload = fileOnloadCompany;
        reader.readAsDataURL(companyLogo);
     }
  
     function fileOnloadCompany(e) {
        var result=e.target.result;
        $('#imgCompany').attr("src",result);
     }

    $('#preview').click(function(e){
      e.preventDefault();
      var img = $('#imgSalida').attr('src');
      $('.image-container').css("background-image", 'linear-gradient(to bottom, rgba(0,0,0,0) 17%,rgba(0,0,0,0.54) 72%,rgba(0,0,0,0.65) 83%,rgba(0,0,0,0.65) 98%),url('+img+')');
      
      $('.corner').html(sector);
      $('.div2').html(quantity);
      $('.div1').html('<div class="porcentaje">'+unit+'</div><div class="sentence">'+sentence+'</div></div>');
      $('.div2-grande').html(quantity);
      $('.div1-grande').html('<div class="porcentaje-grande">'+unit+'</div><div class="sentence">'+sentence+'</div></div>');
      $('.text-case').html(quantity+' '+unit+' '+sentence);

      var imageCompany = encodeURI($('#imgCompany').attr('src'));
      var quote = $('#quote').val();
      var name_quote = $('#name_quote').val();
      var position_quote = $('#position_quote').val();
      var name = $('#name').val();
      var description = $('#description').val();

      var services = $('.servicios').find('input');
      var servicesHtml = '';
      services.each(function(index, el) {
        if($(this).is(':checked'))
          servicesHtml+= getServiceBadge($(this).data('name'));
      });

      servicesHtml+= getServiceBadge($('.pills-sectors.active').data('name'));
      servicesHtml+= getServiceBadge(sector);
      servicesHtml+= getServiceBadge($('#employees option:selected').text());
      servicesHtml+= getServiceBadge($('#region option:selected').text());
      servicesHtml+= getServiceBadge($('#year').text());
      servicesHtml+= getServiceBadge($('#business option:selected').text().substring(0, 3));

      $('.image-container').css('background-image','linear-gradient(to bottom, rgba(0,0,0,0) 17%,rgba(0,0,0,0.54) 72%,rgba(0,0,0,0.65) 83%,rgba(0,0,0,0.65) 98%),url(\''+img+'\')');
      $('.preview').css('background-image','linear-gradient(0deg, rgba(255,255,255,0) 15%, rgba(0,0,0,0.4995040252429097) 33%, rgba(0,0,0,0.502305145691089) 50%, rgba(0,0,0,0.4995040252429097) 67%, rgba(255,255,255,0) 85%),url(\''+img+'\')');
      $('.image-company').attr('src', imageCompany);      
      $('.corner').html(sector);
      $('.text-case-preview').html(quantity+' '+unit+' '+sentence);
      $('.quote').html('"'+quote+'"<br><span class="font-normal">'+name_quote+' - '+position_quote+'</span>');
      $('.name').html(name);
      $('.description').html(description);
      $('#tags').html(servicesHtml);
      $('#image_logo_preview').attr('src', encodeURI($('#imagen_logo').data('image')));

    });



    $('#preview-edit').click(function(e){
      e.preventDefault();
      var img = encodeURI($('#imgSalida').attr('src'));
      var sector = $('.seleccionado').attr('id');
      var quantity = $('#quantity').val();
      var sentence = $('#sentence').val();
      var unit = $('#unit').val();
      var imageCompany = encodeURI($('#imgCompany').attr('src'));
      var quote = $('#quote').val();
      var name_quote = $('#name_quote').val();
      var position_quote = $('#position_quote').val();
      var name = $('#name').val();
      var description = $('#description').val();

      var services = $('.servicios').find('input');
      var servicesHtml = '';
      services.each(function(index, el) {
        if($(this).is(':checked'))
          servicesHtml+= getServiceBadge($(this).data('name'));
      });

      servicesHtml+= getServiceBadge($('.pills-sectors.active').data('name'));
      servicesHtml+= getServiceBadge(sector);
      servicesHtml+= getServiceBadge($('#employees option:selected').text());
      servicesHtml+= getServiceBadge($('#region option:selected').text());
      servicesHtml+= getServiceBadge($('#year').val());
      servicesHtml+= getServiceBadge($('#business option:selected').text().substring(0, 3));
      $('#tags').html(servicesHtml);

      //$('.image-container').css('background-image','linear-gradient(to bottom, rgba(0,0,0,0) 17%,rgba(0,0,0,0.54) 72%,rgba(0,0,0,0.65) 83%,rgba(0,0,0,0.65) 98%),url('+img+')');
      $('.image-container').css('background-image','linear-gradient(to bottom, rgba(0,0,0,0) 17%,rgba(0,0,0,0.54) 72%,rgba(0,0,0,0.65) 83%,rgba(0,0,0,0.65) 98%),url(\''+img+'\')');
      $('.preview').css('background-image','linear-gradient(0deg, rgba(255,255,255,0) 15%, rgba(0,0,0,0.4995040252429097) 33%, rgba(0,0,0,0.502305145691089) 50%, rgba(0,0,0,0.4995040252429097) 67%, rgba(255,255,255,0) 85%),url(\''+img+'\')');
      $('.image-company').attr('src', imageCompany);
      $('.corner').html(sector);
      $('.div2').html(quantity);
      $('.div1').html('<div class="porcentaje">'+unit+'</div><div class="sentence">'+sentence+'</div></div>');
      $('.div2-grande').html(quantity);
      $('.div1-grande').html('<div class="porcentaje-grande">'+unit+'</div><div class="sentence">'+sentence+'</div></div>');
      $('.text-case-preview').html(quantity+' '+unit+' '+sentence);
      $('.quote').html('"'+quote+'"<br><span class="font-normal">'+name_quote+' - '+position_quote+'</span>');
      $('.name').html(name);
      $('.description').html(description);
      $('#image_logo_preview').attr('src', encodeURI($('#imagen_logo').data('image')));
    });

    function getServiceBadge(service){
      return '<a href="#!" class="badge badge-success">'+ service +'</a> ';
    }

    function isPreviewReady(){
      if(file == '')
        return
      if(sector == '')
        return
      if(quantity == '')
        return
      if(sentence == '')
        return
      if(companyLogo == '')
        return
      if(companyLogo == '')
        return
      $('#preview').prop('disabled', false);
      return true;
    }

    $( ".sectors" ).on( "click", function() {
      sector = $( "input:checked" ).prop('id');
      isPreviewReady();
    }); 

    $("#quantity").change(function(event) {
        quantity = $(this).val();
        isPreviewReady();
    });

    $("#sentence").change(function(event) {
        sentence = $(this).val();
        isPreviewReady();
    });


    $("#unit").change(function(event) {
        unit = $(this).val();
        isPreviewReady();
    });


    $("#quote").change(function(event) {
        quote = $(this).val();
        isPreviewReady();
    });


    $("#submit-create-case").on( "click", function() {
      $("#create-form").submit();
    });

//CONFIG PROVIDERS


var $dropdowns = $('.dropdown');
$dropdowns.hover(function()
{
    $('.dropdown-toggle', this).trigger('show.bs.dropdown');
}, function()
{
    $('.dropdown-toggle', this).trigger('hide.bs.dropdown');
});

$dropdowns.on('show.bs.dropdown', function(e)
{
    e.preventDefault();
    $(this).addClass('active');
    $(this).find('.dropdown-menu').first().stop(true, true).delay(200).slideDown(400, function()
    {
        $(this).parent().addClass('open');
        $(this).parent().find('.dropdown-toggle').attr('aria-expanded', 'true');
    });
});

$dropdowns.on('hide.bs.dropdown', function(e)
{
    e.preventDefault();
    if ($(this).find('li.active').length <= 0)
        $(this).removeClass('active');
    $(this).find('.dropdown-menu').first().stop(true, true).delay(200).slideUp(400, function()
    {
        $(this).parent().removeClass('open');
        $(this).parent().find('.dropdown-toggle').attr('aria-expanded', 'false');
    });
});

//DELETE CASE IN DASHBOARD PROVIDER

  $(document).on('click', '.delete', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    var instance = $(this);
    var url = $('#delete').val();
    $.confirm({
        title: 'Borrar caso',
        content: '¿Realmente desea borrar el caso?',
        buttons: {
            Confirmar: {
                btnClass: 'btn-primary',
                action: function () {
                    instance.parents('.instance-dashboard').fadeOut();
                  
                      $.ajax({
                            type: 'get',
                            url: url,
                            data: {"_token": $('#token').val(), "id" : id}
                      });
                    }
                  },
            Volver: function () {

            }
        }
    });
  }); 

  $('.filter').change(function(event) {
      filters();
  });

  filters();

function filters() {
  var employees = [];
    $("input[name=employee]").each(function (index) {  
       if($(this).is(':checked')){
          employees.push($(this).val());
       }
    });
    var sectors = [];
    $("input[name=sector]").each(function (index) {  
       if($(this).is(':checked')){
          sectors.push($(this).val());
       }
    });
    var cities = [];
    $("input[name=city]").each(function (index) {  
       if($(this).is(':checked')){
          cities.push($(this).val());
       }
    });
    var categories = [];
    $("input[name=category]").each(function (index) {  
       if($(this).is(':checked')){
          $(this).parents('.form-check').find('.service-toggle').find("input[name=service]").each(function (index) {
              $(this).prop('checked', true);
          });
          categories.push($(this).val());
       }
    });
    var services = [];
    $("input[name=service]").each(function (index) {  
       if($(this).is(':checked')){
          $(this).parents('.service-toggle').toggle();
          services.push($(this).val());
       }
    });
    var classification = [];
    $("input[name=classification]").each(function (index) {  
          classification.push($(this).val());
    });
    
    var year = [];
    $("input[name=year]").each(function (index) {  
          year.push($(this).val());
    });
    
    var business_type = [];
    $("input[name=business_type]").each(function (index) {
        if($(this).is(':checked')){
          business_type.push($(this).val());
        }
    });

    var form = $('#form-filter');
    var url = form.attr('action');



    $.ajax({
      url : url,
      method : "GET",
    cache: false,
      data : {employees:employees,
              sectors:sectors,
              cities:cities,
              categories:categories,
              services:services,
              classification:classification,
              year:year,
              business_type:business_type},
      success : function (data)
      {

        var output = '';
          for (var i = 0; i < data.length; i++) {
            output += '<div class="col-md-4">';
            output += '<div class="service">';
            output += '<a href="/case/'+data[i].id+'">';
            output += '<div class="corner">'+ $('#classification-'+data[i].classification_id).val()+'</div>';
            imageUrl = $('#image-'+data[i].id).val();
            output += '<div class="image-container" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0) 17%,rgba(0,0,0,0.54) 72%,rgba(0,0,0,0.65) 83%,rgba(0,0,0,0.65) 98%), url(\''+imageUrl+'\')">';
            output += '<div class="container">';
            output += '<div class="row-c">';
            output += '<div class="div2">'+ data[i].quantity+'</div>';
            output += '<div class="div1"><div class="porcentaje">'+ data[i].unit+'</div><div class="sentence">'+ data[i].sentence+'</div></div>';
            output += '</div>';
            output += '</div>';               
            output += '</div>';
            output += '</a>';
            output += '</div>';
        output += '</div>';
          }
        $('.filtered').hide();
        $('.filtered').html(output);
        $('.filtered').show();
        $("input[name=classification]").attr('name', '');



      }
    });


}

$('#formacion').on('click', function(argument) {
      $('.formacion').toggle();
});

$('#proveedores').on('click', function(argument) {
      $('.proveedores').toggle();
});
  
if($('#errors-register').attr('value') == 1){
    $('.modal').modal('show');
}
  
if($('#errors-login').attr('value') == 1){
    $('.modal').modal('show');
}


$('.category').on('click', function(event) {
  event.preventDefault();
    $(this).prop('checked', false);
    $(this).parent().parent().find('.service-toggle').toggle();
});


$('#region').change(function (e) {
    
    var form = $('#form-cities');
    var url = form.attr('action');

    $.ajax({
      url : url,
      method : "GET",
      cache: false,
      data : {id: $(this).val()},
      success : function (data)
      {

        $('#commune').empty();
        if(data.length == 1){
          $('#commune').append($('<option>', {value:data[0].id, text:data[0].commune}));
        }else{
          $('#commune').append($('<option>', {value:'', text:'Seleccione comuna...'}));
          for (var i = 0; i < data.length; i++) {
             $('#commune').append($('<option>', {value:data[i].id, text:data[i].commune}));
           } 
        }
        
      }
    });
})


$(document).on('click', '#travelOrRegister', function(event) {
    event.preventDefault();
    if($(this).data('type') == 'register'){
        $('#registerTravel').modal('show');
    }else{
        window.location.pathname = '/new'
    }
});

$(document).on('click', '#providers_to_approve', function(event) {
  $('#providers_to_approve_table').toggle();
  $('#providers_to_approve').toggle();
  $('#providers_to_approve_up').toggle();
});

$(document).on('click', '#providers_to_approve_up', function(event) {
  $('#providers_to_approve_table').toggle();
  $('#providers_to_approve').toggle();
  $('#providers_to_approve_up').toggle();
});

$(document).on('click', '#providers_in_buffer', function(event) {
  $('#providers_in_buffer_table').toggle();
  $('#providers_in_buffer').toggle();
  $('#providers_in_buffer_up').toggle();
});

$(document).on('click', '#providers_in_buffer_up', function(event) {
  $('#providers_in_buffer_table').toggle();
  $('#providers_in_buffer').toggle();
  $('#providers_in_buffer_up').toggle();
});

$(document).on('click', '#instances_to_approve', function(event) {
  $('#instances_to_approve_table').toggle();
  $('#instances_to_approve').toggle();
  $('#instances_to_approve_up').toggle();
});

$(document).on('click', '#instances_to_approve_up', function(event) {
  $('#instances_to_approve_table').toggle();
  $('#instances_to_approve').toggle();
  $('#instances_to_approve_up').toggle();
});

$(document).on('click', '#users_without_profile', function(event) {
  $('#users_without_profile_table').toggle();
  $('#users_without_profile').toggle();
  $('#users_without_profile_up').toggle();
});

$(document).on('click', '#users_without_profile_up', function(event) {
  $('#users_without_profile_table').toggle();
  $('#users_without_profile').toggle();
  $('#users_without_profile_up').toggle();
});

$(document).on('click', '#instances_buffered', function(event) {
  $('#instances_buffered_table').toggle();
  $('#instances_buffered').toggle();
  $('#instances_buffered_up').toggle();
});

$(document).on('click', '#instances_buffered_up', function(event) {
  $('#instances_buffered_table').toggle();
  $('#instances_buffered').toggle();
  $('#instances_buffered_up').toggle();
});

$(document).on('click', '#providers_approved', function(event) {
  $('#providers_approved_table').toggle();
  $('#providers_approved').toggle();
  $('#providers_approved_up').toggle();
});

$(document).on('click', '#providers_approved_up', function(event) {
  $('#providers_approved_table').toggle();
  $('#providers_approved').toggle();
  $('#providers_approved_up').toggle();
});

$(document).on('click', '#instances_approved', function(event) {
  $('#instances_approved_table').toggle();
  $('#instances_approved_up').toggle();
  $('#instances_approved').toggle();
});

$(document).on('click', '#instances_approved_up', function(event) {
  $('#instances_approved_table').toggle();
  $('#instances_approved_up').toggle();
  $('#instances_approved').toggle();
});

$(document).on('click', '#approve-provider', function(event) {
  event.preventDefault();
  var url = $(this).data('url');
  var token = $(this).data('token');
  var id = $(this).data('id');
  var numberOfInstances = $(this).data('numberofinstances');

  if(numberOfInstances <= 0){
      $.confirm({
          title: 'Aprobar proveedor',
          content: 'El proveedor no tienen ningun caso aprobado ¿Realmente deseas aprobarlo?',
          buttons: {
              Confirmar: {
                  btnClass: 'btn-primary',
                  action: function () {
                        approveProvider(url, token, id);
                    },
                  },
              Volver: function () {

              }
          }
      });
    }else{
      approveProvider(url, token, id);
    }

});$(document).on('click', '#delete-provider', function(event) {
  event.preventDefault();
  var url = $(this).data('url');
  var token = $(this).data('token');
  var id = $(this).data('id');

  $.confirm({
          title: 'Descartar proveedor',
          content: '¿Realmente desea descartar este proveedor?<br>La acción recargará la página',
          buttons: {
              Confirmar: {
                  btnClass: 'btn-primary',
                  action: function () {
                        deleteProvider(url, token, id);
                    },
                  },
              Volver: function () {

              }
          }
      });
  

});

$(document).on('click', '#ignore', function(event) {
      event.preventDefault();
      var row = $(this).parents('tr');
      var url = $(this).data('url');
      var token = $(this).data('token');
      var id = $(this).data('id');
      $.confirm({
          title: 'Ignorar registro',
          content: '¿Realmente deseas ignorar a este usuario?',
          buttons: {
              Confirmar: {
                  btnClass: 'btn-primary',
                  action: function () {
                          $.ajax({
                               url : url,
                               method : "POST",
                               cache: false,
                               data : {"_token": token, "id" : id},
                               success : function (data)
                                        {
                                          row.hide('100');
                                          var number = $('#number_users');
                                          var users = number.html() - 1;
                                          if(Number.isNaN(users)){
                                            users = '0';
                                          }
                                          number.html(users);
                                        }
                              });
                    },
                  },
              Volver: function () {

              }
          }
      });

});

$(document).on('click', '#approve-instance', function(event) {
  event.preventDefault();
  $.ajax({
     url : $(this).data('url'),
     method : "POST",
     cache: false,
     data : {"_token": $(this).data('token'), "id" : $(this).data('id')},
     success : function (data)
              {                
                var number = $('#number_instances');
                var instances = Number(number.html()) + 1;
                number.html(instances);
                number = $('#number_instances_to_approve');
                instances = number.html() - 1;
                if(Number.isNaN(instances)){
                  instances = '0';
                }
                number.html(instances);


                $('#instance-'+data[0].id).hide('100');
                $('#instance-approved').append(addInstanceToApproved(data));
              }
    });
});

$(document).on('click', '#delete-instance', function(event) {
  event.preventDefault();
  $.ajax({
     url : $(this).data('url'),
     method : "POST",
     cache: false,
     data : {"_token": $(this).data('token'), "id" : $(this).data('id')},
     success : function (data)
              {                
                var number = $('#number_instances');
                var instances = Number(number.html()) + 1;
                number.html(instances);
                number = $('#number_instances_to_approve');
                instances = number.html() - 1;
                if(Number.isNaN(instances)){
                  instances = '0';
                }
                number.html(instances);

                $('#instance-'+data[0].id).hide('100');
                $('#instance-approved-'+data[0].id).hide('100');
              }
    });
});

$(document).on('click', '#userWithoutProfile', function(event) {
  event.preventDefault();
  $.ajax({
     url : $(this).data('url'),
     method : "POST",
     cache: false,
     data : {"_token": $(this).data('token'), "id" : $(this).data('id')},
     success : function (data)
              {   
                  $('#users-no-profile-'+data.id).text(data.time);
              }
    });
});

$(document).on('click', '#approve-instance-buffered', function(event) {
  event.preventDefault();
  $.ajax({
     url : $(this).data('url'),
     method : "POST",
     cache: false,
     data : {"_token": $(this).data('token'), "id" : $(this).data('id')},
     success : function (data)
              { 
                var number = $('#number_instances_buffered');
                var casesBuffered = Number(number.html()) - 1;
                if(Number.isNaN(casesBuffered)){
                  casesBuffered = '0';
                }
                number.html(casesBuffered);
                $('#instance-approved-'+data[0].id).hide('200');
                $('#instance-buffered-'+data[0].id).hide('200');
                $('#instance-approved').append(addInstanceToApproved(data));
              }
    });
});

$(document).on('click', '#approve-provider-buffered', function(event) {
  event.preventDefault();
  $.ajax({
     url : $(this).data('url'),
     method : "POST",
     cache: false,
     data : {"_token": $(this).data('token'), "id" : $(this).data('id')},
     success : function (data)
              { 
                var number = $('#number_providers_buffered');
                var providerBuffered = Number(number.html()) - 1;
                if(Number.isNaN(providerBuffered)){
                  providerBuffered = '0';
                }
                number.html(providerBuffered);
                $('#provider-approved-'+data.id).hide('200');
                $('#provider-buffered-'+data.id).hide('200');
                $('#provider-approved').append(addProviderToApproved(data));
              }
    });
});


  $(document).on('click', '.comment-to-provider', function(event) {
    event.preventDefault();
    $('#send-comment-to-provider').attr('disabled', false);
    $('#emailProvider').attr('value', $(this).data('mail'));
    $('#subject').val('Observaciones perfil proveedor de servicios de diseño');
    $('#idProvider').attr('value', $(this).data('id'));
    $('#type').attr('value', 1); 
    $('#message').html($(this).data('comments'));
    $('#commentToProvider').modal('show');
  });

  $(document).on('click', '.comment-to-instance', function(event) {
    event.preventDefault();
    $('#send-comment-to-provider').attr('disabled', false);
    $('#emailProvider').attr('value', $(this).data('mail'));
    var instance = $(this).data('instance');
    $('#subject').val('Observaciones caso '+ instance);
    $('#idProvider').attr('value', $(this).data('provider-id'));
    $('#idInstance').attr('value', $(this).data('instance-id'));
    $('#type').attr('value', 2);
    $('#message').html($(this).data('comments'));
    $('#commentToProvider').modal('show');
  });

  $(document).on('click', '#send-comment-to-provider', function(event) {
    event.preventDefault();
    $(this).attr('disabled', true);
    var mail = $('#emailProvider').val();
    var message = $('#message').val();
    var message = message.replace(/\n/g, "<br>");
    var id = $('#idProvider').val();
    var instance_id = $('#idInstance').val();
    var type = $('#type').val();
    var subject = $('#subject').val();
    $.ajax({
       url : $(this).data('url'),
       method : "POST",
       cache: false,
       data : { "_token": $(this).data('token'), 
                "mail" : mail, 
                "message": message, 
                "id": id, 
                "instance_id": instance_id, 
                "type": type, 
                "subject": subject},
       success : function (data)
                { 
                  $('#message').val('');
                  $('#commentToProvider').modal('hide');

                  if(type == 1){
                    $('#comment-provider-'+id).attr('disabled', 'disabled');
                    $('#comment-provider-'+id).text('Comentarios enviados');
                  }else{
                    $('#comment-instance-'+instance_id).attr('disabled', 'disabled');
                    $('#comment-instance-'+instance_id).text('Comentarios enviados');                    
                  }
                }
    });


  });

    $(document).on('click','.feature',function(e) {
      var id = $(this).data('id');
      $.ajax({
       url : $(this).data('url'),
       method : "POST",
       cache: false,
       data : { "_token": $(this).data('token'), 
                "id": id},
       success : function (data)
                { 
                  $('#instance-approved-'+id).find('.feature').toggleClass('featured');

                }
      });

    });


    $('#quantity').on('input', function (e) {
    if (!/^[0-9,.]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^ 0-9,.]+/ig,"");
    }
    });


    $(document).on('click', '.position-relative', function(event) {
      $(this).next('.stage-content').toggle();
      $(this).children('.arrow-up').toggle();
      $(this).children('.arrow-down').toggle();
    });


     var actualStament = 1;
     var statements = $(document).find('.travel-wrapper');
     var totalStatements = statements.length;

     var options = $('#order').data('order');
     var option = 0;

     if($('#istravel').val() == 1){
        $('.type-3').html(affirmation(5));
        $('.type-4').html(enumerar(4));
        setOptions(options, option);
        setFirst(actualStament, statements);
     }

     $(document).on('click', '.sq.active', function(event) {
      event.preventDefault();
      var bar = 100*(1 - ((options.length - (option+1)) / options.length));
      $('.custom-progress-bar').css('width', bar+'%');
      cleanActives($('.wrapper-'+options[option]));
      setInput(getType(options, option), $(this).text(), options[option]);
      var alto = $(this).parents('.wrapper-'+options[option]).height();
      alto = alto + 50;
      $(this).addClass('selected');
      $(this).parents('.wrapper-'+options[option]).css({
        'margin-top': '-'+alto+'px',
        'opacity': '0',
        'transition': 'margin-top 1s, opacity 1s',
      });;
      var last = $('.wrapper-'+options[option]).parent().parent().data('last');
      option++;
      if(last == option){
        actualStament++;
        setTravel(actualStament, statements)
      }
      setOptions(options, option); 
    });

    $(document).on('click', '.name-type-2', function(event) {
        $(this).parent().parent().children().each(function(index, el) {
          $(this).find('.name-type').removeClass('type-2-selected');
        });
        $(this).addClass('type-2-selected');
        option++;
        actualStament++;
        setTravel(actualStament, statements);
        setOptions(options, option);
    });

    $(document).on('click', '.name-type-1', function(event) {
      var id = $(this).parent().data('stmnt');
        if($(this).hasClass('type-2-selected')){
          setInput(1, id, 0);
          $(this).removeClass('type-2-selected');
        }else{ 
          $(this).addClass('type-2-selected');
          setInput(1, id, id);
        }
    });

     $(document).on('click', '.reverse', function(event) {
      if(actualStament == 1){
        if(option != 0)
          option--;
        setOptions(options, option, 1);
      }else{

        if($(this).data('type') != 3){
          
            if($(this).parents('.wrapper-stmt').prev().find('.travel-wrapper').data('type') == 3){
              option = $(this).parents('.wrapper-stmt').prev().find('.travel-wrapper').data('last')-1;
              setOptions(options, option, 1);
            }
            actualStament--;
            setTravel(actualStament, statements);
        }else{

            if(option+1 == $('.wrapper-'+options[option]).parent().parent().data('first')){
              option = $(this).parents('.wrapper-stmt').prev().find('.travel-wrapper').data('last');
              setOptions(options, option, 1);              
              actualStament--;
              setTravel(actualStament, statements);
            }
            option--;
            setOptions(options, option, 1);
        }
      }
     });

     $(document).on('click', '.avanzar', function(event) {
        actualStament++;
        setTravel(actualStament, statements);
     });

     $(document).on('click', '.enum', function(event) {
      var flag = 0;
      var actual = $(this);
      var enums = $(this).parent('.type-4').find('.enum');
      var opt = $(this).parents('.wrapper').data('stmnt');
      setInput(4, $(this).text(), opt);
      if ($(this).hasClass('type-4-selected')) {
        $(this).removeClass('type-4-selected')
      }else{
       var selected = $(this).parent().find('.type-4-selected');
       var others = $(this).parents('.wrapper').parent().find('.wrapper');
         $.each(others, function(index, val) {

            $.each($(this).find('.enum'), function(index, val) {
              if($(this).hasClass('type-4-selected')){
                if($(this).text() == actual.text())
                  flag++
              }
            });
         });
       if(selected.length != 0)
          flag++;
      if(flag == 0)
        $(this).addClass('type-4-selected')
     }
   });

    $(document).on('click', '.submit-type-4', function(event) {
      var wrappers = $(this).parents('.travel-wrapper').find('.wrapper');
      var count = 0;
      $.each(wrappers, function(index, val) {
        var countLine = 0;
        $.each($(this).find('.type-4').find('.enum'), function(index, val) {
            if($(this).hasClass('type-4-selected')){
              count++;
              countLine++;
            }
            if(countLine > 1)
              count = 0;
          });
      });
      if(count == 4){
        actualStament++;
        setTravel(actualStament, statements);
      }else{
        $('.message').show();
      }
    });
 
    $(document).on('click', '.submit-type-2', function(event) {
      
      actualStament++;
      setTravel(actualStament, statements);

    });

});

function cleanActives(container) {
  $.each(container.find('.sq'), function(index, val) {
     $(this).removeClass('selected');
  });
}

function setTravel(actualStament, statements){

  $('#actualStatement').text(actualStament-1);
  $('.wrapper-stmt-'+actualStament).show();
  $.each(statements, function(index, val) {
      $(this).hide(800);
      if($(this).hasClass('full-stmts-'+actualStament))
        $(this).show(800);
  });
  if(actualStament >= statements.length){
    $('.full-stmts-'+actualStament).addClass('travel-wrapper-final');
    $('.progress-wrapper').hide();
  }
}

function setFirst(actualStament, statements){
  $('#actualStatement').text(actualStament-1);
  $('.wrapper-stmt-'+actualStament).show();
    $.each(statements, function(index, val) {
        $(this).hide();
        if($(this).hasClass('full-stmts-'+actualStament))
          $(this).show();
    });

}

function setOptions(options, option, action=0){
  if(getType(options, option) == 3){
    var sqrs = $('.wrapper-'+options[option]).find('.sq');
    $.each(sqrs, function(index, val) {
     $(this).addClass('active');
    });
    $('.wrapper-'+options[option]).show();
    $('.wrapper-'+options[option]).css('filter', 'opacity(1)');
    $('.wrapper-'+options[option]).css('cursor', 'pointer'); 
    $('.wrapper-'+options[option]).css('transition', 'filter 1s'); 
    for (var i = 1; i < 3; i++) {
      $('.wrapper-'+options[option+i]).css('filter', 'opacity(.5)');
      $('.wrapper-'+options[option+i]).css('cursor', 'not-allowed'); 
      $('.wrapper-'+options[option]).css('transition', 'filter 1s'); 
    }
    if(action == 1){
      $('.wrapper-'+options[option]).css({
        'margin-top': '0',
        'opacity': '1',
        'transition': 'margin-top 1s, opacity 1s',
      });
      sqrs = $('.wrapper-'+options[option+1]).find('.sq');
      $.each(sqrs, function(index, val) {
        $(this).removeClass('active');
      });
    }
  }else{
    for (var i = 1; i < 3; i++) {
      $('.wrapper-'+options[option+i]).css('filter', 'opacity(1)');
    }    
  }

  if(getType(options, option) == 4){
      var actual = $('.wrapper-'+options[option]);
      var statement = actual.parents('.travel-wrapper');
      var last = statement.data('last');
      for (var i = options[option]; i <= last; i++) {
        $('.wrapper-'+i).show();
        $('.wrapper-'+i).css('filter', 'opacity(1)');
        $('.wrapper-'+i).css('cursor', 'pointer');
      }

  }

  if(getType(options, option) == 2){
      var actual = $('.wrapper-'+options[option]);
      var statement = actual.parents('.travel-wrapper');
      var last = statement.data('last');
      for (var i = options[option]; i <= last; i++) {
        $('.wrapper-'+i).show();
        $('.wrapper-'+i).css('filter', 'opacity(1)');
        $('.wrapper-'+i).css('cursor', 'pointer');
      }  

  }


}

function setInput(type, value, option) {
    $('#'+option).prop('value', value);

}

function getType(options, option) {
  return $('.wrapper-'+options[option]).parent().parent().data('type');
}

function affirmation(numberOfLevels) {

  var out = '<div class="affirmation-container">';
  for (var i = 0; i < numberOfLevels; i++) {
    out += '<div class="sq">'+(i+1)+'</div>';
  }
  out+='</div><div class="legend"><div>Para nada</div><div>Si, absolutamente</div></div>';

  return out;
}

function enumerar(numberOfLevels) {

  var out = '';
  for (var i = 0; i < numberOfLevels; i++) {
    out += '<div class="enum">'+(i+1)+'</div>';
  }

  return out;
}


function addProviderToApproved(data){

  return `
          <tr>
            <th scope="row">${data.id}</th>
            <td>${data.name}</td>
            <td>${data.web}</td>
            <td>${data.long_description}</td>
            <td><a target="_blank" class="btn btn-primary" href="/provider/${data.id}">Ver proveedor</a></td>
          </tr>
  `;
}

function addInstanceToApproved(data){

  return `
          <tr id = "instance-approved-${data[0].id}">
            <th scope="row">${data[0].id}</th>
            <td>${data[0].name}</td>
            <td>${data[1]}</td>
            <td>${data[0].company_name}</td>
            <td>${data[0].long_description}</td>
            <td><a target="_blank" class="btn btn-primary" href="/case/${data[0].id}">Ver caso</a></td>
          </tr>
  `;
}

function approveProvider(url, token, id){
  $.ajax({
   url : url,
   method : "POST",
   cache: false,
   data : {"_token": token, "id" : id},
   success : function (data)
            {
              $('#provider-'+data.id).hide('100');
              $('#provider-approved').append(addProviderToApproved(data));
            }
  });
}

function deleteProvider(url, token, id){
  $.ajax({
   url : url,
   method : "POST",
   cache: false,
   data : {"_token": token, "id" : id},
   success : function (data)
            {
              $('#provider-'+data.id).hide('100');
              $('#provider-approved-'+data.id).hide('100');
              location.reload();
            }
  });
}

function getProvidersByService(service){
    var lis = service.parents('.row').children('.col-md-3').find('a');
        $.each(lis, function(){
            $(this).removeClass();
            $(this).addClass('link-default');
            $(this).addClass('service-filter');
        });
        service.addClass('selected');
        service.parents('.categorias').toggle();
        var title = service.text();
        var serviceId = service.parents('li').data('id');
        var url = $('#form-filter').attr('action').replace(':SERVICE_ID', serviceId);
        var data = $('#form-filter').serialize();

        $.post(url, data, function (result){
            $('.results').children('container').remove();
            var text ='';
            text = '<div class="container"><h3 class="mb-5">'+title+'</h3><div class="row">';
            $.each(result.providers, function (index) {
                  text += '<div class="col-md-3 col-sm-6"><div class="service"><a href="/provider/'+this.id+'"><div class="image-container  provider-image-solo" title="'+this.name+'" style="background-image: url(\''+ result.images[index] +'\')"></div></a></div></div>';
              });
            text+= '</div></div>';
            $('.results').html(text);
             var new_position = $('#horizontal-line').offset();
             window.scrollTo(new_position.left,new_position.top);
        });
}




