<input type="text" class="form-control hide" id="identificador_rol" name="identificador_rol" value="<?php echo $area; ?>">   

<?php foreach ($datos as $row): ?>
    <?php if ($row['id_contrato'] == $contrato): ?>
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('contrato') ?>"><span class="fa fa-file-text-o"></span> Listado Contratos Vigentes</a></li>
                <li class="active">Suplemento</li>
            </ol>

            <?php if ($this->session->flashdata('ms_modificar')): ?>
                <div id="ms_modificar" class="alert alert-success">
                    <?php echo $this->session->flashdata('ms_modificar') ?>
                </div>
            <?php endif; ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Suplemento al contrato <?php echo $contrato; ?></h3>
                </div>
                <div class="panel-body">
                    <?php
                    $attributes = array('id' => 'fcontrato', 'role' => 'form');
                    echo form_open_multipart('contrato/suplementar/' . $row['id_contrato'], $attributes);
                    ?>
                    
                    <input type="text" class="form-control hide" id="id_contrato" name="id_contrato">                   
                                              
                    <div id="juridico">
                        <div class="row" >                
                            <div class="col-sm-3 col-md-offset-1">
                                <div class="form-group">
                                    <label for="exampleInputnocontrato">No. Contrato</label>
                                    <input type="text" class="form-control input-sm " name="no_contrato" id="no_contrato" placeholder="" autofocus value="<?php echo $row['no_contrato']; ?>" disabled="true"/>
                                    <input type="text" class="form-control hide" id="el_contrato" name="el_contrato" value="<?php echo $row['no_contrato']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="exampleInputnosuplemento">No. Suplemento</label>
                                <input type="text" class="form-control input-sm " name="no_suplemento" id="no_suplemento" placeholder="" value="<?php echo $row['no_suplemento']; ?>" disabled="true"/>
                            </div>
                            <div class="col-sm-3">
                                <label for="exampleInputffirma">Fecha Firma*</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control input-sm datepicker" id="fecha_firma" name="fecha_firma" placeholder="" value="<?php echo $row['fecha_firma']; ?>" disabled="true"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 col-md-offset-1">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="tipo_empresa">Tipo de Empresa</label>
                                            <select name="tipo_persona" id="tipo_persona" class="form-control" disabled="true">
                                                <option value="">-Seleccione-</option>
                                                <?php if($row['tipo_persona'] == 2):?>
                                                    <option value="2" selected="selected">Empresa Estatal</option>
                                                    <option value="3">Empresa No Estatal</option>
                                                    <option value="1">Persona Natural</option>
                                                <?php endif;?>
                                                <?php if($row['tipo_persona'] == 3):?>
                                                    <option value="3" selected="selected">Empresa No Estatal</option>
                                                    <option value="2">Empresa Estatal</option>
                                                    <option value="1">Persona Natural</option>
                                                <?php endif;?>
                                                <?php if($row['tipo_persona'] == 1):?>
                                                    <option value="3">Empresa No Estatal</option>
                                                    <option value="2">Empresa Estatal</option>
                                                    <option value="1" selected="selected">Persona Natural</option>
                                                <?php endif;?>
                                            </select>
                                        </div> 
                                        <div class="form-group col-lg-6">                                
                                            <label for="empresa">Nombre</label>
                                            <select name="idEmpresa" id="idEmpresa" class="form-control" disabled="true">                                               
                                                <?php foreach ($emprs as $emp): ?>
                                                    <?php if($emp['id_empresa'] == $row['idEmpresa']):?>
                                                        <option value="<?php echo $row['idEmpresa']; ?>"><?php echo $emp['nombre_empresa']; ?></option>
                                                    <?php endif;?>
                                                <?php endforeach;?> 
                                                <option value="">-Seleccione-</option>
                                            </select>                               
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="exampleInputservicio">Servicios*</label>
                                    <select name="idTipoServicio" id="idTipoServicio" class="form-control input-sm" disabled="true">
                                        <option value="">--Seleccione un Servicio--</option>
                                        <?php foreach ($servicios as $serv): ?>
                                            <?php if($serv['nombre_servicio'] == $row['nombre_servicio']):?>
                                                <option value="<?php echo $serv['id_servicio']; ?>" selected="selected"><?php echo $serv['nombre_servicio']; ?></option>
                                            <?php endif;?>
                                            <?php if($serv['nombre_servicio'] != $row['nombre_servicio']):?>
                                                <option value="<?php echo $serv['id_servicio']; ?>"><?php echo $serv['nombre_servicio']; ?></option>
                                            <?php endif;?>    
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>                
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="exampleInputproceso">Procesos*</label>
                                    <select name="id_procesos" id="id_procesos" class="form-control input-sm" disabled="true">
                                        <option value="">--Seleccione un Proceso--</option>
                                        <?php foreach ($procesos as $proc): ?>
                                            <?php if($proc['proceso'] == $row['proceso']):?>
                                                <option value="<?php echo $proc['id']; ?>" selected="selected"><?php echo $proc['proceso']; ?></option>
                                            <?php endif;?> 
                                            <?php if($proc['proceso'] != $row['proceso']):?>
                                                <option value="<?php echo $proc['id']; ?>" ><?php echo $proc['proceso']; ?></option>
                                            <?php endif;?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-sm-1 col-md-offset-1">
                                <div class="form-group">
                                    <label>Vigencia</label>
                                    <input type="number" class="form-control input-sm"  name="vigencia" id="vigencia" min="1" value="<?php echo $row['vigencia']; ?>" disabled="true">
                                </div>
                            </div>  
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Período</label>
                                    <div class="form-inline"> 
                                        <?php if($row['periodo'] == 'd'):?>
                                            <input type="radio" name="periodo" id="periodo" value="d" checked="true" disabled="true"> Días
                                            <input type="radio" name="periodo" id="periodo" value="m" disabled="true"> Meses
                                            <input type="radio" name="periodo" id="periodo" value="y" disabled="true"> Años
                                        <?php endif;?>
                                        <?php if($row['periodo'] == 'm'):?>
                                            <input type="radio" name="periodo" id="periodo" value="d" disabled="true"> Días
                                            <input type="radio" name="periodo" id="periodo" value="m" checked="true" disabled="true"> Meses
                                            <input type="radio" name="periodo" id="periodo" value="y" disabled="true"> Años
                                        <?php endif;?>
                                        <?php if($row['periodo'] == 'y'):?>
                                            <input type="radio" name="periodo" id="periodo" value="d" disabled="true"> Días
                                            <input type="radio" name="periodo" id="periodo" value="m" disabled="true"> Meses
                                            <input type="radio" name="periodo" id="periodo" value="y" checked="true" disabled="true"> Años
                                        <?php endif;?>                                                             
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="exampleInputfexpira">Fecha Expira</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control input-sm datepicker" id="fecha_expira" name="fecha_expira" placeholder="" value="<?php echo $row['fecha_expira']; ?>" disabled="true"/>
                                    </div>
                                </div>
                            </div>
                        </div>    

                        <div class="row">
                            <div class="col-md-9 col-md-offset-1">
                                <div class="form-group">
                                    <label for="exampleInputdocumento">Documento*</label>                      
                                    <div class="container-fluid">
                                        <input type="file" name="userfile" id="userfile" accept=".pdf" disabled="true">
                                    </div>               
                                </div>
                            </div>   
                        </div>
                    </div>    
                    <div class="row" id="logistica">
                        <div class="col-sm-3 col-md-offset-1">
                            <div class="form-group">
                                <label for="exampleInputdocumento">Ficha cliente*</label>
                                <select name="id_ficha" id="id_ficha" multiple class="form-control input-sm selectpicker" data-selected-text-format="count" data-live-search="true" required="true"   data-actions-box="true" >
                                    <!--  usar el optgroup si se quisiera separar los clientes por grupos-->
                                    <!--  <optgroup label="Clientes">--> 
                                        <?php foreach ($fichas as $f_client): ?>
                                    <option value="<?php echo $f_client['id_ficha'] ?>"><?php echo $f_client['cliente_nombre_apellidos'] ?></option>
                                        <?php endforeach; ?>
                                    <!--  </optgroup>   -->
                                </select>
                            </div>
                        </div>                
                    </div>
                    <div class="row" id="juridico_obs">
                        <div class="col-md-9 col-md-offset-1">
                            <div class="form-group">
                                <label for="exampleInputobservaciones">Observaciones</label>
                                <textarea style="resize: none" class="form-control" rows="3" name="observaciones" id="observaciones" placeholder="Observaciones" disabled="true"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="row">           
                        <div class="col-md-10">
                            <div class="pull-right">
                                <button type="reset" class="btn btn-default  btn-sm" >Cancelar</button>
                                <input type="submit" class="btn btn-primary  btn-sm" value="Aceptar">
                            </div>
                        </div>         
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif;?>    
<?php endforeach;?>
