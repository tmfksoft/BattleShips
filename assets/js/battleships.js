/* Update the Page and Playing Field */
function update_grids() {
	$.getJSON('game/get_grids.php',function(data) {
		$('#player_ships').attr('src',data.player_ships);
		$('#computer_hits').attr('src',data.computer_hits);
	});
}
function update_scoreboard() {
	$.get('game/get_scoreboard.php',function(data) {
		$('#player_ships').attr('src',data.player_ships);
		$('#computer_hits').attr('src',data.computer_hits);
	});
}
/* First Level Logic */

$("#player_ships").click(function(e){
   var parentOffset = $(this).parent().offset(); 
   //or $(this).offset(); if you really just want the current element's offset
   var relX = e.pageX - parentOffset.left;
   var relY = e.pageY - parentOffset.top;
   
   var relX = Math.floor(relX / 32)-1;
   var relY = Math.floor(relY / 32)-1;
   console.log("Placing Ship");
   $.get("game/place_ship.php?x="+relX+"&y="+relY,function(data){
		update_grids();
   });
});

$("#computer_hits").click(function(e){
   var parentOffset = $(this).parent().offset(); 
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