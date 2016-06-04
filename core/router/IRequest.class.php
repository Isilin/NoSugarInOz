<?php
	namespace core\router;

	interface IRequest
	{
		public abstract function getMethod(): string;

		public abstract function getResource(): string;

		public abstract function getParameter(string $keyIn): string;
	}