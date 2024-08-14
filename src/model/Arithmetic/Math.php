<?php

namespace Arithmetic;

use Arithmetic\MathAbstract; 

class Math extends MathAbstract  
{
    private $operation;  
    private $summation = [];  


    public function __construct($a, $b, $operation, $summation = []) 
    {
        parent::_construct($a, $b); 
        $this->operation = $operation;
        $this->summation = $summation;
    }

    public function getOperation()
    {
        return $this->operation;
    }

    public function setOperation($operation)
    {
        $this->operation = $operation;
    }

    public function getSummation()
    {
        return $this->summation;
    }

    public function setSummation($summation)
    {
        $this->summation = $summation;
    }

    public function _sum()
    {
        return $this->a + $this->b;
    }

    public function _summation()
    {
        return array_reduce($this->summation, function ($a, $b) {
            return $a + $b;
        }, 0);
    }


    public function _substract()
    {
        return $this->a - $this->b;
    }

    public function _multiply()
    {
        return $this->a * $this->b;
    }

    public function _divide()
    {
        return $this->a / $this->b;
    }

    public function _module()
    {
        return $this->a % $this->b;
    }

    public function _pow()
    {
        $cadena = "{$this->a} ^ {$this->b} = ";
        for ($i = 0; $i < $this->b; $i++) {
            $cadena .= $this->a;
            if ($i < $this->b - 1) {
                $cadena .= " * ";
            }
        }
        $cadena .= " = " . pow($this->a, $this->b);
        return $cadena;
    }

    public function _sqrt()
    {
        return sqrt($this->a);
    }

    public function executeOperation()
    {
        switch ($this->operation) {
            case 'sum':
                return $this->_sum();
            case 'substract':
                return $this->_substract();
            case 'multiply':
                return $this->_multiply();
            case 'divide':
                return $this->_divide();
            case 'module':
                return $this->_module();
            case 'pow':
                return $this->_pow();
            case 'sqrt':
                return $this->_sqrt();
            case 'summation':
                return $this->_summation();
            default:
                return "Operación no válida";

        }
    }
}

?>