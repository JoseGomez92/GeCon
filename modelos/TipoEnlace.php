<?php

    class TipoEnlace{
        
        //Atributos
        private $id;
        private $idUsuario;
        private $nombre;
        private $imagen;
        
        //Metodos
        function __construct($id, $idUsuario, $nombre, $imagen) {
            $this->id = $id;
            $this->idUsuario = $idUsuario;
            $this->nombre = $nombre;
            $this->imagen = $imagen;
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
        
        function getImagen() {
            return $this->imagen;
        }

        function setImagen($imagen) {
            $this->imagen = $imagen;
        }

    }

?>

