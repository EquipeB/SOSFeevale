<?php

date_default_timezone_set('America/Sao_Paulo');

//Diretórios da aplicação, se for na raiz do servidor, utilizar apenas uma "/"
//define("DIRETORIO_BASE", "http://f5digital.noip.me");
define("DIRETORIO_BASE", "localhost");
define("DIRETORIO_INICIAL", "/sos-feevale/");
define("DIRETORIO_ADMIN", DIRETORIO_INICIAL."f5admin/");

//Informações do banco de dados
define("TIPO_BD", "mysql");
define("HOST_BD", "localhost");
define("NOME_BD", "sos_feevale_f5admin");
define("USUARIO_BD", "root");
define("SENHA_BD", "");

//MVC da aplicação
define("CONTROLLERS", "app/controllers/");
define("VIEWS", "app/views/");
define("MODELS", "app/models/");

//Caminho para arquivos do template
if(preg_match("/f5admin/i", $_SERVER[REQUEST_URI])){
    define("HELPERS", "../library/f5-framework/helpers/");
    define("CSS", DIRETORIO_ADMIN."web-files/css/");
    define("JS", DIRETORIO_ADMIN."web-files/js/");
    define("PLUGINS", DIRETORIO_ADMIN."web-files/plugins/");
    define("IMG", DIRETORIO_ADMIN."web-files/img/");
    define("UPLOADS", DIRETORIO_ADMIN."web-files/uploads/");
    define("UPLOADS_SITE", DIRETORIO_INICIAL."web-files/uploads/");
}else{
    define("HELPERS", "library/f5-framework/helpers/");
    define("CSS", DIRETORIO_INICIAL."web-files/css/");
    define("JS", DIRETORIO_INICIAL."web-files/js/");
    define("PLUGINS", DIRETORIO_INICIAL."web-files/plugins/");
    define("IMG", DIRETORIO_INICIAL."web-files/img/");
    define("UPLOADS", DIRETORIO_INICIAL."web-files/uploads/");
}