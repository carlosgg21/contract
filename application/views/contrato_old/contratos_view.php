<div class="container-fluid">


    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><span class="fa fa-home"></span> Inicio</a></li>
        <!--<li><a href="<?php echo base_url('contrato') ?>"><span class="fa fa-file-text-o"></span> Listado Contratos Vigentes-->
        <li class="active"> Listado Contratos</li>
    </ol>
    <div class="toolbar">
        <div class="row">
            <!-- <a href="<?php echo base_url('contrato/nuevo'); ?>" class="btn btn-primary " style="margin-left: 15px"><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a> -->
            <!-- <a href="<?php echo base_url('contrato/exportar_pdf/'); ?>" target="_blank" class="btn btn-primary" style="margin-left: 800px"><i class="fa fa-file-pdf-o"> Exportar a PDF</i></a> -->



            <div style="margin-left: 15px" class="btn-group">
                <a href="<?php echo base_url('contrato/nuevo'); ?>" type="button" class="btn btn-primary"><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a>
                <button type="button" class="btn btn-default" id="btnFilter" title="Filtros">
                    <i class="fa fa-filter">
                        <?php if (!empty($estadoFiltro)) : ?>
                            <span class="text-danger" style="font-size: small; ">
                                <strong> <sup><?php echo count(array_filter($request)) ?></sup></strong>
                            </span>
                    </i>
                <?php else : ?>
                    <span style="font-size: small; "><strong><sup> 0 </sup></strong></span>
                    </i>
                <?php endif; ?>
                </button>
                <a href="<?php echo base_url('contrato/exportar_pdf/'); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-file-pdf-o"> </i> Exportar a PDF</a>

                <!-- <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        Reportes
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Dropdown link</a></li>
                        <li><a href="#">Dropdown link</a></li>
                    </ul>
                </div> -->
            </div>
        </div>

    </div>
    <!--<a data-toggle="modal" href="#myModal" class="btn btn-primary "><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a>-->
    <!--<input type="text" class="form-control" name="ffirma" id="datepicker3" value = "<?php echo date('Y-m-d') ?>">-->

    <?php if (!empty($estadoFiltro)) : ?>
        <div class="well divFilter" style="margin-top: 6%;">
        <?php else : ?>
            <div class="well divFilter" style="display: none; margin-top: 6%;">
            <?php endif; ?>

            <?php
            $attributes = array('id' => 'formFiltral;', 'role' => 'form');
            echo form_open_multipart('contrato/index');
            ?>

            <div class="row">
                <div class="col-md-3">
                    <label for="exampleInputEmail1">Fecha Firma</label>
                    <input class="form-control input-sm" type="date" name="fecha_firma" value="<?php echo !empty($request['fecha_firma']) && $request['fecha_firma']  ? $request['fecha_firma'] : ''; ?>">

                </div>
                <div class=" col-md-3">
                    <label for="exampleInputEmail1">Fecha Vencimiento</label>
                    <input class="form-control input-sm" type="date" name="fecha_vence" value="<?php echo !empty($request['fecha_vence']) && $request['fecha_vence']  ? $request['fecha_vence'] : ''; ?>">

                </div>
                <div class="col-md-3">
                    <label for="exampleInputEmail1">Servicios</label>
                    <select class="form-control input-sm" name="servicio">
                        <option value="">--Seleccione un Servicio--</option>
                        <?php foreach ($serviciosFiltro as $serv) : ?>
                            <?php if (!empty($request['servicio']) && $request['servicio'] == $serv['idTipoServicio']) : ?>
                                <option value="<?php echo $serv['idTipoServicio']; ?>" selected="selected"><?php echo $serv['nombre_servicio']; ?></option>
                            <?php else : ?>
                                <option value="<?php echo $serv['idTipoServicio']; ?>"><?php echo $serv['nombre_servicio']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="col-md-3">
                    <label for="exampleInputEmail1">Provedores</label>
                    <select class="form-control input-sm" name="provedor">
                        <option value="">--Seleccione un Provedor--</option>
                        <?php foreach ($provedoresFiltro as $prov) : ?>
                            <?php if (!empty($request['provedor']) && $request['provedor'] == $prov['idEmpresa']) : ?>
                                <option value="<?php echo $prov['idEmpresa']; ?>" selected="selected"><?php echo $prov['nombre_empresa']; ?></option>
                            <?php else : ?>
                                <option value="<?php echo $prov['idEmpresa']; ?>"><?php echo $prov['nombre_empresa']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </select>

                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="exampleInputEmail1">Procesos</label>
                    <select class="form-control input-sm" name="proceso" id="inputProceso">
                        <option value="">--Seleccione un Proceso--</option>
                        <?php foreach ($procesosFiltro as $proc) : ?>
                            <?php if (!empty($request['proceso']) && $request['proceso'] == $proc['id_procesos']) : ?>
                                <option value="<?php echo $proc['id_procesos']; ?>" selected="selected"><?php echo $proc['proceso']; ?></option>
                            <?php else : ?>
                                <option value="<?php echo $proc['id_procesos']; ?>"><?php echo $proc['proceso']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="col-md-3">
                    <label for="exampleInputEmail1">Año firma</label>

                    <select class="form-control input-sm" name="year_firma">
                        <option value="">--Seleccione un Año--</option>
                        <?php foreach ($yearsFiltro as $year) : ?>
                            <?php if (!empty($request['year_firma']) && $request['year_firma'] == $year['year_firma']) : ?>
                                <option value="<?php echo $year['year_firma']; ?>" selected="selected"><?php echo $year['year_firma']; ?></option>
                            <?php else : ?>
                                <option value="<?php echo $year['year_firma']; ?>"><?php echo $year['year_firma']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">


                </div>
                <!-- <div class="col-md-3">

            </div> -->
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="checkbox">
                        <!-- <label for="">Mostrar contratos</label> -->
                        <label>
                            <input type="checkbox" value="1" name="todos_contratos" <?php echo !empty($request['todos_contratos']) && $request['todos_contratos']  ? 'checked' : ''; ?>>
                            Muestra todos los contratos del sistema
                        </label>
                        <p class="help-block">No se agrupan los contratos, los suplementos se mostran en el listado</p>
                    </div>

                </div>
                <!-- <div class="col-md-3">

            </div> -->
            </div><br>


            <div style=" display: block; margin-left: 40%; margin-right: 40%;">

                <button type="submit" class="btn btn-primary btn-sm  ">Filtrar</button>
                <button type="reset" id="btnReset" class="btn btn-default btn-sm">Limpiar</button>

            </div>
            </form>

            </div>
            <table style="font-size: small;" id="example" class="table table-striped exptable">
                <thead>
                    <tr>
                        <th></th>
                        <th>No. contrato</th>
                        <th>Cantidad de suplementos</th>
                        <!-- <td></td> -->
                        <th>Año firma</th>
                        <th>Empresa</th>
                        <th>Servicio</th>
                        <th>Año expira</th>
                        <th>Documento escaneado</th>

                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <!--                <th></th>-->

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $x => $row) : ?>
                        <tr>
                            <td><?php
                                echo $x + 1;

                                ?>
                            </td>
                            <td><?php echo $row['no_contrato']; ?></td>
                            <!-- <td><?php echo $row['no_suplemento']; ?></td> -->
                            <td class="text-center">


                                <?php if (array_key_exists($row['no_contrato'], $registroNo)) : ?>
                                    <?php $cantSup = count($registroNo[$row['no_contrato']]) ?>
                                    <?php if ($cantSup == 1) : ?> <!--si nomero de sumpleto es nullo  -->
                                        -
                                    <?php else : ?>
                                        <?php if (!$row['no_suplemento']) : ?>
                                            <span class='label label-info'>
                                                <!-- cantidad de suplementos que tiene un contrato  -->
                                                <a style="color: white;" href="<?php echo "contrato/suplementos/" . $row['id_contrato']; ?>" target="_blank"> <?php echo $cantSup;  ?></a>
                                            </span>
                                        <?php else : ?>
                                            <?php echo 'Suplemento o Contrato especifíco No: <br> ' . $row['no_suplemento']; ?>
                                        <?php endif; ?>

                                        <!-- <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#demo<?php echo $x ?>">
                                    simple collapsible
                                </button> -->
                                    <?php endif; ?>
                                <?php endif; ?>



                            </td>

                            <td title="<?php echo $row['fecha_firma']; ?>"><?php echo $row['year_firma']; ?></td>
                            <td><?php echo $row['nombre_empresa']; ?></td>
                            <td><?php echo $row['nombre_servicio']; ?></td>
                            <?php if ($row['fecha_expira'] == "0000-00-00") : ?>
                                <td></td>
                            <?php endif; ?>
                            <?php if ($row['fecha_expira'] != "0000-00-00") : ?>
                                <td title="<?php echo $row['fecha_expira']; ?><"><?php echo $row['year_expira']; ?></td>
                            <?php endif; ?>


                            <td>documento</td>



                            <td> <a class="btn btn-primary btn-sm" data-toggle="" href="<?php echo "contrato/modificar_contrato/" . $row['id_contrato']; ?>" title="Modificar Contrato"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td> <a class="btn btn-success btn-sm" data-toggle="" href="<?php echo "contrato/suplementar_contrato/" . $row['id_contrato']; ?>" title="Suplementos"><span class="fa fa-bookmark-o"></span></a></td>
                            <td><a class="btn btn-info btn-sm" data-toggle="modal" href="#ficha<?php echo $row['id_contrato']; ?>" title="Ver ficha cliente"><span class="fa fa-user-o"></span></a></td>
                            <td><a class="btn btn-danger btn-sm" data-toggle="tooltip" title="Cancelar contrato" href="<?php echo "contrato/cancelar/" . $row['id_contrato']; ?>" onclick="return confirm('Desea cancelar el contrato?');"><i class="fa fa-check"></i> </a></td>

                        </tr>

                        <!-- <div id="demo<?php echo $x ?>" class=" collapse ">
                    dadasd
                </div> -->

                        <!--                mostrar detalles de la ficha cliente-->

                        <!-- Modal detalle solicitud de servicio -->
                        <div class="modal fade" id="ficha<?php echo $row['id_contrato']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="width: 30%">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h5>Ficha cliente del contrato: <?php echo $row['no_contrato']; ?></h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" class="form-control hide" id="laficha" name="laficha" value="<?php echo $row['id_contrato']; ?> ">
                                        <?php $cont = count($laficha);
                                        for ($i = 0; $i < $cont; $i++) : ?>
                                            <?php if (($row['id_contrato']) == ($laficha[$i]['idContrato'])) : ?>
                                                <ul>
                                                    <li><?php echo $laficha[$i]['cliente_nombre_apellidos']; ?></li>
                                                </ul>
                                            <?php endif; ?>
                                        <?php endfor; ?>

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
                            <div class="modal-dialog" style="width: 100%">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Modificar contrato</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">

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
                                                                <input type="text" class="form-control input-sm " name="no_suplemento" id="no_suplemento" placeholder="" value="<?php echo $row['no_suplemento']; ?>" />
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label for="exampleInputffirma">Fecha Firma*</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                    <input type="text" class="form-control input-sm datepicker" id="fecha_firma" name="fecha_firma" placeholder="" value="<?php echo $row['fecha_firma']; ?>" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-3 col-md-offset-1">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="form-group col-lg-6">
                                                                            <label for="tipo_empresa">Tipo de Empresa</label>
                                                                            <select name="tipo_empresa" id="tipo_empresa" class="form-control">
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
                                                                        <?php foreach ($servicios as $serv) : ?>
                                                                            <?php if ($serv['nombre_servicio'] == $row['nombre_servicio']) : ?>
                                                                                <option value="<?php echo $serv['id_servicio']; ?>" selected="selected"><?php echo $serv['nombre_servicio']; ?></option>
                                                                            <?php endif; ?>
                                                                            <?php if ($serv['nombre_servicio'] != $row['nombre_servicio']) : ?>
                                                                                <option value="<?php echo $serv['id_servicio']; ?>"><?php echo $serv['nombre_servicio']; ?></option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputproceso">Procesos*</label>
                                                                    <select name="id_procesos" id="id_procesos" class="form-control input-sm">
                                                                        <option value="">--Seleccione un Proceso--</option>
                                                                        <?php foreach ($procesos as $proc) : ?>
                                                                            <?php if ($proc['proceso'] == $row['proceso']) : ?>
                                                                                <option value="<?php echo $proc['id']; ?>" selected="selected"><?php echo $proc['proceso']; ?></option>
                                                                            <?php endif; ?>
                                                                            <?php if ($proc['proceso'] != $row['proceso']) : ?>
                                                                                <option value="<?php echo $proc['id']; ?>"><?php echo $proc['proceso']; ?></option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-1 col-md-offset-1">
                                                                <div class="form-group">
                                                                    <label>Vigencia</label>
                                                                    <input type="number" class="form-control input-sm" name="vigencia" id="vigencia" min="1" value="<?php echo $row['vigencia']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Período</label>
                                                                    <div class="form-inline">
                                                                        <?php if ($row['periodo'] == 'd'); ?>
                                                                        <input type="radio" name="periodo" id="periodo" value="d" checked="true"> Días
                                                                        <? php; ?>
                                                                        <?php if ($row['periodo'] == 'm'); ?>
                                                                        <input type="radio" name="periodo" id="periodo" value="m" checked="true"> Meses
                                                                        <? php; ?>
                                                                        <?php if ($row['periodo'] == 'y'); ?>
                                                                        <input type="radio" name="periodo" id="periodo" value="y" checked="true"> Años
                                                                        <? php; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="exampleInputfexpira">Fecha Expira</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        <input type="text" class="form-control input-sm datepicker" id="fecha_expira" name="fecha_expira" placeholder="" value="<?php echo $row['fecha_expira']; ?>" />
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
                                                                <select name="id_ficha" id="id_ficha" multiple class="form-control input-sm selectpicker" data-selected-text-format="count" data-live-search="true" required="true" data-actions-box="true">
                                                                    <!--  usar el optgroup si se quisiera separar los clientes por grupos-->
                                                                    <!--  <optgroup label="Clientes">-->
                                                                    <?php foreach ($fichas as $row) : ?>
                                                                        <option value="<?php echo $row['id_ficha'] ?>"><?php echo $row['cliente_nombre_apellidos'] ?></option>
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
                                                                <button type="reset" class="btn btn-default  btn-sm">Cancelar</button>
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