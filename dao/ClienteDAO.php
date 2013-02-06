<?php

class ClienteDAO extends Cliente {

     public static function login($cliente){
        $conexao = new ConexaoDAO();
        
        $sqlText = "SELECT * FROM clientes WHERE email = '{$cliente->getEmail()}'";
        $resultado = $conexao->query($sqlText)->fetch();
        if (!$resultado){
            return false;
        }
        if ($cliente->getPassword() === $resultado['password']){
            return $resultado;
        }        
        return false;
    }
    
    /**
     * Retorna um Cliente
     * 
     * @param integer $id     * 
     * @return Cliente
     */
    public static function getCliente($id){
        $conexao = new ConexaoDAO();
        $sqlText = "SELECT * FROM clientes WHERE id = {$id}";
        $cli = $conexao->query($sqlText)->fetch();
        
        return $cli;
    }
    
    /**
     * Retorna todos os Clientes
     * 
     * @return array
     */
    public static function getClientes(){
        $conexao = new ConexaoDAO();
        $sqlText = "SELECT * FROM clientes";
        $resultado = $conexao->query($sqlText)->fetchAll();
        
        return $resultado;
    }
    /**
     * 
     * @param Clientes $cliente
     */
    public static function saveCliente(Cliente $cliente){
        $conexao = new ConexaoDAO();
        $sqlText = "INSERT INTO clientes (primeiro_nome, ultimo_nome, email, password, token, estado, data_criacao, data_alteracao) VALUES (:primeiro_nome,:ultimo_nome,:email,:password,:token,:estado,:data_criacao,:data_alteracao)";
        $inserir = $conexao->prepare($sqlText);
        
        $inserir->bindValue(':primeiro_nome', $cliente->getPrimeiroNome());
        $inserir->bindValue(':ultimo_nome', $cliente->getUltimoNome());
        $inserir->bindValue(':email',$cliente->getEmail());
        $inserir->bindValue(':password',$cliente->getPassword());
        $inserir->bindValue(':token', $cliente->getToken());
        $inserir->bindValue(':estado', $cliente->getEstado());
        $inserir->bindValue(':data_criacao',$cliente->getDataCriacao());
        $inserir->bindValue(':data_alteracao',$cliente->getDataAlteracao());
        
        $inserir->execute();
        return $inserir;
      }
    public static function deleteCliente($id){
        $conexao = new ConexaoDAO();
        $sqlText = "DELETE FROM clientes WHERE id = :id";
        $exec = $conexao->prepare($sqlText);
        $exec->bindValue(":id", $id);

        $resultado = $exec->execute();

        return $resultado;
    }   
    
    public static function editarCliente(Cliente $cliente){
       $conexao = new ConexaoDAO();
        
        $sqlText ="UPDATE clientes SET primeiro_nome=:primeiro_nome, ultimo_nome=:ultimo_nome, email=:email,
            password=:password, token=:token, data_alteracao=:data_alteracao, estado=:estado WHERE id = :id";
        $execute = $conexao->prepare($sqlText);
        
        $execute->bindValue(':primeiro_nome', $cliente->getPrimeiroNome());
        $execute->bindValue(':ultimo_nome', $cliente->getUltimoNome());
        $execute->bindValue(':email',$cliente->getEmail());
        $execute->bindValue(':password',$cliente->getPassword());
        $execute->bindValue(':token', $cliente->getToken());
        $execute->bindValue(':estado', $cliente->getEstado());
        $execute->bindValue(':data_alteracao',$cliente->getDataAlteracao());
        $execute->bindValue(':id',$cliente->getId());

        $resultado = $execute->execute();

        return $resultado;
    }
}