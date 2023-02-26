

<ol class="breadcrumb">
    
 <li><a href="<?php echo base_url('contrato'); ?>"><i class="fa fa-file-text-o"></i> Listado de contratos</a></li>
    <li class="active">Listado de Servicios</li>
</ol>



<?php if ($this->session->flashdata('ms_insertar')): ?>
    <div id="ms_insertar" class="alert alert-success">
        <?php echo $this->session->flashdata('ms_insertar') ?>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('ms_eliminar')): ?>
    <div id="ms_eliminar" class="alert alert-danger">
        <?php echo $this->session->flashdata('ms_eliminar') ?>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('ms_modificar')): ?>
    <div id="ms_modificar" class="alert alert-success">
        <?php echo $this->session->flashdata('ms_modificar') ?>
    </div>
<?php endif; ?>
<!--<a data-toggle="modal" href="#myModal" class="btn btn-primary "><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a>-->
<a data-toggle="modal" href="#myModal" class="btn btn-primary "><i class="fa fa-plus-square-o"></i> Nuevo Servicio</a>

<table id="example" class="table table-striped" cellpadding=0 cellspacing=2>
    <thead>
        <tr>
            <th>Servicio</th>
            <th>Estado</th>
            <th>Acciones</th>
<!--            <th></th>  -->
    </thead>
    <tbody>
        <?php foreach ($datos as $row): ?>
            <tr>
                <td><?php echo $row['nombre_servicio']; ?></td>
                <td>
                    <?php if($row['estado'] <> 0):?>
                        <span class="label label-success"><?php echo "Activo";?></span> 
                    <?php endif;?>
                    <?php if($row['estado'] <> 1):?>
                        <span class="label label-warning"><?php echo "Inactivo";?></span> 
                    <?php endif;?>
                </td>
                <td> <a class="btn btn-primary btn-sm" data-toggle="modal" href="#myModal<?php echo $row['id_servicio']; ?>"  title="Modificar servicio" ><i class="fa fa-pencil-square-o"></i> </a>   
                <a class="btn btn-success btn-sm" data-toggle="tooltip"  title="Cancelar servicio" href="<?php echo base_url('clasificador/servicio/cancelar_servicio/' . $row['id_servicio']); ?>" onclick="return confirm('Desea cambiar el estado?');"><i class="fa fa-check"></i> </a></td>                  
            </tr>
            
            <!-- Modal -->
        <div class="modal fade" id="myModal<?php echo $row['id_servicio']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modificar Servicio</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        $attributes = array('id' => 'fempresa', 'role' => 'form');
                        echo form_open_multipart('clasificador/servicio/modificar', $attributes);
                        ?>
                        <label> Servicio *</label>
                        <input type="text" class="form-control" name="servicio" value="<?php echo $row['nombre_servicio'] ?>"><br>
                        <input type="text"  class="form-control hide" name="id" value="<?php echo $row['id_servicio']; ?>" id="idservicio">

                        <label> Observaciones</label>
                        <textarea style="resize: none" class="form-control" rows="3" name="observaciones"><?php echo $row['descripcion'] ?></textarea>
                        (*) campos obligatorios
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary  btn" value="Aceptar">
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
<?php endforeach; ?>
</tbody>





</table>






<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Nuevo servicio</h4>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id' => 'fempresa', 'role' => 'form');
                echo form_open_multipart('clasificador/servicio/nueva', $attributes);
                ?>
                <label> Servicio *</label>
                <input type="text" class="form-control" name="servicio" placeholder="Servicio"><br>


                <label> Observaciones</label>
                <textarea style="resize: none" class="form-control" rows="3" name="observaciones" placeholder="Observaciones"></textarea>
                (*) campos obligatorios
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary  btn" value="Aceptar">
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
