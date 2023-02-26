

<ol class="breadcrumb">
    <li><a href="<?php echo base_url('contrato'); ?>"><i class="fa fa-file-text-o"></i> Listado de contratos</a></li>

    <li class="active">Listado de procesos</li>
</ol>



<table id="procesos" class="table table-striped">
    <thead>
        <tr>
            <th>Proceso</th>
            <th>Jefe de proceso</th>

           
    </thead>
    <tbody>
        <?php foreach ($datos as $row): ?>
            <tr>
                <td><?php echo $row['proceso']; ?></td>         
                <td><?php echo $row['jefe_proceso']; ?></td>         
               

            </tr>
        
<?php endforeach; ?>
</tbody>





</table>



