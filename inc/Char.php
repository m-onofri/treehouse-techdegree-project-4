<?php

class Char
{
    protected $content;
    protected $status;
    protected $animate;

    public function __construct($content, $status, $animate = false)
    {
        $this->content = $content;
        $this->status = $status;
        $this->animate = $animate;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setStatus($newStatus)
    {
        $this->status = $newStatus;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setAnimate($bool)
    {
        $this->animate = $bool;
    }

    public function __toString()
    {
        return "<li class='$this->status $this->category'>$this->content</li>";
    }
}