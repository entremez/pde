$(document).ready(function () {


  $('[data-toggle="tooltip"]').tooltip();


    new WOW().init();

  $("#modal-setting").modal("show");


    $('#send-survey').click(function(event){
      event.preventDefault();
      var data = $('#survey-form').serialize();
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
            'commune' : {required:true},
            'logo' : {required:true}
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
           'logo' : { 
                required:'*Selecciona una imagen.'
            }
          },
          errorPlacement: function(error, element) {
            if (element.attr("name") == "service[]") {
              error.insertBefore('.errorTxt');
              element.parents('.servicios').find('.error').addClass('error-class');
            } else if(element.attr("name") == "logo") {
              error.insertBefore('.errorLogo');
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
            'commune' : {required:true},
            'region' : {required:true}
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
            } else {
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
            'ragion' : {required:true}
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
            } else {
              error.insertBefore(element);
            }
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
            'ragion' : {required:true}
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
            }
          },
          errorPlacement: function(error, element) {
            if (element.attr("name") == "service[]") {
              error.insertBefore('.errorTxt');
              element.parents('.servicios').find('.error').addClass('error-class');
            } else if(element.attr("name") == "sector") {
              error.insertBefore('.errorSector');
            } else {
              error.insertBefore(element);
            }
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
                  required:'Este campo es obligatorio.', 
                  rut:'Por favor revise que esté escrito correctamente'
                  },
                'cities[]' : 'Seleccione al menos una región.',
                classification : 'Debe seleccionar el rubro de su empresa',
                name : 'Este campo es obligatorio.',
                address : 'Este campo es obligatorio.',
                phone : 'Este campo es obligatorio.',
                employees : 'Seleccione el rango.',
                gain : 'Seleccione el rango.'
                },
      errorPlacement: function(error, element) {

        if (element.attr("name") == "cities[]") {
          error.insertBefore('.errorTxt');
          element.parents('.col').find('.error').addClass('error-class');
        } else if(element.attr('name') == 'employees') {
          error.insertBefore('.employees');
        } else if(element.attr('name') == 'gain') {
          error.insertAfter('.gain');
        } else if(element.attr('name') == 'classification') {
          error.insertAfter('.classification');
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
      $('.image-container').css("background-image", 'url('+img+')');
      $('.corner').html(sector);
      $('.div2').html(quantity);
      $('.div1').html('<div class="porcentaje">'+unit+'</div><br>'+sentence+'</div>');
      $('.div2-grande').html(quantity);
      $('.div1-grande').html('<div class="porcentaje-grande">'+unit+'</div><br>'+sentence+'</div>');
      $('.text-case').html(quantity+' '+unit+' '+sentence);
    });



    $('#preview-edit').click(function(e){
      e.preventDefault();
      var img = encodeURI($('#imgSalida').attr('src'));
      var quantity = $('#quantity').val();
      var unit = $('#unit').val();
      var sentence = $('#sentence').val();
      $('.image-container').css("background-image", 'url('+img+')');
      $('.corner').html($('.seleccionado').attr('id'));
      $('.div2').html(quantity);
      $('.div1').html('<div class="porcentaje">'+unit+'</div><br>'+sentence+'</div>');
      $('.div2-grande').html(quantity);
      $('.div1-grande').html('<div class="porcentaje-grande">'+unit+'</div><br>'+sentence+'</div>');
      $('.text-case').html(quantity+' '+unit+' '+sentence);
    });

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
            confirmar: {
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
            volver: function () {

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
              year:year},
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
            output += '<div class="div1"><div class="porcentaje">'+ data[i].unit+'</div><br>'+ data[i].sentence+'</div>';
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




$('#terms').on('click', function(event) {
    if($('#submit').prop('disabled') == true){
        $('#submit').prop('disabled',false);
    }else{
        $('#submit').prop('disabled',true);
    }
});

function getProvidersByService(service){
    var lis = service.parents('.row').children('.col-md-3').find('a');
        $.each(lis, function(){
            $(this).removeClass();
            $(this).addClass('link');
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
            $.each(result, function () {
                  text += '<div class="col-md-3 col-sm-6"><div class="service"><a href="/provider/'+this.id+'"><div class="image-container" title="'+this.name+'" style="background-image: url('+this.logo +')"></div></a></div></div>';
              });
            text+= '</div></div>';
            $('.results').html(text);
             var new_position = $('#horizontal-line').offset();
             window.scrollTo(new_position.left,new_position.top);
        });
}

});

