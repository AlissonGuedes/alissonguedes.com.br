<?php

namespace App\Models {

	use CodeIgniter\Model;

	class AppModel extends Model {

		protected $db;

		protected $entity;
		protected $validator;
		protected $insertId = 0;

		protected $order;

		protected $allowedFields = array();

		protected $validationRules = array();

		public function __construct($class_name = null) {

			parent :: __construct();

			$this -> request = \Config\Services :: request();
			$this -> uri = \Config\Services :: uri(current_url());

			if ( $this -> returnType ) 
				$this -> entity = new $this -> returnType();
			
			if ( $this -> formValidation ) {
				$this -> validator			= new $this -> formValidation();
				$this -> allowedFields		= $this -> validator -> getAllowedFields();
				$this -> validationRules	= $this -> validator -> getValidationRules();
			}

		}

		public function error($field, string $message = null) {
			$this -> validation -> setError($field, $message);
			return $this -> validation -> getError();
		}

	}

}