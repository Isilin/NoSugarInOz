<?php
	namespace core\router;

	use core\Log;
	use core\util\JsonBuilder;
	use core\Contract;

	class Web
	{
		private $ways = null;

		public function __construct(string $file)
		{
			$this->ways = array();
			$this->addWays($file);
		}

		public function addWays(string $file) {
			$builder = new JsonBuilder();
			$content = $builder->loadContent($file);
			if(!array_key_exists('root', $content)) {
				Log::exception('The config file should contain a root member.');
			}
			if(!array_key_exists('ways', $content)) {
				Log::exception('The config file should contain a ways member.');
			}
			foreach ($content['ways'] as $value) {
				$way = new Way($value, $content['root']);
				$this->ways[$way->getPath()] = $way;
			}
			Log::info('Ways loaded from ' . $file . '.</br>');
		}

		public function existsWay(string $way)
		{
			$found = false;
			while(!$found && list($key, $value) = each($this->ways)) {
				$found = ($value->getPath() == $way);
			}
			return $found;
		}

		public function getWay(string $way)
		{
			return $this->ways[$way];
		}
	}