<?php
	namespace core\router;

	use core\Log;
	use core\router\HttpRequest;
	use core\router\Web;
	use core\controller\FrontController;

	class Router
	{
		private $request = null;
		private $web = null;

		public function __construct()
		{
			Log::info('Loading ways ...</br>');
			$this->web = new Web("../core/config/router.json");
			$this->web->addWays("../core/config/default_router.json");
			$this->web->addWays("../app/config/router.json");
		}

		public function parseRequest()
		{
			$this->request = new HttpRequest();
			if(substr($this->request->getResource(), -1) != '/') {
				header('Location: http://' . $this->request->getResource() . '/');
			}
		}

		public function processRequest()
		{
			if($this->web->existsWay($this->request->getResource())) {
				$controller = new FrontController();
				$controller->process($this->request, $this->web->getWay($this->request->getResource()));
			} else {
				//header('Location: /404/?resource=' . $this->request->getResource());
			}
		}
	}