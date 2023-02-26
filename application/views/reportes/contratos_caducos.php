

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
    <li><a href="<?php echo base_url('contrato')?>"><span class="fa fa-file-text-o"></span> Listado Contratos Vigentes</a></li>
    <li class="active">Contratos caducados</li>
</ol>

<!--
    <div class="toolbar">
        <a  href="<?php echo base_url('index.php/juridico/registro_contrato/nuevo'); ?>" class="btn btn-primary "><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a>
        
    </div>-->
    <!--<a data-toggle="modal" href="#myModal" class="btn btn-primary "><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a>-->

  <!--<input type="text" class="form-control" name="ffirma" id="datepicker3" value = "<?php echo date('Y-m-d') ?>">-->
    <div class="row"> 
        <a><h3><small></small> Contratos Caducos</h3></a>        
        <hr>
    </div>

    <div class="toolbar">
        <div class="row">            
            <a href="<?php echo base_url('reportes/caducos_pdf/'); ?>" target="_blank" class="btn btn-primary" style="margin-left: 15px"><i class="fa fa-file-pdf-o">  Exportar a PDF</i></a>
        </div>
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
                <th>Documento escaneado</th>

                
                <th></th>
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
                    <?php if ($row['documento'] != NULL): ?>
                        <td  align="center"><a title="documento escaneado" target="__BLANK" href="<?php echo base_url('documents/contratos') . "/" . $row['documento'] ?>"><img src="<?php echo base_url('assets/imagenes/pdfs.png') ?>" width="40" height="40"></a></td>
                    <?php endif; ?>
                    <?php if ($row['documento'] == NULL): ?>
                        <td></td>
                    <?php endif; ?>


                    <?php if(in_array("48", $this->session->userdata('id_rol')) || in_array("47", $this->session->userdata('id_rol')) || in_array("93", $this->session->userdata('id_rol'))):?>
                        <td> <a class="btn btn-primary btn-sm" data-toggle="modal" href="#myModal<?php echo $row['id_contrato']; ?>"  title="Modificar contrato"  ><i class="fa fa-pencil-square-o"></i> </a></td>
                        <td><a class="btn btn-danger btn-sm" data-toggle="tooltip"  title="Cancelar contrato" href="<?php echo "registro_contrato/cancelar/" . $row['id_contrato']; ?>" onclick="return confirm('Desea cancelar el contrato?');"><i class="fa fa-check"></i> </a></td>
                    <?php endif; ?>
                    
                    <!-- Modal Modificar -->
                        <div class="modal fade" id="myModal<?php echo $row['id_contrato']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="width: 30%" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Modificar contrato caduco</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $attributes = array('id' => 'mod_tipo', 'role' => 'form');
                                        echo form_open_multipart('reportes/modificar_caduco', $attributes);
                                        ?>                                        
                                        <input type="text" class="form-control hide" id="id_contrato" name="id_contrato" value="<?php echo $row['id_contrato']; ?> ">
                                        <div class="form-group">
                                            <label for="exampleInputfexpira">Fecha Expira</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control input-sm datepicker" id="fecha_expira" name="fecha_expira" placeholder="Año-mes-día" value="<?php echo $row['fecha_expira']; ?>" required="true">
                                            </div>
                                        </div>                                                                               
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Aceptar</button>
                                        </form>
                                    </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->



                </tr>


            <?php endforeach; ?>
        </tbody>
    </table>


</div>










