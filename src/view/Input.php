<?php

namespace View;

use Interfaces\UIElement;

class Input implements UIElement
{
    private $name;
    private $label;
    private $attributes = [];
    private $errorMsg = "";
    
    public function __construct($name, $label, $required = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->attributes['required'] = $required ? 'required' : '';
    }
    
    public function setType($type)
    {
        $this->attributes['type'] = $type;
        return $this;
    }

    public function setMin($min)
    {
        $this->attributes['min'] = $min;
        return $this;
    }

    public function setMax($max)
    {
        $this->attributes['max'] = $max;
        return $this;
    }

    public function setStep($step)
    {
        $this->attributes['step'] = $step;
        return $this;
    }

    public function setPlaceholder($placeholder)
    {
        $this->attributes['placeholder'] = $placeholder;
        return $this;
    }

    public function setValue($value)
    {
        $this->attributes['value'] = $value;
        return $this;
    }
    
    public function setErrorMsg($errorMsg)
    {
        $this->errorMsg = $errorMsg;
    }

    private function buildAttributes()
    {
        $attributesString = "";
        foreach ($this->attributes as $key => $value) {
            if ($value !== '') {
                $attributesString .= "$key='$value' ";
            }
        }
        return trim($attributesString);
    }
    
    public function render()
    {
        $inputHTML = "";
        $attributesString = $this->buildAttributes();
     
        $inputHTML .= "<div class='form-group'>";
        $inputHTML .= "<label for='$this->name'>$this->label</label>";
        $inputHTML .= "<input name='$this->name' id='$this->name' $attributesString class='form-control'>";
        if($this->errorMsg !== "") {
            $inputHTML .= "<div id='{$this->name}Help' class='form-text'>{$this->errorMsg}</div>";
        }
        $inputHTML .= "</div>";
        
        return $inputHTML; 
    }
}
