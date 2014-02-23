<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Main File

// Load it
include('core/config.inc.php');
config::load("data/config.php");
include('core/battleships.php');

// Construct a monster mamajam.
$game = new battleships();
$hscores = new highscores();
$tmpl = new template();
$bgd = new battle_gd();

// We begin with the game.
if ($game->action() == "clean") {
	// We start the game again.
	
	// Generate the computers grid.
	//$game->computer_gen();
	
	$game->set("action","ready"); // Ready for the player to place ships
	
}

// Now we dance around the rose bush with the templating system.
$tmpl->set("page","home");
// Grid Data
$player_ships = $game->get("player_ships");
$player_hits = $game->get("player_hits");
$tmpl->set("player_ships",$bgd->image_grid($player_ships,$player_hits,true));

$computer_ships = $game->get("computer_ships");
$computer_hits = $game->get("computer_hits");
$tmpl->set("computer_hits",$bgd->image_grid($computer_ships,$computer_hits));

// Pass some info to the page. This is when they first navigate there. AJAX JQuery takes care of updating values.
$tmpl->set("p_score",$game->get('p_score'));
$tmpl->set("c_score",$game->get('c_score'));

$tmpl->set("p_name",$game->get('p_name'));
$tmpl->set("c_name",$game->get('c_name'));

// Player Queue
$tmpl->set("player_queue",$game->player_queue());

$tmpl->load("home.php");
$tmpl->display(false,true);
?>