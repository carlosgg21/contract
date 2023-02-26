

<div class="container-fluid">
<ol class="breadcrumb">
    <li><a href="<?php echo base_url('contrato')?>"><span class="fa fa-file-text-o"></span> Listado Contratos Vigentes</a></li>
    <li class="active">Contratos por empresa</li>
</ol>
    <div class="panel panel-default">

        <div class="panel-body" style="background-color: #DC901E">
            <?php $attributes = array('id' => 'fcontrato', 'role' => 'form', 'class' => "form-inline");
            echo form_open_multipart('reportes/por_empresa', $attributes);
            ?>

            <select style="width: 30%" class="form-control input-sm" name="empresa" required="true">
                <option value="">Seleccione una empresa</option>
                <?php foreach ($empresas as $row): ?>
                    <option value="<?php echo $row['id_empresa']; ?>"><?php echo $row['nombre_empresa']; ?></option>
<?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Buscar</button>
            </form>
        </div>
    </div>




<?php if ($contratos == 0): ?>
        <hr>
        <h3>No hay datos</h3>
    <?php endif; ?>
<?php if (is_array($contratos) && count($contratos) > 0): ?>
        <div class="page-header">
            <h2>Contrato(s) con la empresa <small><?php echo $contratos[0]['nombre_empresa']; ?></small></h2>
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
    <?php foreach ($contratos as $row): ?>
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
                        <td> <?php echo $row['observaciones']; ?></td>
                    </tr>
    <?php endforeach; ?>
            </tbody>
        </table>

<?php endif; ?>


</div>










