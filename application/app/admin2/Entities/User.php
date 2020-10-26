<?php 

namespace App\Entities {

	class User {

		private $login ;
		private $pass ;

		public function __construct() {

		}

		public function setLogin($str) {
			$this -> login = $str;
			return $this;
		}

		public function getLogin() {
			return $this -> login;
		}

		public function setPass($pass) {
			$this -> pass = $pass;
			return $this;
		}

		public function getPass() {
			return $this;
		}

	}

}