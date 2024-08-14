<?php
namespace Arithmetic;

use Arithmetic\MathAbstract;
use Interfaces\UIElement;
use View\Table;

class TablaMultiplicar extends MathAbstract implements UIElement {

    private $multiplicando;
    private $limit;
    private $tabla = [];
    
    public function __construct($multiplicando, $limit) {
        $this->multiplicando = $multiplicando;
        $this->limit = $limit;
    }
    
    public function getTabla() {
        return $this->tabla;
    }
    
    public function setTabla($tabla) {
        $this->tabla = $tabla;
    }
    
    public function executeOperation() {
        return $this->_generateTable();
    }
    
    public function _generateTable() {
        $tabla = array();
        for ($i = 0; $i <= $this->limit; $i++) {
            $tabla[] = $this->multiplicando * $i;
        }
        $this->tabla = $tabla;
    }

    public function paintTable()
    {
        $tablaUI = new Table();
        $tablaUI->setTitles(["Operación", "Resultado"]);
        $tablaUI->setData( array_map(function($index, $value) {
            return ["$this->multiplicando x $index", $value];
        }, array_keys($this->tabla), $this->tabla)
        );
        return $tablaUI;
    }
    
    public function render() {
        echo "<div class='table-responsive' style='max-height: 400px; overflow-y: auto;'>";
        echo $this->paintTable()->render();
        echo "</div>";
    }
    
}
