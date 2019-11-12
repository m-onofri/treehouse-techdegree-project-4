<?php

abstract class Char
{
    protected $content;
    protected $status;
    protected $animate;

    //It takes 3 parameters: content (string), status (string) and animate (boolean, by default false)
    public function __construct($content, $status, $animate = false)
    {
        $this->content = $content;
        $this->status = $status;
        $this->animate = $animate;
    }

    //Getter and setter methods
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

    /*It takes no parameters
    **It returns a string containing the HTML specifically displaying a charachter */
    abstract public function __toString();
}