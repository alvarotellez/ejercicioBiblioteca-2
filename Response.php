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

    //Si queremos devolver un xml, no lo usamos. Le pasamos directamente le decimos que va a ser JSON a la fuerza
    /*
    private function xml_encode($mixed, $domElement= null, $DOMDocument = null){
        //Primera comprobacion: si es un documento DOM
        if(is_null($DOMDocument)){
            $DOMDocument = new DOMDocument;
            $DOMDocument->formatOutput = true;
            $this->xml_encode($mixed,$DOMDocument,$DOMDocument);
            //ASIGNAMOS EL DOCUMENTO PARA GUARDARLO EN EL FORMATO XML(EN MI CASO LO PINTO)
            echo $DOMDocument->saveXML();
        }else{
            //Segunda comprobacion: si es un array
            if(is_array($mixed)){
                foreach ($mixed as $index => $mixedElement){
                    if(is_int()){
                        if($index == 0){
                            $node = $domElement;
                        }else{
                            $node = $DOMDocument->createELement($domElement->tagName);
                            $domElement->parentNode->appendChild($node);
                        }
                    }else{
                        $plural = $DOMDocument->createElement($index);
                        $domElement->appendChild($plural);
                        $node = $plural;
                        if(!(rtrim($index,'s')==$index)){
                            $singular = $DOMDocument->createElement(rtrim($index,'s'));
                            $plural->appendChild($singular);
                            $node = $singular;
                        }
                    }
                    $this->xml_encode($mixedElement, $node, $DOMDocument);
                }
            }else{
                $domElement->appendChild($DOMDocument->createTextNode($mixed));
            }
        }

    }*/

}