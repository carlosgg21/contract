

<div class="container-fluid">
   

<ol class="breadcrumb">
    <li><a href="<?php echo base_url('contrato')?>"><span class="fa fa-file-text-o"></span> Listado Contratos Vigentes</a></li>
    <li class="active">Contratos que cadurán próximamente: <strong> <?php echo count($datos)?></strong></li>
</ol>

<!--
    <div class="toolbar">
        <a  href="<?php echo base_url('index.php/juridico/registro_contrato/nuevo'); ?>" class="btn btn-primary "><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a>
        
    </div>-->
    <!--<a data-toggle="modal" href="#myModal" class="btn btn-primary "><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a>-->

  <!--<input type="text" class="form-control" name="ffirma" id="datepicker3" value = "<?php echo date('Y-m-d') ?>">-->
   
    <div class="row">
        <a><h3>Contratos que cadurán próximamente</h3></a>            
        <hr>
    </div>

    <table id="example" class="table table-striped" >
        <thead>
            <tr>
                <th>No. contrato</th>
                <th>No. suplemento</th>
                <th>Fecha firma</th>
                <th>Empresa</th>
                <th>Servicio</th>
                <th>Fecha expira</th>
                <th>Documento escaneado</th>

<!--                <th></th>-->
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


<!--                    <td> <a class="btn btn-info btn-sm" data-toggle="tooltip" title="Detalles contrato" href="<?php echo base_url('index.php/juridico/registro_contrato/detalles/' . $row['id_contrato']); ?>" ><i class="fa fa-search"></i> </a></td>-->
                    <!--<td> <a class="btn btn-primary btn-sm" data-toggle="modal" href="#myModal<?php echo $row['id_contrato']; ?>"  title="Modificar contrato"  ><i class="fa fa-pencil-square-o"></i> </a></td>-->
<!--                    <td><a class="btn btn-primary btn-sm" data-toggle="tooltip"  title="Modificar contrato" href="<?php echo "registro_contrato/mmodificar/" . $row['id_contrato']; ?>"><i class="fa fa-pencil-square-o"></i> </a></td>
                    <td><a class="btn btn-danger btn-sm" data-toggle="tooltip"  title="Cancelar contrato" href="<?php echo "registro_contrato/cancelar/" . $row['id_contrato']; ?>" onclick="return confirm('Desea cancelar el contrato?');"><i class="fa fa-check"></i> </a></td>-->
                    <!--<td><a data-toggle="modal" href="#myModal<?php echo $row['id_contrato']; ?>" class="btn btn-primary "><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a></td>-->




                </tr>


            <?php endforeach; ?>
        </tbody>
    </table>


</div>










