<?php

/**
 * cepHelper
 * Recebe um CEP, envia ao webservice dos correios e retorna com o endereço completo.
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital
 */
class cepHelper {
    
    protected $cep;
    
    public function verificadorCEP($cep) {
        $this->cep = $cep;
        $html = $this->simple_curl('http://m.correios.com.br/movel/buscaCepConfirma.do',array(
            'cepEntrada'=>$this->cep,
            'tipoCep'=>'',
            'cepTemp'=>'',
            'metodo'=>'buscarCep'
        ));
        
        require 'complements/phpQuery-onefile.php';
        phpQuery::newDocumentHTML($html, $charset = 'utf-8');

        $dados = array(
            'logradouro'=> trim(pq('.caixacampobranco .resposta:contains("Logradouro: ") + .respostadestaque:eq(0)')->html()),
            'bairro'=> trim(pq('.caixacampobranco .resposta:contains("Bairro: ") + .respostadestaque:eq(0)')->html()),
            'cidade/uf'=> trim(pq('.caixacampobranco .resposta:contains("Localidade / UF: ") + .respostadestaque:eq(0)')->html()),
            'cep'=> trim(pq('.caixacampobranco .resposta:contains("CEP: ") + .respostadestaque:eq(0)')->html())
        );
        
        $dados[cidade_uf] = explode('/',$dados['cidade/uf']);

        return $dados[logradouro].'|'.$dados[bairro].'|'.trim($dados['cidade_uf'][0]).'|'.trim($dados['cidade_uf'][1]);
    }
    
    private function simple_curl($url,$post=array(),$get=array()){
	$url = explode('?',$url,2);
	if(count($url)===2){
		$temp_get = array();
		parse_str($url[1],$temp_get);
		$get = array_merge($get,$temp_get);
	}

	$ch = curl_init($url[0]."?".http_build_query($get));
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	@curl_setopt (@$ch, @CURLOPT_FOLLOWLOCATION, @1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	return curl_exec ($ch);
    }
}
