<?php

/**
 * sessionHelper
 * Controle de sessões.
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital
 */
class sessionHelper {
    public function createSession($name, $value) {
        $_SESSION[$name] = $value;
        return $this;
    }
    
    public function selectSession($name) {
        return $_SESSION[$name];
        return $this;
    }
    
    public function deleteSession($name) {
        unset($_SESSION[$name]);
        return $this;
    }
    
    public function checkSession($name) {
        return isset($_SESSION[$name]);
    }
}
