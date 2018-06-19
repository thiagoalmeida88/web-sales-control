<?php

class VendaVO {
    
    private $cod_venda;
    private $data_venda;
    private $forma_pgto;
    private $obs;
    private $cod_vendedor;
    private $cod_veiculo;
    private $cod_cliente;
    private $data_inicial;
    private $data_final;
    
    public function setCodigo($p){
        $this->cod_venda = $p;
    }
    
    public function getCodigo(){
        return $this->cod_venda;
    }
    
    public function setDataInicial($p) {
        $this->data_inicial = explode('/', $p)[2] . '-' . explode('/', $p)[1] . '-' . explode('/', $p)[0];
    }
    
    public function getDataInicial() {
        return $this->data_inicial;
    }
    
    public function setDatafinal($p) {
        $this->data_final = explode('/', $p)[2] . '-' . explode('/', $p)[1] . '-' . explode('/', $p)[0];
    }
    
    public function getDataFinal() {
        return $this->data_final;
    }
    
    public function setDataVenda($p){
        $this->data_venda = $p; // explode('/', $p)[2] . '-' . explode('/', $p)[1] . '-' . explode('/', $p)[0];
    }
    
    public function getDataVenda(){
        return $this->data_venda;
    }
    
    public function setFormaPgto($p){
        $this->forma_pgto = $p;
    }
    
    public function getFormaPgto() {
        return $this->forma_pgto;        
    }
    
    public function setObs($p) {
        $this->obs = trim($p);
    }
    
    public function getObs(){
        return $this->obs;
    }
    
    public function setCodigoVendedor($p){
        $this->cod_vendedor = $p;
    }
    
    public function getCodigoVendedor(){
        return $this->cod_vendedor;
    }
    
    public function setCodigoVeiculo($p){
        $this->cod_veiculo = $p;
    }
    
    public function getCodigoVeiculo(){
        return $this->cod_veiculo;
    }
    
    public function setCodigoCliente($p){
        $this->cod_cliente = $p;
    }
    
    public function getCodigoCliente(){
        return $this->cod_cliente;
    }
}
