<!DOCTYPE html>

<?php

require_once '../Controler/VendaControler.php';
require_once '_msg.php';
require_once '../Controler/Util.php';

Util::VerificarLogado();

$ret = '';
$datainicial = '';
$datafinal= '';

if(isset($_POST['btnPesquisar'])){
    
    $ctrl = new VendaControler();
    
    $datainicial = $_POST['dt_inicial'];
    $datafinal = $_POST['dt_final'];
    
    $vendas = $ctrl->FiltrarVenda($datainicial, $datafinal);
   
    if($vendas == -1){
        $ret = -1;
    }
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
                            <?php ExibirMsg($ret) ?>
                            <h2>Consultar vendas</h2>   
                            <h5>Aqui você pesquisa por período suas venda</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="post" action="consultar_vendas.php">
                    <div class="row">
                        <div class="col-md-12">                            
                            <!-- Form Elements -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Filtro
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Data inicial</label>
                                                <input class="form-control date num" name="dt_inicial" id="dt_inicial" type="text" placeholder="Digite a data inicial" value="<?= $datainicial ?>"/>
                                            </div>                                            
                                        </div>

                                        <div class="col-md-6">
                                        <div class="form-group">                                            
                                            <label>Data final</label>
                                            <input class="form-control date num" name="dt_final" id="dt_final" type="text" placeholder="Digite a data inicial" value="<?= $datafinal ?>" />
                                        </div>
                                    </div>
                                    </div>
                                    <button class="btn btn-primary" name="btnPesquisar" onclick="return Validar(4)">Pesquisar</button>  
                                </div>
                            </div>
                            <!-- End Form Elements -->
                        </div>
                    </div>  
                    </form>
                    <hr />
                    
                    <?php if(isset($vendas) && count($vendas) > 0) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Vendas realizadas
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data da venda</th>
                                                    <th>Cliente</th>
                                                    <th>Vendedor</th>
                                                    <th>Forma de pagamento</th>
                                                    <th>Observação</th>   
                                                    <th>Valor venda</th>   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for($i = 0; $i < count($vendas); $i++) { ?>
                                                
                                                <tr class="odd gradeX">
                                                    <td><?= $vendas[$i]['data_venda']?></td>
                                                    <td><?= $vendas[$i]['nome_cliente'] ?></td>
                                                    <td><?= $vendas[$i]['nome_vendedor']?></td>
                                                    <td><?= $vendas[$i]['forma_pgto'] == 1 ? 'À vista' : ($vendas[$i]['forma_pgto'] == 2 ? 'Boleto' : ($vendas[$i]['forma_pgto'] == 3 ? 'Cartão parcelado' : ($vendas[$i]['forma_pgto'] == 4 ? 'Cartão vencimento' : 'Cartão Débito'))) ?></td>
                                                    <td><?= $vendas[$i]['observacao_venda']?></td>    
                                                    <td><?= $vendas[$i]['valor_venda']?></td> 
                                                </tr>  
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>
                    <?php } else { ?>
                    <center><div class="alert alert-info">Nenhum registro para ser exibido</div></center>
                    <?php } ?>
                    <!-- /. ROW  -->
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    <body>
</html>
