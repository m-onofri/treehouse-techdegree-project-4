<?php

class Letter extends Char
{
    private $category;
    private $animation = "animated flipInY";

    public function __construct($content, $status, $category, $animate = false)
    {
        parent::__construct($content, $status, $animate);
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function __toString()
    {
        $classAttrs = "letter $this->status $this->category";
        if ($this->animate) {
           $classAttrs .= " $this->animation";
        }
        return "<div class='$classAttrs'>$this->content</div>";
    }
}