<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Info File - Returns the info text.

// Load it
include('../core/config.inc.php');
config::load("../data/config.php");
include('../core/battleships.php');

// Construct a monster mamajam.
$game = new battleships();
$hscores = new highscores();
$tmpl = new template();
$bgd = new battle_gd();

// Get the right info line.
echo config::$conf['text']['place_p'];
?>