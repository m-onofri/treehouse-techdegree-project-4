<?php

class Letter extends Char
{
    private $category;
    private $animation = "animated flipInY";

    //It takes 4 parameters: content (string), status (string), category (string) andanimate (boolean, by default false)
    public function __construct($content, $status, $category, $animate = false)
    {
        parent::__construct($content, $status, $animate);
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    /*It takes no parameters
    **It returns a string containing the HTML specifically displaying a Letter */
    public function __toString()
    {
        $classAttrs = "letter $this->status $this->category";
        if ($this->animate) {
           $classAttrs .= " $this->animation";
        }
        return "<div class='$classAttrs'>$this->content</div>";
    }
}