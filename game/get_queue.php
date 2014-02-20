<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Restart the Game
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
$ships = config::get("ships");
?>