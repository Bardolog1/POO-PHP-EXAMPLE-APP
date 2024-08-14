<?php
namespace Arithmetic;

use Interfaces\MathExecutor;

abstract class MathAbstract implements MathExecutor {
    protected  $a;
    protected $b;
    

    public function _construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }
    
    public function getA()
    {
        return $this->a;
    }
    
    public function getB()
    {
        return $this->b;
    }
    
    public function setA($a)
    {
        $this->a = $a;
    }
    
    public function setB($b)
    {
        $this->b = $b;
    }
    abstract public function executeOperation();
    
    
    
}

