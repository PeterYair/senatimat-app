<?php

require_once '../models/Estudiante.php';

if(isset($_POST['operacion'])) {

  $estudiante = new Estudiante();

  if ($_POST['operacion'] == 'registrar'){

    //PASO 1: Recolectar todos los valores enviados por la vista y almacenarlos en un array asociativo
    // ARRAY ASOCIATIVO:    clave  :  valor
    $datosGuardar = [
      "apellidos"          =>$_POST['apellidos'],
      "nombres"            =>$_POST['nombres'],
      "tipodocumento"      =>$_POST['tipodocumento'],
      "nrodocumento"       =>$_POST['nrodocumento'],
      "fechanacimiento"    =>$_POST['fechanacimiento'],
      "idcarrera"          =>$_POST['idcarrera'],
      "idsede"             =>$_POST['idsede'],
      "fotografia"         => ''
    ];

    //Vamos a verficar si la vista nos envió una FOTOGRAFIA // NO GUARDAMOS LA IMAGEN SI NO LA RUTA
    if (isset($_FILES['fotografia'])){

      $rutaDestino = '../views/img/fotografias/';
      $fechaActual = date('c'); //C = complete, AÑO/MES/DIA/MINUTO/SEGUNDO
      $nombreArchivo = sha1($fechaActual) . ".jpg";
      $rutaDestino .= $nombreArchivo;

      //Guardamos la fotografia en el servidor
      if (move_uploaded_file($_FILES['fotografia']['tmp_name'], $rutaDestino)){
        $datosGuardar['fotografia'] = $nombreArchivo;
      }
    }


    //PASO 2: Enviar el array al método registrar 
    $estudiante->registrarEstudiante($datosGuardar);

  }

  if ($_POST['operacion']=='listar'){
    $data = $estudiante->listarEstudiante();
      if ($data){
        $numeroFila = 1;
        $botonNulo = " <a href='#' class='btn btn-sm btn-outline-primary' title='No tiene fotografía'><i class='bi bi-eye-slash-fill'></i></a>";
        foreach($data as $registro){
          $datosEstudiante = $registro['apellidos']. ' ' . $registro['nombres'];
          echo "
            <tr>
              <td>{$numeroFila}</td>,
              <td>{$registro['apellidos']}</td>
              <td>{$registro['nombres']}</td>
              <td>{$registro['tipodocumento']}</td>
              <td>{$registro['nrodocumento']}</td>
              <td>{$registro['fechanacimiento']}</td>
              <td>{$registro['carrera']}</td>
              <td>
                        
                <a href='#' class=' eliminar btn btn-sm btn-outline-danger'title='Eliminar'data-codigo='{$registro['idestudiante']}'><i class='bi bi-trash'></i></a>
          ";

          //La segunda parte a Renderizar, es el boton VER FOTOGRAFIA
          if ($registro['fotografia']== ''){
            echo $botonNulo;
          }else{
            echo "<a href='../views/img/fotografias/{$registro['fotografia']}' data-lightbox='{$registro['idestudiante']}' data-title='{$datosEstudiante}' class='btn btn-sm btn-outline-primary'title='ver'><i class='bi bi-eye-fill'></i></a>";
          }
          
          echo "
              </td>
            </tr>
          ";
          
          $numeroFila++;
        }
      }
  }

  if ($_POST['operacion'] == 'eliminar'){
    $estudiante->eliminar($_POST['idestudiante']);
  }

}
?>