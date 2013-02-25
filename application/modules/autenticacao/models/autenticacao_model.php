<?php
class autenticacao_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	//--------------------------------------------------------------//
	
	/*
	 * buca o usuario pelo login e senha 
	 * caso o usuario tenha algum registro 
	 * retorna os dados do usuário caso contrario retorna false
	 */
	public function autenticar( $email, $senha ) {

		$this->db->where('usuario',$email);
		$this->db->where('senha',$senha);
		
		$resp = $this->db->get('usuarios');
		
		//verifica se tem alguma resposta do banco
		if ( $resp->num_rows() > 0 ){
			return $resp;
		} else {
			return false;
		}
		
	}
	

}
?>