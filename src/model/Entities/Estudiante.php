<?php

namespace Model;


use Model\Persona;

class Estudiante extends Persona{
    private  Notas $notas;

    public function __construct($nombre, Notas $notas) {
        parent::__construct($nombre);
       $this->notas = $notas;
    }
    
    public function getNotas() {
        return $this->notas;
    }
    
    public function setNotas(Notas $notas) {
        $this->notas = $notas;
    }

    
    public function __destruct() {
        echo "";
    }
    
    
    public function toArray() {
        return [
            'nombre' => $this->getNombre(),
            'nota1' => $this->notas->getNota1(),
            'nota2' => $this->notas->getNota2(),
            'nota3' => $this->notas->getNota3(),
            'nota_final' => $this->notas->getNotaFinal(),
            'porcentaje_global' => $this->notas->getPorcentajeGlobal()
        ];
    }
    
    
   
}
