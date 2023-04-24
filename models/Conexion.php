<?php
// Esta clase permitira a alos modelos acceder y consumir los datos 
class Conexion {

  //Atributos
  private $host = "localhost";      //Servidor
  private $port = "3306";           //Puerto comuncacion BD
  private $database = "senatimat";     //Nombre BD
  private $charset = "UTF8";        //Codificacion (idioma)
  private $user = "root";           //Usuario (raiz)
  private $password = "";           //Contraseña

  //Atributo (instancia PDO) que almacena la conexion
  private $pdo;

  //Metodo1: Acceder a la BD
  private function conectarServidor(){
    //Constructor:
    //new PDO("CADENA_CONEXION, "USER", "PASSWORD");
    $conexion = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->database};charset={$this->charset}", $this->user, $this->password);

    return $conexion;
  }

  //Metodo2: Retorna el acceso
  public function getConexion(){
    try{
        //Pasaremos la conexion al atributo/objeto pdo
        $this->pdo = $this->conectarServidor();

        //Controlar errores (sera controlado por los TRY-CATCH)
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Retornamos la conexion al modelo que lo necesite
        return $this->pdo;
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
}