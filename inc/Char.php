<?php

class Char
{
    protected $content;
    protected $status;

    public function __construct($content, $status)
    {
        $this->content = $content;
        $this->status = $status;
    }

    public function __toString()
    {
        return "<li class='$this->status $this->category'>$this->content</li>";
    }
}