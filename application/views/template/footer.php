<!-- Main Footer -->
<!--<footer>
  
     Default to the left 
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
</footer>-->

<hr>
<footer class="container-fluid" style="margin-top: 2.5rem">
    <p class="pull-right">Sistema Registro de Contratos v2.1 &copy; <a href="http://intranet" target="_blank">Banco de Inversiones S.A <?php echo date('Y'); ?></a> </p>
</footer>

</div>


<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url() ?>assets/jquery.js"></script>
<script src="<?php echo base_url('assets/bootstrap/js/jquery.js') ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/datatable/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/datatable/js/dataTables.bootstrap.min.js"></script>
<!-- DataPicker -->
<script src="<?php echo base_url() ?>assets/datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/datepicker/locales/bootstrap-datepicker.es.min.js"></script>

<!-- Funciones js-->
<script src="<?php echo base_url() ?>assets/js/funciones.js"></script>
<script src="<?php echo base_url() ?>assets/js/contratos.js"></script>
<!--Select mMltiples-->
<script type="text/javascript" src="<?php echo base_url('assets/dist-select/js/bootstrap-select.min.js') ?>"></script>
<!--tableexport-->
<script type="text/javascript" src="<?php echo base_url('assets/tableexport/js-xlsx/xlsx.core.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/tableexport/file-save/FileSaver.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/tableexport/js/tableexport.js') ?>"></script>

<!-- easy-pie-chart -->
<script type="text/javascript" src="<?php echo base_url('assets/easy-pie-chart/easypiechart.js') ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/morris/raphael-min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/morris/morris.js') ?>"></script>
<!--Js utiles par alos controladores-->
<?php if (isset($js)) : ?>
    <script src="<?php echo base_url() ?>assets/js/<?php echo $js; ?>"></script>
<?php endif ?>

<script>
    window.setTimeout(function() {
        $("#warning-alert").fadeTo(100, 0).slideUp(100, function() {
            $(this).remove();
        });
    }, 900);
    window.setTimeout(function() {
        $("#success-alert").fadeTo(100, 0).slideUp(100, function() {
            $(this).remove();
        });
    }, 900);
    window.setTimeout(function() {
        $("#ms_modificar").fadeTo(100, 0).slideUp(100, function() {
            $(this).remove();
        });
    }, 900);
    window.setTimeout(function() {
        $("#ms_insertar").fadeTo(100, 0).slideUp(100, function() {
            $(this).remove();
        });
    }, 900);
    window.setTimeout(function() {
        $("#ms_eliminar").fadeTo(100, 0).slideUp(100, function() {
            $(this).remove();
        });
    }, 900);
</script>
<script>
    $(document).ready(function() {

        $('#example').dataTable({
            "dom": '<"top"f>rt<"bottom"ip><"clear">',
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Ãšltimo",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            orientation: "top ",
            autoclose: true

        });


    });
</script>

<!--    <script>
        $(document).ready(function(){
            $("#tipo_empresa").change(function () {
                $("#tipo_empresa option:selected").each(function () {                
                    //elegido=$(this).val(); 
                    elegido=$(tipo_empresa).val();                     
                    $.post("Contrato/muestra_empresas", { elegido: elegido }, function(data){   
                        $("#empresa").html(data);
                    });			
                });
           });
        });        
    </script>   -->


</body>

</html>