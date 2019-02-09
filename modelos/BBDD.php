<?php

    /**
     * Clase para interactuar con la base de datos
     */
    abstract class BBDD{
         
         //Atributos
         private $host = "localhost";
         private $user = "root";
         private $pass = "";
         private $bd = "gecon";
         protected $conex;
         
         public function __construct() {
            $this->conex = mysqli_connect($this->host, $this->user, $this->pass, $this->bd);
         }
         
         public function cerrarConex(){
             mysqli_close($this->conex);
         }    
         
     }

?>
