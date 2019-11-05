<?php

class Phrase 
{
    public $currentPhrase;
    public $arrayPhrase = [];
    private $selected = [];

    public function __construct($currentPhrase = null, $selected = null)
    {
       if (!empty($currentPhrase)) {
           $this->currentPhrase = $currentPhrase;
       } else {
          $this->currentPhrase = $this->getRandomPhrase(); 
       }

       if (!empty($selected)) {
           $this->selected = $selected;
       }

       $this->setArrayPhrase();
    }

    public function addPhraseToDisplay()
    {
        $phrase = "<div id='phrase' class='section'><ul>";

        foreach ($this->arrayPhrase as $letter) {
            $phrase .= "$letter";
        }

        $phrase .= "</ul></div>";

        return $phrase;
    }

    public function updateStatusLetter($letter)
    {
        foreach ($this->arrayPhrase as $char) {
            // echo(var_dump($char));
            // die;
            if ($letter == strtolower($char->getContent())) {
                $char->setStatus("show");
            }
        }
    }

    public function checkLetter($letter)
    {
        if (strpos(strtolower($this->currentPhrase), $letter) >= 0) {
            return true;
        }
        return false;
    }

    private function getRandomPhrase()
    {
        # get random phrase from db
    }

    private function setArrayPhrase()
    {
        $phraseArr = str_split($this->currentPhrase);

        foreach ($phraseArr as $char) {
            switch (true) {
                case preg_match("/\s/", $char):
                    $this->arrayPhrase[] = new Letter($char, "display", "space");
                    break;
                case preg_match("/[a-zA-Z]/", $char):
                    $this->arrayPhrase[] = new Letter($char, "hide", "letter");
                    break;
                case preg_match("/[,?!;:.]/", $char):
                    $this->arrayPhrase[] = new Letter($char, "display", "punctuation");
                    break;
                default:
                    $this->arrayPhrase[] = new Letter("*", "display", "punctuation");
                    break;
            }
        }
    }
}