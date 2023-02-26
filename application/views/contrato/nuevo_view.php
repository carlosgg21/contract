<?php
//echo "<PRE>";
//print_r(); 
//echo "</PRE>";
//die();
?>
<div class="container-fluid">

    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('contrato') ?>"><span class="fa fa-file-text-o"></span> Listado Contratos Vigentes</a></li>
        <li class="active"> Nuevo  Contrato</li>
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
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Nuevo contrato</h3>
        </div>
        <div class="panel-body">

            <?php
            $attributes = array('id' => 'fcontrato', 'role' => 'form');
            echo form_open_multipart('contrato/add', $attributes);
            ?>
            
                <div class="row">                
                    <div class="col-sm-3 col-md-offset-1">
                        <div class="form-group">
                            <label for="exampleInputnocontrato">No. Contrato*</label>
                            <input type="text" class="form-control input-sm " name="no_contrato" id="no_contrato" placeholder="No Contrato" autofocus required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="exampleInputnosuplemento">No. Suplemento</label>
                        <input type="text" class="form-control input-sm " name="no_suplemento" id="no_suplemento" placeholder="No Suplemento" disabled="true">
                    </div>
                    <div class="col-sm-3">
                        <label for="exampleInputffirma">Fecha Firma*</label>
                        <div class="input-group" id="f_firma">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control input-sm datepicker" id="fecha_firma" name="fecha_firma" placeholder="Fecha firma"  required onfocus="validar()" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-md-offset-1">
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="tipo_empresa">Tipo de Empresa</label>
                                    <select name="tipo_persona" id="tipo_persona" class="form-control">
                                        <option value="">-Seleccione-</option>
                                        <option value="2">Empresa Estatal</option>
                                        <option value="3">Empresa No Estatal</option>
                                        <option value="1">Persona Natural</option>
                                    </select>
                                </div> 
                                <div class="form-group col-lg-6">                                
                                    <label for="empresa">Nombre</label>
                                    <select name="idEmpresa" id="idEmpresa" class="form-control">
                                        <option value="">-Seleccione-</option>
                                    </select>                               
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                         <div class="form-group">
                             <label for="exampleInputservicio">Servicios*</label>
                             <select name="idTipoServicio" id="idTipoServicio" class="form-control input-sm"  required>
                                 <option value="">--Seleccione un Servicio--</option>
                                 <?php foreach ($servicios as $row): ?>
                                     <option value="<?php echo $row['id_servicio']; ?>"><?php echo $row['nombre_servicio']; ?></option>
                                 <?php endforeach; ?>
                             </select>
                         </div>
                     </div>                
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="exampleInputproceso">Procesos*</label>
                            <select name="id_procesos" id="id_procesos" class="form-control input-sm"  required>
                                <option value="">--Seleccione un Proceso--</option>
                                <?php foreach ($procesos as $row): ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['proceso']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1 col-md-offset-1">
                        <div class="form-group">
                            <label>Vigencia</label>
                            <input type="number" class="form-control input-sm"  name="vigencia" id="vigencia" min="1">
                        </div>
                    </div>  
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Período</label>
                            <div class="form-inline" id="f_exp" onchange="val_expira()">      
                                <input type="radio" name="periodo" id="periodo" value="d"> Días
                                <input type="radio" name="periodo" id="periodo" value="m"> Meses
                                <input type="radio" name="periodo" id="periodo" value="y"> Años 
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="exampleInputfexpira">Fecha Expira</label>
                            <div class="input-group" id="f_expira">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-sm datepicker" id="fecha_expira" name="fecha_expira" placeholder="Año-mes-día" onchange="val_fecha()">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="exampleInputdocumento">Documento*</label>                      
                            <div class="container-fluid">
                                <input type="file" name="userfile" id="userfile" accept=".pdf" required="true">
                            </div>               
                        </div>
                    </div>
                </div>          
               
            
            
                <div class="col-sm-3 col-md-offset-1">
                    <div class="form-group">
                        <label for="exampleInputdocumento">Ficha cliente*</label>
                        <select name="ficha_cliente[]" id="ficha_cliente"  multiple class="form-control input-sm selectpicker" data-selected-text-format="count" data-live-search="true" required="true"   data-actions-box="true">
<!--                                usar el optgroup si se quisiera separar los clientes por grupos-->
<!--                            <optgroup label="Clientes">--> 
                                <?php foreach ($fichas as $row): ?>
                                    <option value="<?php echo $row['id_ficha'] ?>" ><?php echo $row['cliente_nombre_apellidos'] ?></option>
                                 <?php endforeach; ?>
<!--                            </optgroup>                                -->
                        </select>
                    </div>
                </div>                
            
                <div class="col-md-9 col-md-offset-1">
                    <div class="form-group">
                        <label for="exampleInputobservaciones">Observaciones</label>
                        <textarea style="resize: none" class="form-control" rows="3" name="observaciones" id="observaciones" placeholder="Observaciones"></textarea>
                    </div>
                </div>
            
            
<!--            hasta aqui-->
            <div class="row">           
                <div class="col-md-10">
                    <div class="pull-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary  btn-sm" value="Crear contrato">
                    </div>
                </div>         
            </div>
            
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Subir contrato PDF</h4>
            </div>
            <div class="modal-body">
                <?php echo $error;?>                
                //<?php echo form_open_multipart('contrato/do_upload');?>
                <input type="file" name="userfile" id="userfile"/></div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary  btn" value="Aceptar">
<!--                </form>-->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



