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
        $(this).fadeOut();
        $('.provider-contact').fadeIn();
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

    $('.counter-num').counterUp({
        delay: 10,
        time: 1000
    });

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
});

