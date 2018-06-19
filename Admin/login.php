<!DOCTYPE html>

<?php

require_once '../Controler/VendaControler.php';
require_once '_msg.php';

$ret = '';
$email = '';
$senha = '';

if(isset($_POST['btnAcessar'])){
    
    $ctrl = new VendaControler();
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $ret = $ctrl->ValidarLogin($email, $senha);
}


?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php include '_head.php' ?>
    <body>
        <div class="container">
            <div class="row text-center ">
                <div class="col-md-12">
                    <br /><br />                    
                    <h2> Controle de Vendas</h2>

                    <h5>( Faça seu login para seu acesso )</h5>
                    <br />
                </div>
            </div>
            <div class="row ">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>   Entre com seus dados </strong>  
                        </div>
                        <div class="panel-body">
                            <?php ExibirMsg($ret) ?>
                            <form method="post" action="login.php">
                                <br />
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Seu e-mail" value="<?= $email ?>" />
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control" id="senha" name="senha"  placeholder="Sua senha" />
                                </div>                                

                                <button class="btn btn-primary " id="btn_acessar" name="btnAcessar" onclick="return Validar(1)">Acessar</button>                               

                            </form>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </body>
</html>

