<?php

/**
 * Created by PhpStorm.
 * User: atellez
 * Date: 24/11/16
 * Time: 10:12
 */
require_once "ConsLibrosModel.php";

class LibroHandlerModel
{
   public static function getLibro($id){

       $listaLibros = null;

       $db = DatabaseModel::getInstance();
       $db_connection = $db->getConnection();


       $valid = self::isValid($id);
        //Usamos \ConstantesDB\ que es el namespace de ConsLibrosModel, por si hiciera falta cambiar algo solo tocamos en esa carpeta y se cambia solo
       if($valid == true || $id == null){
           $query = "SELECT " . \ConstantesDB\ConsLibrosModel::ISBN . ","
               .\ConstantesDB\ConsLibrosModel::TITULO
               .",".\ConstantesDB\ConsLibrosModel::EJEMPLARES.
               "," . \ConstantesDB\ConsLibrosModel::PRECIO
               ."FROM" . \ConstantesDB\ConsLibrosModel::TABLE_NAME;


           //Esto lo usamos si el id es distinto de null
           if($id != null){
           $query = $query ."WHERE" . \ConstantesDB\ConsLibrosModel::ISBN ." = ?";
           }

           $prep_query = $db_connection->prepare($query);


           if($id != null){
               $prep_query->bind_param('s',$id);
           }

           $prep_query->execute();
           $listaLibros = array();


           $prep_query-> bind_result($isbn, $titulo, $precio, $ejemplares);
            while($prep_query->fetch()){

                $titulo =utf8_encode($titulo);
                $libro = new LibroModel($isbn, $titulo, $precio,$ejemplares);
                $listaLibros[] = $libro;
            }
       }
       $db->closeConnection();

       return $listaLibros;
   }
   public static function isValid($id){
       $res = false;

       if(ctype_digit($id)){
           $res = true;
       }
       return $res;
   }

}