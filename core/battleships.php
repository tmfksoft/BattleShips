<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Core File

session_start();

class battleships {
	public function __construct() {
		// Create some Variables
		$this->grids = array();
		if (isset($_SESSION) && count($_SESSION) > 0) {
			$this->data = $_SESSION;
		} else {
			$this->data = array("action"=>"clean");
		}
	}
	public function update() {
		// Updates the data variable to the Session variable
		$_SESSION = $this->data;
	}
	public function create_grid($name,$width = 10,$height = 10,$default = false) {
		$dat = array();
		for ($y = 1; $y != $height; $y++) {
			$row = array();
			for ($x = 1; $x != $width; $x++) {
				$row[$x] = $default;
			}
			$dat[$y] = $row;
		}
		$this->data["grid_".strtolower($name)] = $dat;
		// Update the Session
		$this->update();
	}
	public function grid_exists($name) {
		if (isset($this->data["grid_".strtolower($name)])) {
			return true;
		} else {
			return false;
		}
	}
	public function get_grid($name) {
		if ($this->grid_exists($name)) {
			return $this->data["grid_".strtolower($name)];
		} else {
			return null;
		}
	}
	public function action($name = false) {
		if ($name) {
			$this->data['action'] = $name;
			$this->update();
			return true;
		} else {
			return $this->data['action'];
		}
	}
	
	// Easy access to variables
	public function set_var($name,$val) {
		$this->data["var_".strtolower($name)] = $val;
	}
	public function get_var($name) {
		if (isset($this->data["var_".strtolower($name)])) {
			return $this->data["var_".strtolower($name)];
		} else {
			return null;
		}
	}
}

// Include some PHP Files.
include('core/hscore.inc.php');
include('core/tmpl.inc.php');
include('core/gd.inc.php');
?>