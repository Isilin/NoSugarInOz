<?php
	namespace core\router;

	use core\router\IRequest;

	class HttpRequest implements IRequest
	{
		private $method;
		private $resource;
		private $parameters;


		public function __construct()
		{
			if (array_key_exists('method', $_POST) && isset($_POST['method'])) {
				$this->method = $_POST['method'];
			} else {
				$this->method = 'GET';
			}

			$this->resource = substr($_SERVER['REQUEST_URI'], 1);

			if(strpos($this->resource, '?')) {
				$this->resource = substr($this->resource, 0, strpos($this->resource, '?'));
			}

			$this->resource = $_SERVER['SERVER_NAME'] . '/' . $this->resource;

			if($this->method == 'GET') {
				$this->parameters = $_GET;
			} else {
				$this->parameters = $_POST;
				unset($this->parameters['method']);
			}
		}

		public function getMethod(): string
		{
			return $this->method;
		}

		public function getResource(): string
		{
			return $this->resource;
		}

		public function getParameter(string $keyIn): string
		{
			return $this->parameters[$keyIn];
		}
	}