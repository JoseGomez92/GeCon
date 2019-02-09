<?php

    class TipoEnlace{
        
        //Atributos
        private $id;
        private $idUsuario;
        private $nombre;
        
        //Metodos
        function __construct($id, $idUsuario, $nombre) {
            $this->id = $id;
            $this->idUsuario = $idUsuario;
            $this->nombre = $nombre;
        }

        function getId() {
            return $this->id;
        }

        function getIdUsuario() {
            return $this->idUsuario;
        }

        function getNombre() {
            return $this->nombre;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setIdUsuario($idUsuario) {
            $this->idUsuario = $idUsuario;
        }

        function setNombre($nombre) {
            $this->nombre = $nombre;
        } 
        
    }

?>

