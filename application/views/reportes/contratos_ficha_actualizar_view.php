
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
    </ol>
    
    <div class="col-sm-8">
        <a style="text-decoration: none"><h3>Actualizar ficha cliente del contrato: <?php echo $idContrato; ?></h3></a>      
    </div>
        
    <input type="text" class="form-control hide" id="idContrato" name="idContrato" value="<?php echo $idContrato; ?> "/>
    
    <div class="col-sm-6">
        <div class="panel panel-default">           
            <div class="panel-body">
                <?php $attributes = array('id' => 'fcontrato', 'role' => 'form');
                echo form_open('reportes/actualizar_fcliente', $attributes);
                ?>  
                    <input type="text" class="form-control hide" id="idContrato" name="idContrato" value="<?php echo $idContrato; ?>"/>
                    <select class="selectpicker" multiple="multiple" name="id_ficha[]" id="id_ficha">
                        <?php foreach ($fichas as $row): ?>                                                              
                        <option value="<?php echo $row['id_ficha'] ?>"><?php echo $row['cliente_nombre_apellidos'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <p>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Aceptar</button>                            
                    </div>
                </form>
            </div>
        </div>    
    </div>
</div>                        
        