<div class="page-header">
	<h3>
		Play Battleships
		<span class="pull-right">
			<input type="button" value="Restart" class="btn"/>
		</span>
	</h3>
</div>
<center>
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
	<hr></hr>
	<table id="playing_grids">
		<tr>
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
				<img id="player_ships" src="data:image/png;base64,<?php echo base64_encode($this->get("player_ships")); ?>"/>
			</td>
			<td>
				<img id="computer_hits" src="data:image/png;base64,<?php echo base64_encode($this->get("computer_hits")); ?>"/>
			</td>
		</tr>
	</table>
</center>