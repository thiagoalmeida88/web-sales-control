<?php

require_once '../Controler/Util.php';

if(isset($_GET['close']) && $_GET['close'] == 1){
    Util::Deslogar();    
}

?>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li>
                <a href="#"><i class="fa fa-user fa-3x"></i> Cliente<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="novo_cliente.php">Novo</a>
                    </li>
                    <li>
                        <a href="consultar_cliente.php">Consultar / Alterar</a>
                    </li>                    
                </ul>
            </li

            <li>
            <li>
                <a href="#"><i class="fa fa-money fa-3x"></i> Vendas<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="fechar_venda.php">Nova</a>
                    </li>
                    <li>
                        <a href="consultar_vendas.php">Consultar</a>
                    </li>                    
                </ul>
            </li>
            <li>
                <a  href="_menu.php?close=1"><i class="fa fa-close fa-3x"></i> Sair</a>
            </li>
        </ul>

    </div>

</nav>

