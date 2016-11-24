<?php

/**
 * Created by PhpStorm.
 * User: atellez
 * Date: 24/11/16
 * Time: 9:39
 */
class DatabaseModel
{
    private $_connection;
    private static $_instance;

    //Obtenemos una instancia de la base de datos
    public static function getInstance(){
        if (!(self::$_instance instanceof  self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct(){
        $config = parse_ini_file('config/config.ini'); //Tiene la ruta donde esta lo necesario para acceder a la BD
        //Le pasamos todos los datos que hay en el config.ini a la nueva conexion
        $this->_connection=new mysqli($config['host'],$config['username'],$config['password'],$config['dbname']);

        //Nos muestra un error si no podemos conectarnos a MySQL
        if ($this->_connection->connect_error){
            trigger_error("Imposible conectar con MySQL" . $this->_connection->connect_error,E_USER_ERROR);
        }
    }
    //Duplica la conexion de forma preventiva
    public function __clone()
    {
        trigger_error("Clonando " . get_class($this)." no esta permitido: ",E_USER_ERROR);
    }
    //Duplica serializado a descerializado
    public function  __wakeup()
    {
        trigger_error("Deserializacion de " . get_class($this) ." no permitido: ",E_USER_ERROR);
    }
    //Obtener la conexion
    public function getConnection(){
        return $this->_connection;
    }
    //Cerrar la conexion
    public function closeConnection(){
        $this->_connection->close();
        self::$_instance=null;
    }
    //Reconectar
    public function reconnect(){
        $this->_connection->close();
        self::$_instance=null;
        return self::getInstance()->getConnection();
    }
}