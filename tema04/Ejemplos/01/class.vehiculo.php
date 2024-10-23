<?php
/*
    clase: class.vehiculo
*/
class Class_Vehiculo
{

    private $matricula;
    private $velocidad;
    public function __construct()
    {
        $this->matricula = null;
        $this->velocidad = null;
    }
    public function getmatricula()
    {
        return $this->matricula;
    }
    public function setmatricula($matricula)
    {
        $this->matricula = $matricula;
    }





}