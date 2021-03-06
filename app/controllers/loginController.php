<?php

/**
 * <b>Login Controller</b>
 * Esta classe realiza o tratamento dos parâmetros para exibição na Index, login e logout da aplicação.
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital.
 */
class Login extends F5_Controller{
    
    /**
     * Executa tudo que tem aqui antes de inicar QUALQUER action deste controller. O uso deste método é opcional, pois já está sobreescrevendo o método init() de controller do F5 Framework.
     */
    public function init() {
       $this->trataURL = new removerAcentosURLHelper();
    }
    
    /**
     * Action index do controller.
     */
    public function index_action(){
		$dados[rodape] = $this->footer();
		
		$this->view("login/index", $dados);
    }
	
    public function meus_dados(){
		
		$this->view("login/meus-dados", $dados);
    }
	
}
