<?php 

namespace App\Controllers {
	
	use  \App\Models\UserModel;
	
	class Login extends AppController {
		
		public function __construct() {
			
			$this -> user_model = new UserModel();
		
		}

		public function index() {

			if ( ! isset($_SESSION[USERDATA]) ) {
				$dados['page_title'] = traduzir('label_area_admin', 'Área Restrita');
				$dados['method'] = 'post';
				return $this -> view('login/index', $dados);
			}
			
		}

		/**
		 * @method auth
		 */
		public function auth() {

			$status		= 'error';
			$message	= null;
			$data		= null;
			$fields		= null;
			$text		= null;
			$url		= base_url();
			$type		= 'reload';

			if ( $user = $this -> user_model -> userAuthentication() ) {

				$status		= 'first_auth';
				$message	= 'Usuário logado com sucesso';

				if ( isset($user['logged']) && $user['logged']) {

					$status		= 'success';
					$data		= [USERDATA => $user];
					$this -> session -> set($data);

				}

			} else {

				$text   = 'Por favor, verifique os campos marcados.';
				$fields = $this -> user_model -> errors();

			}

			echo json_encode(array(
				'status'	=> $status,
				'message'	=> $message,
				'data'		=> $data,
				'fields'    => $fields,
				'url'		=> $url,
				'type'		=> $type
			));

		}

        public function logout()
        {
			$this -> session -> remove(USERDATA);
			location( base_url() . 'login' );
		}

	}

}