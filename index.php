<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Main File

// Load it
include('core/battleships.php');

// Construct a monster mamajam.
$game = new battleships();
$hscores = new highscores();
$tmpl = new template();

// We begin with the game.
if ($game->action() == "clean") {
	// We start the game again.
	$game->create_grid("player",10,10,0);
	$game->create_grid("computer",10,10,0);
	$game->create_grid("computer_guess",10,10,0);
	$game->create_grid("player_guess",10,10,0);
}

// Now we dance around the rose bush with the templating system.
$tmpl->set("page","home");
$tmpl->load("home.php");
$tmpl->display(false,true);
?>