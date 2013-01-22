<?php

class VendaDAO extends Venda {
     private $con = NULL;
    
    public function __construct(){
        $link = new Conexao();
        $this->con = $link;
    }
    
    public function listarVenda($venda){
        try{
            $Query = "SELECT valor, valor_desconto, valor_total, data_venda, estado  FROM vendas WHERE descricao = '".$produto->getDescricao()."'";
            $this->con->query($Query)->fetch();
            
        }
        catch (ErrorException $list){
            throw new Exception("Mensagem: " .$list->getMessage(). "Código errado: ". $list->getCode());
       }
     }

     public function cadastrarVenda($venda){
        try {
            $sql = "INSERT INTO vendas (valor, valor_desconto, valor_total, data_venda, estado)
            VALUES (:valor,:valor_desconto, :valor_total,:data_venda, :estado)";
            
            $cadastrar = $this->con->prepare($sql);
            $cadastrar->bindValue(':valor', $venda->getValor());
            $cadastrar->bindValue(':valor_desconto', $venda->getValorDesconto());
            $cadastrar->bindValue(':valor_total', $venda->getValorTotal());
            $cadastrar->bindValue(':data_venda', $venda->getDataVenda());
            $cadastrar->bindValue(':estado', $venda->getEstado());
            $resultado = $cadastrar->execute();
            return $resultado;
        }
        catch (ErrorException $ven) {
            throw new Exception("Mensagem: " .$ven->getMessage(). "Código de erro: ". $ven->getCode());
            $resultado = false;
      
       }    
     }
     
     public function alterarVenda($venda){
        try {
            $queryy = "UPDATE vendas SET valor=:valor, valor_desconto=:valor_desconto, valor_total=:valor_total, data_venda=:data_venda, estado=:estado WHERE id = '".$produto->getId()."' ";
            
            $update = $this->con->prepare($queryy);
            $update->bindValue(':valor', $venda->getValor());
            $update->bindValue(':valor_desconto', $venda->getValorDesconto());
            $update->bindValue(':valor_total', $venda->getValorTotal());
            $update->bindValue(':data_venda', $venda->getDataVenda());
            $update->bindValue(':estado', $venda->getEstado());
            $update->bindParam(':id',$produto->$_SESSION['user_id']);
            $resulta = $update->execute();

     }
        catch (ErrorException $vend) {
            throw new Exception("Mensagem: " .$vend->getMessage(). "Código de erro: ". $vend->getCode());
            $resulta = false;
      
       }    
     }
}