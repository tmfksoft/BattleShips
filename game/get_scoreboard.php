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
?>
<table class="table" id="score_board">
	<thead>
		<tr>
			<td></td>
			<td>Score</td>
			<td>Winning</td>
			<td>Sank Ships</td>
			<td>Damaged Ships</td>
			<td>Unharmed Ships</td>
		</tr>
	</thead>
	<tr>
		<td><?php echo $game->get_var("p_name"); ?></td>
		<td><?php echo $game->get_var("p_score"); ?></td>
		<td><?php echo "Yes"; ?>
		<td>0</td>
		<td>0</td>
		<td>0</td>
	</tr>
	<tr>
		<td><?php echo $game->get_var("c_name"); ?></td>
		<td><?php echo $game->get_var("c_score"); ?></td>
		<td><?php echo "No"; ?>
		<td>0</td>
		<td>0</td>
		<td>0</td>
	</tr>
</table>