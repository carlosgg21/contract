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
        <li><a href="<?php echo base_url('contrato')?>"><span class="fa fa-file-text-o"></span> Listado Contratos Sin Ficha Cliente</a></li>
        <li class="active">Contratos sin Ficha Cliente</li>
    </ol>
    <div class="row">
        <a><h3><small></small>Contratos sin Ficha Cliente</h3></a>            
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
<!--                    <td> <a class="btn btn-primary btn-sm" data-toggle="modal" href="#myModal<?php echo $row['id_contrato']; ?>"  title="Actualizar ficha Cliente"  ><i class="fa fa-paperclip"></i> </a></td>-->
                    <td><a class="btn btn-primary btn-sm" href="./contratos_ficha_actualizar/<?php echo $row['id_contrato']; ?>"  title="Actualizar ficha Cliente"  ><i class="fa fa-paperclip"></i> </a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>