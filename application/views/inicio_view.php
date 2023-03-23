<div class="container-fluid">

    <!-- PANEL RESUMEN  -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-2">
            <div class="box  box-yelow text-center">
                <h1 class="font-light">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <?php echo $result['provedores']['cantEnterpriseWithContract'] ?>
                </h1>

                <p style="font-size: large;text-transform: uppercase;">
                    Provedores
                </p>
            </div>

        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-2">
            <div class="box box-blue text-center">
                <h1 class="font-light text-white">
                    <i class="fa fa-clone" aria-hidden="true"></i>
                    <?php echo $result['servicios']['cantServiceWithContract'] ?>
                </h1>

                <p style="font-size: large;text-transform: uppercase;">
                    Servicios
                </p>
            </div>

        </div>
        <div class="col-md-6 col-lg-3 col-xlg-2">
            <div class="box  box-yelow text-center">
                <h1 class="font-light">
                    <i class="fa fa-file-text-o" aria-hidden=" true"></i>
                    <?php echo $result['cantContratos'] ?>
                </h1>
                <p style="font-size: large;text-transform: uppercase;">
                    Contratos Vigentes
                </p>

            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-2">
            <div class="box box-blue text-center">
                <h1 class="font-light text-white">
                    <i class="fa fa-cubes" aria-hidden="true"></i>
                    <?php echo $result['procesos']['cantProcesWithContract'] ?>
                </h1>

                <p style="font-size: large;text-transform: uppercase;">
                    Procesos
                </p>
            </div>
        </div>
    </div>
    <!-- END PANEL RESUMEN -->

    <!--  CONTRATOS POR AÑO -->
    <div style="margin-top: 2%;" class="row">
        <div class="col-md-6 col-lg-6 col-xlg-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    <h4 class="card-title">CONTRATOS POR AÑOS</h4>
                    <div id="morris-bar-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xlg-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    <h1 style="color:#193962; font-weight: bold;">2023</h1>
                    <div class="row">
                        <div style="margin-left:3%;margin-right: 1%;" class="col-md-6 col-lg-6 col-xlg-2 box box-contractblue">
                            <h1>
                                <i class="fa fa-pencil-square-o"></i> <?php echo $result['actualInfo']['firmados'] ?>


                            </h1>
                            <h2 class="text-right">

                                Nuevos contratos firmados

                            </h2>
                        </div>

                        <div style="margin-left:3%;margin-right: 1%;" class="col-md-6 col-lg-5 col-xlg-2 box box-contractyelow">
                            <h1>
                                <i class="fa fa-calendar-times-o"></i> <?php echo $result['actualInfo']['expiran'] ?>


                            </h1>
                            <h2 class="text-right">

                                Contratos que<br> vencen

                            </h2>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END  CONTRATOS POR AÑO -->


    <!-- CONTRATOS POR TIPO DE PERSONA -->
    <div style="margin-top: 2%; margin-left: 1px; margin-right: 1px;" class="row box box-yelow">
        <div class="col-md-6 col-lg-4 col-xlg-2 text-center">
            <h2>
                <?php echo $result['tipoPersona']['typeEe'] ?> <small>Empresa Estatal</small>

            </h2>
            <div class="chart chart1 canvas" data-percent="<?php echo $result['tipoPersona']['eePercentage'] ?> "><?php echo $result['tipoPersona']['eePercentage'] ?> %</div>
        </div>
        <div class="col-md-6 col-lg-4 col-xlg-2 text-center">
            <h2>
                <?php echo $result['tipoPersona']['typeEnE'] ?> <small>Empresa NO Estatal</small>
            </h2>
            <div class="chart chart2 canvas" data-percent="<?php echo $result['tipoPersona']['enePercentage'] ?>"><?php echo $result['tipoPersona']['enePercentage'] ?>%</div>
        </div>
        <div class="col-md-6 col-lg-4 col-xlg-2">
            <h2>
                <?php echo $result['tipoPersona']['typeTcp'] ?> <small>Trabajador por Cuenta Propia (TCP)</small>
            </h2>
            <div class="chart chart3 canvas" data-percent="<?php echo $result['tipoPersona']['tcpPercentage'] ?>"><?php echo $result['tipoPersona']['tcpPercentage'] ?>%</div>
        </div>


    </div>

    <!-- END CONTRATOS POR TIPO DE PERSONA -->

    <!-- TABLA MÁS CONTRATOS POR PROCESOS Y SERVICIO -->
    <!-- <div style="margin-top: 2%;" class="row">
        <div class="col-md-6 col-lg-6 col-xlg-2">
            <div class="panel panel-primary">
                <div class="panel-heading">PROCESOS CON MÁS CONTRATOS</div>
                <div class="panel-body">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>PROCESO</th>
                                <th class=" text-center">CANTIDAD DE CONTRATOS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result['procesos']['getFiveMost'] as  $value) : ?>
                                <tr>
                                    <td><?php echo $value['proceso'] ?></td>
                                    <td class=" text-center"><?php echo $value['cant_contratos'] ?></td>

                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->

        <!-- <div class="col-md-6 col-lg-6 col-xlg-2">
            <div class="panel panel-primary">
                <div class="panel-heading">SERVICIOS CON MÁS CONTRATOS</div>
                <div class="panel-body">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>SERVICIO</th>
                                <th class=" text-center">CANTIDAD DE CONTRATOS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result['servicios']['getFiveMost'] as  $value) : ?>
                                <tr>
                                    <td><?php echo $value['nombre_servicio'] ?></td>
                                    <td class=" text-center"><?php echo $value['cant_contratos'] ?></td>

                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->
    </div>

    <!-- END MÁS CONTRATOS POR PROCESOS Y SERVICIO -->





</div>
<!-- /.container-fluid -->