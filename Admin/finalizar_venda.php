<!DOCTYPE html>

<?php

require_once '../Controler/VendaControler.php';
require_once '../Controler/ClienteCtrl.php';
require_once '_msg.php';
require_once '../Controler/Util.php';

Util::VerificarLogado();

if(isset($_GET['cod']) && $_GET['cod'] != '' && is_numeric($_GET['cod'])){
    
    $ctrl = new VendaControler();
    $veiculo = $ctrl->DadosVeiculo($_GET['cod']);
    
    if(count($veiculo) == 0){
        
        header('location: fechar_venda.php');        
    }

    $ctrl = new ClienteCtrl();
    $clientes = $ctrl->ConsultarCliente();            
    
}else if(isset($_POST['btn_finalizar'])){
    
    $ctrl = new VendaControler();
    $vo = new VendaVO();
    
    $vo->setCodigoCliente($_POST['cliente']);
    $vo->setCodigoVeiculo($_POST['cod_veiculo']);
    $vo->setFormaPgto($_POST['formaPgto']);
    $vo->setObs($_POST['descricao']);
    
    $ret = $ctrl->FinalizarVenda($vo);
    
    header('location: fechar_venda.php?ret=' . $ret);
    
}else{
    header('location: fechar_venda.php');
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
    include '_head.php';
    ?>
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
                            <h2>Finalizar venda</h2>   
                            <h5>Aqui você conclui sua venda</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Form Elements -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Dados do veículo
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="disabledSelect">Marca</label>
                                                <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled value="<?= $veiculo[0]['nome_marca'] ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledSelect">Valor</label>
                                                <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled value="<?= $veiculo[0]['valor_venda'] ?>" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="disabledSelect">Modelo</label>
                                                <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled value="<?= $veiculo[0]['nome_modelo'] ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label for="disabledSelect">Placa</label>
                                                <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled value="<?= $veiculo[0]['placa_veiculo'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Form Elements -->
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Form Elements -->
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    Finalizar a venda 
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="post" action="finalizar_venda.php">
                                                <input type="hidden" name="cod_veiculo" value="<?= $veiculo[0]['cod_veiculo'] ?>">
                                                       
                                                <div class="form-group">
                                                    <label>Cliente</label>
                                                    <select class="form-control" id="cliente" name="cliente">
                                                         <option value="">Selecione</option>
                                                        <?php for($i=0; $i < count($clientes); $i++) { ?>
                                                            <option value="<?= $clientes[$i]['cod_cliente'] ?>"><?= $clientes[$i]['nome_cliente'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Forma de pagamento</label>
                                                    <select class="form-control" id="formaPgto" name="formaPgto">
                                                        <option value="">Selecione</option>
                                                        <option value="1">À vista</option>
                                                        <option value="2">Boleto</option>
                                                        <option value="3">Cartão parcelado</option>
                                                        <option value="4">Cartão vencimento</option>                                                    
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Descrição da compra</label>
                                                    <textArea class="form-control" id="descricao" name="descricao" maxlength="1000" placeholder="Digite aqui a descrição da venda"></textArea>
                                            </div>
                                                <button class="btn btn-success" id="btn_finalizar" name="btn_finalizar" onclick="return Validar(3)">Finalizar</button>
                                            </form>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <!-- End Form Elements -->
                        </div>
                    </div>
                    <!-- /. ROW  -->
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="assets/js/custom.js"></script>


    </body>
</html>
