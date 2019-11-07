<?php

class Game
{
    private $phrase;
    private $scoreBoard;
    private $lives = 5;
    private $keyboard;

    public function __construct($phrase)
    {
        $this->phrase = $phrase;
        $this->scoreBoard = new ScoreBoard();
        $this->keyBoard = new KeyBoard();
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
}