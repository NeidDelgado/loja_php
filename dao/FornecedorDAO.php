<?php

class FornecedorDAO extends Fornecedor {

    private $con = NULL;
    
    public function __construct(){
        $link = new Conexao();
        $this->con = $link;
    }
    
   public function listarFornecedor($fornecedor){
        try{
            $Query = "SELECT nome_empresa, nome_contacto, telefone, fax, email, cidade,  estado FROM fornecedores WHERE nome_empresa = '".$fornecedor->getNomeEmpresa()."'";
            $this->con->query($Query)->fetch();
            
            foreach ($Query as $key => $fornecedor) {

                $this->getEstado() = "";
                    if ($fornecedor->setEstado() == 1){
                        $this->getEstado() = "Novo";
                    } 
                    elseif ($fornecedor->setEstado() ==2) {
                        $this->getEstado() ="Activado";
                    }
                    elseif ($fornecedor->setEstado() ==3) {
                        $this->getEstado() ="Bloqueiado"; 
                    }
                    elseif ($fornecedor->setEstado() ==4) {
                        $this->getEstado() ="Inativo";
                    }  
              }
        }
        catch (ErrorException $list){
            throw new Exception("Mensagem: " .$list->getMessage(). "Código errado: ". $list->getCode());
       }
    }

     public function cadastrarFornecedor($fornecedor){
        try {
            $sql = "INSERT INTO fornecedores (nome_empresa, nome_contacto, telefone, fax, email, cidade,  data_criacao, data_atualizacao, estado)
            VALUES (:nome_empresa, :nome_contacto, :telefone, :fax, :email, :cidade, :data_criacao, :data_atualizacao, :estado)";
            
            $cadastrar = $this->con->prepare($sql);
            $cadastrar->bindValue(':nome_empresa', $fornecedor->getNomeEmpresa());
            $cadastrar->bindValue(':nome_contacto', $fornecedor->getNomeContacto());
            $cadastrar->bindValue(':telefone',$fornecedor->getTelefone());
            $cadastrar->bindValue(':fax',$fornecedor->getFax());
            $cadastrar->bindValue(':email', $fornecedor->getEmail());
            $cadastrar->bindValue(':cidade', $fornecedor->getCidade());
            $cadastrar->bindValue(':data',$fornecedor->getDataCriacao());
            $cadastrar->bindValue(':estado', $fornecedor->getEstado());
        
            $resultado = $cadastrar->execute();
            return $resultado;
        }
        catch (ErrorException $forneced) {
            throw new Exception("Mensagem: " .$forneced->getMessage(). "Código de erro: ". $forneced->getCode());
            $resultado = false;
      
       }    
     }
     
     public function alterarFornecedor($fornecedor){
        try {
            $queryy = "UPDATE fornecedores SET nome_empresa=:nome_empresa, nome_contacto=:nome_contacto, telefone=:telefone, fax=:fax, email=:email,
             cidade=:cidade, data_alteracao=:data_alteracao, estado=:estado, id=:id_user
            WHERE id = '".$fornecedor->getId()."' ";
            
            $update = $this->con->prepare($queryy);
            $update->bindValue(':nome_empresa', $fornecedor->getNomeEmpresa());
            $update->bindValue(':nome_contacto', $fornecedor->getNomeContacto());
            $update->bindValue(':telefone',$fornecedor->getTelefone());
            $update->bindValue(':fax',$fornecedor->getFax());
            $update->bindValue(':email', $fornecedor->getEmail());
            $update->bindValue(':cidade', $fornecedor->getCidade());
            $update->bindValue(':data',$fornecedor->getDataCriacao());
            $update->bindValue(':estado', $fornecedor->getEstado());
            $update->bindParam(':id',$fornecedor->$_SESSION['user_id']);
            $resulta = $update->execute();

     }
        catch (ErrorException $fornecedo) {
            throw new Exception("Mensagem: " .$fornecedo->getMessage(). "Código de erro: ". $fornecedo->getCode());
            $resulta = false;
      
       }    
     }
}