<?php

	
	class Session {
		
		const SESSION_STARTED = TRUE;
		const SESSION_NOT_STARTED = FALSE;
		
		private $sessionState = self::SESSION_NOT_STARTED;
		private static $instance;
		
		
		private function __construct() {}

    	public static function getInstance()
		{
			if ( !isset(self::$instance))
			{
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function start($name, $secure = true) {
			if (ini_set('session.use_only_cookies', 1) === FALSE)
				return false;

			//$secure = _SECURE;
			$httponly = true;
			$cookieParams = session_get_cookie_params();
			session_set_cookie_params(
										$cookieParams["lifetime"],
										$cookieParams["path"], 
										$cookieParams["domain"], 
										$secure,
										$httponly
									);					
			session_name($name);
						
			if ($this->sessionState !== self::SESSION_STARTED)
				$this->sessionState = session_start();
				
		    //session_regenerate_id(true); 
			return ($this->sessionState === self::SESSION_STARTED);
		}

		public function close() {
			if ($this->sessionState !== self::SESSION_NOT_STARTED) {
				session_write_close();
				$this->sessionState = self::SESSION_NOT_STARTED;
			}
			
			return ($this->sessionState === self::SESSION_NOT_STARTED);
		}

    	public function destroy()
		{
			if ($this->sessionState !== self::SESSION_NOT_STARTED) {
				unset($_SESSION);		
				$params = session_get_cookie_params();
				setcookie(session_name(),'', time() - 42000,$params["path"],$params["domain"],$params["secure"],$params["httponly"]);
				$this->sessionState = !session_destroy();
				
				return ($this->sessionState === self::SESSION_NOT_STARTED);
			}
			return FALSE;
		}
		
		public function __set($name , $value) {
			$_SESSION[$name] = $value;
		}
		
		public function __get($name) {
			if (isset($_SESSION[$name]))
				return $_SESSION[$name];
			return null;
		}
		
		public function __isset($name) {
			return isset($_SESSION[$name]);
		}
		
		public function __unset($name) {
			unset($_SESSION[$name]);
		}
		
		public function checkCSRF($token) {
			if (Utils::isNullOrEmpty($token) || ($this->sessionState !== self::SESSION_STARTED))
				return false;
			return ($this->csrf === $token);
		}
	
		public static function newCSRF() {
			$token = md5(uniqid(rand(), true));

			return $token;
		}

	}
?>