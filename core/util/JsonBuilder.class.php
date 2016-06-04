<?php
	namespace core\util;

	use core\util\IBuilder;
	use core\Log;

	class JsonBuilder implements IBuilder
	{
		public function __construct()
		{

		}

		public function getContent(array $parametersIn): string
		{
			return json_encode($parametersIn);
		}

		public function loadContent(string $file): array
		{
			if(file_exists($file)) {
				$content = file_get_contents($file);
				return json_decode($content, true);
			} else {
				Log::exception("The file " . $file . " doesn't exist.");
				return array();
			}
		}
	}