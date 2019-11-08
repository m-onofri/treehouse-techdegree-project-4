<?php

class Game
{
    private $phrase;
    private $scoreBoard;
    private $lives = 5;
    private $keyboard;

    public function __construct($phrase, $lives = null)
    {
        $this->phrase = $phrase;
        $this->scoreBoard = new ScoreBoard($lives = null);
        $this->keyBoard = new KeyBoard();
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
            return [
                'msg' => "<h1>Congratulations on guessing:</h1><h1>'" . $this->phrase->getCurrentPhrase() . "'</h1>",
                'status' => 'win'
            ];
        } elseif ($this->checkForLose()) {
            return [
                'msg' => "<h1>The phrase was:</h1><h1>'" . $this->phrase->getCurrentPhrase() . "'</h1><h1> Better luck next time!<h1>",
                'status' => 'lose'
            ];
        } else {
            return false;
        }
    }

    public function handleUserChoice($choice)
    {
        $this->phrase->update($choice);
        if ($this->phrase->checkLetter($choice)) {
            $this->keyBoard->update($choice, "correct");
        } else {
            $this->scoreBoard->update();
            $this->keyBoard->update($choice, "incorrect");
        }
    }

    public function displayKeyboard()
    {
        return $this->keyBoard->display();
    }

    public function displayScore()
    {
        return $this->scoreBoard->display();

    }

    public function displayPhrase()
    {
        return $this->phrase->display();
    }
}