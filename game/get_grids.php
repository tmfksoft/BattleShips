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
$grids['player_ships'] = "data:image/png;base64,".base64_encode($bgd->image_grid(true));
$grids['computer_hits'] = "data:image/png;base64,".base64_encode($bgd->image_grid(true));
echo json_encode($grids);
?>