

<div  class="container-fluid">

    <!-- Page Heading -->
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('contrato'); ?>"><i class="fa fa-file-text-o"></i> Listado de contratos</a></li>

        <li class="active">Inicio</li>
    </ol>
    <!-- /.row -->

    <!--                <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
                            </div>
                        </div>
                    </div>-->
    <!-- /.row -->

    <div class="row">      
<!--        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-trello fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><h1>Contratos</h1></div>
                            <div>New Orders!</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">                    
                    <div><p class="text-primary">Cantidad de Contratos Vigentes<strong> <?php echo $datos['cant_vigentes'];?></strong> </p> </div>
                    <div><p class="text-danger">Cantidad de Contratos Caducos<strong> <?php echo $datos['cant_caducos'];?></strong> </p> </div>
                    <div><?php echo 0 ?> Cantidad de vistas</div>
                </div>
            </div>
        </div>-->
<!--        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-code-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><h1>Reportes</h1></div>
                            <div>New Orders!</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <div><?php echo 0 ?> Cantidad de controladores</div>
                    <div><?php echo 0 ?> Cantidad de modelos</div>
                    <div><?php echo 0?> Cantidad de vistas</div>
                </div>

            </div>
        </div>-->
        
<!--        lianet-->
    


    <div class="col-md-4 box effect1">           
            <div class="page-header">
                <a style="text-decoration: none"><h2>Sistema Registro de Contratos</h2></a>
            </div>
            <div>
                <p><strong>Cantidad vigentes:</strong> <?php echo $datos['cant_vigentes'];?></p>
                <p><strong>Cantidad caducos:</strong> <?php echo $datos['cant_caducos'];?></p>
                
                <br>
            </div>
        </div>        
    </div>

    <!--                                <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i>  <strong>Versión 1.0</strong> | 01  de Febrero 2018 <a href="http://www.bancoi.cu" class="alert-link">Banco de Inversiones S.A</a> 
                            </div>
                        </div>
                    </div>-->



</div>
<!-- /.container-fluid -->



