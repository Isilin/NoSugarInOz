<?php
	namespace core;

	define("BROWSER", 0);
	define("FILE", 1);
	
	class Log
	{
		private static $mode = BROWSER;
		
		public static function setMode($modeIn)
		{
			Log::$mode = $modeIn;
		}
		
		public static function info($stringIn)
		{
			if (Log::$mode == 0) {
				echo '<span class="log_info">';
				echo '<i>[' . date('Y-m-d H:i:s') . ']</i><b>[INFO]</b> ' . $stringIn;
				echo '</span>';
			} else {
				$file = fopen('../core/log.log', 'a');
				if ($file) {
					fwrite($file, '[' . date('Y-m-d H:i:s') . '][INFO] ' . $stringIn);
				} else {
					echo 'Error : forbidden to write logs.<br>';
				}
				fclose($file);
			}
		}
		
		public static function exception($stringIn)
		{
			if (Log::$mode == 0) {
				throw new \Exception('<span class ="log_exception"><i>[' . date('Y-m-d H:i:s') . ']</i><b>[ERROR]</b> ' . $stringIn . '</span>');
			} else {
				$file = fopen('../core/log.log', 'a');
				if ($file) {
					fwrite($file, '[' . date('Y-m-d H:i:s') . '][ERROR] ' . $stringIn);
				} else {
					echo 'Error : forbidden to write logs.<br>';
				}
				fclose($file);
			}
			exit();
		}
		
		public static function taggedLog($tagIn, $stringIn)
		{
			if (Log::$mode == 0) {
				echo '<span class="log_tagged">';
				echo '<i>[' . date('Y-m-d H:i:s') . ']</i><b>[' . $tagIn . ']</b> ' . $stringIn;
				echo '</span>';
			} else {
				$file = fopen('../core/log.log', 'a');
				if ($file) {
					fwrite($file, '[' . date('Y-m-d H:i:s') . '][' . $tagIn . '] ' . $stringIn);
				} else {
					echo 'Error : forbidden to write logs.<br>';
				}
				fclose($file);
			}
		}
	}