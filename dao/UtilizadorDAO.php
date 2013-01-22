<?php
class UtilizadorDAO extends ConexaoDAO {
    
    public static function login($utilizador){
        $conexao = new ConexaoDAO();
        
        $sqlText = "SELECT * FROM utilizadores WHERE email = '{$utilizador->getEmail()}'";
        $resultado = $conexao->query($sqlText)->fetch();
        if (!$resultado){
            return false;
        }
        
        if ($utilizador->getPassword() === $resultado['password']){
            return $resultado;
        }        
        
        return false;
    }


    public function cadastrarUtilizador($utilizador){
        try {
            $sql = "INSERT INTO utilizadores (primeiro_nome, ultimo_nome, email, password,nivel_acesso, token, data_criacao, estado)
            VALUES (:primeiro_nome,:ultimo_nome,:email,:password,:nivel_acesso,:token,:data,:estado)";
            
            $inserir = $this->con->prepare($sql);
            $inserir->bindValue(':primeiro_nome', $utilizador->getPrimeiroNome());
            $inserir->bindValue(':ultimo_nome', $utilizador->getUltimoNome());
            $inserir->bindValue(':email',$utilizador->getEmail());
            $inserir->bindValue(':password',$utilizador->getPassword());
            $inserir->bindValue(':nivel_acesso', $utilizador->getNivelAcesso());
            $inserir->bindValue(':token', $utilizador->getToken());
            $inserir->bindValue(':data',$utilizador->getDataCriacao());
            $inserir->bindValue(':estado', $utilizador->getEstado());
        
            $resultado = $inserir->execute();
            return $resultado;
        }
        catch (ErrorException $util) {
            throw new Exception("Mensagem: " .$util->getMessage(). "Código de erro: ". $util->getCode());

            $resultado = false;
         }    
     }
     public function loginUtilizador($utilizador){
        try {
            $query= "SELECT * FROM utilizadores WHERE email = '".$utilizador->getEmail()."' AND password = '".$utilizador->getPassword()."'";
            $user = $this->con->query($query)->fetch();
                
            if (!$user){
                 header("Location: login.php?login=false");
                
                return FALSE;
            } else {
                $_SESSION['logged'] = true;
                $_SESSION['user_id'] = $user['id'];
                
                return true;
            }
        }
        catch (ErrorException $logi){
            throw new Exception("Mensagem: " .$logi->getMessage(). "Código errado: ". $logi->getCode());
       }
    }
    public function logoutUtilizador() {
        
        if($_SESSION['logged'] == false){
            header("Location: login.php?logout=false");
            
            return FALSE;
        }
       
    }
    
    
}
