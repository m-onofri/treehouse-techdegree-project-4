<?php

class Key extends Char
{
    public function __toString()
    {
        if ($this->status != 'active') {
            return "<input type='submit' name='key' value='$this->content' class='$this->status' disabled/>";
        } else {
            return "<input type='submit' name='key' value='$this->content' class='$this->status' />";
        }
    }
}