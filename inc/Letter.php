<?php

class Letter
{
    private $content;
    private $category;
    private $status;

    public function __construct($content, $category, $status)
    {
        $this->content = $content;
        $this->category = $category;
        $this->status = $status;
    }

    public function __toString()
    {
        return "<li class='$this->status $this->category'>$this->content</li>";
    }
}