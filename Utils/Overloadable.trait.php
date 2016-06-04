<?php
	namespace Utils;

    function overload(string $name, array $parameters)
    {
        $function = $name . generateSuffixe($parameters);
        if (function_exists($function)) {
            return call_user_func_array($function, $args);
        } else {
            echo $function . '(' . implode($args, ',') . ') cannot be found !<br/>';
        }
    }

    function generateSuffixe(array $args) : string
    {
        $suffixe = '';
        foreach ($args as $val) {
            $suffixe = $suffixe . getSuffixe($val);
        }
        return $suffixe;
    }

    function getSuffixe($arg) : string
    {
        $type = gettype($arg);
        $arg = substr(ucfirst($type), 0, 1);
        return $arg;
    }

	trait Overloadable
	{
		public function __construct()
		{
			return $this->callMethod('__construct', func_get_args());
		}

		public function __call(string $name, array $args)
		{
			return $this->callMethod($name, $args);
		}

		public static function __callStatic(string $name, array $args)
		{
			return self::callStaticMethod($name, $args);
		}

        private function callMethod(string $name, array $args)
        {
        	$method = $name . generateSuffixe($args);
        	if (method_exists($this, $method)) {
        		return call_user_func_array(array($this, $method), $args);
        	} else {
        		echo $method . '(' . implode($args, ',') . ') cannot be found !<br/>';
        	}
        }

        private static function callStaticMethod(string $name, array $args)
        {
        	$className = get_called_class();
        	$method = $name . generateSuffixe($args);
        	if (method_exists($className, $method)) {
        		return call_user_func_array($className . '::' . $method, $args);
        	} else {
        		echo $className . '::' . $method . '(' . implode($args, ',') . ') cannot be found !<br/>';
        	}
        }
	}
?>