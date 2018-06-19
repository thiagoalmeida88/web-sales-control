function Validar(tipo_tela) {

    var ret = true;
    var campos = "";

    if (tipo_tela == 1) {

        if ($("#email").val().trim() == "") {
            campos += "- E-mail \n";
            ret = false;
        }
        if ($("#senha").val().trim() == "") {
            campos += "- Senha \n";
            ret = false;
        }
    }

    if (tipo_tela == 2) {

        if ($("#nome").val().trim() == "") {
            campos += "- Nome \n";
            ret = false;
        }
        if ($("#email").val().trim() == "") {
            campos += "- E-mail \n";
            ret = false;
        }
        if ($("#telefone").val().trim() == "") {
            campos += "- Telefone \n";
            ret = false;
        }
        if ($("#endereco").val().trim() == "") {
            campos += "- Endereço \n";
            ret = false;
        }

    }
    
    if(tipo_tela == 3){
        
        if($("#cliente").val().trim() == ""){
            campos += "- Cliente \n";
            ret = false;
        }
        if($("#formaPagamento").val().trim() == ""){
            campos += "- Forma de pagamento \n";
            ret = false;
        }
        if($("#descricao").val().trim() == ""){
            campos += "- Descrição \n";
            ret = false;
        }
    }
    
    if(tipo_tela == 4){
        
        if($("#dt_inicial").val().trim() == ""){
            campos += "- Data inicial \n";
            ret = false;
        }
        if($("#dt_final").val().trim() == ""){
            campos += "- Data final \n";
            ret = false;
        }
    }

    if (!ret) {
        alert(campos);
    }

    return ret;

}
        