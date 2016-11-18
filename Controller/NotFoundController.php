<?php

/**
 * Created by PhpStorm.
 * User: atellez
 * Date: 18/11/16
 * Time: 8:48
 */
require_once "Controller.php";

class NotFoundController extends  Controller
{
    //ENVIAR PARA LA RESPUESTA DE ERROR SI NO SE ENVIA
    public function manage(Request $req){
        $response = new Response('404',null,null, $req->getAccept());
        $response->generate();
    }
}