
        
<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('contrato'); ?>"><i class="fa fa-file-text-o"></i> Listado de contratos</a></li>
        <li class="active">Bitacora</li>
    </ol>

    <?php if(isset($datos)):?>            
        <table id="example" class="table table-hover table-condensed ">
            <thead>
                <tr>
                    <th>Fecha/Hora</th>
                    <th>Acción</th>
                    <!--<th>Id del Proyecto</th>-->
                    <th>Usuario</th>
                    <th>Dirección IP</th>                    
                    <!--<th></th>-->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $value):?>
                    <tr>
                        <td><?php echo $value['last_activity']?></td>
                        <td><?php echo $value['descripcion']?></td>
                        <td><?php  echo $value['user']?></td>
                        <td><?php  echo $value['ip_address']?></td>                        
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    <?php else:?>
        <h1>No hay datos</h1>
    <?php endif;?>
</div>
        
         
        
        