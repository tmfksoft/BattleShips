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

// Now we dance around the rose bush with the templating system.
$tmpl->set("scores",$hscores->get());
$tmpl->set("page","highscores");
$tmpl->load("highscores.php");
$tmpl->display(false,true);
?>