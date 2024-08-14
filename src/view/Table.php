<?php

namespace View;


use Interfaces\UIElement;


class Table implements UIElement
{
    private $data = array();
    private $titles = array();
    

    public function setData($data)
    {
        $this->data = $data;
    }
    
    
    
    public function getData()
    {
        return $this->data;
    }
    
   
    public function setTitles($titles)
    {
        $this->titles = $titles;
    }
    
    public function getTitles()
    {
        return $this->titles;
    }
    
    public function makeColumns()
    {
        $html = "<tr>";
        foreach($this->titles as $title)
        {
            $html .= "<th class='text-center'>$title</th>";
        }
        $html .= "</tr>";
        return $html;
    }
    
    public function makeRows()
    {
        $html = "";
        foreach($this->data as $row)
        {
            $html .= "<tr>";
            foreach($row as $column)
            {
                $html .= "<td class='text-center'>$column</td>";
            }
            $html .= "</tr>";
        }
        return $html;
    }
    
    public function makeTable()
    {
        $html = "<table class='table table-striped table-bordered mt-4'>";
        
        $html .= "<thead class='thead-dark'>";
        $html .= $this->makeColumns();
        $html .= "</thead>";
        
        $html .= "<tbody>";
        $html .= $this->makeRows();
        $html .= "</tbody>";
        
        $html .= "</table>";
        
        
        return $html;
    }
    
    
    public function render()
    {
        return $this->makeTable();
    } 
    
}