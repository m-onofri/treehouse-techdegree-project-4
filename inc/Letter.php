<?php

class Letter extends Char
{
    private $category;

    public function __construct($content, $status, $category)
    {
        parent::__construct($content, $status);
        $this->category = $category;
    }

    public function __toString()
    {
        return "<li class='$this->status $this->category'>$this->content</li>";
    }
}