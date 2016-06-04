<?php
	namespace core\util;

	interface IBuilder
	{
		public function getContent(array $parametersIn): string;
	}