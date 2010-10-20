<?php
	require_once('GlobalFunctions.php');
	class GameChallengesResponse extends APIResponse
	{
		private $Daily; // array
		private $Weekly; // array

		public function __construct($GameChallengesResponse){
			$this->reason = $GameChallengesResponse->reason;
			$this->status = $GameChallengesResponse->status;
			$this->Daily  = $GameChallengesResponse->Daily;
			$this->Weekly = $GameChallengesResponse->Weekly;
		}

		public function __get($a){
			return $this->$a;
		}

		public function __toString(){
			return __CLASS__;
		}

	}
?>
