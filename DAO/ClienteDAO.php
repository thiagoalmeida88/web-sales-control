<?php

require_once 'Conexao.class.php';
require_once '../VO/ClienteVO.php';

class ClienteDAO extends Conexao {

    /** @var PDO */
    private $conexao;

    /** @var PDOStatement */
    private $sql;

    public function InserirCliente(ClienteVO $vo) {

        //1 Passo: resgatar a conexão
        $this->conexao = parent::getConexao();

        //2 Passo: montar a instrução SQL
        $comando = 'insert into tb_cliente (nome_cliente, email_cliente, tel_contato, endereco_cliente, cod_vendedor) VALUES (?,?,?,?,?)';

        //3 Passo: vincular no SQL a conexão preparada para executar o comando
        $this->sql = $this->conexao->prepare($comando);

        //4 Passo: vínculo dos valores aos índices
        $this->sql->bindValue(1, $vo->getNomeCliente());
        $this->sql->bindValue(2, $vo->getEmailCliente());
        $this->sql->bindValue(3, $vo->getTelefoneCliente());
        $this->sql->bindValue(4, $vo->getEnderecoCliente());
        $this->sql->bindValue(5, $vo->getCodigoVendedor());


        try {

            //5 Passo: EXECUTAR
            $this->sql->execute();
            return 1;
        } catch (Exception $ex) {

            echo $ex->getMessage();
            return -100;
        }
    }

    public function ConsultarCliente($cod_vendedor) {

        $this->conexao = parent::getConexao();

        $comando = 'select cod_cliente, nome_cliente, endereco_cliente, tel_contato, email_cliente '
                . 'FROM tb_cliente WHERE cod_vendedor = ?';

        $this->sql = $this->conexao->prepare($comando);

        $this->sql->bindValue(1, $cod_vendedor);

        $this->sql->setFetchMode(PDO::FETCH_ASSOC);

        $this->sql->execute();

        return $this->sql->fetchAll();
    }

    public function AlterarCliente(ClienteVO $vo) {

        $this->conexao = parent::getConexao();

        $comando = 'update tb_cliente set nome_cliente = ?, endereco_cliente = ?, tel_contato = ?, email_cliente = ? WHERE cod_cliente = ?';

        $this->sql = $this->conexao->prepare($comando);

        $this->sql->bindValue(1, $vo->getNomeCliente());
        $this->sql->bindValue(2, $vo->getEnderecoCliente());
        $this->sql->bindValue(3, $vo->getTelefoneCliente());
        $this->sql->bindValue(4, $vo->getEmailCliente());
        $this->sql->bindValue(5, $vo->getCodigo());

        try {

            $this->sql->execute();
            return 1;
            
        } catch (Exception $ex) {
            
            echo $ex->getMessage();
            return -100;
            
        }
    }
    
    public function DetalhesCliente($cod_vendedor, $cod_cliente){
        
        $this->conexao = parent::getConexao();
        
        $comando = 'select cod_cliente, nome_cliente, email_cliente, tel_contato, endereco_cliente'
                . ' FROM tb_cliente WHERE cod_cliente = ? AND cod_vendedor = ?';
        
        $this->sql = $this->conexao->prepare($comando);
        
        $this->sql->bindValue(1, $cod_cliente);
        $this->sql->bindValue(2, $cod_vendedor);
        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $this->sql->execute();
        
        return $this->sql->fetchAll();
    }

}
