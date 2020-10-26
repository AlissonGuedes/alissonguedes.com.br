<?php

namespace App\Models {

	/**
	 * @className UserModel
	 * @package App
	 */
	class UserModel extends AppModel {

		/**
		 * Nome da tabela do banco de dados a ser utilizada
		 * 
		 * @var string $table
		 */
		protected $table = 'tb_usuario';

		/**
		 * A chave primária da tabela
		 * 
		 * @var string $primaryKey
		 */
		protected $primaryKey = 'id';

		/**
		 * Classe espelho do banco de dados
		 * 
		 * @var string $returnType
		 */
		protected $returnType = 'App\Entities\User';

		/**
		 * Validação para formulários
		 * 
		 * @var array $formValidation
		 */
		protected $formValidation = 'App\Validations\UserValidation';

		/**
		 * Especificar quais colunas da tabela serão ordenadas
		 * 
		 * @var array $order
		 */
		protected $order = array();

		public function __construct() {

			parent :: __construct();
			$this -> user = $this -> entity;

		}

		public function userAuthentication() {

			if ( $this -> validate($_POST) === FALSE ) {
				return false;
			}

			$login = $_POST['login'];
			$pass  = isset($_POST['pass']) ? $_POST['pass'] : null;
			
			$this -> select('login,senha')
				  -> from('tb_usuario', true)
				  -> where('login', $_POST['login']);

			$user = $this -> get() -> getRowArray();

			if ( isset($user) ) {
				
				if ( isset($pass) ) {

					$password = hashCode($pass);

					if ( $password === $user['senha'] ) {

						$this -> allowedFields = ['ultimo_login'];
						// $this -> user -> setUltimoLogin('now');
						// $this -> set(['ultimo_login' => $this -> user -> getUltimoLogin() ]);
						// $this -> update(['id' => $user['id']]);
						$user['logged'] =	true;

						return $user;

					} else {

						$this -> error('pass', traduzir('invalid_password', 'Senha Incorreta.'));
						return false;
						
					}
						
				}

				return true;

			} else {

				$this -> error('login', traduzir('invalid_user', 'Usuário inativo ou inexistente.'));

			}

			return false;

		}

	}

}