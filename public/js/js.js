$(document).ready(function () {

/*    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        if($("#menu-toggl").text() == 'arrow_back'){
            $("#menu-toggl").text('arrow_forward');
        }else{
            $("#menu-toggl").text('arrow_back');
        }
    });*/


});



jQuery('input[type=file]').change(function(e){
    if(Object.keys(e.currentTarget.files).length > 1)
        $("#file").text(Object.keys(e.currentTarget.files).length + ' archivos selecionados');
    else{
     var filename =  e.currentTarget.files[0].name;
     $("#file").text(filename);
    }
});

    function archivo(evt) {
      var files = evt.target.files; // FileList object
console.log (files);
      // Obtenemos la imagen del campo "file".
      for (var i = 0, f; f = files[i]; i++) {
        //Solo admitimos imágenes.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        reader.onload = (function(theFile) {
            return function(e) {
              // Insertamos la imagen
             document.getElementById("list").innerHTML = ['<img class="rounded img-fluid" style="width: 300px" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
            };
        })(f);

        reader.readAsDataURL(f);
      }
    }

document.getElementById('files').addEventListener('change', archivo, false);



