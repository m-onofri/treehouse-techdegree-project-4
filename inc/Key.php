<?php

class Key extends Char
{

    public function __toString()
    {
        return "<button class='key $this->status'>$this->content</button>";
    }
}