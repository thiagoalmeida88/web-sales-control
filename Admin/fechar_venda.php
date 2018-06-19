<!DOCTYPE html>

<?php
require_once '../Controler/VendaControler.php';
require_once '_msg.php';
require_once '../Controler/Util.php';

Util::VerificarLogado();

$ret = '';

if(isset($_GET['ret'])){
    $ret = $_GET['ret'];
}

$ctrl = new VendaControler();

$cod_modelo = '';

if (isset($_POST['btnProcurar'])) {

    $cod_modelo = $_POST['modelo'];
    $veiculos = $ctrl->FiltrarVeiculo($cod_modelo);
}

$modelos = $ctrl->CarregarModelo();
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
                            <?php ExibirMsg($ret) ?>
                            <h2>Fechar Venda</h2>   
                            <h5>Escolha o modelo do carro para a conclusão da venda</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="post" action="fechar_venda.php">
                        <div class="form-group">
                            <label>Escolha o modelo</label>                       
                            <select class="form-control" id="modelo" name="modelo">

                                <option value="">Selecione</option>

                                <?php for ($i = 0; $i < count($modelos); $i++) { ?>

                                    <option value="<?= $modelos[$i]['cod_modelo'] ?>" <?php if ($modelos[$i]['cod_modelo'] == $cod_modelo) echo 'selected' ?>> 
                                        <?= $modelos[$i]['nome_modelo'] ?> 
                                    </option>

                                <?php } ?>
                            </select>
                        </div>                    
                        <button class="btn btn-info" name="btnProcurar">Procurar</button>
                    </form>
                    <hr>

                        <?php if (isset($veiculos) && count($veiculos) > 0) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Advanced Tables -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Veículos encontrados
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Marca</th>
                                                            <th>Modelo</th>
                                                            <th>Valor</th>                                                    
                                                            <th>Ação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php for ($i = 0; $i < count($veiculos); $i++) { ?>

                                                            <tr class="odd gradeX">
                                                                <td><?= $veiculos[$i]['nome_marca'] ?></td>
                                                                <td><?= $veiculos[$i]['nome_modelo'] ?></td>
                                                                <td><?= $veiculos[$i]['valor_venda'] ?></td>

                                                                <td>
                                                                    <center>
                                                                        <input type="hidden" id="anofab<?= $i ?>" value="<?= $veiculos[$i]['ano_fabricacao'] ?>">
                                                                        <input type="hidden" id="anocarro<?= $i ?>" value="<?= $veiculos[$i]['ano_carro'] ?>"> 
                                                                        <input type="hidden" id="kmveiculo<?= $i ?>" value="<?= $veiculos[$i]['km_veiculo'] ?>">
                                                                        <input type="hidden" id="numporta<?= $i ?>" value="<?= $veiculos[$i]['num_porta'] ?>">
                                                                        <input type="hidden" id="dirveiculo<?= $i ?>" value="<?= $veiculos[$i]['direcao_veiculo'] == 1 ? 'Mecânica' : ($veiculos[$i]['direcao_veiculo'] == 2 ? 'Hidráulica' : 'Elétrica') ?>">
                                                                        <input type="hidden" id="airbag<?= $i ?>" value="<?= $veiculos[$i]['airbag_veiculo'] == 1 ? 'Nenhum' : ($veiculos[$i]['airbag_veiculo'] == 2 ? 'Duplo' : 'Duplo e lateral')?>">
                                                                        <input type="hidden" id="arveiculo<?= $i ?>" value="<?= $veiculos[$i]['ar_condicionado'] == 1 ? 'Sim' : 'Não' ?>">
                                                                        <input type="hidden" id="freioabs<?= $i ?>" value="<?= $veiculos[$i]['freio_abs'] == 1 ? 'Sim' : 'Não' ?>">
                                                                            
                                                                            <button data-toggle="modal" data-target="#Detalhes" onclick="return CarregarDados(<?= $i ?>)" class="btn btn-primary">Detalhes</button>
                                                                        <a href="finalizar_venda.php?cod=<?= $veiculos[$i]['cod_veiculo'] ?>" class="btn btn-success">Escolher</a>
                                                                    </center>
                                                                </td>
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
                            <center> <p>Nenhum registro para ser exibido</p> </centerr>
                            <?php } ?>

                            </div>
                            <!-- /. PAGE INNER  -->
                            </div>
                            <!-- /. PAGE WRAPPER  -->
                            </div>
                            <div class="modal fade" id="Detalhes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Detalhes do veículo</h4>
                                        </div>
                                        
                                            <div class="col-md-6" style="margin-top: 30px">
                                                <div class="form-group">
                                                    <label>Ano fabricação: </label>
                                                    <input type="text" id="anofab_popup" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ano carro: </label>
                                                    <input type="text" id="anocar_popup" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Direção: </label>
                                                    <input type="text" id="dir_popup" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Freio ABS: </label>
                                                    <input type="text" id="freio_popup" class="form-control" disabled>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6" style="margin-top: 30px">
                                                <div class="form-group">
                                                    <label>KM: </label>
                                                    <input type="text" id="km_popup" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Número de portas: </label>
                                                    <input type="text" id="numporta_popup" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Airbag: </label>
                                                    <input type="text" id="airbag_popup" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ar condicionado: </label>
                                                    <input type="text" id="ar_popup" class="form-control" disabled>
                                                </div>                                            
                                            </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <script>                            
                            
                            function CarregarDados(valor){
                                
                                $("#anofab_popup").val( $("#anofab" + valor).val() );
                                $("#anocar_popup").val( $("#anocarro" + valor).val() );
                                $("#km_popup").val( $("#kmveiculo" + valor).val() );
                                $("#numporta_popup").val( $("#numporta" + valor).val() );
                                $("#dir_popup").val( $("#dirveiculo" + valor).val() );
                                $("#airbag_popup").val( $("#airbag" + valor).val() );
                                $("#ar_popup").val( $("#arveiculo" + valor).val() );
                                $("#freio_popup").val( $("#freioabs" + valor).val() );
                                
                                return false;
                            }
                            
                            </script>
        
                            </body>
                            </html>


