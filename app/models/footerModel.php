<?php

/**
 * FooterModel
 * Tratamento de dados para a visão geral da aplicação.
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital
 */
class FooterModel extends F5_Model {
	public $_table = "f5_site_postagens";
    public $idName = "id_postagem";
	
	public function listarNoticias(){
	
		$dados = $this->read(null, 'tipo = "Notícias"', null, null, 'data_cadastro');
		
		return $dados;
	}
}