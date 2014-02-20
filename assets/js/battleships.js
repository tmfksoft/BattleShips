/* Update the Page and Playing Field */
function update_grids() {
	$.getJSON('game/get_grids.php',function(data) {
		$('#player_ships').attr('src',data.player_ships);
		$('#computer_hits').attr('src',data.computer_hits);
	});
}
function update_scoreboard() {
	$.getJSON('game/get_scoreboard.php',function(data) {
		$('#player_ships').attr('src',data.player_ships);
		$('#computer_hits').attr('src',data.computer_hits);
	});
}
function update_queue() {
	$.get('game/get_queue.php',function(data) {
		$('#player_queue').html(data);
	});
}
function restart_game() {
	if (confirm("Restart game?\n\nAll scores and grids will be reset.")) {
		$.get('game/restart_game.php',function(data) {
			update_grids();
			update_queue();
			update_scoreboard();
		});
	}
}
/* First Level Logic */
$("#player_ships").click(function(e){
   var parentOffset = $(this).offset(); 
   //or $(this).offset(); if you really just want the current element's offset
   var relX = e.pageX - parentOffset.left;
   var relY = e.pageY - parentOffset.top;
   
   var relX = Math.floor(relX / 32)-1;
   var relY = Math.floor(relY / 32)-1;
   console.log("Placing Ship at "+relX+"x"+relY);
   $.get("game/place_ship.php?x="+relX+"&y="+relY,function(data){
		update_grids();
		update_queue();
   });
});

$("#computer_hits").click(function(e){
   var parentOffset = $(this).offset(); 
   //or $(this).offset(); if you really just want the current element's offset
   var relX = e.pageX - parentOffset.left;
   var relY = e.pageY - parentOffset.top;
   
   var relX = Math.floor(relX / 32)-1;
   var relY = Math.floor(relY / 32)-1;
   console.log("Placing Hit");
   $.get("game/place_hit.php?x="+relX+"&y="+relY,function(data){
		update_grids();
   });
});