<!DOCTYPE html>

<?php 

require_once '../Controler/ClienteCtrl.php';
require_once '../VO/ClienteVO.php';
require_once '_msg.php';
require_once '../Controler/Util.php';

Util::VerificarLogado();

$ret = '';

if(isset($_POST['btnGravar'])){
    
    $vo = new ClienteVO();
    
    $ctrl = new ClienteCtrl();
    
    $vo->setEmailCliente($_POST['email']);
    $vo->setEnderecoCliente($_POST['endereco']);
    $vo->setNomeCliente($_POST['nome']);    
    $vo->setTelefoneCliente($_POST['telefone']);
    
    $ret = $ctrl->InserirCliente($vo);
    
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <?php include '_head.php'; ?>
    <body>
        <div id="wrapper">
            <?php
            include '_topo.php';
            include '_menu.php';
            ?>  
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            
                                ExibirMsg($ret)
                            
                            ?>
                            
                            <h2>Novo Cliente</h2>   
                            <h5>Cadastre seus clientes aqui</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form method="post" action="novo_cliente.php">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input class="form-control" maxlength="45" id="nome" name="nome" placeholder="Digite o seu cliente aqui" />
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input class="form-control" maxlength="45" id="email" name="email" placeholder="Digite o email do seu cliente aqui" />
                        </div>
                        <div class="form-group">
                            <label>Telefone para contato:</label>
                            <input class="form-control tel num telpree" maxlength="11" id="telefone" name="telefone" placeholder="Digite o telefone do seu cliente aqui" />
                        </div>
                        <div class="form-group">
                            <label>Endereço:</label>
                            <input class="form-control" maxlength="500" id="endereco" name="endereco" placeholder="Digite o endereço do seu cliente aqui" />
                        </div>
                        <button class="btn btn-success" name="btnGravar" onclick="return Validar(2)">Gravar</button>
                    </form>

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>


