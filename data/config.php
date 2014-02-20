<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Config File
//	Configures certain aspects of the game.

// [WARNING] Editing this config WILL reset ALL games currently running.
$cfg = array();

// Game Related
$cfg['root'] = "/home/www/repos/BattleShips/";
$cfg['cols'] = 10;
$cfg['rows'] = 10;

// Ships used in the game.
$ships = array();
$ships[] = array("name"=>"Aircraft Carrier","len"=>5);
$ships[] = array("name"=>"Battleship","len"=>4);
$ships[] = array("name"=>"Submarine","len"=>3);
$ships[] = array("name"=>"Destroyer","len"=>3);
$ships[] = array("name"=>"Patrol Boat","len"=>2);
$cfg['ships'] = $ships;

//Text Prompts. Edit these to change wording or even the language.
$text = array();
$text['place_p'] = "Place your ships on the grid on the left. Until the queue is empty.";
$text['click_p'] = "Click anywhere on the grid on the right to try and hit the opponents ships.";
$cfg['text'] = $text;
?>