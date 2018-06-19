<?php

require_once 'Conexao.class.php';
require_once '../VO/VendaVO.php';

class VendaDAO extends Conexao {
    
    /** @var PDO */    
    private $conexao;
    
    /** @var PDOStatement */
    private $sql;
    
    public function CarregarModelo($codVendedor) {
        
        $this->conexao = parent::getConexao();
        
        $comando = 'select cod_modelo, nome_modelo FROM tb_modelo md '
                . 'INNER join tb_empresa ep ON md.cod_empresa = ep.cod_empresa '
                . 'INNER join tb_vendedor_sistema vs ON ep.cod_empresa = vs.cod_empresa '
                . 'WHERE vs.cod_vendedor = ? ';
        
        $this->sql = $this->conexao->prepare($comando);
        
        $this->sql->bindValue(1, $codVendedor);
        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $this->sql->execute();
        
        return $this->sql->fetchAll();
    }
    
    public function FiltrarVeiculo($cod_modelo){
        
        $this->conexao = parent::getConexao(); 
        
        $comando = 'select cod_veiculo, nome_marca, nome_modelo, valor_venda, ano_fabricacao, ano_carro, km_veiculo, num_porta, direcao_veiculo, airbag_veiculo, ar_condicionado, freio_abs FROM tb_veiculo '
                . 'INNER join tb_modelo ON tb_veiculo.cod_modelo = tb_modelo.cod_modelo '
                . 'INNER join tb_marca ON tb_modelo.cod_marca = tb_marca.cod_marca WHERE tb_veiculo.cod_modelo = ? AND situacao_veiculo = 1 ';
        
        $this->sql = $this->conexao->prepare($comando);
        
        $this->sql->bindValue(1, $cod_modelo);
        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $this->sql->execute();
        
        return $this->sql->fetchAll();
    }
    
    public function DadosVeiculo($cod){
        
        $this->conexao = parent::getConexao();
        
        $comando = 'select cod_veiculo, nome_marca, nome_modelo, valor_venda, placa_veiculo '
                . 'FROM tb_veiculo INNER join tb_modelo ON tb_veiculo.cod_modelo = tb_modelo.cod_modelo '
                . 'INNER join tb_marca ON tb_modelo.cod_marca = tb_marca.cod_marca WHERE cod_veiculo = ? AND situacao_veiculo = 1';
        
        $this->sql = $this->conexao->prepare($comando);
        
        $this->sql->bindValue(1, $cod);
        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $this->sql->execute();
        
        return $this->sql->fetchAll();              
                
    }
    
    public function FinalizarVenda(VendaVO $vo) {
        
        $this->conexao = parent::getConexao();
        
        $comando = 'insert into tb_venda (data_venda, forma_pgto, observacao_venda, cod_vendedor, cod_veiculo, cod_cliente) VALUES (?, ?, ?, ?, ?, ?)';
        
        $this->sql = $this->conexao->prepare($comando);
        
        $this->sql->bindValue(1, $vo->getDataVenda());
        $this->sql->bindValue(2, $vo->getFormaPgto());
        $this->sql->bindValue(3, $vo->getObs());
        $this->sql->bindValue(4, $vo->getCodigoVendedor());
        $this->sql->bindValue(5, $vo->getCodigoVeiculo());
        $this->sql->bindValue(6, $vo->getCodigoCliente());
        
        $this->conexao->beginTransaction();
        
        try{
            
            $this->sql->execute();
            
            $comando = 'UPDATE tb_veiculo SET situacao_veiculo = 3 WHERE cod_veiculo = ?';
            
            $this->sql = $this->conexao->prepare($comando);
            
            $this->sql->bindValue(1, $vo->getCodigoVeiculo());
            
            $this->sql->execute();
            
            $this->conexao->commit();
            
            return 2;
            
        } catch (Exception $ex) {
        //echo $ex->getMessage();
            $this->conexao->rollBack();
            return -100;
        }        
    }
    
    public function FiltrarVenda($datainicial, $datafinal, $codVendedor) {
        
        $this->conexao = parent::getConexao();
        
        $comando = 'select DATE_FORMAT(data_venda, "%d/%m/%Y") as data_venda, cl.nome_cliente, vs.nome_vendedor, forma_pgto ,observacao_venda, vc.valor_venda FROM tb_venda vd '
                    .'INNER join tb_veiculo vc ON vd.cod_veiculo = vc.cod_veiculo '
                    .'INNER join tb_cliente cl ON vd.cod_cliente = cl.cod_cliente '
                    .'INNER join tb_vendedor_sistema vs ON vd.cod_vendedor = vs.cod_vendedor '
                    .'WHERE ( data_venda BETWEEN ? AND ? ) AND vs.cod_vendedor = ? ';
        
        $this->sql = $this->conexao->prepare($comando);
        
        $this->sql->bindValue(1, $datainicial);
        $this->sql->bindValue(2, $datafinal);
        $this->sql->bindValue(3, $codVendedor);
        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $this->sql->execute();
        
        return $this->sql->fetchAll();
                
    }
    
    public function ValidarLogin($email, $senha) {
        
        $this->conexao = parent::getConexao();
        
        $comando = 'select cod_vendedor FROM tb_vendedor_sistema WHERE email_vendedor = ? AND senha_vendedor = ?';
        
        $this->sql = $this->conexao->prepare($comando);
        
        $this->sql->bindValue(1, $email);
        $this->sql->bindValue(2, $senha);
        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $this->sql->execute();

        return $this->sql->fetchAll();
        
    }
    
}
