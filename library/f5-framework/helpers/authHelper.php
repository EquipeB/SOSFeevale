<?php

/**
 * authHelper
 * Classe de autenticação de usuário a uma aplicação.
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital
 */
class authHelper {
    /**
     *
     * @var string definidoras da autenticação.
     */
    protected $sessionHelper, $redirectorHelper, $tableName, $userColumn, $passColumn, $user, $pass, $loginController = 'index', $loginAction = 'index', $logoutController = 'index', $logoutAction = 'index';

    public function __construct() {
        $this->sessionHelper = new sessionHelper();
        $this->redirectorHelper = new redirectorHelper();
        return $this;
    }
    
    public function setTableName($val) {
        $this->tableName = $val;
        return $this;
    }
    
    public function setUserColumn($val) {
        $this->userColumn = $val;
        return $this;
    }
    
    public function setPassColumn($val) {
        $this->passColumn = $val;
        return $this;
    }
    
    public function setUser($val) {
        $this->user = $val;
        return $this;
    }
    
    public function setPass($val) {
        $this->pass = $val;
        return $this;
    }
    
    public function setLoginControllerAction($controller, $action) {
        $this->loginController = $controller;
        $this->loginAction = $action;
        return $this;
    }
    
    public function setLogoutControllerAction($controller, $action) {
        $this->logoutController = $controller;
        $this->loginAction = $action;
        return $this;
    }
    
    /**
     * Faz a busca do usuário e senha no banco de dados para verificar se os dados estão corretos.
     */
    public function login() {
        $db = new F5_Model();
        $db->_table = $this->tableName;
        
        $where = $this->userColumn."='".$this->user."' AND ".$this->passColumn."='".$this->pass."' AND ativo = 'sim'";   
       
        $query = $db->read(null, $where, '1');
        
        if(count($query) > 0){
            
            $empresas = new empresasModel();
            $listaEmpresas = $empresas->read();
            
            $usuarioFuncoes = new usuariosFuncoesModel();
            $listaUsuarioFuncoes = $usuarioFuncoes->read(null, "id_usuario=".$query[0][id_usuario]);
            
            $this->sessionHelper->createSession("userAuth", true)
                 ->createSession("userData", $query[0])
                 ->createSession("empresa", $listaEmpresas[0])
                 ->createSession("usuarioFuncoes", $listaUsuarioFuncoes)
                 ->createSession("alert", ["titulo" => "Bem vindo", "mensagem" => "Acesso ao sistema F5 Digital realizado.", "imagem" => "success"]);
            
            $this->redirectorHelper->goToControllerAction($this->loginController, $this->loginAction);
            exit;
        }else{
            $this->sessionHelper->createSession("alert", ["titulo" => "Erro de autenticação", "mensagem" => "Verifique se o e-mail e/ou a senha estão corretos.", "imagem" => "error"]);

            $this->redirectorHelper->goToControllerAction("index", "login");
            exit;
        }
    }
    
    public function logout() {
        $this->sessionHelper->deleteSession("userAuth")
                            ->deleteSession("userData")
                            ->deleteSession("empresa")
                            ->deleteSession("usuarioFuncoes");
        
        $this->sessionHelper->createSession("alert", ["titulo" => "Desconexão realizada", "mensagem" => "Obrigado por utilizar o F5 Admin, volte sempre.", "imagem" => "info"]);
        
        $this->redirectorHelper->goToControllerAction($this->logoutController, $this->logoutAction);
        return $this;
    }
    
    public function checkLogin($action) {
        switch ($action){
            case "boolean":
                if(!$this->sessionHelper->checkSession("userAuth")){
                    return true;
                }else{
                    return false;
                }
                break;
            case "redirect":
                if(!$this->sessionHelper->checkSession("userAuth")){
                    if($this->redirectorHelper->getCurrentController() != $this->loginController || $this->redirectorHelper->getCurrentAction() != $this->loginAction){       
                        $this->redirectorHelper->goToControllerAction($this->loginController, $this->loginAction);
                    }
                }
                break;
            case "stop":
                if(!$this->sessionHelper->checkSession("userAuth")){
                    exit;
                }
                break;
        }
    }
    
    public function userData($key) {
        $s = $this->sessionHelper->selectSession("userData");
        return $s[key];
    }
}
