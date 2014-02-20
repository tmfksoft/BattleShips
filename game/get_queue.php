<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Return what ships can be placed in the queue.

// Load it
include('../core/config.inc.php');
config::load("../data/config.php");
include('../core/battleships.php');

// Construct a monster mamajam.
$game = new battleships();
$hscores = new highscores();
$tmpl = new template();
$bgd = new battle_gd();

// Set to clean.
foreach ($game->player_queue("player_queue") as $ship) {
	echo '<img class="ship" title="'.$ship['name'].'" src="assets/img/ship_'.$ship['len'].'.png"/>';
}
if (count($game->player_queue("player_queue")) <= 0) {
	echo "<center><i>You've placed all your ships!</i></center>";
}
?>