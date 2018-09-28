$(document).ready(function () {

  $("#modal-setting").modal("show");

  $('#modal-send').click(function(){
    console.log($("select#foo option:checked").val());
  });

    $('#send-survey').click(function(event){
      event.preventDefault();
      var data = $('#survey-form').serialize();
      $('#survey-form').submit();
    });


    $('.service-filter').click(function(event) {
        event.preventDefault();
        var lis = $(this).parents('.container').children('.row').children('.col-md-3').find('a');
        $.each(lis, function(){
            $(this).removeClass();
        });
        $(this).addClass('selected');
        //var title = $(this).parents('.service').find('h3').text();
        var title = $(this).text();
        var serviceId = $(this).parents('li').data('id');
        var url = $('#form-filter').attr('action').replace(':SERVICE_ID', serviceId);
        var data = $('#form-filter').serialize();

        $.post(url, data, function (result){
            $('.results').children('container').remove();
            var text ='';
            text = '<div class="container"><h3>'+title+'</h3><div class="row">';
            $.each(result, function () {
                  text += '<div class="col-md-3"><a href="/provider/'+this.id+'"><img class="img-fluid w-100-h-200 image-provider" src="'+this.logo +'" alt="'+this.name +'"><div class="middle-provider"><div class="text-provider">'+this.name +'</div></div></a></div>';
              });
            text+= '</div></div>';
            $('.results').html(text);
             var new_position = $('#results').offset();
             window.scrollTo(new_position.left,new_position.top);
        });
    });


    $('.provider-btn').click(function(e){
        e.preventDefault();
        $('.provider-contact').toggle();
        var id = $(this).data('id')
        var url = $('#form-counter').attr('action').replace(':PROVIDER_ID', id);
        var data = $('#form-counter').serialize();
        $.post(url, data);

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
            console.log(data);
            var url = form.attr('action');
            $("#view-more-providers").html("Cargando....");
            $.ajax({
               url : url,
               method : "POST",
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
      console.log(e.target.files);
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
          console.log($(this));
        }
     });



     //LOGIN

     $('#submit-login').click(function(e){
        e.preventDefault();
        var form = $(this).parents('.form-horizontal');

        form.validate({
          rules: {
            'email-login': { required : true, email: true},
            'password-login' : {required:true}
          },
          messages: {
             'email': {
                required: "Ingrese su correo electrónico.",
                email: "Su correo electrónico debe ser válido.",
             },
             'password-login': {
                required: "Ingrese su clave."
             }
          }
        });


          form.submit();
     });



     //REGISTER

     $('#submit-register').click(function(e){
        e.preventDefault();
        var form = $(this).parents('.form-horizontal');

        form.validate({
          rules: {
            'email-register': { required : true, email: true},
            'password-register' : {required:true},
            'password-register_confirmation' : {required:true}
          },
          messages: {
             'email-register': {
                required: "Ingrese su correo electrónico.",
                email: "Su correo electrónico debe ser válido.",
             },
             'password-register': {
                required: "Ingrese su clave."
             },
             'password-register_confirmation': {
                required: "Confirme su clave."
             }
          }
        });

        if($('#password-register').val() == $('#password-confirm').val() && $('#email-register').val().length > 4){
          form.submit();
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

});

