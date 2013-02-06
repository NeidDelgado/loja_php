<?php

class Helper {
    
    /**
     * Permite Definir a Sessão
     * 
     * @param int $id - ID do utilizador logado
     * @param nivel_acesso - Nível de Acesso.
     * @param boolean $status - true se logado e false se não logado
     */
    public static function setSession($id, $nivel, $status){
        $_SESSION['user_id'] = $id; // $args['id'];
        $_SESSION['nivel_acesso'] = $nivel;
        $_SESSION['logged'] = $status; // $args['status'];        
    }
    /**
     * Limpar Sessão
     */
    public static function clearSession(){
        $_SESSION['user_id'] = null;
        $_SESSION['nivel_acesso'] = null;
        $_SESSION['logged'] = false;
        
        session_destroy();
    }
    /**
     * Verificar Sessão
     * 
     * @return boolean
     */
    public static function verificarSessao(){
        if (isset($_SESSION['user_id']) && isset($_SESSION['logged']) && isset($_SESSION['nivel_acesso'])){
            
            if (($_SESSION['user_id'] != null && $_SESSION['user_id'] > 0) && $_SESSION['logged'] === true){
                return true;
            }
            
            return false;
        }
        
        return false;
    }
    public static function randString($tam = 10){
		$caracteres_validos = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$str = "";
		$array = str_split($caracteres_validos, 1);
		$tam_array = strlen($caracteres_validos);
		for ($i = 0; $i < $tam; $i++){
			$rand_i = rand(0, $tam_array - 1);
			$str .= $array[$rand_i];
		}	
		
		return $str;
	}

	

}