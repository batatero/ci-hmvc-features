<?php
	class Autenticacao extends MX_Controller 
	{
		private $data;//array

		public $autoload = array('libraries' => array('ObjAutenticacao','ObjMisc'));

	    function __construct() {
	        parent::__construct();
        }


		//------------------------------------------------------------------------------------//
		public function index ( ) {
			$misc = new ObjMisc();
			$this->data['mensagens'] = $misc;
			$this->load->view('login',$this->data);
			
			//destroi toda a sessao que o usuario estava logado caso ela exista
			$this->session->sess_destroy();
		}

		public function logout () {
			//destroi os dados de sessão do usuario para que ele não consiga logar
			$this->session->unset_userdata('usuario');
			
			$msg['info'][] = 'Você saiu do sistema!';
				
			$this->session->set_flashdata('msg',$msg);
			// Redireciona o usuario para o login
			redirect('autenticacao');
		}
		
		public function autenticar ( ) {
			//inicializa o objeto de autenticacao
			$atuh = new ObjAutenticacao();

			//recebe os dados via post
			$post = $this->input->post( NULL, TRUE );
			 
			//adiciona os dados de post usuario
			$usuarioPost = $post['usuario'];
		
			//verifica se ocorreu algum erro no form
			if ($this->form_validation->run('login') == FALSE) {
				//adiciona msg de erro
				$msg['error'][]= validation_errors();
				$this->session->set_flashdata('msg',$msg);
			}
		
			//seta os dados para autenticao
			$atuh->__set('method', 'autenticar');

			// Verifica se a autenticação deu errado
			if( !$atuh->autenticar( strtolower($usuarioPost['login']),md5($usuarioPost['senha']) ) ) {
				 
				//destroi os dados de sessão do usuario para que ele não consiga logar
				$this->session->unset_userdata('usuario');
				
				//adiciona msg de erro
				$msg['error'][] = 'Usuário ou senha inválidos!';
				$this->session->set_flashdata('msg', $msg);
				
				// Redireciona o usuario para o login
				redirect('autenticacao/autenticacao');

			} else {
				//recebe da sessao o usuario altenticado
				$usuario = $this->session->userdata('usuario');
				redirect('welcome');
			}
		}		
	}
?>