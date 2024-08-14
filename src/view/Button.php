<?php

namespace View;



use Interfaces\UIElement;

class Button implements UIElement {
    private $text;
    private $action;
    private $style;
    private $type;

    public function __construct($text, $action = "#", $style = "primary", $type = "button") {
        $this->text = $text;
        $this->action = $action;
        $this->style = $style;
        $this->type = $type;
    }

    public function render() {
        $buttonClass = "btn btn-$this->style btn-lg rounded-pill shadow";
        
        if($this->type == "submit") {
            return 
                "<div class='d-inline-block p-2'>
                    <form action='{$this->action}' method='post'>
                        <div class='mb-3'>
                            <input class='$buttonClass' type='submit' value='{$this->text}'>
                        </div>
                    </form>
                </div>"
            ;
        } else if($this->type == "link") {
            return 
                "<div class='d-inline-block p-2'>
                    <a href='{$this->action}' class='$buttonClass'>{$this->text}</a>
                </div>"
            ;
        } else {
            return 
                "<div class='d-inline-block p-2'>
                    <div class='mb-3'>
                        <button class='$buttonClass' type='$this->type'>{$this->text}</button>
                    </div>
                </div>";
        }
    }
}
