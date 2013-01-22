<?php

class Paises {
    private $nome;
    private $data_criacao;
    private $data_alteracao;
    
    function setNome($nome) {
        $this->nome = $nome;
    }
    function getNome() {
        return $this->nome;
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