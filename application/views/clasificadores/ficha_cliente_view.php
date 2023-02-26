

<ol class="breadcrumb">
  <li><a href="<?php echo base_url('contrato'); ?>"><i class="fa fa-file-text-o"></i> Listado de contratos</a></li>

    <li class="active">Trabajdores en fichas de clientes</li>
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
<a data-toggle="modal" href="#myModal" class="btn btn-primary "><i class="fa fa-plus-square-o"></i> Agregar nuevo</a>

<table id="example" class="table table-striped" cellpadding=0 cellspacing=2>
    <thead>
        <tr>
            <th>Trabajdor en Ficha de Cliente</th>
            <th></th>
        </tr>    
    </thead>
    <?php if($datos != ''):?>       
        <tbody>
            <?php foreach ($datos as $row): ?>
                <tr>
                    <td><?php echo $row['cliente_nombre_apellidos']; ?></td>         
                    <td><a class="btn btn-danger btn-sm" data-toggle="tooltip"  title="Borrar empresa" href="<?php echo base_url('clasificador/ficha_clientes/eliminar/' . $row['id_ficha']); ?>" onclick="return confirm('Desea eliminar esta empresa del sistema?');"><i class="fa fa-trash-o"></i> </a></td>                  
                </tr>
            <?php endforeach; ?>
        </tbody>
    <?php endif;?>
        
</table>







<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Nueva ficha cliente</h4>
            </div>
            <div class="modal-body">
                <?php $attributes = array('id' => 'fproceso', 'role' => 'form');
                echo form_open_multipart('clasificador/ficha_clientes/nuevo', $attributes);
                ?>
                <label> Trabajdores *</label>


                  
                <select class="form-control" name="trabajador" required="true">
                    <option value="">seleccione un trabajador</option>
                    <?php foreach ($trabajadores as $value): ?>
                        <option value="<?php echo $value['id_usuario'] ?>"><?php echo $value['nombre_apellidos'] ?></option>
                        
                <?php endforeach; ?>
                </select><br>

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