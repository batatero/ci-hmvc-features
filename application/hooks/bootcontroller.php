<?php
class BootController {
	/**
	 * verifica se o usuario está locado ao acessar uma
	 * controller caso não tenha permissão redireciona para
	 * pagina inicial
	 */
	public function verificaAutenticacao () {
		$this->getCI()->load->library('ObjAutenticacao');
		
		//inicia as variaveis
		$verificar = true;
		
		//array com as contrller que e methods que não vão validar autenticacao INI {
		
		$controllers[] = array(
			'controller' => 'example', 
			'method' => null
		);
		/*
		$controllers[] = array(
			'controller'=> 'request',
			'method' => null,
		);
		*/
		
		//array com as contrller que e methods que não vão validar autenticacao FIM }
		
		foreach($controllers as $chave => $valor ) {
			if ( $valor['method'] != null ) {
				if ( 
					$this->getCI()->router->fetch_class() == $valor['controller'] AND 
					$this->getCI()->router->fetch_method() == $valor['method'] 
				) {
					$verificar = false;
				}	
			} else {
				if ( $this->getCI()->router->fetch_class() == $valor['controller'] ) {
					$verificar = false;
				}
			}
		}
		
		//verifica se vai executar a autenticação 
		if ( $verificar ) { 
			ObjAutenticacao::executaAutenticacao();
		}
	}
	
	//instancia da model e do core do code CI
	private function getCI () {
		$CI =& get_instance();
		return $CI;
	}
	
}
