<div class="page-header">
	<h3>
		Play Battleships
		<span class="pull-right">
			<input type="button" onclick="restart_game();" value="Restart" class="btn"/>
		</span>
	</h3>
</div>
<center>
	<div id="score_board">
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
				<td><?php echo $this->get("p_name"); ?></td>
				<td><?php echo $this->get("p_score"); ?></td>
				<td><?php echo "Yes"; ?>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr>
				<td><?php echo $this->get("c_name"); ?></td>
				<td><?php echo $this->get("c_score"); ?></td>
				<td><?php echo "No"; ?>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
		</table>
	</div>
	<hr></hr>
	<table class="table" id="playing_grids">
		<tr>
			<td>
				<h4>Ship Queue</h4>
				<small>Ships you can place</small>
			</td>
			<td>
				<h4>Your Ships</h4>
				<small>Your ships you've placed.</small>
			</td>
			<td>
				<h4>Your Hits</h4>
				<small>Hits against the Computer</small>
			</td>
		</tr>
		<tr>
			<td>
				<div id="player_queue">
					<?php foreach ($this->get("player_queue") as $ship) {
						echo '<img class="ship" title="'.$ship['name'].'" src="assets/img/ship_'.$ship['len'].'.png"/>';
					} ?>
				</div>
			</td>
			<td>
				<img id="player_ships" src="data:image/png;base64,<?php echo base64_encode($this->get("player_ships")); ?>"/>
			</td>
			<td>
				<img id="computer_hits" onclick="place_hit();" src="data:image/png;base64,<?php echo base64_encode($this->get("computer_hits")); ?>"/>
			</td>
		</tr>
	</table>
</center>