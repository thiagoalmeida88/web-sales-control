<?php

require_once '../DAO/ClienteDAO.php';
require_once '../VO/ClienteVO.php';
require_once 'Util.php';

class ClienteCtrl {
    
    public function InserirCliente(ClienteVO $vo){
        
        if($vo->getNomeCliente() == '' || $vo->getEmailCliente() == '' || $vo->getTelefoneCliente() == '' || $vo->getEnderecoCliente() == ''){
            
            return -1;
            
        }
        $vo->setCodigoVendedor(Util::CondigoLogado());
        
        $dao = new ClienteDAO();
        return $dao->InserirCliente($vo);
        
    }
    
    public function AlterarCliente(ClienteVO $vo) {
        
        
        //echo $vo->getTelefoneCliente();
        
        if($vo->getNomeCliente() == '' || $vo->getEmailCliente() == '' || $vo->getTelefoneCliente() == '' || $vo->getEnderecoCliente() == ''){
            return -1;
        }
        
        $dao = new ClienteDAO();
        return $dao->AlterarCliente($vo);
    }
    
    public function ConsultarCliente(){
        $dao = new ClienteDAO();
        return $dao->ConsultarCliente(Util::CondigoLogado());
    }
    
    public function DetalhesCliente($cod_cliente) {
        $dao = new ClienteDAO();
        return $dao->DetalhesCliente(Util::CondigoLogado(), $cod_cliente);
    }
}
