<?php

namespace App\Controllers{

	class Home extends AppController
	{

		public function index()
		{
		    if ( isAjax() ) {
    			echo json_encode(['message' => 'O formulário foi desativado', 'status' => 'success']);
    			return;
    		}
			return $this -> view('home/index');
		}

		//--------------------------------------------------------------------

	}

}