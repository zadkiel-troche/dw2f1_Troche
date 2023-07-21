<?php
  require("procesar.php");
  $res=mostrarMensajes($mysqli)
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sugerencias</title>
  </head>
  <body>

    <div class="container mt-4 mb-4" id="cabecera">
      <h1>Mensajes</h1>
    </div>

      <?php
        while ($data=mysqli_fetch_array($res))
       {
          echo '
          <div class="container mb-4" style="border-style: dotted;">
            <div class="row mt-3 mb-3">
              <div class="col-md-6 row" id="usuario">
                <div class="col-md-2" style="align-items: center;">
                  <img src="./img/usuario.png" width="70px" />
                </div>

                <div class="col-md-4">
                  <p>'.
                    $data["usuario"].' <br>
                    '.$data["email"].' <br> '.$data["fecha"].'
                  </p>
                </div>
              </div>

              <div class="col-md-6" >
                <p>
                    <span class="fw-bold">Mensaje:</span> <br>
                  '.$data["contenido"].'
                </p>
              </div>
           </div>
          </div>
          ';
       }

        if($data==' '){
          echo('
            <div class="container mb-4">
            <div class="alert alert-info" role="alert">
              No hay datos para mostrar
            </div>
            </div>
          ');
        }
    ?>

    <div class="container mt-4 mb-4" id="formulario">
      <h2>Crear nuevo mensaje</h2>
      <form method="POST" action="procesar.php">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text" name="nombre" class="form-control" id="nombre">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email:</label>
          <input type="enabled" name="email" class="form-control" id="exampleInputEmail1">
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Mensaje:</label>
          <textarea class="form-control" name="mensaje" id="message" rows="3"></textarea>
        </div>
        <input type="submit" name="enviar" class="btn btn-primary col-12" value="Enviar">
      </form>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>