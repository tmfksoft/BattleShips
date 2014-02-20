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
$hits = $game->get("computer_hits");
$hits[] = array("x"=>$_GET['x'],"y"=>$_GET['y']);
$game->set("computer_hits",$hits);
?>