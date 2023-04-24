<?php
session_start();
  if (isset($_SESSION['login']) && $_SESSION['login']){
    header('Location:main.php');
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenido</title>

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>
<body>

<div class="container">
    <div class="row mt-3">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-primary text-light">
            <strong>Inicio de Sesión</strong>
          </div>
          <div class="card-body">
            <form action="">
              <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" id="usuario" class="form-control form-control-sm" autofocus>
              </div>
              <div class="mb-3">
                <label for="clave" class="form-label">Contraseña:</label>
                <input type="password" id="clave" class="form-control form-control-sm">
              </div>
            </form>
          </div>
          <div class="card-footer text-muted">
            <button type="button" class="btn btn-success" id="iniciar-sesion">Iniciar Sesion</button>
          </div>
        </div>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
  
 <!-- jQuery -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
  $(document).ready(function (){

    function iniciarSesion(){
      const usuario = $("#usuario").val();
      const clave = $("#clave").val();

      if (usuario != "" && clave != ""){
        $.ajax({
          url: 'controllers/usuario.controller.php',
          type: 'POST',
          data: {
            operacion     : 'login',
            nombreusuario : usuario,
            claveIngresada: clave
          },
          dataType: 'JSON',
          success: function (result){
            console.log(result);
            if (result["status"]){
              window.location.href = "main.php";
            }else{
              alert(result["mensaje"]);
            }
          }
        });
      }
    }

    $("#iniciar-sesion").click(iniciarSesion);

  })
</script>



</body>
</html>