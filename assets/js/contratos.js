/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 $(document).ready(function(){
    $("#tipo_persona").change(function () {
        //alert('aki');
        $("#tipo_persona option:selected").each(function () {                
            //elegido=$(this).val(); 
            elegido=$('#tipo_persona').val();   

            $.ajax({
                type: 'POST',
                url : document.location.origin + "/registro_contrato/contrato/muestra_empresas",
                data : {'elegido':elegido},
                dataType : 'json',
                async: false,
                success: function(datos) 
                    {
                        $('#idEmpresa').empty();
                        $('#idEmpresa').append('<option value="">--Selecione--</option>');
                        for (var i in datos){
                            $('#idEmpresa').append('<option value="'+datos[i]['id_empresa']+'">'+datos[i]['nombre_empresa']+'</option>');
                        }
                    },
                    error: function () {
                        alert("Error","Error al cargar los datos.", "error");
                    }
            });		
        });
    });   
    
    $("#f_exp").change(function (){ 
        
        
        fecha = $('#fecha_firma').val();         
        dia = fecha.getDate();
        mes = fecha.getMonth()+1;// +1 porque los meses empiezan en 0
        anio = fecha.getFullYear();

        fecha_firma = (dia+"/"+mes+"/"+anio);
        fecha_expira = ((dia+3)+"/"+mes+"/"+anio);
       
       alert(fecha_firma);
    
    });
});



// $(document).ready(function(){
//    $("#tipo_empresa").change(function () {
//        //alert('aki');
//        $("#tipo_empresa option:selected").each(function () {                
//            //elegido=$(this).val(); 
//            elegido=$('#tipo_empresa').val();   
//
//            $.ajax({
//                type: 'POST',
//                url : document.location.origin + "/registro_contrato/contrato/muestra_empresas",
//                data : {'elegido':elegido},
//                dataType : 'json',
//                async: false,
//                success: function(datos) 
//                    {
//                        $('#empresa').empty();
//                        $('#empresa').append('<option value="">--Selecione--</option>');
//                        for (var i in datos){
//                            $('#empresa').append('<option value="'+datos[i]['id_empresa']+'">'+datos[i]['nombre_empresa']+'</option>');
//                        }
//                    },
//                    error: function () {
//                        alert("Error","Error al cargar los datos.", "error");
//                    }
//            });		
//        });
//    });
//});
