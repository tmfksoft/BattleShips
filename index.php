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
	$game->create_grid("player_ships",10,10,0);
	$game->create_grid("player_hits",10,10,0);
	
	$game->create_grid("computer_ships",10,10,0);
	$game->create_grid("computer_hits",10,10,0);
}

// Now we dance around the rose bush with the templating system.
$tmpl->set("page","home");
$tmpl->set("player_ships",$bgd->image_grid(true));
$tmpl->set("computer_hits",$bgd->image_grid());

// Pass some info to the page. This is when they first navigate there. AJAX JQuery takes care of updating values.
$tmpl->set("p_score",$game->get_var('p_score'));
$tmpl->set("c_score",$game->get_var('c_score'));

$tmpl->set("p_name",$game->get_var('p_name'));
$tmpl->set("c_name",$game->get_var('c_name'));

$tmpl->load("home.php");
$tmpl->display(false,true);
?>