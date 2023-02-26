<div class="container">
    <div class="row">
        <div class="col-md-12">   
            <h4>Roles del sistema </h4>
            <hr>
            <div class="panel-body">
              
          <table id="example1" class="table table-hover table-condensed " cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Rol</th>
                        <th>Descripción</th>
                        <th>Estado</th>                     
                    </tr>
                </thead>
                <tbody>
                    <?php $cont= 1 ; foreach ($roles as $value):?>
                  
                    <tr>
                        <td><?php  echo $cont++?></td>
                        <td><?php  
                                $result = explode("_", $value['nombre_rol']);
                                echo $result[0]?>
                        </td>
                       
                        <td><?php  echo $value['descripcion']?></td>
                        <?php if($value['estado_rol']==1):?>
                         <td><span class="label label-success">Activo</span></td>
                        <?php endif;?>
                        <?php if($value['estado_rol']==0):?>
                         <td>   <td><span class="label label-warning">Inactivo</span></td>
                        <?php endif;?>
                       
                        </tr>
                      
                      <?php endforeach;?>
                </tbody>
            </table>

           
        </div>
    </div>
</div>
</div>
