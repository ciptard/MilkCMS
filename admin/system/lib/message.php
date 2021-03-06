<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class message {

	var $message;
	var $error;
	
	public function set($message, $error = false) {
		
		$this -> message = self::getMessage($message);
		$this -> error = $error;
		
	}
	
	public function get() {
	
		$message = $this -> message;
		$error = $this -> error;
		
		if (!empty($message)) {
		
			if ($error) $class = 'error';
			else $class = 'success';
			
			require_once(c::get('root.site') . '/templates/includes/message.php');
			
		}
		
	}
	
	public static function getMessage($message) {
	
		$messages = yaml::load(c::get('root.site') . '/messages/messages.php');
		
		return $messages[$message];
		
	}

}

?>