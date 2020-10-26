<?php

namespace App\Controllers{

	class Home extends AppController
	{

		public function index()
		{
			return $this -> view('home/index');
		}

		//--------------------------------------------------------------------//

		public function welcome() {

			return $this -> view('home/welcome');

		}
		
		//--------------------------------------------------------------------//

	}

}