<?php
// BattleShips Game
// Created by Thomas Edwards [2014]
// Template File

class template {
	public function __construct($dir = "data/tmpl/") {
		$this->files = array();
		$this->dir = $dir;
	}
	public function load($fname) {
		$file = $this->dir.$fname;
		if (file_exists($file)) {
			$f = $this->files;
			$f[] = $fname;
			$this->files = $f;
		}
	}
	public function display($ret = false,$debug = false) {
		// Display
		$files = $this->files;
		$html = "";
		$err_list = array();
		
		// Store our old Error Reporting so we can restore it.
		$err_rep = error_reporting();
		error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
		foreach ($files as $fname) {
		
			// Get our output.
			ob_start();
			include($this->dir.$fname);
			$tdat = ob_get_contents();
			ob_end_clean();
			
			// Use Magic!
			$html .= $tdat;
			
			// Check if theres an Error
			$e = error_get_last();
			if ($e) {
				$err_list[] = $e;
			}
			
		}
		// Restore our error code
		error_reporting($err_rep);
		// Now we deal with the possibility of errors.
		if (count($err_list) > 0) {
			// There were errors. Display them!
			$d = "<ul>\n";
			$debug_dat = "<br/> - <small><b>DEBUG</b> is turned <b>OFF</b></small>";
			if ($debug) {
				// Shouldn't really do this but. Meh.
				if (file_exists($e['file'])) {
					$more_temp = explode("<br />",highlight_string(file_get_contents($e['file']),true));
					$line = $more_temp[($e['line']-1)];
					$debug_dat = "<br/> - <small>".$line."</small>";
				} else {
					$debug_dat = "<br/> - <small>Unable to retrieve line from file. File doesn't exist!</small>";
				}
			}
			foreach ($err_list as $e) {
				$d .= "<li><b>ERROR</b>: {$e['message']} in {$e['file']} on line number {$e['line']}{$debug_dat}</li>";
			}
			$d .= "</ul>";
			$html = $d;
		}
		
		// Now we add on the Header and footer.
		// We're doing this last for a reason.
		// This allows other template files to set variables and such beforehand.
		// We capture the output and add it in the right places.
		
		// Header
		ob_start();
		include($this->dir."header.php");
		$html = ob_get_contents().$html;
		ob_end_clean();
		
		// Footer
		ob_start();
		include($this->dir."footer.php");
		$html = $html.ob_get_contents();
		ob_end_clean();
		
		if ($ret) {
			return $html;
		} else {
			echo $html;
		}
	}
}
?>