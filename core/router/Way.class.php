<?php
	namespace core\router;

	use core\Log;

	class Way
	{
		private $name = "";
		private $path = "";
		private $controller = "";
		private $method = "";

		public function __construct(array $parameters, string $root)
		{
			if(!array_key_exists('name', $parameters)) {
				Log::exception('The way\'s parameters should contain a name member.');
			}
			if(!array_key_exists('path', $parameters)) {
				Log::exception('The way\'s parameters should contain a path member.');
			}
			if(!array_key_exists('controller', $parameters)) {
				Log::exception('The way\'s parameters should contain a controller member.');
			}

			$this->name = $parameters['name'];
			$this->path = $root . $parameters['path'];
			$this->controller = $parameters['controller'];
			$controllerPath = explode(':', $this->controller);
			if(count($controllerPath) != 3) {
				Log::exception('The way\'s parameter controller is invalid.');
			}
			$this->controller = $controllerPath[0] . '\\controller\\' . $controllerPath[1];
			$this->method = $controllerPath[2]; 
		}

		public function getName(): string
		{
			return $this->name;
		}

		public function getPath(): string
		{
			return $this->path;
		}

		public function getController(): string
		{
			return $this->controller;
		}

		public function getMethod(): string
		{
			return $this->method;
		}
	}