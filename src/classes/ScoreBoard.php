<?php

class ScoreBoard implements Board
{
    public $lives = 5;
    private $remainingLives = 5;
    private $urlLiveHeart = "assets/images/liveHeart.png";
    private $urlLostHeart = "assets/images/lostHeart.png";

    //It takes 1 optional parameter: the number of lives a an integer (by default is 5)
    public function __construct($lives = null)
    {
        if (!empty($lives)) {
            $this->lives = $lives;
            $this->remainingLives = $lives;
        }
    }

    /*It takes no parameters
    **It returns a string containing the HTML specifically displaying the ScoreBoard */
    private function create()
    {
        $lostLives = $this->lives - $this->remainingLives;
        $result = "";

        for ($i = 0; $i < $this->remainingLives; $i++) { 
            $result .= " <li class='animated pulse tries'><img src='$this->urlLiveHeart' height='35px' widght='30px'></li>";
         }
 
         for ($i = 0; $i < $lostLives; $i++) { 
             $result .= " <li class='tries'><img src='$this->urlLostHeart' height='35px' widght='30px'></li>";
         }

         return $result;
    }

    /*It takes no parameters
    **It returns a string containing the HTML displaying the ScoreBoard */
    public function display()
    {
        $result = "<div id='scoreboard' class='section'><ol>";
        $result .= "<h4>Remaining Lives</h4>";

        $result .= $this->create();

        $result .= "</ol></div>";

        return $result;

    }

    //It takes 2 optional parameters: a letter as a string and a status as a string
    //It reduces by 1 $remainingLives
    public function update($key = NULL, $newStatus = NULL)
    {
        $this->remainingLives -= 1;
    }

    public function getRemainingLives()
    {
        return $this->remainingLives;
    }
}
