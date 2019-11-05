<?php

class Game
{
    public $phrase;
    public $lives = 5;
    public $remainingLives = 5;
    private $keysList = [
        ["q", "w", "e", "r", "t", "y", "u", "i", "o", "p"],
        ["a", "s", "d", "f", "g", "h", "j", "k", "l"],
        ["z", "x", "c", "v", "b", "n", "m"]
    ];
    private $keyboard = [];

    public function __construct($phrase)
    {
        $this->phrase = $phrase;

        $this->createKeyboard();
    }

    public function checkForWin()
    {

    }

    public function checkForLose()
    {

    }

    public function gameOver()
    {

    }

    public function displayKeyboard()
    {
        $result = "<div id='qwerty' class='section'>";

        foreach ($this->keyboard as $keyrow) {
            $result .= "<div class='keyrow'>";
            foreach ($keyrow as $keyObj) {
                $result .= "$keyObj";
            }
            $result .= "</div>";
        }

        $result .= "</div>";
        
        return $result;
    }

    public function displayScore()
    {
        $lostLives = $this->lives - $this->remainingLives;
        $result = "<div id='scoreboard' class='section'><ol>";

        for ($i = 0; $i < $this->remainingLives; $i++) { 
           $result .= " <li class='tries'><img src='images/liveHeart.png' height='35px' widght='30px'></li>";
        }

        for ($i = 0; $i < $lostLives; $i++) { 
            $result .= " <li class='tries'><img src='images/lostHeart.png' height='35px' widght='30px'></li>";
        }

        $result .= "</ol></div>";

        return $result;

    }

    private function createKeyboard()
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