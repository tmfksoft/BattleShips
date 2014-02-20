<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Config File

class config {
	static $conf = array();
	static function load($file) {
		if (file_exists($file)) {
			include($file);
			$configuration = array();
			foreach ($cfg as $cn => $cv) {
				// Make sure everythings lowercase
				$configuration[strtolower($cn)] = $cv;
			}
			
			self::$conf = $configuration;
		}
	}
	static function get($var = false) {
		if ($var) {
			if (isset(self::$conf[strtolower($var)])) {
				return self::$conf[strtolower($var)];
			} else {
				return null;
			}
		} else {
			return $this->conf;
		}
	}
}
?>