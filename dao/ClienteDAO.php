<?php

class ClienteDAO extends Cliente {
    private $con = NULL;
    
    public function __construct(){
        $link = new Conexao();
        $this->con = $link;
    }
    
    public function cadastrarCliente($cliente){
        try {
            $sql = "INSERT INTO clientes (primeiro_nome, ultimo_nome, email, password, token, data_criacao, estado)
            VALUES (:primeiro_nome,:ultimo_nome,:email,:password,:token,:data,:estado)";
            
            $cadastrar = $this->con->prepare($sql);
            $cadastrar->bindValue(':primeiro_nome', $cliente->getPrimeiroNome());
            $cadastrar->bindValue(':ultimo_nome', $cliente->getUltimoNome());
            $cadastrar->bindValue(':email',$cliente->getEmail());
            $cadastrar->bindValue(':password',$cliente->getPassword());
            $cadastrar->bindValue(':token', $cliente->getToken());
            $cadastrar->bindValue(':data',$cliente->getDataCriacao());
            $cadastrar->bindValue(':estado', $cliente->getEstado());
        
            $resultado = $cadastrar->execute();
            return $resultado;
        }
        catch (ErrorException $client) {
            throw new Exception("Mensagem: " .$client->getMessage(). "Código de erro: ". $client->getCode());
            $resultado = false;
      
       }    
     }
    
    public function loginCliente($cliente){
        try {
            $query= "SELECT * FROM clientes WHERE email = '".$cliente->getEmail()."' AND password = '".$cliente->getPassword()."'";
            $user = $this->con->query($query)->fetch();
                
            if (!$user){
                header("Location: login_cliente.php?login=false");
                
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
    
    public function logoutCliente() {
        
        if($_SESSION['logged'] == false){
            header("Location: login_cliente.php?logout=false");
            
            return FALSE;
        }
       
    }
    
    public function listarCliente($cliente){
        try{
            $Query = "SELECT primeiro_nome, ultimo_nome, email, estado FROM clientes WHERE primeiro_nome = '".$cliente->getPrimeiroNome()."'";
            $this->con->query($Query)->fetch();
            
        }
        catch (ErrorException $list){
            throw new Exception("Mensagem: " .$list->getMessage(). "Código errado: ". $list->getCode());
       }
    }
    
     public function alterarCliente($cliente){
        try {
            $queryy = "UPDATE clientes SET primeiro_nome=:primeiro_nome, ultimo_nome=:ultimo_nome,  email=:email,
             password=:password, token=:token, data_alteracao=:data_alteracao, estado=:estado, id=:id_user
            WHERE id = '".$cliente->getId()."' ";
            
            $update = $this->con->prepare($queryy);
            $update->bindValue(':primeiro_nome', $cliente->getPrimeiroNome());
            $update->bindValue(':ultimo_nome', $cliente->getUltimoNome());
            $update->bindValue(':email',$cliente->getEmail());
            $update->bindValue(':password',$cliente->getPassword());
            $update->bindValue(':token', $cliente->getToken());
            $update->bindValue(':data',$cliente->getDataCriacao());
            $update->bindValue(':estado', $cliente->getEstado());
            $update->bindParam(':id',$cliente->$_SESSION['user_id']);
            $resulta = $update->execute();

     }
        catch (ErrorException $cli) {
            throw new Exception("Mensagem: " .$cli->getMessage(). "Código de erro: ". $cli->getCode());
            $resulta = false;
      
       }    
     }
}