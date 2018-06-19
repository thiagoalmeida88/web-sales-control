<?php

function ExibirMsg($ret) {

    if ($ret == -100) {
        echo '<div class="alert alert-danger">
                Ocorreu um erro na operação
              </div>';
    } else if ($ret == -1) {
        echo '<div class="alert alert-warning">
                Favor preencher campo(s) obrigatórios
              </div>';
    } else if ($ret == 1) {
        echo '<div class="alert alert-success">
                Dados gravados com sucesso
              </div>';
    } else if ($ret == 2) {
        echo '<div class="alert alert-success">
                Venda realizada com sucesso
              </div>';
    } else if ($ret == 3) {
        echo '<div class="alert alert-warning">
                Usuário não encontrado
              </div>';
    }
}
