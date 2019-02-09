<?php
    
    /**
     * Clase enlace para representar una instancia de un enlace en la aplicacion.
     */
    class Enlace{
        
        //Atributos
        private $idEnlace;
        private $idUsuario;
        private $url;
        private $nombre;
        private $idTipo;
        
        
        //Metodos
        public function __construct($idEnlace, $idUsuario, $url, $nombre, $idTipo) {
            $this->idEnlace = $idEnlace;
            $this->idUsuario = $idUsuario;
            $this->url = $url;
            $this->nombre = $nombre;
            $this->idTipo = $idTipo;
        }
        
        function getIdEnlace() {
            return $this->idEnlace;
        }
        
        function getIdUsuario() {
            return $this->idUsuario;
        }

        function getUrl() {
            return $this->url;
        }

        function getNombre() {
            return $this->nombre;
        }

        function getIdTipo() {
            return $this->idTipo;
        }

        function setIdEnlace($idEnlace) {
            $this->idEnlace = $idEnlace;
        }
        
        function setIdUsuario($idUsuario) {
            $this->idUsuario = $idUsuario;
        }

        function setUrl($url) {
            $this->url = $url;
        }

        function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        function setIdTipo($idTipo) {
            $this->idTipo = $idTipo;
        }
        
    }

?>

