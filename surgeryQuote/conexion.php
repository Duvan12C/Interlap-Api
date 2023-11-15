<?php
    class Conexion
    {
        private $servidor;
        private $usuario;
        private $clave;
        private $basedatos;
        public $conActiva;

        public function __construct($servidor, $usuario, $clave, $basedatos)
        {
            $this->servidor = $servidor;
            $this->usuario = $usuario;
            $this->clave = $clave;
            $this->basedatos = $basedatos;
        }

        public function Conectar()
        {
            $miconexion = new mysqli($this->servidor, $this->usuario, $this->clave, $this->basedatos);
            // Validar si conecta la BD.
            if ($miconexion->connect_errno) {
                $mensaje = 'Error de conexion...';
                $miconexion->connect_error;
            } else {
                $mensaje = 'Conexion exitosa...';
                $this->conActiva = $miconexion;
                $this->conActiva->set_charset("utf8mb4");
            }
            return $mensaje;
        }
    }

    // Para probar la conexion
    $con = new Conexion('localhost', 'bariatr5_interlap', '29$$10Interlap', 'bariatr5_interlap');
    $con->Conectar();
    /* La variable $conx podra ser usada en cualquier lugar 
    donde se llame la conexion */
    $conx = $con->conActiva;
?>
