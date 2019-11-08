<?php

class Key extends Char
{
    private $animation = 'animated jello';
    
    public function __toString()
    {
        $classAttrs = "$this->status";
        if ($this->animate) {
            $classAttrs .= " $this->animation";
        }
        
        $html = "<input type='submit' name='key' value='$this->content' class='$classAttrs'";

        if ($this->status != 'active') {
            $html.=" disabled";
        } 

        $html.= "/>";

        return $html;
    }
}