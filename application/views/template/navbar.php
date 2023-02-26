<?php if (in_array(49, $this->session->userdata('id_rol'))): ?>
    <?php echo '<script>alert("Sistema en fase de prueba");</script>';  ?>
<?php endif;?>
<?php if (in_array(47, $this->session->userdata('id_rol')) || (in_array(48, $this->session->userdata('id_rol'))) || (in_array(93, $this->session->userdata('id_rol'))) || (in_array(129, $this->session->userdata('id_rol')))): ?>
<nav  class="navbar navbar-fixed-top navbar-default" role="navigation">

    <a  class="navbar-brand" href="<?php echo base_url();?>">
        <img style="max-width:160px; margin-top: -18px;"
                 src="<?php echo base_url() ?>/assets/imagenes/logo.png ">

         
                <!--Sistema de registro de contratos-->
    </a>
  <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">  
        <ul class="nav navbar-nav navbar-right">
            <li><a title="Contratos de proveedores"href="<?php echo base_url();?>"><i class="fa fa-home"></i> Inicio</a></li>
            <?php if (in_array(47, $this->session->userdata('id_rol')) || (in_array(48, $this->session->userdata('id_rol'))) || (in_array(93, $this->session->userdata('id_rol'))) || (in_array(129, $this->session->userdata('id_rol')))): ?>
                <li><a title="Contratos de proveedores"href="<?php echo base_url('contrato');?>"><i class="fa fa-file-text-o"></i> Contratos vigentes</a></li>
            <?php endif;?>
            <!--     Catndiad de contactos que caducan este mes-->
        
            <!--     Reportes-->
            
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file"></i> Reportes <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('reportes/caducos');?>"><i class="fa fa-list"></i> Contratos Caducos </a></li>
                        <li><a href="<?php echo base_url('reportes/cancelados');?>"><i class="fa fa-check-square-o"></i> Contratos Cancelados </a></li>
                        <li><a href="<?php echo base_url('/reportes/por_empresa')?>"><i class="fa fa-file-text-o"></i> Contratos por Empresa</a></li>
                        <!--<li><a href="<?php echo base_url('reportes/contratos_ffirma')?>"><i class="fa fa-calendar"></i> Contratos por Fecha Firma</a></li>-->
                        <li><a href="<?php echo base_url('reportes/por_servicio')?>"><i class="fa fa-file-text"></i> Contratos por Servicios</a></li>
                        <li><a href="<?php echo base_url('reportes/sin_adjunto')?>"><i class="fa fa-file-pdf-o"></i> Contratos sin adjuntos</a></li>
                        <li><a href="<?php echo base_url('reportes/contratos_vigentes_sin_ficha')?>"><i class="fa fa-list"></i> Contratos vigentes sin ficha de clientes</a></li>
                        <li><a href="<?php echo base_url('reportes/contratos_ficha_desactualizadas')?>"><i class="fa fa-list"></i> Contratos con ficha de cliente desactualizada</a></li>
                        <li><a href="<?php echo base_url('reportes/por_proceso')?>"><i class="fa fa-list"></i> Contratos vigentes por proceso</a></li>
                        <li><a href="<?php echo base_url('reportes/caducan')?>"><i class="fa fa-calendar-check-o"></i> Contratos caducan el próximo mes</a></li>
                        <li><a href="<?php echo base_url('reportes/por_anno')?>"><i class="fa fa-calendar-check-o"></i> Contratos firmados por año</a></li>
                        <li><a href="<?php echo base_url('reportes/contratos_suplementos')?>"><i class="fa fa-calendar-check-o"></i>Suplementos por contratos</a></li>
                    </ul>
                </li>
            
                
            <!--     Clasificadores-->            
                <li class="dropdown">
                     <!-- <?php if (in_array(47, $this->session->userdata('id_rol')) || (in_array(48, $this->session->userdata('id_rol'))) || (in_array(93, $this->session->userdata('id_rol')))): ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-table"></i> Clasificadores <b class="caret"></b></a>
                     <?php endif;?>   -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-table"></i> Clasificadores <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php if (in_array(47, $this->session->userdata('id_rol')) || (in_array(48, $this->session->userdata('id_rol')))): ?>
                            <li><a href="<?php echo base_url('clasificador/empresa');?>"><i class="fa fa-list-alt"></i> Empresas</a></li>
                            <li><a href="<?php echo  base_url('clasificador/servicio');?>"><i class="fa fa-list-alt"></i> Servicios</a></li>
                            <li><a href="<?php echo  base_url('clasificador/proceso');?>"><i class="fa fa-list-alt"></i> Procesos</a></li>
                            <li><a href="<?php echo  base_url('clasificador/ficha_clientes');?>"><i class="fa fa-list-alt"></i> Ficha de clientes</a></li>
                        <?php endif;?>
                        <!-- <?php if (in_array(47, $this->session->userdata('id_rol'))): ?>        
                            <li><a href="<?php echo  base_url('clasificador/bitacora');?>"><i class="fa fa-list-alt"></i> Bitacora</a></li>
                        <?php endif;?>    -->
                        <li><a href="<?php echo  base_url('clasificador/bitacora');?>"><i class="fa fa-list-alt"></i> Bitacora</a></li> 
                    </ul>
                </li>
                <?php if(in_array(47, $this->session->userdata('id_rol')) || in_array(48, $this->session->userdata('id_rol'))):?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Gestionar Usuarios<b class="caret"></b></a>
                        <ul class="dropdown-menu">                   
                            <li><a href="<?php echo base_url('Usuario')?>"><i class="fa fa-list-alt"></i> Usuarios</a></li>
                            <li><a href="<?php echo base_url('Roles')?>"><i class="fa fa-list-alt"></i> Roles</a></li>                        
                        </ul>
                    </li>
                <?php endif;?>    
            
<!--            <li><a href="<?php echo base_url('update_bd');?>"><i class="fa fa-list-alt"></i> UPdateBD</a></li>-->
                        
                    
        <!--<li class="active"><a style="margin-right: 3%"href="<?php echo "contrato_caduco";?>"><i class="fa fa-user"></i> Usuario: <?php echo $usuario;?> </a></li> //--> 
        <?php $cant = $this->utilidades->contratos_caducos()?> 
        <li><a style="background-color: tomato"  href="<?php echo base_url('reportes/caducan_pmes');?>" title="Contratos que cadurán próximamente"><i class="fa fa-bell-o"></i> <strong><?php echo $cant;?></strong></a></li>
        
        <li  class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-user-circle-o"></span> Usuario: <?php echo $this->session->userdata('usuario');?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li style="margin-left: -1%"><a target="__BLANK" href="<?php echo base_url('contrato/logout'); ?>"><i class="fa fa-sign-out"></i> Salir</a></li>
                    <li style="margin-left: -1%"><a target="__BLANK" href="<?php echo base_url('assets/ayuda/reg_contratos.pdf'); ?>"><i class="fa fa-question-circle"></i> Ayuda</a></li>
                </ul>
        </li>
        
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
<?php endif;?>