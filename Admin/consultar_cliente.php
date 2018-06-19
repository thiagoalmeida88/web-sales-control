<!DOCTYPE html>
<?php

    require_once '../Controler/ClienteCtrl.php';
    require_once '../Controler/Util.php';

    Util::VerificarLogado();
    
    $ctrl = new ClienteCtrl();
    $clientes = $ctrl->ConsultarCliente();

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
                            <h2>Consultar Cliente</h2>   
                            <h5>Consultar / Alterar seus clientes aqui</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Clientes cadastrados
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Email</th>
                                                    <th>Telefone</th>
                                                    <th>Endereço</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for($i=0; $i < count($clientes); $i++){ ?>                                               
                                                
                                                <tr class="odd gradeX">
                                                    <td><?= $clientes[$i]['nome_cliente']?></td>
                                                    <td><?= $clientes[$i]['email_cliente'] ?></td>
                                                    <td><?= $clientes[$i]['tel_contato']?></td>
                                                    <td><?= $clientes[$i]['endereco_cliente'] ?></td>
                                                    <td>
                                                        <a href="alterar_cliente.php?cod=<?= $clientes[$i]['cod_cliente'] ?>" class="btn btn-warning">Alterar</a>
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

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>


