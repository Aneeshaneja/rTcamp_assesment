<?php
require_once('xkcd_comic.php');

class xkcd{
  //the ID of the latest comic to validate random number do not request for non-existing page.
	private $latestnum = 0;

	function __construct(){
		$this->refresh();
	}

	public function refresh(){
		$raw = json_decode(file_get_contents('http://xkcd.com/info.0.json'), true); //get the latest comic info
    
    // initalize a new comic object residing in xkdc_comic.php
		$comic = new xkcd_comic($raw, $this);
		$this->latestnum = $comic->num;
	}

//Getting a comic
	public function get($num){
		$num = (int)$num;

    //random number validation
		if($num > $this->latestnum || $num < 1){
            throw new Exception('Wrooooong comic ID specified!'); return null;
		}
    // return validated comic
		else{
				$raw = json_decode(file_get_contents('http://xkcd.com/'.$num.'/info.0.json'), true);
				$comic = new xkcd_comic($raw, $this);
				return $comic;
			}
		}

    public function latest(){
        return $this->get($this->latestnum);
    }

  //using the get fn now fetching a random comic.
	public function random(){
		$rand = rand(1, $this->latestnum);
		return $this->get($rand);
	}
}
