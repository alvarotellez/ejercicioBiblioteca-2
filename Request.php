<?php

/**
 * Created by PhpStorm.
 * User: atellez
 * Date: 17/11/16
 * Time: 10:06
 */

//ESTA CLASE SE ENCARGA DE MANEJAR LA PETICION DEL CLIENTE
class Request
{
    private $url_elements;
    private $query_string;
    private $verb; //ES EL VERBO DE LA ACCIÓN QUE VAMOS A REALIZAR
    private $body_parameters; //SON LOS PARÁMETROS QUE LE PASAMOS A LA PETICION
    private $format;//EL FORMATO QUE ACEPTA NUESTRO REST
    private $accept;

    public function __construct($verb,$url_elemnts,$query_string,$body,$content_type,$accept)
    {
        $this->verb = $verb;
        $this->url_elements = $url_elemnts;
        $this->query_string = $query_string;
        $this->parseBody($body,$content_type); //EL PARSE BODY LO DEFINIMOS DEBAJO
        //EN ESTE SWITCH LE DECIMOS QUE FORMATOS VAMOS A ACEPTAR EN LA PETICION
        switch ($accept){
            case 'application/json': //POR DEFECTO SERA JSON
            case '*/*':
            case null:
                $this->accept='json';
                break;
            default:
                $this->accept='unsupported';
                break;
        }
        return true;//NO SIRVE PARA NADA
    }
    //CUERPO DE LA PETICIÓN QUE SE NOS REALIZA Y ALMACENA LOS DATOS EN UN ARRAY
    private function parseBody($body,$content_type){
        $parameters = array();

        switch ($content_type){
            case "application/json":
                $this->format="json";
                $parameters = json_decode($body);//Decodifica el $body y lo mete en el array
                $body_params = json_decode($body);
                break;
            default:
                break;
        }
        $this-> body_parameters = $parameters; //Añadimos los parametros  al cuerpo de los parametros

    }

    //AUTOGENERADOS
    /**
     * @return mixed
     */
    public function getUrlElements()
    {
        return $this->url_elements;
    }

    /**
     * @param mixed $url_elements
     */
    public function setUrlElements($url_elements)
    {
        $this->url_elements = $url_elements;
    }

    /**
     * @return mixed
     */
    public function getQueryString()
    {
        return $this->query_string;
    }

    /**
     * @param mixed $query_string
     */
    public function setQueryString($query_string)
    {
        $this->query_string = $query_string;
    }

    /**
     * @return mixed
     */
    public function getVerb()
    {
        return $this->verb;
    }

    /**
     * @param mixed $verb
     */
    public function setVerb($verb)
    {
        $this->verb = $verb;
    }

    /**
     * @return mixed
     */
    public function getBodyParameters()
    {
        return $this->body_parameters;
    }

    /**
     * @param mixed $body_parameters
     */
    public function setBodyParameters($body_parameters)
    {
        $this->body_parameters = $body_parameters;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getAccept()
    {
        return $this->accept;
    }

    /**
     * @param string $accept
     */
    public function setAccept($accept)
    {
        $this->accept = $accept;
    }



}