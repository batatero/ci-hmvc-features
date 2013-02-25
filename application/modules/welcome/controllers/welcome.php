<?php
	class Welcome extends MX_Controller 
	{
		private $data;
		//public $autoload = array('libraries' => array(''), 'helpers' => array(''));


	    function __construct() {
	        parent::__construct(); 
        }

		public function index()
		{
			$this->layout->setLayout('layout/welcome_layout');
			$this->layout->view('welcome.php');
		}
	}
?>