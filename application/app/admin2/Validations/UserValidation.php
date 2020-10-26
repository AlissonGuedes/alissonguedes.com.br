<?php

namespace App\Validations {

	use \App\Entities\User;

	class UserValidation {

		public function __construct(){

			$this -> user = new User();

		}

		public function getAllowedFields() {

			if ( ! isset($_POST['_method']) ) {
				return array();
			}

			$fields = array(
				'id_grupo',
				'id_gestor',
				'nome',
				'email',
				'login',
				( ! empty($_POST['pass']) ? 'pass' : NULL ),
				'hide_menu',
				'status'
			);

			return $fields;

		}

		public function getValidationRules() {

			if ( ! isset($_POST['_method']) || ( isset($_POST['_method']) && $_POST['_method'] === 'delete') )
				return array();

			if ( isset($_POST['acao']) && $_POST['acao'] === 'login' ) {
				return array(
					'login' => array(
						'trim',
						'required',
						'min_length[5]',
						'max_length[255]'
					),
					'pass' => array(
						'trim', 
						'required',
						'min_length[5]',
						'max_length[255]'
					)
				);
			}

			$rules = array();

			return $rules;

		}

	}

}