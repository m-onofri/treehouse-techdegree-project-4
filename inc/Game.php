<?php

class Game
{
    private $phrase;
    private $scoreBoard;
    private $lives = 5;
    private $keyboard;

    public function __construct($currentPhrase = null, $selected = null, $lives = null)
    {
        $this->phrase = new Phrase($currentPhrase = null, $selected = null);
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
                'msg' => "Congratulations on guessing: '" . $this->phrase->getCurrentPhrase() . "'",
                'status' => 'win'
            ];
        } elseif ($this->checkForLose()) {
            return [
                'msg' => "The phrase was: '" . $this->phrase->getCurrentPhrase() . "'. Better luck next time!",
                'status' => 'lose'
            ];
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

    public function displayPhrase()
    {
        return $this->phrase->addPhraseToDisplay();
    }
}