<?php
    
    /**
     * Clase enlace para representar una instancia de un enlace en la aplicacion.
     */
    class Enlace{
        
        //Atributos
        private $id;
        private $url;
        private $nombre;
        private $idTipo;
        
        
        //Metodos
        public function __construct($id, $url, $nombre, $idTipo) {
            $this->id = $id;
            $this->url = $url;
            $this->nombre = $nombre;
            $this->idTipo = $idTipo;
        }
        
        function getId() {
            return $this->id;
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

        function setId($id) {
            $this->id = $id;
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

