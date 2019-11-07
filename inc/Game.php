<?php

class Game
{
    private $phrase;
    private $scoreBoard;
    private $lives = 5;
    private $keysList = [
        ["q", "w", "e", "r", "t", "y", "u", "i", "o", "p"],
        ["a", "s", "d", "f", "g", "h", "j", "k", "l"],
        ["z", "x", "c", "v", "b", "n", "m"]
    ];
    private $keyboard = [];

    public function __construct($phrase)
    {
        $this->phrase = $phrase;
        $this->scoreBoard = new ScoreBoard(5);

        $this->createKeyboard();
    }

    public function getPhrase()
    {
        return $this->phrase;
    }

    private function checkForWin()
    {
        $remainingLetters = array_filter(
            $this->phrase->getArrayPhrase(), 
            function($a){return $a->getStatus() == "hide";});

        if (count($remainingLetters) == 0) {
            return true;
        }
        return false;
    }

    private function checkForLose()
    {
        if ($this->scoreBoard->getRemainingLives() == 0) {
            return true;
        }
        return false;
    }

    public function gameOver()
    {
        if ($this->checkForWin()) {
            return "Congratulations on guessing: '" . $this->phrase->getCurrentPhrase() . "'";
        } elseif ($this->checkForLose()) {
            return "The phrase was: '" . $this->phrase->getCurrentPhrase() . "'. Better luck next time!";
        } else {
            return false;
        }
    }

    public function handleUserChoice($choice)
    {
        if ($this->phrase->checkLetter($choice)) {
            $this->phrase->updateStatusLetter($choice);
            $this->updateKeyboard($choice, "correct");
        } else {
            $this->scoreBoard->update();
            $this->updateKeyboard($choice, "incorrect");
        }
    }

    private function updateKeyboard($key, $newStatus)
    {
        foreach ($this->keyboard as $keyrow) {
            foreach ($keyrow as $keyObj) {
                if ($keyObj->getContent() == $key) {
                    $keyObj->setStatus($newStatus);
                }
            }
        }
    }

    public function displayKeyboard()
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

    public function displayScore()
    {
        return $this->scoreBoard->display();

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