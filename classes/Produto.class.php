<?php

class Produto {
    private $id;
    private $codigo_barra;
    private $titulo;
    private $descricao;
    private $categoria;
    private $preco_venda;
    private $preco_custo;
    private $existencias;
    private $url_imagem;
    private $data_criacao;
    private $data_actualizacao;
  
    
    function setId($id) {
        $this->id = $id;
    }
    function getId() {
        return $this->id;
    }
    function setCodigoBarra($codigo_barra) {
        $this->codigo_barra = $codigo_barra;
    }
    function getCodigoBarra() {
        return $this->codigo_barra;
    }
    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    function getTitulo() {
        return $this->titulo;
    }
    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    function getDescricao() {
        return $this->descricao;
    }
    function setCategoria($categoria) {
        $this->categoria= $categoria;
    }
    function getCategoria() {
        return $this->categoria;
    }
    function setPrecoVenda($preco_venda) {
        $this->preco_venda = $preco_venda;
    }
    function getPrecoVenda() {
        return $this->preco_venda;
    }
    function setPrecoCusto($preco_custo) {
        $this->preco_custo = $preco_custo;
    }
    function getPrecoCusto() {
        return $this->preco_custo;
    }
    function setExistencias($existencias) {
        $this->existencias = $existencias;
    }
    function getExistencias() {
        return $this->existencias;
    }
    function setUrlImagem($url_imagem) {
        $this->url_imagem = $url_imagem;
    }
    function getUrlImagem() {
        return $this->url_imagem;
    }
    function setDataCriacao($data_criacao) {
        $this->data_criacao = $data_criacao;
    }
    function getDataCriacao() {
        return $this->data_criacao;
    }
    function setDataActualizacao($data_actualizacao) {
        $this->data_actualizacao = $data_actualizacao;
    }
    function getDataActualizacao() {
        return $this->data_actualizacao;
    }
}