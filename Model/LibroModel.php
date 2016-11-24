<?php

/**
 * Created by PhpStorm.
 * User: atellez
 * Date: 24/11/16
 * Time: 10:32
 */
class LibroModel implements JsonSerializable
{

    private $isbn;
    private $titulo;
    private $ejemplares;
    private $precio;

    function jsonSerialize()
    {
        return array(
            'isbn' => $this->isbn,
            'titulo' => $this->titulo,
            'ejemplares'=>$this->ejemplares,
            'precio' => $this->precio
        );
    }

    public function __sleep()
    {
        return array('titulo','codigo','numpag');
    }

    /**
     * @return mixed
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param mixed $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getEjemplares()
    {
        return $this->ejemplares;
    }

    /**
     * @param mixed $ejemplares
     */
    public function setEjemplares($ejemplares)
    {
        $this->ejemplares = $ejemplares;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }


}