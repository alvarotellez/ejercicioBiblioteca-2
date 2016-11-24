<?php

/**
 * Created by PhpStorm.
 * User: atellez
 * Date: 18/11/16
 * Time: 8:47
 */
require_once "Controller.php";

class LibroController extends Controller
{
    public function manageGetVerb(Request $request)
    {
        $listaLibros = null;
        $id = null;
        $response = null;
        $code = null;

        //El dos es la segunda posicion de la ruta desde el dominio(0)
        if(isset($request->getUrlElements()[2])){
            $id = $request->getUrlElements()[2];
        }

        $listaLibros = LibroHandlerModel::getLibro($id);

        if($listaLibros!=null){
            $code = '200';

        }else{
            if (LibroHandlerModel::isValid($id)){
                $code = '404';

            }else{
                $code = '400';
            }
        }

        $response = new Response($code, null, $listaLibros, $request->getAccept());
        $response->generate();
    }
}