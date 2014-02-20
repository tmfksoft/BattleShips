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
if ($_GET['x'] >= 0 && $_GET['y'] >= 0 && $_GET['y'] <= config::get("rows") && $_GET['x'] <= config::get("cols")) {
	$game->player_place_ship($_GET['x'],$_GET['y']);
}
?>