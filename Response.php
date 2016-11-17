<?php

/**
 * Created by PhpStorm.
 * User: atellez
 * Date: 17/11/16
 * Time: 10:07
 */
//ESTA CLASE SIRVE PARA MANEJAR LA RESPUESTA
class Response
{
    private $code;
    private $headers;
    private $body;
    private $format;

    //CONSTRUCTOR, SI HA LLEGADO HASTA AQUÍ LE PONEMOS EL CODIGO 200, QUE SIGNIFICA ESTA OK!
    public function __construct($code='200',$headers=null,$body=null,$format='json')
    {
        $this->code = $code;
        $this->headers = $headers;
        $this->body = $body;
        $this->format = $format;
    }

    //METODO PARA GENERAR LA RESPUESTA DE LA PETICIÓN
    public function generate(){
        switch ($this->format){
            case 'json':
                break;
            case 'unsupported':
                //Si el body es distnto de null o json devuelve un error 406, diciendo que no soprta ese formato
                if($this->body!=null){
                    $this->code = '406';
                    $this->body = null;
                }
                break;
        }
        http_response_code($this->code);//Codigo de respuesta, puede ser o 200 o 4006

        if(isset($this->headers)){
            foreach ($this->headers as $key=>$value){
                header($key. ' : '.$value);
            }
        }
        //Si no esta vacio el cuerpo de la respuesta nos pinta el cuerpo
        if(!empty($this->body)){
            echo $this->body;
        }
    }
}