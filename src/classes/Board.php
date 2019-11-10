<?php

interface Board
{
    public function update($value=null, $newStatus=null);
    public function display();
}