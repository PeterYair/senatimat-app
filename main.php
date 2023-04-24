<?php
  session_start();
  if (!isset($_SESSION['login']) || $_SESSION['login'] == false){
    header('Location:../');
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

  <div class="container py-4">
    <div class="card  text-center">
      <div class="card-header bg-success">
        <h2>Sistema de Matricula</h2>
      </div>
      <div class="card-body">
          <p>
            Bienvenido a mi sistema ...
          </p>
      </div>
      <div class="card-footer text-muted">
        <a href="views/colaboradores.php"class="btn btn-outline-secondary" type="button">Colaboradores</a>
        <a href="views/estudiantes.php"class="btn btn-outline-secondary" type="button">Estudiantes</a>
        <a href="controllers/usuario.controller.php?operacion=finalizar"class="btn btn-outline-secondary">Cerrar Sesión</a>
      </div>
    </div>
  </div>
  
</body>
</html>