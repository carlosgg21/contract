
<div class="container-fluid">
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

    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('contrato') ?>"><span class="fa fa-file-text-o"></span> Contratos con Ficha Cliente desactualizada</a></li>
        <li class="active">Contratos con Ficha Cliente desactualizada</li>
    </ol>
    <div class="row">
        <a><h3>Contratos con Ficha Cliente Desactualizada</h3></a>            
        <hr>
    </div>
    
    <table id="example" class="table table-striped exptable" >
        <thead>
            <tr>
                <th>No. contrato</th>
                <th>No. suplemento</th>
                <th>Fecha firma</th>
                <th>Empresa</th>
                <th>Servicio</th>
                <th>Fecha expira</th>
                <th>Ficha Cliente</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $row): ?>
                <tr>
                    <td><?php echo $row['no_contrato']; ?></td>
                    <td><?php echo $row['no_suplemento']; ?></td>

                    <td><?php echo $row['fecha_firma']; ?></td>
                    <td><?php echo $row['nombre_empresa']; ?></td>
                    <td><?php echo $row['nombre_servicio']; ?></td>
                    <?php if ($row['fecha_expira'] == "0000-00-00"): ?>
                        <td></td>
                    <?php endif; ?>
                    <?php if ($row['fecha_expira'] != "0000-00-00"): ?>
                        <td><?php echo $row['fecha_expira']; ?></td>
                    <?php endif; ?>
                    <td><?php echo $row['nombre_apellidos']; ?></td>                
                    <td><a class="btn btn-primary btn-sm" href="./contratos_ficha_actualizar/<?php echo $row['id_contrato']; ?>"  title="Actualizar ficha Cliente"  ><i class="fa fa-paperclip"></i> </a></td>
<!--                    <td><a class="btn btn-primary btn-sm" data-toggle="modal" href="#myModal<?php echo $row['id_contrato']; ?>"  title="Actualizar ficha Cliente"  ><i class="fa fa-paperclip"></i> </a></td>-->


            <!--                     Modal Actualizar ficha cliente -->
<!--            <div class="modal fade" id="myModal<?php echo $row['id_contrato']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width: 30%" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Actualizar Ficha Cliente</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                            $attributes = array('id' => 'fcontrato', 'role' => 'form');
                            echo form_open('Contrato/actualizar_fcliente', $attributes);
                            ?>
                            <input type="text" class="form-control hide" id="idContrato" name="idContrato" value="<?php echo $row['id_contrato']; ?> "/>
                            <div class="row">
                                <div class="col-sm-6 col-md-offset-1">
                                    <label for="exampleInputficha">Ficha cliente*</label>
                                    <label class="control-label" for="selectError2">Ficha cliente*</label>
                                    <select name="id_ficha[]" class="form-control input-sm"  required="true">
                                    <select data-placeholder="Seleccione" id="id_ficha" data-rel="chosen">
                                        <?php foreach ($fichas as $row): ?>                                                              
                                            <option value="<?php echo $row['id_ficha'] ?>"><?php echo $row['cliente_nombre_apellidos'] ?></option>
                                        <?php endforeach; ?>                                        
                                    </select> 
                                    <hr>
                                    <select data-placeholder="Seleccione" id="id_ficha" name="id_ficha[]"  multiple data-rel="chosen">
                                        <?php foreach ($fichas as $row): ?>
                                            <?php if(isset($seleccionados[$row['id_ficha']])) :?>
                                                <option selected value="<?php echo $row['id_ficha'] ?>"><?php echo $row['cliente_nombre_apellidos'] ?></option>
                                                <?php else: if(!isset($seleccionados[$row['id_ficha']]))?>
                                                <option value="<?php echo $row['id_ficha'] ?>"><?php echo $row['cliente_nombre_apellidos'] ?></option>
                                            <?php endif;?>                                                
                                         <?php endforeach; ?> 
                                        <?php foreach ($fichas as $row) :?>                                               
                                        <?php endforeach?>                                              
                                    </select>
                                    <hr>
                             
                                    <select class="form-control selectpicker" multiple="multiple" name="id_ficha[]" id="id_ficha">
                                        <?php foreach ($fichas as $row): ?>                                                              
                                            <option value="<?php echo $row['id_ficha'] ?>"><?php echo $row['cliente_nombre_apellidos'] ?></option>
                                        <?php endforeach; ?>
                                    </select>                              
                                </div>                                    
                            </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-sm">Aceptar</button>                            
                        </div>
                        </form>
                    </div> /.modal-content 
                </div> /.modal-dialog 
            </div> /.modal -->
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
