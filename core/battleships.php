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
			
			$this->computer_gen();
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
		$ships = config::get("ships");
		$com_ships = array();
		foreach ($ships as $id => $sh) {
			// We cycle each ship and place it randomly (As in we dont care about any other variables yet.).
			$t = array();
			$direction = rand(0,1);
			// Simple system to avoid a ship being dramatically off the grid
			if ($direction) {
				$t['y'] = rand(0,config::get("rows") - $sh['len']);
				$t['x'] = rand(0,9);
			} else {
				$t['x'] = rand(0,config::get("cols") - $sh['len']);
				$t['y'] = rand(0,9);
			}
			$t['len'] = $sh['len'];
			$t['name'] = $sh['name'];
			$t['dir'] = $direction;
			$com_ships[] = $t;
		}
		$this->set("computer_ships",$com_ships);

	}
	function computer_do_hit($x = -1, $y = -1) {
		// AI To place a hit against the player.
		$x = rand(0,config::get("cols")-1);
		$y = rand(0,config::get("rows")-1);
		$hits = $this->get("player_hits");
		if (count($hits) < config::get("cols") * config::get("rows")) {
			// Make sure we have room to hit.
			if ($this->can_hit($hits,$x,$y)) {
				$hits[] = array("x"=>$x,"y"=>$y);
				$this->set("player_hits",$hits);
			} else {
				// Restart to find a different X,Y
				$this->computer_do_hit($x,$y);
			}
		}
	}
	// Player Related.
	function player_place_ship($x,$y,$dir = 0) {
		$ships = config::get("ships");
		
		$player_ships = $this->get("player_ships");
		if (count($player_ships) < count($ships)) {
			$place = false;
			$tmp = $ships[count($player_ships)];
			$tmp['x'] = $x;
			$tmp['y'] = $y;
			$tmp['dir'] = $dir;
			// Check if it fits within the Grid.
			if ($x < config::get("cols") && $y < config::get("rows")) {
				if ($dir == 1) {
					if ( ($y+$tmp['len']) <= config::get("rows")) {
						$place = true;
					}
				} else {
					if ( ($x+$tmp['len']) <= config::get("cols")) {
						$place = true;
					}
				}
			}
			// Check if theres not already a ship here!
			foreach ($player_ships as $sh) {
				if ($sh['x'] == $x && $sh['y'] == $y) {
					$place = false;
				}
				if ($sh['dir']) {
					// Existing ship is Vertical
					if ($x >= $sh['x'] && $x <= $sh['x'] + $sh['len']-1) {
						if ($y == $sh['y']) {
							$place = false;
						}
					}
				} else {
					// Existing ship is Horizontal
					if ($y >= $sh['y'] && $x <= $sh['y'] + $sh['len']-1) {
						if ($x == $sh['x']) {
							$place = false;
						}
					}
				}
			}
			
			$player_ships[] = $tmp;
			if ($place) $this->set("player_ships",$player_ships);
		}
	}
	function player_place_hit($x,$y) {
		if (count($this->get("player_ships")) === count(config::get("ships"))) {
			// Check we've actually placed our ships.
			$hits = $this->get("computer_hits");
			if ($this->can_hit($hits,$x,$y)) {
				// We CAN hit here.
				$hits[] = array("x"=>$x,"y"=>$y);
				$this->set("computer_hits",$hits);
				return true;
			} else {
				return false;
			}
		}
	}
	function player_queue() {
		$ships = config::get("ships");
		
		return array_slice($ships,count($this->get("player_ships")));
	}
	/* General Functions, These arent specific */
	public function score($ships=array(),$hits=array()) {
		// Pretty much same as the GD code except without the drawing.
		$shot = 0;
		if (count($hits) > 0) {
			foreach ($hits as $hid => $ht) {
				$type = 0;
				// Determine if this is a hit image or not.
				foreach ($ships as $sid => $sh) {
					// Check for a direct hit.
					if ($ht['x'] === $sh['x'] && $ht['y'] === $sh['y']) {
						// Hit!
						$type++;
					} else {
						if ($sh['dir'] == 1) {
							// Its vertical.
							if ($ht['x'] === $sh['x']) {
								if ($ht['y'] <= $sh['y']+$sh['len']-1) {
									if ($ht['y'] >= $sh['y']) {
										// Hit!
										$type++;
									}
								}
							}
						} else {
							// Its horizontal
							
							if ($ht['y'] == $sh['y']) {
								if ($ht['x'] <= $sh['x']+$sh['len']-1) {
									if ($ht['x'] >= $sh['x']) {
										// Hit!
										$type++;
									}
								}
							}
							
						}
					}
				}
				$shot = $shot + $type;
			}
		}
		return ($shot*5 + count($hits) * 5);
	}
	public function can_hit($hits = array(),$x, $y) {
		// Simple code to check if a hit CAN be placed.
		// Used for the computer and the player to stop dupes.
		$can = true;
		foreach ($hits as $mh) {
			// Cycle the main hits.
			if ($mh['x'] == $x && $mh['y'] == $y) {
				// MUTINY!
				$can = false;
			}
		}
		return $can;
	}
}

// Load Extra
include(config::get('root').'core/hscore.inc.php');
include(config::get('root').'core/tmpl.inc.php');
include(config::get('root').'core/gd.inc.php');
?>