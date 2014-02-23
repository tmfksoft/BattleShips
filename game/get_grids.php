<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Main File

// Load it
include('../core/config.inc.php');
config::load("../data/config.php");
include('../core/battleships.php');

// Construct a monster mamajam.
$game = new battleships();
$hscores = new highscores();
$tmpl = new template();
$bgd = new battle_gd();

// Return an array.
$grids = array();


// Grid Data
$player_ships = $game->get("player_ships");
$player_hits = $game->get("player_hits");
$grids['player_ships'] = "data:image/png;base64,".base64_encode($bgd->image_grid($player_ships,$player_hits,true));

$computer_ships = $game->get("computer_ships");
$computer_hits = $game->get("computer_hits");
if (count($computer_hits) < (config::get("rows") * config::get("cols"))) {
	$grids['computer_hits'] = "data:image/png;base64,".base64_encode($bgd->image_grid($computer_ships,$computer_hits));
} else {
	// Max hits placed. Auto end the game.
	$grids['computer_hits'] = "data:image/png;base64,".base64_encode($bgd->image_grid($computer_ships,$computer_hits),true);
}

echo json_encode($grids);
?>