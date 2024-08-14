<?php

namespace Model;

use Arithmetic\Math;

class Notas
{
    private $notaFinal;

    private $nota1;
    private $nota2;
    private $nota3;
    private $porcentajeGlobal;

    public function __construct($nota1, $nota2, $nota3)
    {
        $this->nota1 = $nota1;
        $this->nota2 = $nota2;
        $this->nota3 = $nota3;
    }

    public function getNota1()
    {
        return $this->nota1;
    }

    public function getNota2()
    {
        return $this->nota2;
    }

    public function getNota3()
    {
        return $this->nota3;
    }

    public function setNota1($nota1)
    {
        $this->nota1 = $nota1;
    }

    public function setNota2($nota2)
    {
        $this->nota2 = $nota2;
    }

    public function setNota3($nota3)
    {
        $this->nota3 = $nota3;
    }

    public function getNotaFinal()
    {
        return $this->notaFinal;
    }



    public function calcularNotaFinal()
    {
        $math = new Math($this->nota1, 0, 'multiply');
        $math->setB(0.3);
        $this->notaFinal = $math->executeOperation();

        $math->setA($this->nota2);
        $math->setB(0.3);
        $this->notaFinal += $math->executeOperation();

        $math->setA($this->nota3);
        $math->setB(0.4);
        $this->notaFinal += $math->executeOperation();

        $this->calcularPorcentajeGlobal($this->notaFinal);

        return $this->notaFinal;
    }


    private function calcularPorcentajeGlobal($notaFinal)
    {
        $notaMaxima = 5;
        $this->porcentajeGlobal = ($notaFinal / $notaMaxima) * 100 . '%';
        return $this->porcentajeGlobal;
    }



    public function getPorcentajeGlobal()
    {
        return $this->porcentajeGlobal;
    }

}