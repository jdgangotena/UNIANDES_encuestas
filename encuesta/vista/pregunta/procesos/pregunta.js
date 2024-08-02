inicializarVirtualSpace();

function inicializarVirtualSpace(){
    window.ns_alternativas = {
        numero: 0,
        funcionSimple(){}
    }
    window.ns_alternativa = {
        id_alternativa: 0
    }
    window.ns_pregunta = {
        id_pregunta: 0
    }
    window.ns_menu_opcion = {
        is_activado: 0,
        is_permitido: 0
    }
}

$(document).ready(function() {
    getListaEncuesta();
    getListaTipoPregunta();
    eventoMyPagina();
});

function abrirOpciones(){
    var my_menu_usu = document.getElementById("my-usuario-opcion"); 
    if(my_menu_usu.style.display == 'none'){
        my_menu_usu.style.display = 'block';
        window.ns_menu_opcion.is_activado = 1;
        setTimeout(function(){
            window.ns_menu_opcion.is_activado += 1;
        }, 300);
    }else{
        my_menu_usu.style.display = 'none';
        window.ns_menu_opcion.is_activado = 0;
    }
    document.getElementById("my-usuario-opcion").focus();
}

function eventoMyPagina(){
    window.onclick = function() {
        var my_menu_usu = document.getElementById("my-usuario-opcion"); 
        if((window.ns_menu_opcion.is_activado > 1)){
            my_menu_usu.style.display = 'none';
            window.ns_menu_opcion.is_activado = 0;
        }   
    }
}

var modal_lv = 0;
$('.modal').on('shown.bs.modal', function (e) {
    $('.modal-backdrop:last').css('zIndex',1051+modal_lv);
    $(e.currentTarget).css('zIndex',1150+modal_lv);
    modal_lv++
});

/*EVALUAR SI ESTA INTERVENCION DEL EVENTO HIDEN VALE LA PENA O NO*/
$('.modal').on('hidden.bs.modal', function (e) {
    modal_lv--
});



function animacionGuardado(respuesta, animarId){
    switch (respuesta){
        case "OK":
            break;
        case "NO":
            errorIngreso(animarId);
            break;
        default:
            errorIngreso(animarId);
            break;
    }
}

function errorIngreso(animarId){
    document.getElementById(animarId).classList.remove("colorTexto");
    document.getElementById(animarId).classList.add("bg-danger");
    document.getElementById(animarId).classList.add("text-white");
    document.getElementById(animarId).classList.add("phTemaObse");
    
    setTimeout(function(){
                document.getElementById(animarId).classList.remove("bg-danger");
                document.getElementById(animarId).classList.remove("text-white");
                document.getElementById(animarId).classList.remove("phTemaObse");
                document.getElementById(animarId).classList.add("colorTexto");
    }, 2000);
}

function cerrarModalDesi(){
    $("#miModalDesicion .close").click();
}

function guardarPregunta(){
    var preg = document.getElementById("my_preg").value;
    var alter = obtenerAlternativas();
    var encu = document.getElementById("my_encuesta").value;
    var orde = obtenerOrdenes();
    var tipo = document.getElementById("my_tp_preg").value;

    $.post("./procesos/guardarPregunta.php", {preg: preg , alter: alter, encu: encu, orde: orde, tipo: tipo}, function(mensaje) {
        //console.log(mensaje);
        limpiarControles();
        visualizarEncuesta();

    });
}

function visualizarEncuesta(){
    var encu = document.getElementById("my_encuesta").value;
    $.post("./procesos/visualizarEncuesta.php", {encu: encu}, function(mensaje) {
        $("#my_encuesta_view").html(mensaje);
    });
}

function limpiarControles(){
    document.getElementById("my_preg").value = "";
    document.getElementById("my_alter0").value = "";
    document.getElementById("my_orden0").value = "";
    document.getElementById("btn_alt0").disabled = false;
    $(".my_div_alter_gen").remove();
}

function obtenerAlternativas(){
    var limite = window.ns_alternativas.numero + 1;
    var myAlternativas = [];
    var myString = "my_alter";
    var tipo_preg = document.getElementById("my_tp_preg").value;
    for(var i= 0; i < limite; i++){
        myAlternativas[i] = document.getElementById(myString + i.toString()).value;
        if(document.getElementById(myString + i.toString()).value == ""){
            if((tipo_preg != 0) && (tipo_preg != 3)){
                myOrdenes = null;
                break;
            }
        }
    }
    return myAlternativas;
}

function obtenerOrdenes(){
    var limite = window.ns_alternativas.numero + 1;
    var myOrdenes = [];
    var myString = "my_orden";
    var tipo_preg = document.getElementById("my_tp_preg").value;
    for(var i= 0; i < limite; i++){
        myOrdenes[i] = document.getElementById(myString + i.toString()).value;
        if (document.getElementById(myString + i.toString()).value == ""){
            if((tipo_preg != 0) && (tipo_preg != 3)){
                myOrdenes = null;
                break;
            }
        }
    }
    return myOrdenes;
}

function nuevaAlternativa(idtext, idbutton, iddiv, idorden){

    var my_id_text = parseInt(idtext.replace("my_alter", ""), 10) + 1;
    var my_id_button = parseInt(idbutton.replace("btn_alt", ""), 10) + 1;
    var my_id_div = parseInt(iddiv.replace("my_div", ""), 10) + 1;
    var my_id_orden = parseInt(idorden.replace("my_orden", ""), 10) + 1;

    document.getElementById(idbutton).disabled = true;

    var template='<div class="input-group input-group-sm py-1 my_div_alter_gen" id="my_div' + my_id_div + '">' +
                        '<input type="text" name="my_alter' + my_id_text + '" id="my_alter' + my_id_text + '"' +
                        'class="form-control my-tam-alter" placeholder="Escribe una alternativa" title="Escribe una alternativa">' +
                        '<button type="button" id="btn_alt' + my_id_button + '" class="btn btn-warning btn-sm mx-1"' +
                            'onclick="nuevaAlternativa(\'my_alter'+ my_id_text + '\', \'btn_alt'+ my_id_button +'\',\'my_div'+ my_id_div +'\', \'my_orden'+ my_id_orden +'\');"' + 
                            'title="Nueva alternativa">' +
                            '<i class="fa fa-plus fa-sm px-1" ></i>' +
                        '</button>' +
                        '<input type="text" name="my_orden' + my_id_orden + '" id="my_orden' + my_id_orden + '" ' +
                            'class="form-control my-tam-order" placeholder="Orden" title="Orden" autocomplete="off">' +
                        '<button type="button" id="btn_eli' + my_id_button + '" class="btn btn-danger btn-sm mx-1"' +
                            'onclick="eliminarAlternativa(\'my_div'+ my_id_div + '\',\'btn_alt'+ my_id_button +'\');"' + 
                            'title="Eliminar alternativa">' +
                        '<i class="fa fa-close fa-sm px-1" ></i>' +
                    '</button>' +
                 '</div>';

    $("#my_alternativas").append(template);

    window.ns_alternativas.numero = my_id_button;

    logicaEliminar(my_id_button);
}

function eliminarAlternativa(idDiv, idbutton){

    var my_id_button = parseInt(idbutton.replace("btn_alt", ""), 10) - 1;

    var my_string_nuev = "btn_alt" + my_id_button;
    var my_string_elim = "btn_eli" + my_id_button;

    document.getElementById(my_string_nuev).disabled = false;

    if(my_id_button > 0){
        document.getElementById(my_string_elim).disabled = false;
    }
    
    $("#" + idDiv).remove();

    window.ns_alternativas.numero = my_id_button;
}

function logicaEliminar(idbutton){
    if(idbutton > 1){
        idbutton = idbutton - 1;
        var my_string = "btn_eli" + idbutton.toString();
        document.getElementById(my_string).disabled = true;
    }
}

function editarPregunta(miId){
    var preg = miId;
    var encu = document.getElementById("my_encuesta").value;
    $.post("./procesos/verPregunta.php", {preg: preg , encu: encu}, function(mensaje) {
        $("#my_pregunta_completa").html(mensaje);
        abrirModalEditar();
    });
}

function abrirModalEditar(){
    $('#miModalEditar').modal('show');
    $('#miModalEditar').on('shown.bs.modal', function () {
        $('#cerrarModalEditar').focus();
    });
}

function preguardarPregunta(objeto){
    var myObjeto = document.getElementById(objeto.id);
    var palabra = myObjeto.value;
    if (palabra.length  > 6){
        myObjeto.classList.remove("bg-danger");
        myObjeto.classList.remove("text-white");
        myObjeto.classList.remove("phTemaObse");
        myObjeto.classList.add("colorTexto");

        var myId = objeto.id;

        actualizarPregunta(myId, palabra);
    }else{
        errorIngreso(objeto.id);
    }
}

function actualizarPregunta(idAc, tema){
    var datosR = new Array(2);
    datosR[0] = idAc;
    datosR[1] = tema;
    $.post("./procesos/actualizarPregunta.php", {valor: datosR}, function(mensaje) {
        animacionGuardado(mensaje, idAc);
        visualizarEncuesta();
    });
}

function preguardarAlter(objeto){
    var myObjeto = document.getElementById(objeto.id);
    var palabra = myObjeto.value;
    if (palabra.length  > 4){
        myObjeto.classList.remove("bg-danger");
        myObjeto.classList.remove("text-white");
        myObjeto.classList.remove("phTemaObse");
        myObjeto.classList.add("colorTexto");

        var myId = objeto.id;
    
        actualizarAlter(myId, palabra);
    }else{
        errorIngreso(objeto.id);
    }
}

function actualizarAlter(idAc, tema){
    var datosR = new Array(2);
    datosR[0] = idAc;
    datosR[1] = tema;
    $.post("./procesos/actualizarAlter.php", {valor: datosR}, function(mensaje) {
        animacionGuardado(mensaje, idAc);
        visualizarEncuesta();
    });
}

function modalDesicion(des, valor, objeto = null){
    var text = "";
    var myOClass = "";
    var myId = "";
    if(objeto != null){
        myOClass = $(objeto).parent().parent().parent().attr("class").split(" ");
    }
    switch(des){
        case 1:
            text = "¿Deseas eliminar la pregunta?";
            $("#eventeame").attr('onclick', 'eliminarUpPregunta(' + valor + ');');
            break;
        case 2:
            text = "¿Deseas eliminar la alternativa?";
            $("#eventeame").attr('onclick', 'eliminarUpAlter(' + valor +', \''+ myOClass[2] +'\');');
            break;
        case 3:
            text = "¿Deseas eliminar la encuesta?";
            myId = objeto.id;
            $("#eventeame").attr('onclick', 'eliminarEncuesta(\''+ myId +'\');');
            break;
        default:
            console.log("Error al mostrar modal desicion");
            text = "Error al mostrar modal desicion";
            break;
    }

    document.getElementById('miModalDesTexto').textContent = text;
    $('#miModalDesicion').modal('show');
    $('#miModalDesicion').on('shown.bs.modal', function () {
        $('#cerrarModalDesicion').focus();
    });
}

function eliminarUpPregunta(valor){
    cerrarModalDesi();
    $.post("./procesos/eliminarActPregunta.php", {valor: valor}, function(mensaje) {
        visualizarEncuesta();
    });
}

function eliminarUpAlter(valor, myOClass){
    cerrarModalDesi();
    $.post("./procesos/eliminarActAlternativa.php", {valor: valor}, function(mensaje) {
        $("." + myOClass).remove();
        visualizarEncuesta();
    });
}

function agregarUpAlter(valor){
    $.post("./procesos/agregarActPregunta.php", {valor: valor}, function(mensaje) {
        $("#my_edit_preg_completa").append(mensaje);
        visualizarEncuesta();
    });
}

function getListaEncuesta(){
    $.post("./procesos/getListaEncuesta.php",{ valor: "protected" }, function(mensaje) {
        $("#my_encuesta").html(mensaje);
        $("#my_re_encuesta").html(mensaje);
    });
}

function getListaTipoPregunta(){
    $.post("./procesos/getListaTipoPregunta.php", { valor: "protected" }, function(mensaje) {
        $("#my_tp_preg").append(mensaje);
    });
}

function habilitaPorTPregunta(objeto){
    var tipo_preg = document.getElementById(objeto.id).value;
    if (tipo_preg == 3){
        window.ns_alternativas.numero = 0;
        document.getElementById("my_alter0").disabled = true;
        document.getElementById("btn_alt0").disabled = true;
        document.getElementById("my_orden0").disabled = true;
    }else{
        window.ns_alternativas.numero = 0;
        document.getElementById("my_alter0").disabled = false;
        document.getElementById("btn_alt0").disabled = false;
        document.getElementById("my_orden0").disabled = false;
    }
}

function nuevaEncuesta(){
    getEncuesta();
    abrirModalEncuesta();
}

function getEncuesta(){
    $.post("./procesos/getEncuesta.php", { valor: "protected" }, function(mensaje) {
        $("#my_encuesta_llenado").html(mensaje);
    });
}

function abrirModalEncuesta(){
    $('#miModalEncuesta').modal('show');
    $('#miModalEncuesta').on('shown.bs.modal', function () {
        $('#cerrarModalEncuesta').focus();
    });
}

function abrirModalReEncu(){
    console.log("open");
    $('#miModalReEncu').modal('show');
    $('#miModalReEncu').on('shown.bs.modal', function () {
        $('#cerrarModalReEncu').focus();
    });
}

function verNuevaEncuesta(){
    document.getElementById("my_encu_nuevo").disabled = true;
    document.getElementById("my_encu_cancelar").disabled = false;
    document.getElementById("my-llenado-encuesta").style.display = "block";
    document.getElementById("my_n_encuesta").value = "";
    document.getElementById("my_n_encuesta").focus();
}

function verCancelarEncuesta(){
    document.getElementById("my_encu_nuevo").disabled = false;
    document.getElementById("my_encu_cancelar").disabled = true;
    document.getElementById("my-llenado-encuesta").style.display = "none";
    document.getElementById("my_n_encuesta").value = "";
}

function guardarNuevaEncuesta(){
    var valor = document.getElementById("my_n_encuesta").value;
    $.post("./procesos/guardarEncuesta.php", { valor: valor }, function(mensaje) {
        getEncuesta();
        getListaEncuesta();
        verCancelarEncuesta();
    });
}

function preguarEEncuesta(objeto){
    var myObjeto = document.getElementById(objeto.id);
    var myId = objeto.id;
    if (myObjeto.checked == true){
        guardarEEncuesta(myId, 1)
    } else {
        guardarEEncuesta(myId, 0)
    }
}

function guardarEEncuesta(idAc, marca){
    var datosR = new Array(2);
    datosR[0] = idAc;
    datosR[1] = marca;
    $.post("./procesos/guardarEEncuesta.php", {valor: datosR}, function(mensaje) {
       //console.log(mensaje);
       getListaEncuesta();
    });
}

function eliminarEncuesta(myId){
    $.post("./procesos/eliminarEncuesta.php", {valor: myId}, function(mensaje) {
        getEncuesta();
        getListaEncuesta();
        cerrarModalDesi();
    });
}

function reporteEncuExcel(){
    var form = $(document.createElement('form'));
    $(form).attr("action", "procesos/reporteEncuExcel.php");
    $(form).attr("method", "POST");
    $(form).css("display", "none");

    var my_encu_se = $("<input>")
    .attr("text", "date")
    .attr("name", "my_encu_reporte")
    .val(document.getElementById("my_re_encuesta").value);
    $(form).append($(my_encu_se));

    form.appendTo(document.body);
    $(form).submit();

    //DESTROY
    form.remove();
}