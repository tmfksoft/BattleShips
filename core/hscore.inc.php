<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Highscores File

class highscores {
	public function __construct() {
		if (file_exists("data/hscore.json")) {
			$tmp = file_get_contents("data/hscore.json");
			$dt = @json_decode($tmp,true);
			if ($dt) {
				$this->data = $dt;
			} else {
				$this->data = array();
			}
		} else {
			$this->data = array();
		}
	}
	public function update() {
		file_put_contents("data/hscore.json",json_encode($this->data));
	}
	public function add($name,$score) {
		$this->data[] = array("name"=>$name,"score"=>$score,"time"=>time());
		$this->update();
	}
	public function get() {
		return $this->data;
	}
}
?>