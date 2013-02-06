<?php

class UtilizadorDAO extends Utilizador {
    
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
    /**
     * Retorna um Utilizador
     * 
     * @param integer $id     * 
     * @return Produto
     */
    public static function getUtilizador($id){
        $conexao = new ConexaoDAO();
        
        $sqlText = "SELECT * FROM utilizadores WHERE id = {$id}";
        
        $utiliza = $conexao->query($sqlText)->fetch();
        
        return $utiliza;
    }
    /**
     * Retorna todos os Utilizadores
     * 
     * @return array
     */
    public static function getUtilizadores(){
        $conexao = new ConexaoDAO();
        
        $sqlText = "SELECT * FROM utilizadores";
        $resultado = $conexao->query($sqlText)->fetchAll();
        
        return $resultado;
    }
    /**
     * 
     * @param Utilizadores $utilizador
     */
    public static function saveUtilizador(Utilizador $utilizador){
        $conexao = new ConexaoDAO();
        
        $sqlText = "INSERT INTO utilizadores (primeiro_nome, ultimo_nome, email, password,nivel_acesso, token, estado, url_imagem, data_criacao, data_alteracao) VALUES (:primeiro_nome,:ultimo_nome,:email,:password,:nivel_acesso,:token,:estado,:url_imagem,:data_criacao,:data_alteracao)";
        $inserir = $conexao->prepare($sqlText);
        
        $inserir->bindValue(':primeiro_nome', $utilizador->getPrimeiroNome());
        $inserir->bindValue(':ultimo_nome', $utilizador->getUltimoNome());
        $inserir->bindValue(':email',$utilizador->getEmail());
        $inserir->bindValue(':password',$utilizador->getPassword());
        $inserir->bindValue(':nivel_acesso', $utilizador->getNivelAcesso());
        $inserir->bindValue(':token', $utilizador->getToken());
        $inserir->bindValue(':estado', $utilizador->getEstado());
        $inserir->bindValue(':url_imagem', $utilizador->getUrlImagem());
        $inserir->bindValue(':data_criacao',$utilizador->getDataCriacao());
        $inserir->bindValue(':data_alteracao',$utilizador->getDataAlteracao());
        
        $inserir->execute();
        return $inserir;
    }
    
    public static function deleteUtilizador($id){
        $conexao = new ConexaoDAO();
         
            $utiliza = self::getUtilizador($id);
            $img = PASTA_IMG_UTILIZADORES . $utiliza['url_imagem'];            
           
            $sqlText = "DELETE FROM utilizadores WHERE id = :id";
            $exec = $conexao->prepare($sqlText);
            $exec->bindValue(":id", $id);
            
            $resultado = $exec->execute();
            if ($resultado){
                if ($utiliza['url_imagem'] != "sem_imagem.png"){
                    unlink($img);
                }
                return $resultado;
            }
        return false;
    }   
    
    public static function editarUtilizador(Utilizador $utilizador){
        $conexao = new ConexaoDAO();
        
        $sqlText ="UPDATE utilizadores SET primeiro_nome=:primeiro_nome,ultimo_nome=:ultimo_nome,email=:email,password=:password,nivel_acesso=:nivel_acesso,token=:token,estado=:estado,url_imagem=:url_imagem,data_alteracao=:data_alteracao WHERE id = :id";
        
        $exec = $conexao->prepare($sqlText);
        $exec->bindValue(':primeiro_nome', $utilizador->getPrimeiroNome());
        $exec->bindValue(':ultimo_nome', $utilizador->getUltimoNome());
        $exec->bindValue(':email',$utilizador->getEmail());
        $exec->bindValue(':password',$utilizador->getPassword());
        $exec->bindValue(':nivel_acesso', $utilizador->getNivelAcesso());
        $exec->bindValue(':token', $utilizador->getToken());
        $exec->bindValue(':estado', $utilizador->getEstado());
        $exec->bindValue(':url_imagem', $utilizador->getUrlImagem());
        $exec->bindValue(':data_alteracao',$utilizador->getDataAlteracao());
        $exec->bindValue(':id',$utilizador->getId());
        
        $resultado = $exec->execute();
        
        return $resultado;
    }
    
}