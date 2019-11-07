<?php

class Keyboard
{
    private $keysList = [
        ["q", "w", "e", "r", "t", "y", "u", "i", "o", "p"],
        ["a", "s", "d", "f", "g", "h", "j", "k", "l"],
        ["z", "x", "c", "v", "b", "n", "m"]
    ];
    private $keyboard = [];

    public function update($key, $newStatus)
    {
        foreach ($this->keyboard as $keyrow) {
            foreach ($keyrow as $keyObj) {
                if ($keyObj->getContent() == $key) {
                    $keyObj->setStatus($newStatus);
                }
            }
        }
    }

    public function display()
    {
        $result = "<form method='post' action='play.php' id='qwerty' class='section'>";

        foreach ($this->keyboard as $keyrow) {
            $result .= "<div class='keyrow'>";
            foreach ($keyrow as $keyObj) {
                $result .= "$keyObj";
            }
            $result .= "</div>";
        }

        $result .= "</form>";
        
        return $result;
    }

    private function create()
    {
        foreach ($this->keysList as $keyrow) {
            $row = [];
            foreach ($keyrow as $keyLetter ) {
                $row[] = new Key($keyLetter, "active");
            }
            $this->keyboard[] = $row;
        }
    }
}