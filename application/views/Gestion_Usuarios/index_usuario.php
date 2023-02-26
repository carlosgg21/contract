<div class="container">
    <div class="row">
        <div class="col-md-12">   
            <h4>Listado de Usuarios del sistema</h4>
            <hr>
            <div class="panel-body">
                <a style="margin-left: 15px" class="btn btn-primary nuevo " data-toggle="modal" href="#myModal" title="Nuevo" ><i class="fa fa-plus-square-o"></i>  Nuevo</a>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Exportar<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li> <a href="<?php echo base_url('usuario/exportar_pdf/'); ?>" target="_blank"> <i class="fa fa-file-pdf-o">  Exportar a PDF</i></a></li>
                        <li> <a href="<?php echo base_url('usuario/exportar_excel'); ?>" target="_blank"> <i class="fa fa-file-excel-o">  Exportar a Excel</i></a></li>
                    </ul>
                </div>
                <br>  <br>
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

                <table id="example" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th style="width: 20%"> Nombre y apellidos </th>
                            <th width="200" > Área </th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th width="150" style="text-align: center">Acciones</th>                   
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        
                        foreach ($usuarios_sistema as $value): ?>
                            <tr>                                          
                                <td><?php echo $value['nombre_apellidos'] ?></td> 
                                <td><?php echo $value['nombre_area'] ?></td>  
                                <td><?php echo $value['usuario'] ?></td>                    
                                <td>
                                    <?php
                                    $valores = explode('_', $value['nombre_rol']);
                                    echo $valores[0]
                                    ?>
                                </td>                 
                                <td><?php echo $value['correo'] ?></td>     
                              
                                <?php if ($value['estado_permiso'] == 1 || $value['estado_permiso'] == 2): ?>
                                    <td><span class="label label-success">Activo</span></td>

                                    <td > 
                                        <a class="btn btn-default btn-sm" data-toggle="modal" href="#myModal<?php echo $value['id_usuario']; ?>"  title="Modificar permisos del usuario"  ><i class="fa fa-pencil-square-o"></i> </a>&nbsp &nbsp
                                        <a class="btn btn-success btn-sm" data-toggle="tooltip"  title="Cancelar permisos del usuario" href="<?php echo base_url('usuario/cancelar_permisos/' . $value['id_usuario']); ?>" onclick="return confirm('¿Desea cancelar al usuario del sistema?');"><i class="fa fa-check"></i> </a>&nbsp &nbsp
                                        <a class="btn btn-danger btn-sm" data-toggle="tooltip"  title="Eliminar usuario del sistema" href="<?php echo base_url('usuario/delete/' . $value['id_usuario']); ?>" onclick="return confirm('¿Desea cancelar al usuario del sistema?');"><i class="fa fa-trash-o"></i> </a>
                                    </td>
                                <?php endif; ?>
                                <?php if ($value['estado_permiso'] == 0): ?>
                                    <td><span class="label label-warning">Inactivo</span></td>
                                    <td > 
                                        <a class="btn btn-default btn-sm" data-toggle="modal" href="#myModal<?php echo $value['id_usuario']; ?>"  title="Modificar permisos del usuario"  ><i class="fa fa-pencil-square-o"></i> </a>&nbsp &nbsp
                                        <a class="btn btn-warning btn-sm" data-toggle="tooltip"  title="Activar permisos del usuario" href="<?php echo base_url('usuario/activar_permisos/' . $value['id_usuario']); ?>" onclick="return confirm('¿Desea activar al usuario del sistema?');"><i class="fa fa-mail-reply"></i> </a>&nbsp &nbsp
                                        <a class="btn btn-danger btn-sm" data-toggle="tooltip"  title="Eliminar usuario del sistema" href="<?php echo base_url('usuario/delete/' . $value['id_usuario']); ?>" onclick="return confirm('¿Desea cancelar al usuario del sistema?');"><i class="fa fa-trash-o"></i> </a>
                                    </td>
                                <?php endif; ?>
        <!--                    <td> 
                                <div align="center">
                                    <a class="btn btn-primary btn-sm" data-toggle="modal" href="#myModal<?php echo $value['id_usuario']; ?>"  title="Modificar rol"  ><i class="fa fa-pencil-square-o"></i></a>&nbsp &nbsp 
                                    <a class="btn btn-danger btn-sm"  data-toggle="tooltip" title="Eliminar"  href="<?php echo base_url() . "moneda/delete/" . $value['id_usuario']; ?>" onclick="return confirm('¿Desea cancelar al usuario del sistema?');"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>-->
                            </tr>


                            <!-- Modal Modificar rrol del usuario -->
                        <div class="modal fade" id="myModal<?php echo $value['id_usuario']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="width: 30%" >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Modificar rol del usuario en el sistema</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php $attributes = array('role' => 'form');
                                        echo form_open('usuario/change_rol', $attributes);
                                        ?>
                                        <div class="form-group">
                                            <label for="siglas">Rol actual</label>
                                            <p class="form-control-static"><?php echo $valores[0] ?></p>
                                            <input type="text"  class="form-control hide" name="id_usuario" value="<?php echo $value['id_usuario']; ?> " >
                                        </div>
                                        <div class="form-group">
                                            <label for="siglas">Roles</label>
                                            <select name="rol" id="rol" class="form-control input-sm" required="TRUE">
                                                <option value="">Seleccione un rol</option>

                                                <?php foreach ($roles as $row): ?>
                                                    <?php // if ($dtos['sector'] != $value['nombre']): ?>
                                                    <?php
                                                    $valores = explode('_', $row['nombre_rol']);
//                             echo $valores[0]
                                                    ?>
                                                    <?php if ($row['id_roles'] != $value['id_roles']): ?>
                                                        <option value="<?php echo $row['id_roles']; ?>"><?php echo $valores[0]; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <p class


                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary ">Aceptar</button>               
                                </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>


<!-- Modal Nuevo Usuario del sistema -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 30%" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Nuevo</h4>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id' => 'nusuario', 'role' => 'form');
                echo form_open('usuario/add', $attributes);
                ?>


                <div class="form-group">
                    <label for="idUsuario">Usuarios*</label>
                    <!--<input type="text" class="form-control" id="modalidad" name="modalidad" placeholder="Modalidad" required="true">-->
                    <select name="idUsuario" id="idUsuario" class="form-control input-sm" required="TRUE">
                        <option value="">Seleccione un usuario</option>
                        <?php foreach ($usuarios as $value): ?>
                            <option value="<?php echo $value['id_usuario']; ?>"><?php echo $value['nombre_apellidos']; ?></option>

                        <?php endforeach; ?>
                    </select>

                </div>
                <!--usuarios-->
                <div class="form-group">
                    <label for="idRol">Rol*</label>
                    <!--<input type="text" class="form-control" id="modalidad" name="modalidad" placeholder="Modalidad" required="true">-->


                    <select name="idRol" id="idRol" class="form-control input-sm" required="TRUE">
                        <option value="">Seleccione un rol</option>

                        <?php foreach ($roles as $value): ?>
                            <?php // if ($dtos['sector'] != $value['nombre']): ?>
                            <?php
                            $valores = explode('_', $value['nombre_rol']);
//                             echo $valores[0]
                            ?>

                            <option value="<?php echo $value['id_roles']; ?>"><?php echo $valores[0]; ?></option>

                            <?php endforeach; ?>
                    </select>
                </div>



            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary ">Aceptar</button>
                </form>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



