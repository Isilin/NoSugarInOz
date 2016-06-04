<?php
	namespace core;
	
	use core\Log;
	
	final class Autoloader
	{

		public static function register()
		{
			Log::info('Register the autoloader ...<br>');
			spl_autoload_register(array(__CLASS__, "loadClass"));
		}

		private static function loadClass($classNameIn)
		{
			assert(is_string($classNameIn));
			
			$prefix = str_replace('\\', '/', $classNameIn);
			$prefix = __DIR__.'/../'.$prefix;
			$suffix = '.class.php';
			Log::info('Loading file : ' . $prefix.$suffix . ' ...<br>');
			if (file_exists($prefix.$suffix)) {
				require_once $prefix.$suffix;
				Log::info('File ' . $prefix.$suffix . ' loaded.<br>');
			} else {
				Log::exception('The file ' . $prefix.$suffix . ' doesn\'t exist. Check the path.<br>');
			}
		}

	}