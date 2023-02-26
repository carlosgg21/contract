<div class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('contrato')?>"><span class="fa fa-file-text-o"></span> Contratos firmados por año</a></li>
        <li class="active">Suplementos por contratos</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-body" style="background-color: #DC901E">
            <?php $attributes = array('id' => 'fcontrato', 'role' => 'form', 'class' => "form-inline");
            echo form_open_multipart('reportes/mostrar_contratos_suplementos/', $attributes);
            ?>

            <select style="width: 30%" class="form-control input-sm" name="no_contrato" required="true">
                <option value="">Seleccione un contrato</option>
                <?php foreach ($contratos as $row): ?>
                    <option value="<?php echo $row['no_contrato']; ?>"><?php echo $row['no_contrato']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Buscar</button>
            </form>
        </div>
    </div>
            <?php if ($ctrtos == true):?> 
        
            <?php if (count($contratos_suplementos) < 1): ?>
                <hr>
                <?php echo 'El contrato no tiene suplementos'; ?>
            <?php endif; ?>
        
            <?php if (is_array($contratos_suplementos) && count($contratos_suplementos) > 0): ?>
                <div class="page-header">
                    <h2>Suplementos del contrato: <small><?php echo $seleccionado; ?></small></h2>
                </div>

                <table id="example" class="table table-hover">
                    <thead>
                        <tr>
                            <th>No. contrato</th>
                            <th>No. suplemento</th>
                            <th>Fecha firma</th>
                            <th>Empresa</th>
                            <th>Servicio</th>
                            <th>Fecha expira</th>
                            <th>Documento escaneado</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contratos_suplementos as $row): ?>
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
                                    <td  align="center"><a  title="documento escaneado" target="__BLANK" href="<?php echo base_url('documents/contratos') . "/" . $row['documento'] ?>"><img src="<?php echo base_url('assets/imagenes/pdfs.png') ?>" width="40" height="40"></a></td>
                                <?php endif; ?>
                                <?php if ($row['documento'] == NULL): ?>
                                    <td></td>
                                <?php endif; ?>
                                <td><?php echo $row['observaciones']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>        
            <?php endif;?>
        <?php endif;?> 
</div> 
