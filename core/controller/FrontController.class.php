<?php
	namespace core\controller;
	
	use core\Log;
	use core\router\IRequest;
	use core\router\Way;

	class FrontController
	{
		private $controller = null;

		public function __construct()
		{
		}

		public function process(IRequest $request, Way $way)
		{
			Log::info("Request is in process ...</br>");

			$this->controller = $this->buildController($way->getController());

			Log::info("Request processed.<br/>");
		}

		private function buildController(string $name) : IController
		{
			$controllerName = $name;
			$controller = new $controllerName();
			return $controller;
		}
	}