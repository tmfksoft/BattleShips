<?php
$scores = $this->get("scores");
?>
<div class="page-header">
	<h3>Battleships Highscores <span class="pull-right"><small><?php echo count($scores)." Scores"; ?></small></span></h3>
</div>
<center>
	<table class="table">
		<thead>
			<tr>
				<td><b>Name</b></td>
				<td><b>Score</b></td>
				<td><b>Date</b></td>
			</tr>
		</thead>
	<?php
	foreach ($scores as $s) {
		echo "<tr>\n\t<td>{$s['name']}</td>\n\t<td>{$s['score']}</td>\n\t<td>".$this->dateify($s['time'])."</td>\n</tr>";
	}
	?>
	</table>
</center>