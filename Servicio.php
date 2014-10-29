<?php
function conectaBBDD(){
    //AQUI CAMBIAS LA CONFIGURACIÓN y pones la de tu servidor de Hostinger
    
    //Nombre de base de datos MySQL  en Hostinger
    $BBDD = '';
    
    //Usuario MySQL de Hostinger
    $usuario_mysql_hostinger = '';
    
    //contraseña de mysql
    $pass = '';
    
 $conexion = new mysqli('localhost', $usuario_mysql_hostinger, $pass, $BBDD);
 $consulta = $conexion ->query("SET NAMES UTF8");
 return $conexion;   
}

class ServicioDeUsuarios
{
    private $_DNI;
    private $_PASSWORD;

    public function login($dni, $password)
    {
        $conexion = conectaBBDD();
        $this->_DNI = $dni;   
        $this->_PASSWORD = $password; 

        $consulta_usuario= $conexion->query("SELECT * FROM usuariosAlmacen WHERE DNI = $dni"); 
        $num_filas = mysqli_num_rows ( $consulta_usuario);
        if($dni != "" && $dni != NULL){
            $fila = $consulta_usuario->fetch_assoc();
            $usuario = $fila['nombre'].' '.$fila['apellidos'];
            return $usuario;
        }
        return $num_filas;
    }
 
}



$servidor = new SoapServer(null, array('uri' => 'urn:webservices'));

$servidor ->setClass(ServicioDeUsuarios);


$servidor -> handle();
