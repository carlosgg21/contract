

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
      <li><a href="<?php echo base_url()?>"><span class="fa fa-home"></span> Inicio</a></li>
      <!--<li><a href="<?php echo base_url('contrato')?>"><span class="fa fa-file-text-o"></span> Listado Contratos Vigentes-->
    <li class="active"> Listado Contratos</li>
    </ol>
    <div class="toolbar">
<!--        <div class="row">
            <a href="<?php echo base_url('contrato/nuevo'); ?>" class="btn btn-primary " style="margin-left: 15px"><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a>
            <a href="<?php echo base_url('contrato/exportar_pdf/'); ?>" target="_blank" class="btn btn-primary" style="margin-left: 800px"><i class="fa fa-file-pdf-o">  Exportar a PDF</i></a>
        </div>-->
        
        
        

    <div class="btn-group">
        <a href="<?php echo base_url('contrato/nuevo'); ?>" class="btn btn-primary " style="margin-left: 15px"><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a>
        <!--<button type="button" class="btn btn-default">2</button>-->

        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Exportar<span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li> <a href="<?php echo base_url('contrato/exportar_pdf/'); ?>" target="_blank"> <i class="fa fa-file-pdf-o">  Exportar a PDF</i></a></li>
                <li> <a href="<?php echo base_url('contrato/exportar_excel'); ?>" target="_blank"> <i class="fa fa-file-excel-o">  Exportar a Excel</i></a></li>
            </ul>
        </div>
    </div>

    </div>
    <!--<a data-toggle="modal" href="#myModal" class="btn btn-primary "><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a>-->
    <!--<input type="text" class="form-control" name="ffirma" id="datepicker3" value = "<?php echo date('Y-m-d') ?>">-->
    <table id="example" class="table table-striped exptable" >
        <thead>
            <tr>
                <th>No. contrato</th>
                <th>No. suplemento</th>
                <th>Fecha firma</th>
                <th>Empresa</th>
                <th>Servicio</th>
                <th>Fecha expira</th>
                <th>Documento escaneado</th>

                <th></th>
                <th></th>
				<th></th>
                                <th></th>
<!--                <th></th>-->

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
                        
                    <?php if ($row['documento'] != NULL): ?>
<!--                        <td  align="center"><a  title="documento escaneado" target="__BLANK" href="<?php echo base_url('assets/documentos') . "/" . $row['documento'] ?>"><img src="<?php echo base_url('assets/imagenes/pdfs.png') ?>" width="40" height="40"></a></td>-->
                        <td  align="center"><a  title="documento escaneado" target="__BLANK" href="<?php echo base_url('documents/contratos') . "/" . $row['documento']. '.'.'pdf' ?>"><img src="<?php echo base_url('assets/imagenes/pdfs.png') ?>" width="40" height="40"></a></td>
                        
                    <?php endif; ?>
                    <?php if ($row['documento'] == NULL): ?>
                        <td></td>
                    <?php endif; ?>
                        
                    <?php if(in_array("48", $this->session->userdata('id_rol')) || in_array("47", $this->session->userdata('id_rol')) || in_array("93", $this->session->userdata('id_rol'))):?>
                        <td> <a class="btn btn-primary btn-sm" data-toggle="" href="<?php echo "contrato/modificar_contrato/" . $row['id_contrato']; ?>"  title="Modificar Contrato" ><i class="fa fa-pencil-square-o"></i></a></td>
                        <td> <a class="btn btn-success btn-sm" data-toggle="" href="<?php echo "contrato/suplementar_contrato/" . $row['id_contrato']; ?>"  title="Suplementos" ><span class="fa fa-bookmark-o"></span></a></td>                                                                     
                        <td><a class="btn btn-info btn-sm" data-toggle="modal" href="#ficha<?php echo $row['id_contrato']; ?>" title="Ver ficha cliente" ><span class="fa fa-user-o"></span></a></td>
                        <td><a class="btn btn-danger btn-sm" data-toggle="tooltip"  title="Cancelar contrato" href="<?php echo "contrato/cancelar/" . $row['id_contrato']; ?>" onclick="return confirm('Desea cancelar el contrato?');"><i class="fa fa-check"></i> </a></td>
                    <?php endif;?>
                </tr>
                <!--                mostrar detalles de la ficha cliente-->   

                <!-- Modal detalle solicitud de servicio -->
                    <div class="modal fade" id="ficha<?php echo $row['id_contrato']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="width: 30%" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h5>Ficha cliente del contrato: <?php echo $row['no_contrato']; ?></h5>
                                </div>
                                <div class="modal-body">                                                                       
                                    <input type="text" class="form-control hide" id="laficha" name="laficha" value="<?php echo $row['id_contrato']; ?> ">
                                    <?php $cont = count($laficha);                                    
                                          for ($i = 0; $i < $cont; $i++):?>
                                        <?php if(($row['id_contrato']) == ($laficha[$i]['idContrato'])):?>
                                            <ul>
                                                <li><?php echo $laficha[$i]['cliente_nombre_apellidos'];?></li>
                                            </ul>
                                        <?php endif;?>                                           
                                    <?php endfor;?>
                                                                                                                     
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-primary btn-sm" data-dismiss="modal">Salir</button>    
                                    </form>
                                </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal --> 
<!--                fin de mostrar detalles de la ficha cliente-->
                <!-- Modal Modificar -->
                <div class="modal fade" id="myModal<?php echo $row['id_contrato']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width: 100%" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Modificar contrato</h4>
                            </div>
                            <div class="modal-body">                                                                                
                                <div class="container-fluid">
                                    <?php if ($this->session->flashdata('ms_modificar')): ?>
                                        <div id="ms_modificar" class="alert alert-success">
                                            <?php echo $this->session->flashdata('ms_modificar') ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Modificar contrato</h3>
                                        </div>
                                        <div class="panel-body">
                                            <?php
                                            $attributes = array('id' => 'fcontrato', 'role' => 'form');
                                            echo form_open_multipart('contrato/modificar', $attributes);
                                            ?>
                                            <input type="text" class="form-control hide" id="id_contrato" name="id_contrato">
                                            
                                            <div id="juridico">
                                                
                                                <div class="row">                
                                                    <div class="col-sm-3 col-md-offset-1">
                                                        <div class="form-group">
                                                            <label for="exampleInputnocontrato">No. Contrato</label>
                                                            <input type="text" class="form-control input-sm " name="no_contrato" id="no_contrato" placeholder="" autofocus value="<?php echo $row['no_contrato']; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="exampleInputnosuplemento">No. Suplemento</label>
                                                        <input type="text" class="form-control input-sm " name="no_suplemento" id="no_suplemento" placeholder="" value="<?php echo $row['no_suplemento']; ?>"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="exampleInputffirma">Fecha Firma*</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            <input type="text" class="form-control input-sm datepicker" id="fecha_firma" name="fecha_firma" placeholder="" value="<?php echo $row['fecha_firma']; ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-sm-3 col-md-offset-1">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="form-group col-lg-6">
                                                                    <label for="tipo_empresa">Tipo de Empresa</label>
                                                                    <select name="tipo_empresa" id="tipo_empresa" class="form-control" >
                                                                        <option value="">-Seleccione-</option>
                                                                        <option value="1">Empresa Estatal</option>
                                                                        <option value="2">Empresa No Estatal</option>
                                                                        <option value="3">Persona Natural</option>
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
                                                            <select name="idTipoServicio" id="idTipoServicio" class="form-control input-sm">
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
                                                            <select name="id_procesos" id="id_procesos" class="form-control input-sm">
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
                                                            <input type="number" class="form-control input-sm"  name="vigencia" id="vigencia" min="1" value="<?php echo $row['vigencia']; ?>">
                                                        </div>
                                                    </div>  
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Período</label>
                                                            <div class="form-inline"> 
                                                                <?php if($row['periodo'] == 'd');?>
                                                                    <input type="radio" name="periodo" id="periodo" value="d" checked="true"> Días
                                                                <?php ;?>
                                                                <?php if($row['periodo'] == 'm');?>
                                                                    <input type="radio" name="periodo" id="periodo" value="m" checked="true"> Meses
                                                                <?php ;?>
                                                                <?php if($row['periodo'] == 'y');?>
                                                                    <input type="radio" name="periodo" id="periodo" value="y" checked="true"> Años
                                                                <?php ;?>                                                             
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="exampleInputfexpira">Fecha Expira</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                <input type="text" class="form-control input-sm datepicker" id="fecha_expira" name="fecha_expira" placeholder="" value="<?php echo $row['fecha_expira']; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                                
                                                <div class="row">
                                                    <div class="col-md-9 col-md-offset-1">
                                                        <div class="form-group">
                                                            <label for="exampleInputdocumento">Documento*</label>                      
                                                            <div class="container-fluid">
                                                                <input type="file" name="userfile" id="userfile" accept=".pdf">
                                                            </div>               
                                                        </div>
                                                    </div>   
                                                </div>
                                            </div>    
                                            <div class="row" id="logistica">
                                                <div class="col-sm-3 col-md-offset-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputdocumento">Ficha cliente*</label>
                                                        <select name="id_ficha" id="id_ficha"  multiple class="form-control input-sm selectpicker" data-selected-text-format="count" data-live-search="true" required="true"   data-actions-box="true">
                                                            <!--  usar el optgroup si se quisiera separar los clientes por grupos-->
                                                            <!--  <optgroup label="Clientes">--> 
                                                                <?php foreach ($fichas as $row): ?>
                                                                    <option value="<?php echo $row['id_ficha'] ?>" ><?php echo $row['cliente_nombre_apellidos'] ?></option>
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
                                                        <textarea style="resize: none" class="form-control" rows="3" name="observaciones" id="observaciones" placeholder="Observaciones"></textarea>
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
                        </div>                                   
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            <?php endforeach; ?>
        </tbody>
    </table>
</div>










