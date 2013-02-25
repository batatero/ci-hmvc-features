<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class ObjAutenticacao
{
	
	private $method; //String
	
	function __construct($usuario = NULL, $senha = NULL){
	}
    
	//------------------------------------------------------------------------------------------------//
    
	/**
	 * Verfica se o usuario tem acesso ao sistema recebendo a model que 
	 * irá verificade modo dinamico desque a query contenha usuario e senha
	 * @param string $usuario
	 * @param string $senha
	 */
	public function autenticar( $usuario = NULL , $senha = NULL, $parms = NULL){
		
		//verifica se o usuario passou os paramentro para verificao
		if ($usuario == NULL OR $senha == NULL) {
			return false;
		}
		
		if( $this->_required(array('method')) ){
			//carrega a model setada no parametro
			$this->getCI()->load->model('autenticacao_model','autenticacao_model',true);
			
			//verifica se foi passado mais parametros para a autenticaçao
			if( $parms ) {
				//busca os dados do usuario com paramentros especificos
				$autenticacao = $this->getCI()->autenticacao_model->{$this->method}($usuario,$senha, $parms);
			} else {
				//busca os dados do usuario
				$autenticacao = $this->getCI()->autenticacao_model->{$this->method}($usuario,$senha);
			}
			
			//verifica se veio os dados do usuario
			if( $autenticacao ) {
				//recebe os dados do usuario
				$usuario = current( $autenticacao->result() );
				$sessionUsuario['info'] = $usuario;
				$sessionUsuario['autenticacao'] = true;
				
				//adiciona os dados do usuario na sessao
				$this->getCI()->session->set_userdata('usuario',$sessionUsuario);
				return true;
			} else {
				//destroi toda a sessao que o usuario estava logado caso ela exista
				$this->getCI()->session->set_userdata('usuario',null);

				return false;
				
			}
		}
	}

	//------------------------------------------------------------------------------------------------//
	
	/**
	 * verifica se o usuario está logado no sistema caso esteja retorna true 
	 * se não retorna false para que o desenvolvedor passa fazer suas validaçoes
	 */
	
	public static  function verificaAutenticacao(){
		// Recebe a sessao do usaurio 
		$sessionUsuario = self::getCI()->session->userdata('usuario');
		//verifica se a variavel foi setada
		return ( isset($sessionUsuario['autenticacao']) ) ? true : false;
	}

	//------------------------------------------------------------------------------------------------//
	/**
	 * Verifica seousuario está autenticado caso não esteja redireciona o usuario para 
	 * a pagina de login 
	 */
	public static  function executaAutenticacao(){
		//verifica se o usuario nao está autenticado
		if( ! ObjAutenticacao::verificaAutenticacao() ) {
			
// 			self::getCI()->session->sess_destroy();
			
			//verifica se o usuario está na pagina index
			if ( ! class_exists('autenticacao') ) {
				$msg['error'][] = 'Você não está logado!';
				self::getCI()->session->set_flashdata('msg',$msg);
				redirect('autenticacao');

			}
		}
	}	
	//instancia da model e do core do code CI
	private function getCI () {
		$CI =& get_instance();
		return $CI;
	}
	

	//method magico para  acessar as variaveis
	public function __set( $var, $val ) {
		$this->$var = $val;
	}
	
	public function __get( $var ) {
		return $this->$var;
	}
	
	/**
	 * recebe como paramentro um array com os nomes dos atributos
	 * e verifica se o atributo foi setado caso n�o tenha sido setado
	 * retorna um erro dizendo que o atribuoto � obrigatorio
	 * @param mixed $data
	 * 
	 * return boolean
	 */
	private function _required( $data = array() ) {
		if( count($data) > 0 ) {
				
			foreach ( $data as $field ) {
				
				if ( $this->$field == NULL ) {
					trigger_error('Atributo \''.$field.'\' vazio', E_USER_ERROR);
					throw new Exception('Atributo \''.$field.'\' vazio');
					return false;
					break;
				}
			}
		}
		
		return true;
	}
}

//end of file