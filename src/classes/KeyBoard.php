<?php

class Keyboard implements Board
{
    private $keysList = [
        ["q", "w", "e", "r", "t", "y", "u", "i", "o", "p"],
        ["a", "s", "d", "f", "g", "h", "j", "k", "l"],
        ["z", "x", "c", "v", "b", "n", "m"]
    ];
    private $keyboard = [];

    public function __construct()
    {
        $this->create();
    }

    //It takes 2 optional parameters: a letter as a string and a status as a string
    //According to the letter chosen by the user, it updates the Key object status and enable/disable animation
    public function update($key=null, $newStatus=null)
    {
        foreach ($this->keyboard as $keyrow) {
            foreach ($keyrow as $keyObj) {
                if ($keyObj->getContent() == $key) {
                    $keyObj->setStatus($newStatus);
                    $keyObj->setAnimate(true);
                } else {
                    $keyObj->setAnimate(false);
                }
            }
        }
    }

    /*It takes no parameters
    **It returns a string containing the HTML displaying the KeyBoard */
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

    /*It takes no parameters
    **For each key in the keyboard, it creates a new Key object, and store them in the $keyboard property*/
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