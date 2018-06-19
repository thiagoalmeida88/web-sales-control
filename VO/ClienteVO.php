<?php

class ClienteVO {
    
    private $cod_cliente;
    private $nome_cliente;
    private $email_cliente;
    private $tel_cliente;
    private $endereco_cliente;
    private $cod_vendedor;
    
    public function setCodigo($p) {
        $this->cod_cliente = $p;
    }
    
    public function getCodigo(){
        return $this->cod_cliente;
    }
    
    public function setNomeCliente($p){
        $this->nome_cliente = trim($p);
    }
    
    public function getNomeCliente(){
        return $this->nome_cliente;
    }
    
    public function setEmailCliente($p){
        $this->email_cliente = trim($p);
    }
    
    public function getEmailCliente(){
        return $this->email_cliente;
    }
    
    public function setTelefoneCliente($p){
        $this->tel_cliente = preg_replace("/[^0-9]/", "", $p);
    }
    
    public function getTelefoneCliente() {
        return $this->tel_cliente;
    }
    
    public function setEnderecoCliente($p){
        $this->endereco_cliente = trim($p);
    }
    
    public function getEnderecoCliente(){
        return $this->endereco_cliente;
    }
    
    public function setCodigoVendedor($p){
        $this->cod_vendedor = $p;
    }
    
    public function getCodigoVendedor(){
        return $this->cod_vendedor;
    }
}
