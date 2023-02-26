
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
        <li class="active">Contratos sin adjuntos</li>
    </ol>
    <div class="row">
        <a><h3><small></small>Contratos sin Adjuntos</h3></a>            
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
                                    
                    <td> <a class="btn btn-primary btn-sm" data-toggle="modal" href="#myModal<?php echo $row['id_contrato']; ?>"  title="Adjuntar documento"  ><i class="fa fa-paperclip"></i> </a></td>
                   
                    
<!--                     Modal Modificar -->
                        <div class="modal fade" id="myModal<?php echo $row['id_contrato']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="width: 30%" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Adjuntar documento</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $attributes = array('id' => 'mod_tipo', 'role' => 'form');
                                        echo form_open_multipart('reportes/adjuntar_documento', $attributes);
                                        ?>                                        
                                        <input type="text" class="form-control hide" id="id" name="id" value="<?php echo $row['id_contrato']; ?> ">
                                        <div class="form-group">
                                            <label for="exampleInputdocumento">Documento*</label>                      
                                            <div class="container-fluid">
                                                <input type="file" name="userfile" id="userfile" accept=".pdf" required="true">
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