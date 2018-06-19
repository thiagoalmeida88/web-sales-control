<?php

require_once '../DAO/VendaDAO.php';
require_once '../VO/VendaVO.php';
require_once 'Util.php';

class VendaControler {

    public function CarregarModelo() {

        $dao = new VendaDAO();
        return $dao->CarregarModelo(Util::CondigoLogado());
    }

    public function FiltrarVeiculo($cod_modelo) {

        $dao = new VendaDAO();
        return $dao->FiltrarVeiculo($cod_modelo);
    }

    public function DadosVeiculo($cod) {

        $dao = new VendaDAO();
        return $dao->DadosVeiculo($cod);
    }

    public function FinalizarVenda(VendaVO $vo) {

        if ($vo->getCodigoCliente() == '' || $vo->getFormaPgto() == '' || $vo->getObs() == '') {
            return -1;
        }

        $vo->setCodigoVendedor(Util::CondigoLogado());
        $vo->setDataVenda(Util::DataAtual());

        $dao = new VendaDAO();

        return $dao->FinalizarVenda($vo);
    }

    public function FiltrarVenda($datainicial, $datafinal) {

        if ($datainicial == '' || $datafinal == '') {
            return -1;
        }
        
        $datainicial = Util::TratarDataBanco($datainicial);
        $datafinal = Util::TratarDataBanco($datafinal); 
        
        $dao = new VendaDAO();

        return $dao->FiltrarVenda($datainicial, $datafinal, Util::CondigoLogado());
    }
    
    public function ValidarLogin($email, $senha) {
        
        if($email == '' || $senha == ''){
            return -1;
        }
        
        $dao = new VendaDAO();
        
        $usuario = $dao->ValidarLogin($email, $senha);
        
        if(count($usuario)== 0){
            return 3;
        }else{
            Util::GuardarInformacao($usuario[0]['cod_vendedor']);
            header('location: fechar_venda.php');
        }
        
    }

}
