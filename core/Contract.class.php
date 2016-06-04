<?php
	namespace core;

	class Contract
	{
		static public function onAssertFailure($file, $line, $message)
		{
		    echo "<hr>Assertion Failed:<br />
		    		File : $file<br />
		    		Line : $line<br />
		    		Assertion : '". substr($message, 0, strpos($message, '; //*')) ."'<br />
		    		Error : ". substr($message, strpos($message, '; //*')+5) ."<br /><hr />";
		}

		public static function initialize($activateIn)
		{
			assert_options(ASSERT_ACTIVE, $activateIn);
			assert_options(ASSERT_BAIL, false);
			assert_options(ASSERT_WARNING, false);
			assert_options(ASSERT_QUIET_EVAL, true);
			assert_options(ASSERT_CALLBACK, array('Core\Contract', 'onAssertFailure'));
		}

		public static function assert($expressionIn, $messageIn)
		{
			assert($expressionIn .'; //*'. $messageIn);
		}

		public static function assertIsInstanceOf($object, $type)
		{
			assert('$object instanceof $type ; //* This variable should be a ' . $type . '.');
		}
	}