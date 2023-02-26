function mostrar_div(valor){
    //alert(valor);
    if(valor=='0'){
        $('#natural_div').removeClass('hide');
        $('#empresa_div').addClass('hide');
    }
    if(valor=='1'){
        $('#empresa_div').removeClass('hide');
        $('#natural_div').addClass('hide');
    }
}

function mostrar_div1(valor){
    //alert(valor);
    if(valor=='1'){
        $('#pnatural_div').removeClass('hide');
        $('#empresas_div').addClass('hide');
    }
    if(valor=='0'){        
        $('#empresas_div').removeClass('hide');
        $('#pnatural_div').addClass('hide');       
    }
}

function mostrar_div2(valor){
    //alert(valor);
    if(valor=='2' || valor=='3'){
        //$('#pnatural_div').removeClass('hide');
        $('#estatal_div').addClass('hide');
        //$('#empresas_div').addClass('hide');
    }   
}

//Valida que de los campos No. Contrato y No. Suplemento al menos uno tenga datos 
function validar(){    
    if(($('#no_contrato').val().length === 0) && $('#no_suplemento').val().length === 0){
        alert("No. Contrado y No. Suplemento vacios. Rellene uno de estos campos.");
        return false;
    }
}

function val_fecha(){
    if( ($('#fecha_expira').val()) < ($('#fecha_firma').val())){
        alert("La Fecha Expira no debe ser menor que la Fecha de Firma");
    }
}





$(document).ready(function () {
//    $(".exptable").tableExport({ //exportar la tabla a los formatos: excel,csv,xls
//        bootstrap: true,            
//        position: top,            
//    });
    
    $(".selectpicker").selectpicker();
});










