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

$cscore = $game->score($game->get("player_ships"),$game->get("player_hits"));
$pscore = $game->score($game->get("computer_ships"),$game->get("computer_hits"));
?>
<table class="table">
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
		<td><?php echo $game->get("p_name"); ?></td>
		<td><?php echo $pscore; ?>pts</td>
		<td><?php if ($pscore > $cscore) { echo "Yes"; } else if ($pscore === $cscore) { echo "Drawing"; } else { echo "No"; }; ?></td>
		<td>.</td>
		<td>0</td>
		<td>0</td>
	</tr>
	<tr>
		<td><?php echo $game->get("c_name"); ?></td>
		<td><?php echo $cscore; ?>pts</td>
		<td><?php if ($pscore < $cscore) { echo "Yes"; } else if ($pscore === $cscore) { echo "Drawing"; } else { echo "No"; }; ?></td>
		<td>0</td>
		<td>0</td>
		<td>0</td>
	</tr>
</table>