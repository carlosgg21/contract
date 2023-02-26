

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
        <li class="active">Contratos cancelados</li>
    </ol>
    
    <div class="row"> 
        <a><h3><small></small> Contratos Cancelados</h3></a>        
        <hr>
    </div>

   
    <!--<a data-toggle="modal" href="#myModal" class="btn btn-primary "><i class="fa fa-plus-square-o"></i> Nuevo Contrato</a>-->

  <!--<input type="text" class="form-control" name="ffirma" id="datepicker3" value = "<?php echo date('Y-m-d') ?>">-->
    <table id="example" class="table table-striped" >
        <thead>
            <tr>
                <th>No. contrato</th>
                <th>No. suplemento</th>
                <th>Fecha firma</th>
                <th>Empresa</th>
                <th>Servicio</th>
                <th>Documento escaneado</th>
                <th>Fecha expira</th>


            </tr>
        </thead>
         <tbody>
              <?php foreach ($datos as $row):?>
		<tr>
                        <td><?php echo $row['no_contrato'];?></td>
			<td><?php echo $row['no_suplemento'];?></td>
                        <td><?php echo $row['fecha_firma'];?></td>
			<td><?php echo $row['nombre_empresa'];?></td>
                        <td><?php echo $row['nombre_servicio'];?></td>
		
			
                        <?php if($row['documento']!=NULL):?>
                        <td  align="center"><a  title="documento escaneado" target="__BLANK" href="<?php echo base_url('documents/contratos')."/".$row['documento']?>"><img src="<?php echo base_url('assets/imagenes/pdfs.png')?>" width="40" height="40"></a></td>
                        <?php endif;?>
                        <?php if($row['documento']==NULL):?>
                        <td></td>
                        <?php endif;?>
                       <td><?php echo $row['fecha_expira'];?></td>
                       
		</tr>
	<?php endforeach;?>
          </tbody>
    </table>


</div>










