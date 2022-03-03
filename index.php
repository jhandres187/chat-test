<!doctype html>
<html lang="en">
  <head>
    <title>Test chat</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var conn = new WebSocket('ws://chat.lincecostore.com.co:34:22/');//conectara
            conn.onopen = function(e) {
                console.log("Conexion exitosa!");
            };

            conn.onmessage = function(e) {
                var respuesta =JSON.parse(e.data);
                var responsemsg= document.querySelector('#response-msg');
                console.log("nombre: "+respuesta.nombre);
                console.log("mensaje: "+respuesta.mensaje);
                let html = "<div><span>"+respuesta.nombre+" :</span><p>"+respuesta.mensaje+"</p>";
                responsemsg.insertAdjacentHTML('beforeend', html);
            };
            document.querySelector('#btn').addEventListener('click',function(){
                var nombre = document.querySelector('#nombre').value;
                var mensaje = document.querySelector('#mensaje').value;
                var responsemsg= document.querySelector('#response-msg');
                var enviar = {
                    "nombre":nombre,
                    "mensaje":mensaje
                };
                conn.send(JSON.stringify(enviar));
                let html = "<div><span>Tu :</span><p>"+mensaje+"</p>";
                responsemsg.insertAdjacentHTML('beforeend',html);
            });


            // conn.send('Hello World!');
        });
    </script>
  </head>
  <body>
      <div class="container">
          <div class="row">
              <div class="col-md-6">
                  <input type="text" placeholder="nombre" name="nombre" id="nombre" class="form-control">
                  <br>
                  <textarea name="mensaje" id="mensaje" cols="30" rows="10" class="form-control"></textarea>
                  <br>
                  <div id="btn" class="btn btn-primary">enviar</div>
              </div>
              <div class="col-md-6" id="response-msg">

              </div>
          </div>
      </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
