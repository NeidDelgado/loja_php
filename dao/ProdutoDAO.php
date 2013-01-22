<?php

class ProdutoDAO extends Produto {
    private $con = NULL;
    
    public function __construct(){
        $link = new Conexao();
        $this->con = $link;
    }
    
    public function cadastrarProduto($produto){
        try {
            $sql = "INSERT INTO produtos (codigo_barra, titulo, descricao, preco_venda, preco_custo, existencias, data_criacao)
            VALUES (:codigo_barra, :titulo, :descricao, :preco_venda, :preco_custo, :existencias, :data_criacao)";
            
            $cadastrar = $this->con->prepare($sql);
            $cadastrar->bindValue(':codigo_barra', $produto->getCodigoBarra ());
            $cadastrar->bindValue(':titulo', $produto->getTitulo());
            $cadastrar->bindValue(':descricao', $produto->getDescricao());
            $cadastrar->bindValue(':preco_venda', $produto->getPrecoVenda());
            $cadastrar->bindValue(':preco_custo', $produto->getPrecoCusto());
            $cadastrar->bindValue(':existencias', $produto->getExistencias());
            $cadastrar->bindValue(':data_criacao',$produto->getDataCriacao());
            $resultado = $cadastrar->execute();
            return $resultado;
        }
        catch (ErrorException $produt) {
            throw new Exception("Mensagem: " .$produt->getMessage(). "Código de erro: ". $produt->getCode());
            $resultado = false;
      
       }    
     }
     public function listarProduto(){
        try{
            $Query = $this->con->query( "SELECT produtos.* FROM produtos")->fetchAll();
           
            return $Query;
        }
        catch (ErrorException $list){
            throw new Exception("Mensagem: " .$list->getMessage(). "Código errado: ". $list->getCode());
       }
     }
     
}