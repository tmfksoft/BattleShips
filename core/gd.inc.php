<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Image File - 60% of This file is Debug. :|
// Generates the Grid image to display to the user.
class battle_gd {
	public function image_grid($draw_ships = false) {
		// Returns Image Data in PNG Format.
		
		// Grid Data
		$rows = 10;
		$cols = 10;
		$font = 5;
		$debug = false; // Do we spit out debug. [WARNING] VERY MESSY
		
		$ships = array();
		$ships[] = array("dir"=>1,"len"=>3,"x"=>8,"y"=>4);
		$ships[] = array("dir"=>0,"len"=>5,"x"=>4,"y"=>2);
		$ships[] = array("dir"=>1,"len"=>3,"x"=>0,"y"=>7);
		$ships[] = array("dir"=>0,"len"=>2,"x"=>2,"y"=>5);
		
		$hits = array();
		$hc = rand(5,100);
		for ($ly = 0; $ly != $hc; $ly++) {
			$hits[] = array("x"=>rand(0,$cols-1),"y"=>rand(0,$rows-1));
		}
		
		// Cell Sizes.
		$width = 32;
		$height = 32;
		
		// Grid Size, Takes into account the Grid lines and such
		$g_w = $width * $cols + $width + ($cols*2);
		$g_h = $height * $rows + $height + ($rows*2);
		
		// Create template image and give it no background
		$grid = imagecreatetruecolor($g_w,$g_h);
		imagealphablending($grid, true);
		$bg_colour = imagecolorallocatealpha($grid, 0, 0, 0, 127); 
		imagefill($grid, 0, 0, $bg_colour); 
		imagesavealpha($grid, true);
		
		// Draw our background
		$water = imagecolorallocate($grid, 155, 199, 228);
		imagefilledrectangle($grid, $width, $height, $width * $cols + $width, $height * $rows + $height, $water);
		
		// Draw Grid Lines.
		
		// Make some colours
		$black = imagecolorallocate($grid, 0, 0, 0); // Allocate the Black Colour.
		$red = imagecolorallocate($grid, 255, 0, 0); // Allocate the Black Colour.
		
		// Draw the headers first.
		imageline($grid, $width,0, $width * $cols + $width, 0, $black); // Top
		imageline($grid, 0 , $height, 0, $height * $rows + $height, $black); // Left
		
		// Now the rest.
		for ($ly = 0; $ly != $rows+1; $ly++) {
			for ($lx = 0; $lx != $cols+1; $lx++) {
				imageline($grid, 0, $ly * $height + $height, $width * $cols + $width, $ly * $height + $height, $black); // Rows
				imageline($grid, $width * $lx + $width, 0, $width * $lx + $width, $height * $rows + $height, $black); // Cols
			}
		}
		// Draw column ID's
		for ($c = 0; $c != $cols; $c++) {
			imagestring($grid, $font, $width * $c + $width/2 + $width - ($font*strlen($c+1)), $height/2 - $font, $c+1, $black);
		}
		// Draw row ID's
		for ($r = 0; $r != $rows; $r++) {
			imagechar($grid, $font, $width/2 - $font, $height * $r + $height/2 + $height - $font, chr(65+$r), $black);
		}
		
		// Now we draw the Ships on the Grid.
		if ($draw_ships) {
			foreach ($ships as $sid => $sh) {
				$res = imagecreatefrompng(config::get("root")."assets/img/ship_{$sh['len']}.png"); // Load the Ship Image
				// Ensure it realises we want maintain alpha transparency.
				imagealphablending($res, true);
				imagesavealpha($res, true);
				
				$w = imagesx($res);
				$h = imagesy($res);
				
				// Copy it to the right place on the grid.
				
				// Does it need to be rotated?
				if ($sh['dir'] == 1) {
					$nres = imagerotate($res, -90, $bg_colour);
					$res = $nres;
				}
				
				// DST, SRC, DSTX, DSTY, SRCX, SRCY, DSTW, DSTH, SRCW, SRCH
				if ($sh['dir']) {
					imagecopyresampled($grid, $nres, $sh['x'] * $width + $width, $sh['y'] * $height + $height, 0, 0, $height, $width * $sh['len'], $h, $w);
				} else {
					imagecopyresampled($grid, $res, $sh['x'] * $width + $width, $sh['y'] * $height + $height, 0, 0, $width * $sh['len'], $height, $w, $h);
				}
				
				if ($debug) imagestring($grid, 5, $sh['x'] * $width + $width + ($width-10), $sh['y'] * $height + $height, $sid, $red);
				if ($debug && $sh['dir']) imagestring($grid, 5, $sh['x'] * $width + $width + ($width-10), $sh['y'] * $height + $height + 30, "V", $red);
				if ($debug && !$sh['dir']) imagestring($grid, 5, $sh['x'] * $width + $width + ($width-10), $sh['y'] * $height + $height + 30, "H", $red);
				
				imagedestroy($res); // Destroy what we dont need.
			}
		}
		
		// Finally. Time to draw the Hits on the grid.
		$shot = 0;
		foreach ($hits as $hid => $ht) {
			$type = 0;
			// Determine if this is a hit image or not.
			foreach ($ships as $sid => $sh) {
				// Check for a direct hit.
				if ($ht['x'] === $sh['x'] && $ht['y'] === $sh['y']) {
					if ($debug) imagechar($grid, 5, $ht['x'] * $width + $width, $ht['y'] * $height + $height, "A", $red);
					$type++;
				} else {
					if ($sh['dir'] == 1) {
						// Its vertical.
						if ($ht['x'] === $sh['x']) {
							if ($ht['y'] <= $sh['y']+$sh['len']-1) {
								if ($ht['y'] >= $sh['y']) {
									$type++;
									if ($debug) imagechar($grid, 5, $ht['x'] * $width + $width + 10, $ht['y'] * $height + $height, "B", $red);
								}
							}
						}
					} else {
						// Its horizontal
						
						if ($ht['y'] == $sh['y']) {
							if ($ht['x'] <= $sh['x']+$sh['len']-1) {
								if ($ht['x'] >= $sh['x']) {
									$type++;
									if ($debug) imagechar($grid, 5, $ht['x'] * $width + $width + 20, $ht['y'] * $height + $height, "C", $red);
								}
							}
						}
						
					}
				}
				// Spew the Ship ID we're checking
				if (!$type) {
					// Miss!
					if ($debug) imagestring($grid, 5, $ht['x'] * $width + $width + 13 * $sid, $ht['y'] * $height + $height + 49, $sid, $red);
				} else {
					// Hit!
					if ($debug) imagestring($grid, 5, $ht['x'] * $width + $width + 13 * $sid, $ht['y'] * $height + $height + 52, $sid, $red);
				}
				if ($debug && $sh['dir']) imagestring($grid, 5, $sh['x'] * $width + $width + ($width-10), $sh['y'] * $height + $height + 40, "V", $red);
				if ($debug && !$sh['dir']) imagestring($grid, 5, $sh['x'] * $width + $width + ($width-10), $sh['y'] * $height + $height + 40, "H", $red);
				
				// ship pos
				if ($debug) imagestring($grid, 3, $ht['x'] * $width + $width + 30 + ($sid * 10), $ht['y'] * $height + $height + 13, $sh['x'], $red);
				if ($debug) imagestring($grid, 3, $ht['x'] * $width + $width + 30 + ($sid * 10), $ht['y'] * $height + $height + 26, $sh['y'], $red);
			}
			
			if ($type) {
				$shot++;
				$res = imagecreatefrompng(config::get("root")."assets/img/hit.png"); // Load the Hit Image
				if ($debug) imagechar($grid, 5, $ht['x'] * $width + $width + 30, $ht['y'] * $height + $height, "D", $red);
			} else {
				$res = imagecreatefrompng(config::get("root")."assets/img/miss.png"); // Load the Miss Image
				if ($debug) imagechar($grid, 5, $ht['x'] * $width + $width + 40, $ht['y'] * $height + $height, "E", $red);
			}
			
			
			// Get the size.
			$w = imagesx($res);
			$h = imagesy($res);
			
			// Copy it to the right place
			// DST, SRC, DSTX, DSTY, SRCX, SRCY, DSTW, DSTH, SRCW, SRCH
			imagecopyresampled($grid, $res , $ht['x'] * $width + $width, $ht['y'] * $height + $height, 0, 0, $width, $height, $w, $h);
			imagedestroy($res);
			
			// Debug data
			if ($debug) imagestring($grid, 5, $ht['x'] * $width + $width, $ht['y'] * $height + $height + 13, "X:".$ht['x'], $red);
			if ($debug) imagestring($grid, 5, $ht['x'] * $width + $width, $ht['y'] * $height + $height + 26, "Y:".$ht['y'], $red);
			if ($debug && $type) imagestring($grid, 4, $ht['x'] * $width + $width, $ht['y'] * $height + $height + 36, "HIT!", $red);
			if ($debug && !$type) imagestring($grid, 4, $ht['x'] * $width + $width, $ht['y'] * $height + $height + 36, "MISS!", $red);
		}
		if ($debug) imagestring($grid, 5, 5, 5, $shot, $red);
		
		ob_start();
			imagepng($grid);
			$image = ob_get_contents();
		ob_end_clean();
		
		return $image;
		
	}
}
?>