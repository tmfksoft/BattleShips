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
			<td width="160px">
				<h3>Info</h3>
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
			<td width="160px">
				<span id="instructions">
					<?php echo config::$conf['text']['place_p']; ?>
				</span>
				<hr></hr>
				<h4>Ship Queue</h4>
				<input type="button" class="btn btn-primary btn-large" onclick="if (typeof(direction) !== 'undefined') { direction = !direction; } else { direction = 1; } this.value = (direction == true ? 'Rotate Horizontal' : 'Rotate Vertical')" value="Rotate Vertical"/>
				<hr></hr>
				<div id="player_queue">
					<?php
					foreach ($this->get("player_queue") as $ship) {
						echo '<img class="ship" title="'.$ship['name'].' - '.$ship['len'].' Cells" src="assets/img/ship_'.$ship['len'].'.png"/>';
					}
					if (count($this->get("player_queue")) <= 0) {
						echo "<center><i>Nothing here!</i></center>";
					}
					?>
				</div>
			</td>
			<td>
				<img id="player_ships" src="data:image/png;base64,<?php echo base64_encode($this->get("player_ships")); ?>"/>
			</td>
			<td>
				<img id="computer_hits" src="data:image/png;base64,<?php echo base64_encode($this->get("computer_hits")); ?>"/>
			</td>
		</tr>
	</table>
</center>