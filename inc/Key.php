<?php

class Key extends Char
{

    public function __toString()
    {
        $url = "play.php?key=$this->content";
        return "<button class='key $this->status'><a href='$url'>$this->content</a></button>";
    }
}