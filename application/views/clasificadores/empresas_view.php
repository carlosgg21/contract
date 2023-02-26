

<ol class="breadcrumb">
 <li><a href="<?php echo base_url('contrato'); ?>"><i class="fa fa-file-text-o"></i> Listado de contratos</a></li>

    <li class="active">Listado empresas</li>
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

<a data-toggle="modal" href="#myModal" class="btn btn-primary "><i class="fa fa-plus-square-o"></i> Nueva empresa</a>

    
<table id="example" class="table table-striped" cellpadding=0 cellspacing=2>
    <thead>
        <tr>
            <th>Proveedor</th>
            <th>Tipo de proveedor</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $row): ?>
            <tr>
                <td><?php echo $row['nombre_empresa']; ?></td>         
                <td><?php echo $row['tipo_empresa']; ?></td>         
                <td> <a class="btn btn-primary btn-sm" data-toggle="modal" href="#myModal<?php echo $row['id_empresa']; ?>"  title="Modificar empresa" ><i class="fa fa-pencil-square-o"></i> </a></td>   
                <td><a class="btn btn-danger btn-sm" data-toggle="tooltip"  title="Borrar empresa" href="<?php echo base_url('clasificador/empresa/eliminar/' . $row['id_empresa']); ?>" onclick="return confirm('Desea eliminar esta empresa del sistema?');"><i class="fa fa-trash-o"></i> </a></td>                  

            </tr>
            <!-- Modal -->
            <div class="modal fade" id="myModal<?php echo $row['id_empresa']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Modificar Empresa</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                            $attributes = array('id' => 'fempresa', 'role' => 'form');
                            echo form_open_multipart('clasificador/empresa/modificar', $attributes);
                            ?>
                            <label> Proveedor *</label>                        
                                <input type="text" class="form-control" name="empresa" value="<?php echo $row['nombre_empresa'] ?>" required><br>
                                <input type="text"  class="form-control hide" name="id" value="<?php echo $row['id_empresa']; ?>" id="idservicio">

                            <label> Tipo de empresa *</label>
                                <br>
                                <input style="margin-left: 10px" type="radio" name="tipo_empresa" id="tipo_empresa" value="Empresa Estatal">Empresa Estatal<br>
                                <input style="margin-left: 10px" type="radio" name="tipo_empresa" id="tipo_empresa" value="Empresa No Estatal">Empresa No Estatal<br>
                                <input style="margin-left: 10px" type="radio" name="tipo_empresa" id="tipo_empresa" value="Persona Natural">Persona Natural<br><br>

                            <label> Observaciones</label>
                                <textarea style="resize: none" class="form-control" rows="3" name="observaciones"><?php echo $row['observaciones'] ?></textarea>
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
                <h4 class="modal-title">Nueva Empresa</h4>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id' => 'fempresa', 'role' => 'form');
                echo form_open_multipart('clasificador/empresa/nueva', $attributes);
                ?>              
                
                <div class="form-group" >                  
                    <div class=" form-group">
                        <label> Proveedor *</label>                                         
                        <input type="text" class="form-control" name="empresa" placeholder="Empresa" required="true"><br>
                        <input type="text" class="form-control hide" name="id_empresa" id="id_empresa">
                    </div>              
                    <div class="radio">
                        <label><input type="radio" name="tipo" id="optionsRadios1" value="Empresa Estatal">Empresa Estatal</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="tipo" id="optionsRadios2" value="Empresa No Estatal">Empresa No Estatal</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="tipo" id="optionsRadios2" value="Persona Natural">Persona Natural</label>
                    </div><br>
                
                    <label> Observaciones</label>
                    <textarea style="resize: none" class="form-control" rows="3" name="observaciones" placeholder="Observaciones"></textarea>
                    (*) campos obligatorios
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary  btn" value="Aceptar">
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
