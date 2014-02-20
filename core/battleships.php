<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Core File

session_start();

class battleships {
	public function __construct($force_clean = false) {
		// Create some Variables
		$this->grids = array();
		if (isset($_SESSION) && count($_SESSION) > 0 && !$force_clean) {
			$this->data = $_SESSION;
		} else {
			$default = array();
			// Basic Data
			$default['var_action'] = "clean";
			$default['var_p_score'] = 0;
			$default['var_c_score'] = 0;
			$default['var_p_name'] = "Player";
			$default['var_c_name'] = "Computer";
			// Ship and Grid
			$default['var_player_ships'] = array();
			$default['var_player_hits'] = array();
			$default['var_computer_ships'] = array();
			$default['var_computer_hits'] = array();
			
			$this->data = $default;
			$this->update();
		}
	}
	public function update() {
		// Updates the data variable to the Session variable
		$_SESSION = $this->data;
	}
	public function action($name = false) {
		if ($name) {
			$this->data['action'] = $name;
			$this->update();
			return true;
		} else {
			return $this->data['var_action'];
		}
	}
	
	// Easy access to variables
	public function set($name,$val) {
		$this->data["var_".strtolower($name)] = $val;
		$this->update();
	}
	public function get($name = false) {
		if ($name) {
			if (isset($this->data["var_".strtolower($name)])) {
				return $this->data["var_".strtolower($name)];
			} else {
				return null;
			}
		} else {
			$ret = array();
			foreach ($this->data as $vname => $val) {
				if ($vname[0] === "v") {
					// Check if its a variable
					$ret[$vname] = $val;
				}
			}
			return $ret;
		}
	}
	
	// Computer Related
	function computer_gen() {
		// Generates the Ship grid from the computer.
		$ships = array();
		$ships[] = array("name"=>"Aircraft Carrier","len"=>5);
		$ships[] = array("name"=>"Battleship","len"=>4);
		$ships[] = array("name"=>"Submarine","len"=>3);
		$ships[] = array("name"=>"Destroyer","len"=>3);
		$ships[] = array("name"=>"Patrol Boat","len"=>2);
		
		foreach ($ships as $id => $sh) {
			// We cycle each ship and place it randomly.
			$ships[$id]['x'] = rand(0,9);
			$ships[$id]['y'] = rand(0,9);
			$ships[$id]['dir'] = rand(0,1);
		}
		$this->set("computer_ships",$ships);

	}
	function computer_do_hit() {
		// AI To place a hit against the player.
	}
	// Player Related.
	function player_place_ship($x,$y) {
		$ships = array();
		$ships[] = array("name"=>"Aircraft Carrier","len"=>5);
		$ships[] = array("name"=>"Battleship","len"=>4);
		$ships[] = array("name"=>"Submarine","len"=>3);
		$ships[] = array("name"=>"Destroyer","len"=>3);
		$ships[] = array("name"=>"Patrol Boat","len"=>2);
		
		$player_ships = $this->get("player_ships");
		if (count($player_ships) < count($ships)) {
			$tmp = $ships[count($player_ships)];
			$tmp['x'] = $x;
			$tmp['y'] = $y;
			$tmp['dir'] = 1;
			$player_ships[] = $tmp;
			$this->set("player_ships",$player_ships);
		}
	}
}

// Load Extra
include(config::get('root').'core/hscore.inc.php');
include(config::get('root').'core/tmpl.inc.php');
include(config::get('root').'core/gd.inc.php');
?>