<?php

/**
 * Created by PhpStorm.
 * User: atellez
 * Date: 18/11/16
 * Time: 8:47
 */
class Controller
{
    //SON LOS CONTROLADORES DE LOS VERBOS, POR DEFECTO NOS VA A DEVOLVER UN CÓDIGO DE ERROR
    //HAY QUE HACER UN EXTENDS DE ESTA CLASE EN CADA CONTROLLER

    public function manageGetVerb(Request $request){
        $response = new Response('405',null,null,$request->getAccept());
        $response->generate();
    }

    public function managePostVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function managePutVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function managePatchVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageDeleteVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageHeadVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageTraceVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageOptionsVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

    public function manageConnectVerb(Request $request)
    {
        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }
}