<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Highscores File

class highscores {
	public function __construct() {
		if (file_exists("data/hscore.json")) {
			$tmp = file_get_contents("data/hscore.json");
			$dt = @json_encode("data/hscore.json");
			if ($dt) {
				$this->data = $dt;
			} else {
				$this->data = $dt;
			}
		} else {
			$this->data = array();
		}
	}
}
?>