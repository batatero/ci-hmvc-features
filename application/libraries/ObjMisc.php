<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class ObjMisc 
{
  
  public $data = array();

  private function getCI () {
    $CI =& get_instance();
    return $CI;
  }

  public function mensagens() {
  //recebe a msg adiciona na sessao
  $msg = $this->getCI()->session->flashdata('msg');

  // Verifica se a msg é vaizia caso não tenha nada atribui null
  if(empty($msg)){
    $msg = null;
  }
  //tra erros de estrutura de msg
  try {
    //verifica se o paramatro passado é um array
    if(is_array($msg)){
      
      //percorre o array e verifica sua estrutura
      foreach( $msg as $msgChave => $msgValor ) {
        
        //padrão de msg a ser exibido na tela
        $padraoDefinido = array('error','success','info');
        
        //Verifica se a $msg está na estrutura de array correta
        if( !in_array($msgChave,$padraoDefinido) ) {
          throw new Exception('A variável $msg não está defina de acordo com o padrão. <br> Ela deve ser um array contendo uma dessas chaves msg[error], msg[success], msg[info]. <br><br>Estrutura array $msg[' .$msgChave. '] = '. $msgValor);
          break;
        }
      }
      //zera os indices do foreach
      $msgChave = null;
      $msgValor = null;
      
      //adiciona as msg
      foreach( $msg as $msgChave => $msgValor ){
        //adiciona a msg ma view
        $this->data[$msgChave]['conteudo'] = $msgValor;
      }
        
    }   
  } catch ( Exception $e ) {
    trigger_error(utf8_decode($e->getMessage()), E_USER_ERROR);
    throw new Exception(utf8_decode($e->getMessage()));
  }

  //carraga a view com as msg
  $this->getCI()->load->view('mensagem',$this->data);
  }

}