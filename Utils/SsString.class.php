<?php
	namespace Utils;

	require_once('Overloadable.trait.php');

	class SsString
	{
		use Overloadable;
		// TODO check size in all method
		// TODO exception ?
		// TODO position / include / exclude ?
		// TODO gérer paramètre string ou SsString
		// TODO toujours retourner l'objet pour pouvoir chaîner les appels
		// TODO utiliser le keyword "void" en paramètre et en retour de méthode
		// TODO check all arguments and type arguments and number of arguments in methods
		// TODO générer doc doxygen
		// TODO envisager le découpage

		static private $maxSize = 2147483647;

		private $string = "";

		private static function testI(int $arg)
		{
			echo "integer !<br/>";
		}

		private static function testS(string $arg)
		{
			echo "string !<br/>";
		}

		private function __constructS(string $param)
		{
			if(is_string($param)) {
				$this->string = $param;
			} else if (is_array($param)) {
				$this->string = implode($param);
			}
		}

		private function __constructAS($array, $separator)
		{
			$this->string = implode($separator, $array);
		}

		public function __destruct()
		{

		}

		public function __get($name)
		{

		}

		public function __set($name, $value)
		{

		}

		public function __isset($name)
		{

		}

		public function __unset($name)
		{

		}

		public function __sleep()
		{

		}

		public function __wakeup()
		{

		}

		public function __toString()
		{

		}

		public function __invoke()
		{

		}

		public function __set_state()
		{

		}

		public function __debugInfo()
		{
			
		}

		public function get() : string
		{
			return $this->string;
		}

		public function set(string $newString)
		{
			$this->string = $newString;
		}

		public function size() : int
		{
			return strlen($this->string);
		}

		public function maxSize() : int
		{
			return self::$maxSize;
		}

		public function clear()
		{
			$this->string = "";
		}

		public function isEmpty() : bool
		{
			return $this->size() == 0;
		}

		public function at(int $index) : string
		{
			return substr($this->string, $index, 1);
		}

		public function back() : string
		{
			return $this->at($this->size() - 1);
		}

		public function front() : string
		{
			return $this->at(0);
		}

		public function append(string $rightOperand)
		{
			$this->string = $this->string . $rightOperand;
		}

		public function assign(string $rightOperand, $position = 0)
		{
			$this->string = substr($this->string, 0, $position) . $rightOperand . substr($this->string, strlen($rightOperand) + $position);
		}

		public function insert(string $newElement, int $position)
		{
			$this->string = substr($this->string, 0, $position) . $newElement . substr($this->string, $position);
		}

		private function eraseI(int $begin)
		{
			$this->string = substr($this->string, 0, $begin);
		}

		private function eraseII(int $begin, $size)
		{

			$this->string = substr($this->string, 0, $begin - 1) . substr($this->string, $begin + $size - 1);
		}

		public function replace(string $lastString, string $newString)
		{
			$this->string = str_replace($lastString, $newString, $this->string);
		}

		public function replaceBinary(string $lastString, string $newString)
		{
			$this->string = strtr($this->string, $lastString, $newString);
		}

		public function swap(SsString $secondString)
		{
			$tmp = $this->string;
			$this->string = $secondString->get();
			$secondString->set($tmp);
		}

		public function pop() : string
		{
			$char = $this->back();
			$this->erase($this->size());
			return $char;
		}

		public function explode($separator) : array
		{
			if(is_int($separator)) {
				return str_split($this->string, $separator);
			} else if(is_string($separator)) {
				return explode($separator, $this->string);
			}
		}

		public function repeat(int $multiple)
		{
			$this->string = str_repeat($this->string, $multiplie);
		}

		public function compare(string $rightOperand) : bool
		{
			return strcmp($this->string, $rightOperand);
		}

		public function trim()
		{
			$this->string = trim($this->string);
		}

		public function trimFirst()
		{
			$this->string = ltrim($this->string);
		}

		public function trimLast()
		{
			$this->string = rtrim($this->string);
		}

		public function upper()
		{
			$this->string = strtoupper($this->string);
		}

		public function upperFirst()
		{
			$this->string = ucfirst($this->string);
		}

		public function upperWords()
		{
			$this->string = ucwords($this->string);
		}

		public function lower()
		{
			$this->string = strtolower($this->string);
		}

		public function lowerFirst()
		{
			$this->string = lcfirst($this->string);
		}

		public function lowerWord()
		{
			
		}

		public function substring()
		{
	        $args = func_get_args();
	        $nbArgs = func_num_args();
	        $function = 'substring'.$nbArgs;
	        if (method_exists($this, $function)) {
	            call_user_func_array(array($this, $function), $args);
	        }
		}

		public function substring1(int $begin)
		{
			return substr($this->string, $begin);
		}

		public function substring2(int $begin, int $length)
		{
			return substr($this->string, $begin, $length);
		}

		public function findFirstOf(string $needle)
		{

		}

		public function findLastOf(string $needle)
		{
			
		}

		public function findFirstNotOf(string $needle)
		{

		}

		public function findLastNotOf(string $needle)
		{

		}

		public function reverse()
		{
			$this->string = strrev($this->string);
		}

		public function complete(string $complement, int $length)
		{
			$this->string = str_pad($this->string, $length, $complement);
		}

		public function completeReverse(string $complement, int $length)
		{
			$this->string = str_pad($this->string, $length, $complement, STR_PAD_LEFT);
		}

		public function completeBalanced(string $complement, int $lenght)
		{
			$this->string = str_pad($this->string, $length, $complement, STR_PAD_BOTH);	
		}

		public function stats() : array
		{
			return count_chars($this->string);
		}
	}
?>