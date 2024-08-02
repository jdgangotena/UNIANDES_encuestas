inicializarVirtualSpace();

$(document).ready(function() {
    setTimeout(function(){ $("#my_tope").hide();}, 1200);
});

function inicializarVirtualSpace(){
    window.ns_resp_check = {
        id: ""
    }
}

function validarTextos(){
    var myPacketTexto = [];

    var myIndiCEPreg = 0;
    $("form#myFormEncuesta textarea").each(function(){
        var myIdPacket = $(this).parent().parent().attr("id");
        var myDataPack = new Array(1);
        myDataPack[0] = myIdPacket;
        myDataPack[1] = $(this).attr("id");
        myIndiCEPreg = myIndiCEPreg + 1;
        myPacketTexto.push(myDataPack);
    });

    var myTamPTE = myPacketTexto.length;
    var myNRPTE = "";
    var myEPTE = null;
    var myNuevoTE = [];
    var myIndiTE = 0;
    var my_envio = "";
    for(var i = 0; i < myTamPTE; i++){
        for(var k = 0; k < 2; k++){
            myEPTE = document.getElementById(myPacketTexto[i][1]).value;
            if(myPacketTexto[i][0] != myNRPTE){
                myNRPTE = myPacketTexto[i][0];
            }
            if(myEPTE == ""){
                document.getElementById(myNRPTE).classList.add("my_validate_bad_style");
                break;
            }else{
                document.getElementById(myNRPTE).classList.remove("my_validate_bad_style");
                document.getElementById(myNRPTE).classList.add("my_validate_oki_style");
                myIndiTE = myIndiTE + 1;
                my_envio = myPacketTexto[i][1] + "|" + document.getElementById(myPacketTexto[i][1]).value;
                myNuevoTE.push(my_envio);
                break;
            }
        }
    }

    if(myIndiTE == myIndiCEPreg){
        return myNuevoTE;
    }else{
        return null;
    }
}

function validarRadios(){
    var myPacketRadio = [];

    $("form#myFormEncuesta input[type=radio]").each(function(){
        var myIdPacket = $(this).parent().parent().attr("id");
        var myDataPack = new Array(1);
        myDataPack[0] = myIdPacket;
        myDataPack[1] = $(this).attr("id");
        myPacketRadio.push(myDataPack);
    });

    var myTamPRA = myPacketRadio.length;
    var myNRPRA = "";
    var myEPRA = null;
    var myNuevoRA = [];
    var myIndiRA = 0;
    var my_envio = "";
    for(var i = 0; i < myTamPRA; i++){
        for(var k = 0; k < 2; k++){
            myEPRA = document.getElementById(myPacketRadio[i][1]).checked;
            if(myPacketRadio[i][0] != myNRPRA){
                myNRPRA = myPacketRadio[i][0];
            }
            if(myEPRA == false){
                document.getElementById(myNRPRA).classList.add("my_validate_bad_style");
                break;
                //console.log("Falta llenar pregunta");
            }else{
                document.getElementById(myNRPRA).classList.remove("my_validate_bad_style");
                document.getElementById(myNRPRA).classList.add("my_validate_oki_style");
                myIndiRA = myIndiRA + 1;
                my_envio = myPacketRadio[i][1] + "|" + document.getElementById(myPacketRadio[i][1]).value;
                myNuevoRA.push(my_envio);
                //console.log("Pregunta llenada");
                break;
            }
        }
    }

    var myIndiRaPreg = 0;
    var myParentIndiRA = "";
    $(".icolec-encuesta .ismyradio").each(function(){
        if($(this).parent().attr("id") != myParentIndiRA){
            myIndiRaPreg += 1;
            myParentIndiRA = $(this).parent().attr("id");
        }
    });

    if(myIndiRA == myIndiRaPreg){
        return myNuevoRA;
    }else{
        return null;
    }

}

function validarCheckboxes(){
    var myPacketCheck = [];

    $("form#myFormEncuesta input[type=checkbox]").each(function(){
        var myIdPacket = $(this).parent().parent().attr("id");
        var myDataPack = new Array(1);
        myDataPack[0] = myIdPacket;
        myDataPack[1] = $(this).attr("id");
        myPacketCheck.push(myDataPack);
    });

    var myTamPCK = myPacketCheck.length;
    var myNRPCK = "";
    var myEPCK = null;
    var myNuevoCE = [];
    var myIndiCE = 0;
    var my_envio = "";
    for(var i = 0; i < myTamPCK; i++){
        for(var k = 0; k < 2; k++){
            myEPCK = document.getElementById(myPacketCheck[i][1]).checked;
            if(myPacketCheck[i][0] != myNRPCK){
                myNRPCK = myPacketCheck[i][0];
            }
            if(myEPCK == false){
                document.getElementById(myNRPCK).classList.add("my_validate_bad_style");
                break;
            }else{
                document.getElementById(myNRPCK).classList.remove("my_validate_bad_style");
                document.getElementById(myNRPCK).classList.add("my_validate_oki_style");
                myIndiCE = myIndiCE + 1;
                my_envio = myPacketCheck[i][1] + "|" + document.getElementById(myPacketCheck[i][1]).value;
                myNuevoCE.push(my_envio);
                break;
            }
        }
    }

    var myIndiCePreg = 0;
    var myParentIndiCE = "";
    $(".icolec-encuesta .ismycheck").each(function(){
        if($(this).parent().attr("id") != myParentIndiCE){
            myIndiCePreg += 1;
            myParentIndiCE = $(this).parent().attr("id");
        }
    });

    if(myIndiCE >= myIndiCePreg){
        return myNuevoCE;
    }else{
        return null;
    }
}

function enviarEncuesta(){
    var mycevirable = validarCheckboxes();
    var myravirable = validarRadios();
    var mytevirable = validarTextos();
    $("#my_tope").show();
    $.ajax({                    
        type: "POST",
        url: './procesos/guardarRespuesta.php',
        data: {ce: mycevirable, ra: myravirable, te: mytevirable},                  
        success: function(mensaje){   
            mensajeEncuesta(mensaje);
        }
    }).done(function(){
        setTimeout(function(){ $("#my_tope").hide();}, 500);
    });
}

function noDesclickCheck(id){
    var myNopDesclick = [];
    $("#" + id + " input[type=checkbox]").each(function(){
        myNopDesclick.push($(this).attr("id"));
    });

    var liminopde = myNopDesclick.length;
    var my_cont = 0;
    var my_aux = null;

    for(var i = 0; i < liminopde; i++){
        if(document.getElementById(myNopDesclick[i]).checked == true){
            my_cont = my_cont + 1;
            my_aux = myNopDesclick[i];
        }
    }

    if(my_cont == 1){
        window.ns_resp_check.id = my_aux;
    }

    if(my_cont == 0 && window.ns_resp_check.id != ""){
        document.getElementById(window.ns_resp_check.id).checked = true;
    }
}

function mensajeEncuesta(mensaje){
    var my_icono = "";
    if(mensaje == "OK"){
        my_icono ='<i class="fa fa-check text-success" style="font-size:50px;" aria-hidden="true"></i>';
        setTimeout(function(){ abrirModalOKI("Gracias por realizar la encuesta.", my_icono);}, 600);
        reDireccionarOKI();
    }else if(mensaje == "NUL"){
        my_icono ='<i class="fa fa-close text-danger" style="font-size:50px;" aria-hidden="true"></i>';
        abrirModalOKI("Error al guardar la encuesta.", my_icono);
    }else{
        my_icono ='<i class="fa fa-exclamation text-warning" style="font-size:50px;" aria-hidden="true"></i>';
        setTimeout(function(){ abrirModalOKI(mensaje, my_icono);}, 600);
        setTimeout(function(){ miModalOkiClose();}, 2000);
    }
}

function abrirModalOKI(mensaje, icono){
    $(".OKIcono").html(icono);
    document.getElementById('OKIconcepto').textContent = mensaje;
    $('#miModalOKI').modal('show');
}

function miModalOkiClose(){
    $("#miModalOKI .close").click();
}

function reDireccionarOKI(){
    setTimeout(function(){
        location.reload();
    }, 2000);
}