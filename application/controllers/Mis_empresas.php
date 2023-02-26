<?php


        $estatales = $this->empresas->tipo_empresa('Empresa Estatal');
        $no_estatales = $this->empresas->tipo_empresa('Empresa No Estatal');
        $persona_nat = $this->empresas->tipo_empresa('Persona Natural');

        $html = "";
        $html.='<option value="">--Seleccione--</option>';
            if ($_POST["elegido"]==1) {   
                foreach ($estatales as $row){
                    $html.='<option value="'.$row['id_empresa'].'">'.$row['nombre_empresa'].'</option>';
                };
            }
            if ($_POST["elegido"]==2) {        
                foreach ($no_estatales as $row){
                    $html.='<option value="'.$row['id_empresa'].'">'.$row['nombre_empresa'].'</option>';
                };
            }
            if ($_POST["elegido"]==3) {
                foreach ($persona_nat as $row){
                    $html.='<option value="'.$row['id_empresa'].'">'.$row['nombre_empresa'].'</option>';	
                };
            }
        echo $html;	
    
?>                         
 
