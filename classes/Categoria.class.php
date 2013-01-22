<?php

class Categoria {
    private $id;
    private $nome;
    private $descricao;
    private $categoria_id;
    private $url_imagem;        
    private $data_criacao;
    private $data_alteracao;
    
    function setId($id){
        $this->id = $id;
    }
    function  getId(){
    return $this->id;
    }
    function setNome($nome) {
        $this->nome = $nome;
    }
    function getNome() {
        return $this->nome;
    }
    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    function getDescricao() {
        return $this->descricao;
    }
    
    function getUrlImagem(){
        return $this->url_imagem;
    }
    
    function setUrlImagem($value){
        $this->url_imagem = $value;
    }
    
    function  getCategoriaId(){
        return $this->categoria_id;
    }
    
    function setCategoriaId($value){
        $this->categoria_id = $value;
    }
            
    function setDataCriacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }
    function getDataCriacao() {
        return $this->data_criacao;
    }
    function setDataAlteracao($data_alteracao) {
        $this->data_alteracao = $data_alteracao;
    }
    function getDataAlteracao() {
        return $this->data_alteracao;
    }
}