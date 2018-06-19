<!DOCTYPE html>

<?php

require_once '../Controler/ClienteCtrl.php';
require_once '../VO/ClienteVO.php';
require_once './_msg.php';

$ret = '';

if(isset($_GET['cod']) && $_GET['cod'] != '' && is_numeric($_GET['cod'])){
    
    $ret = isset($_GET['ret']) ? $_GET['ret'] : '';    
    
    $cod = $_GET['cod'];
    $ctrl = new ClienteCtrl();
    
    $dados = $ctrl->DetalhesCliente($cod);
    
    if(count($dados) == 0){
        header('location: consultar_cliente.php');
    }
    
}
else if(isset ($_POST['btnGravar'])){
    
    /*echo '<pre>';
    print_r($_POST);
    echo '</pre>';*/
    
    $vo = new ClienteVO;
    $ctrl = new ClienteCtrl();
    
    $vo->setCodigo($_POST['cod_cliente']);
    $vo->setEmailCliente($_POST['email']);
    $vo->setEnderecoCliente($_POST['endereco']);
    $vo->setNomeCliente($_POST['nome']);
    $vo->setTelefoneCliente($_POST['telefone']);
    
    $ret = $ctrl->AlterarCliente($vo);
    
    header('location: alterar_cliente.php?cod=' . $_POST['cod_cliente'] . '&ret=' . $ret);
    
}else {
    header('location: consultar_cliente.php');
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
                            <?php ExibirMsg($ret)?>
                            <h2>Alterar Cliente</h2>   
                            <h5>Altere seus clientes aqui</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <form method="post" action="alterar_cliente.php">
                        <input type="hidden" name="cod_cliente" value="<?= $dados[0]['cod_cliente']?>">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input class="form-control" maxlength="45" id="nome" name="nome" placeholder="Digite o seu cliente aqui" value="<?= $dados[0]['nome_cliente']?>" />
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input class="form-control" maxlength="45" id="email" name="email"placeholder="Digite o email do seu cliente aqui" value="<?= $dados[0]['email_cliente']?>" />
                        </div>
                        <div class="form-group">
                            <label>Telefone para contato:</label>
                            <input class="form-control" maxlength="11" id="telefone" name="telefone" placeholder="Digite o telefone do seu cliente aqui" value="<?= $dados[0]['tel_contato']?>" />
                        </div>
                        <div class="form-group">
                            <label>Endereço:</label>
                            <input class="form-control" maxlength="500" id="endereco" name="endereco" placeholder="Digite o endereço do seu cliente aqui" value="<?= $dados[0]['endereco_cliente']?>" />
                        </div>
                        <button class="btn btn-primary" name="btnVoltar">Voltar</button>
                        <button class="btn btn-success" name="btnGravar" onclick="return Validar(2)">Gravar</button>
                        
                    </form>

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>


