/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//$(document).ready(function(){     
//    var area = $('#identificador_rol').val();
//    
//    if(area === '48'){ // direccion juridica. habilito todo excepto la ficha cliente
//       $("#no_contrato").prop('disabled', false);
//       $("#no_suplemento").prop('disabled', false);
//       $("#fecha_firma").prop('disabled', false);
//       $("#tipo_persona").prop('disabled', false);
//       $("#idEmpresa").prop('disabled', false);
//       $("#idTipoServicio").prop('disabled', false);
//       $("#id_procesos").prop('disabled', false);
//       $("#no_contrato").prop('disabled', false);
//       $("#vigencia").prop('disabled', false);
//       $("#periodo").prop('disabled', false);
//       $("#fecha_expira").prop('disabled', false);
//       $("#userfile").prop('disabled', false);
//       $("#observaciones").prop('disabled', false);  
//       $(".selectpicker").prop('disabled', true);
//    }else{
//        if(area === '93'){ // direccion logistica. inhabilito todo excepto la ficha cliente
//            $(".selectpicker").prop('disabled', false);           
//        }else{
//            if(area === '47'){
//                $(".selectpicker").prop('disabled', true); // SAD. muestro todo inhabilitado
//            }
//        }
//    }  
//});

$(document).ready(function(){     
    var area = $('#identificador_rol').val();
    
    if((area === '48') || (area === '93') || (area === '47')){ // direccion juridica. habilito todo excepto la ficha cliente
       $("#no_contrato").prop('disabled', true);
       $("#no_suplemento").prop('disabled', true);
       $("#fecha_firma").prop('disabled', false);
       $("#tipo_persona").prop('disabled', false);
       $("#idEmpresa").prop('disabled', false);
       $("#idTipoServicio").prop('disabled', false);
       $("#id_procesos").prop('disabled', false);
       //$("#no_contrato").prop('disabled', false);
       $("#vigencia").prop('disabled', false);
       $("#periodo").prop('disabled', false);
       $("#fecha_expira").prop('disabled', false);
       $("#userfile").prop('disabled', false);
       $("#observaciones").prop('disabled', false);  
       $(".selectpicker").prop('disabled', false);
    }
//        else{
//        if(area === '93'){ // direccion logistica. inhabilito todo excepto la ficha cliente
//            $(".selectpicker").prop('disabled', false);           
//        }else{
//            if(area === '47'){
//                $(".selectpicker").prop('disabled', true); // SAD. muestro todo inhabilitado
//            }
//        }
//        }  
});

