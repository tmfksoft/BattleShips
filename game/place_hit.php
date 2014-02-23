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

// Get our ships.
if ($game->player_place_hit($_GET['x'],$_GET['y'])) {
	// Hit placed nicely.
	$game->computer_do_hit();
}
?>