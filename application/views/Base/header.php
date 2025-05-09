<!doctype html>
<html lang="en" dir="ltr">
   <head>
      <!-- META DATA -->
      <meta charset="UTF-8">
      <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- FAVICON -->
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>public/images/empresa/favicon.ico" />
      <!-- TITLE -->
      <title>Encomiendas Campos</title>
      <!-- BOOTSTRAP CSS -->
      <link id="style" href="<?php echo base_url(); ?>public/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
      <!-- STYLE CSS -->
	   <link href="<?php echo base_url(); ?>public/css/select2.min.css" rel="stylesheet">
      
      <link href="<?php echo base_url(); ?>public/css/style.css" rel="stylesheet" />
      <link href="<?php echo base_url(); ?>public/css/dark-style.css" rel="stylesheet" />
      <link href="<?php echo base_url(); ?>public/css/transparent-style.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>public/css/skin-modes.css" rel="stylesheet" />
      <!--- FONT-ICONS CSS -->
      <link href="<?php echo base_url(); ?>public/css/icons.css" rel="stylesheet" />
      <!-- COLOR SKIN CSS -->
      <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>public/css/color1.css" />

      <!-- DATE-PICKER-->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/plugins/date-picker/jquery.timepicker.css" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/plugins/date-picker/bootstrap-datepicker.css" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/plugins/date-picker/site.css" />
      

      <!-- Toastr -->
	   <link href="<?php echo base_url(); ?>public/css/toastr.min.css" rel="stylesheet">


      <!-- JQUERY JS -->
      <script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
      
   </head>
   <body class="app sidebar-mini ltr light-mode">
      <!-- global-loader -->
      <div id="global-loader">
         <!-- <img src="<?php echo base_url(); ?>public/images/loader.svg" class="loader-img" alt="Loader"> -->
         <!-- <img src="<?php echo base_url(); ?>public/images/loader.png" class="loader-img" alt="Loader"> -->
      </div>
      <!-- /global-loader -->
      <!-- page -->
      <div class="page">
      <div class="page-main">
      <!-- app-Header -->
      <div class="app-header header sticky">
         <div class="container-fluid main-container">
            <div class="d-flex">
               <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
               <!-- sidebar-toggle-->
               <a class="logo-horizontal " href="<?= base_url(); ?>">
                  <!-- <img src="<?php echo base_url(); ?>public/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo"> -->
                  <img src="<?php echo base_url(); ?>public/images/empresa/logo-3.png" class="header-brand-img light-logo1"alt="logo">
               </a>
               <!-- LOGO -->
               <!-- <div class="main-header-center ms-3 d-none d-lg-block">
                  <input class="form-control" placeholder="Search for results..." type="search">
                  <button class="btn px-0 pt-2"><i class="fe fe-search" aria-hidden="true"></i></button>
               </div> -->
               <div class="d-flex order-lg-2 ms-auto header-right-icons">
                  <div class="dropdown d-none">
                     <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                     <i class="fe fe-search"></i>
                     </a>
                     <div class="dropdown-menu header-search dropdown-menu-start">
                        <div class="input-group w-100 p-2">
                           <input type="text" class="form-control" placeholder="Search....">
                           <div class="input-group-text btn btn-primary">
                              <i class="fe fe-search" aria-hidden="true"></i>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- SEARCH -->
                  <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                  </button>
                  <div class="navbar navbar-collapse responsive-navbar p-0">
                     <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">
                            <div class="dropdown  d-flex">
                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                <span class="light-layout"><i class="fe fe-sun"></i></span>
                                </a>
                            </div>
                           <!-- Theme-Layout -->
                            <div class="dropdown d-flex">
                                <a class="nav-link icon full-screen-link nav-link-bg">
                                <i class="fe fe-minimize fullscreen-button"></i>
                                </a>
                            </div>
                           <!-- full-screen -->
                           <!--    <div class="dropdown  d-flex notifications">
                                 <a class="nav-link icon" data-bs-toggle="dropdown"><i
                                    class="fe fe-bell"></i><span class=" pulse"></span>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading border-bottom">
                                       <div class="d-flex">
                                          <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications
                                          </h6>
                                       </div>
                                    </div>
                                    <div class="notifications-menu">
                                       <a class="dropdown-item d-flex" href="notify-list.html">
                                          <div
                                             class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                             <i class="fe fe-mail"></i>
                                          </div>
                                          <div class="mt-1">
                                             <h5 class="notification-label mb-1">New Application received
                                             </h5>
                                             <span class="notification-subtext">3 days ago</span>
                                          </div>
                                       </a>
                                       <a class="dropdown-item d-flex" href="notify-list.html">
                                          <div
                                             class="me-3 notifyimg  bg-secondary brround box-shadow-secondary">
                                             <i class="fe fe-check-circle"></i>
                                          </div>
                                          <div class="mt-1">
                                             <h5 class="notification-label mb-1">Project has been
                                                approved
                                             </h5>
                                             <span class="notification-subtext">2 hours ago</span>
                                          </div>
                                       </a>
                                       <a class="dropdown-item d-flex" href="notify-list.html">
                                          <div
                                             class="me-3 notifyimg  bg-success brround box-shadow-success">
                                             <i class="fe fe-shopping-cart"></i>
                                          </div>
                                          <div class="mt-1">
                                             <h5 class="notification-label mb-1">Your Product Delivered
                                             </h5>
                                             <span class="notification-subtext">30 min ago</span>
                                          </div>
                                       </a>
                                       <a class="dropdown-item d-flex" href="notify-list.html">
                                          <div class="me-3 notifyimg bg-pink brround box-shadow-pink">
                                             <i class="fe fe-user-plus"></i>
                                          </div>
                                          <div class="mt-1">
                                             <h5 class="notification-label mb-1">Friend Requests</h5>
                                             <span class="notification-subtext">1 day ago</span>
                                          </div>
                                       </a>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="notify-list.html"
                                       class="dropdown-item text-center p-3 text-muted">View all
                                    Notification</a>
                                 </div>
                              </div> -->
                           <!-- notifications -->
                           <!-- <div class="dropdown d-flex header-settings">
                              <a href="javascript:void(0);" class="nav-link icon"
                                 data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                                 <i class="fe fe-align-right"></i>
                              </a>
                           </div> -->
                           <!-- side-menu -->
                           <div class="dropdown d-flex profile-1">
                              <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                              <img src="<?php echo base_url(); ?>public/images/empresa/logo_circle.jpg" alt="profile-user"
                                 class="avatar  profile-user brround cover-image">
                              </a>
                              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                 <div class="drop-heading">
                                    <div class="text-center">
                                       <h5 class="text-dark mb-0 fs-14 fw-semibold"><?php echo $this->session->userdata('empleado_h'); ?></h5>
                                       <small class="text-muted"><?php echo $this->session->userdata('usuario_h'); ?></small>
                                    </div>
                                 </div>
                                 <div class="dropdown-divider m-0"></div>
                                 <a class="dropdown-item" href="<?php echo base_url(); ?>Usuarios/cerrar_sesion">
                                    <i class="dropdown-icon fe fe-alert-circle"></i> Salir
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /app-Header -->
      <!--app-sidebar-->
      <div class="sticky">
         <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
         <div class="app-sidebar">
            <div class="side-header">
               <a class="header-brand1" href="<?= base_url(); ?>">
               <img src="<?php echo base_url(); ?>public/images/empresa/logo.png" class="header-brand-img desktop-logo" alt="logo">
               <img src="<?php echo base_url(); ?>public/images/empresa/logo-1.png" class="header-brand-img toggle-logo" alt="logo">
               <img src="<?php echo base_url(); ?>public/images/empresa/logo_empresa.png" class="header-brand-img light-logo" alt="logo">
               <img src="<?php echo base_url(); ?>public/images/empresa/logo-3.png" class="header-brand-img light-logo1" alt="logo">
               </a>
               <!-- LOGO -->
            </div>
            <div class="main-sidemenu">
               <div class="slide-left disabled" id="slide-left">
                  <svg xmlns="http://www.w3.org/2000/svg"
                     fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                     <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                  </svg>
               </div>
               <ul class="side-menu">
                  <li class="sub-category">
                     <h3>General</h3>
                  </li>


                  <li class="slide">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i  class="side-menu__icon fe fe-user-check"></i><span
                        class="side-menu__label">Clientes</span><i class="angle fe fe-chevron-right"></i></a>
                     <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)"></a></li>
                        <li><a href="<?= base_url(); ?>Clientes/" class="slide-item">Lista de clientes</a></li>
                        <li><a href="<?= base_url(); ?>Clientes/agregar_cliente/" class="slide-item">Agregar cliente</a></li>
                     </ul>
                  </li>

                  <li class="slide">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i  class="side-menu__icon fe fe-file"></i><span
                        class="side-menu__label">Ordenes</span><i class="angle fe fe-chevron-right"></i></a>
                     <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)"></a></li>
                        <li><a href="<?= base_url(); ?>Ordenes/agregar_orden" class="slide-item">Nueva orden</a></li>
                        <li><a href="<?= base_url(); ?>Ordenes/" class="slide-item">Lista de ordenes</a></li>
                     </ul>
                  </li>

                  <li class="slide">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i  class="side-menu__icon fe fe-file-plus"></i><span
                        class="side-menu__label">Envios</span><i class="angle fe fe-chevron-right"></i></a>
                     <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)"></a></li>
                        <li><a href="<?= base_url(); ?>Envios/" class="slide-item">Crear envio</a></li>
                        <li><a href="<?= base_url(); ?>Envios/lista_envios" class="slide-item">Lista de envios</a></li>
                     </ul>
                  </li>

                  <li class="slide">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i  class="side-menu__icon fe fe-file-plus"></i><span
                        class="side-menu__label">Entrega de paquetes</span><i class="angle fe fe-chevron-right"></i></a>
                     <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)"></a></li>
                        <li><a href="<?= base_url(); ?>Entregas/" class="slide-item">Entregas</a></li>
                        <li><a href="<?= base_url(); ?>Entregas/lista_paquetes" class="slide-item">Paquetes</a></li>
                        <li><a href="<?= base_url(); ?>Entregas/busqueda_paquete" class="slide-item">Busqueda paquetes</a></li>
                     </ul>
                  </li>

                  <li class="slide">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i  class="side-menu__icon fe fe-users"></i><span
                        class="side-menu__label">Empleados</span><i class="angle fe fe-chevron-right"></i></a>
                     <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)"></a></li>
                        <li class="slide-item"> <a href="<?php echo base_url(); ?>Empleado/">Agregar empleado</a> </li>
                        <li class="slide-item"> <a href="<?php echo base_url(); ?>Empleado/lista_empleados">Lista empleados</a> </li>
                        <li class="slide-item"> <a href="<?php echo base_url(); ?>Empleado/cargos_empleados">Cargos</a> </li>
                     </ul>
                  </li>

                  <li class="slide">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i  class="side-menu__icon fe fe-file"></i><span
                        class="side-menu__label">Gastos</span><i class="angle fe fe-chevron-right"></i></a>
                     <ul class="slide-menu">
                        <li class="slide-item"> <a href="<?php echo base_url(); ?>Gastos/">Cuentas</a> </li>
                        <li class="slide-item"> <a href="<?php echo base_url(); ?>Gastos/control_gastos">Control de gastos</a> </li>
                     </ul>
                  </li>

                  <li class="slide">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i  class="side-menu__icon fe fe-file"></i><span
                        class="side-menu__label">Reportes</span><i class="angle fe fe-chevron-right"></i></a>
                     <ul class="slide-menu">
                        <li class="slide-item"> <a href="<?php echo base_url(); ?>Reportes/lista_clientes">Clientes</a> </li>
                        <li class="slide-item"> <a href="<?php echo base_url(); ?>Reportes/ordenes_por_fecha">Ordenes por fecha</a> </li>
                        <li class="slide-item"> <a href="<?php echo base_url(); ?>Reportes/ordenes_por_ruta">Ordenes por rutas</a> </li>
                     </ul>
                  </li>


                  <li class="slide">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i  class="side-menu__icon fa fa-cog"></i><span
                        class="side-menu__label">Configuración</span><i class="angle fe fe-chevron-right"></i></a>
                     <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)"></a></li>
                        <li class="slide-item"><a href="<?php echo base_url(); ?>Accesos/">Accesos</a></li>
                        <li class="slide-item"><a href="<?php echo base_url(); ?>Usuarios/gestion_usuarios">Usuarios</a></li>
                        <li class="slide-item"><a href="<?php echo base_url(); ?>Permisos/">Permisos</a></li>
	                     <li class="slide-item"><a href="<?php echo base_url(); ?>Herramientas/movimientos_hojas">Movimientos hoja</a></li>
                     </ul>
                  </li>
                  
                  <li class="slide">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i  class="side-menu__icon fa fa-building-o"></i><span
                        class="side-menu__label">Empresa</span><i class="angle fe fe-chevron-right"></i></a>
                     <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)"></a></li>
                        <li class="slide-item"><a href="<?php echo base_url(); ?>Empresa/">Información</a></li>
                     </ul>
                  </li>

            <!--
                  <li>
                     <a class="side-menu__item" href="<?= base_url(); ?>Empleados/lista_empleados/">
                        <i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Empleados</span>
                     </a>
                  </li>
                  <li class="slide">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i  class="side-menu__icon fe fe-user-check"></i><span
                        class="side-menu__label">Permisos</span><i class="angle fe fe-chevron-right"></i></a>
                     <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)"></a></li>
                        <li><a href="<?= base_url(); ?>Permisos/lista_permisos/1/" class="slide-item">Administración</a></li>
                        <li><a href="<?= base_url(); ?>Permisos/lista_permisos/2/" class="slide-item">Cajeras</a></li>
                        <li><a href="<?= base_url(); ?>Permisos/lista_permisos/3/" class="slide-item">ISBM</a></li>
                        <li><a href="<?= base_url(); ?>Permisos/lista_permisos/4/" class="slide-item">Enfermeria</a></li>
                        <li><a href="<?= base_url(); ?>Permisos/lista_permisos/5/" class="slide-item">Hemodiálisis</a></li>
                        <li><a href="<?= base_url(); ?>Permisos/lista_permisos/6/" class="slide-item">Laboratorio Clínico</a></li>
                        <li><a href="<?= base_url(); ?>Permisos/lista_permisos/7/" class="slide-item">Rayos X</a></li>
                        <li><a href="<?= base_url(); ?>Permisos/lista_permisos/8/" class="slide-item">Botiquín</a></li>
                        <li><a href="<?= base_url(); ?>Permisos/lista_permisos/9/" class="slide-item">Limpieza</a></li>
                        <li><a href="<?= base_url(); ?>Permisos/lista_permisos/10/" class="slide-item">Mantenimiento</a></li>
                        <li><a href="<?= base_url(); ?>Permisos/lista_permisos/11/" class="slide-item">Vigilante</a></li>
                     </ul>
                  </li>
                  <li class="slide">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-file-text"></i><span
                        class="side-menu__label">Incapacidades</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                     <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)"></a></li>
                        <li><a href="<?= base_url(); ?>Incapacidades/lista_incapacidades/1/" class="slide-item">Administración</a></li>
                        <li><a href="<?= base_url(); ?>Incapacidades/lista_incapacidades/2/" class="slide-item">Cajeras</a></li>
                        <li><a href="<?= base_url(); ?>Incapacidades/lista_incapacidades/3/" class="slide-item">ISBM</a></li>
                        <li><a href="<?= base_url(); ?>Incapacidades/lista_incapacidades/4/" class="slide-item">Enfermeria</a></li>
                        <li><a href="<?= base_url(); ?>Incapacidades/lista_incapacidades/5/" class="slide-item">Hemodiálisis</a></li>
                        <li><a href="<?= base_url(); ?>Incapacidades/lista_incapacidades/6/" class="slide-item">Laboratorio Clínico</a></li>
                        <li><a href="<?= base_url(); ?>Incapacidades/lista_incapacidades/7/" class="slide-item">Rayos X</a></li>
                        <li><a href="<?= base_url(); ?>Incapacidades/lista_incapacidades/8/" class="slide-item">Botiquín</a></li>
                        <li><a href="<?= base_url(); ?>Incapacidades/lista_incapacidades/9/" class="slide-item">Limpieza</a></li>
                        <li><a href="<?= base_url(); ?>Incapacidades/lista_incapacidades/10/" class="slide-item">Mantenimiento</a></li>
                        <li><a href="<?= base_url(); ?>Incapacidades/lista_incapacidades/11/" class="slide-item">Vigilante</a></li>
                     </ul>
                  </li>

                  <li class="slide">
                     <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-file"></i><span
                        class="side-menu__label">Acción de personal</span><i class="angle fe fe-chevron-right"></i>
                    </a>
                     <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)"></a></li>
                        <li><a href="<?= base_url(); ?>Acciones/lista_acciones/1/" class="slide-item">Administración</a></li>
                        <li><a href="<?= base_url(); ?>Acciones/lista_acciones/2/" class="slide-item">Cajeras</a></li>
                        <li><a href="<?= base_url(); ?>Acciones/lista_acciones/3/" class="slide-item">ISBM</a></li>
                        <li><a href="<?= base_url(); ?>Acciones/lista_acciones/4/" class="slide-item">Enfermeria</a></li>
                        <li><a href="<?= base_url(); ?>Acciones/lista_acciones/5/" class="slide-item">Hemodiálisis</a></li>
                        <li><a href="<?= base_url(); ?>Acciones/lista_acciones/6/" class="slide-item">Laboratorio Clínico</a></li>
                        <li><a href="<?= base_url(); ?>Acciones/lista_acciones/7/" class="slide-item">Rayos X</a></li>
                        <li><a href="<?= base_url(); ?>Acciones/lista_acciones/8/" class="slide-item">Botiquín</a></li>
                        <li><a href="<?= base_url(); ?>Acciones/lista_acciones/9/" class="slide-item">Limpieza</a></li>
                        <li><a href="<?= base_url(); ?>Acciones/lista_acciones/10/" class="slide-item">Mantenimiento</a></li>
                        <li><a href="<?= base_url(); ?>Acciones/lista_acciones/11/" class="slide-item">Vigilante</a></li>
                     </ul>
                  </li>
                  
                  <li>
                     <a class="side-menu__item" href="<?= base_url(); ?>Calendario/">
                        <i class="side-menu__icon fe fe-calendar"></i><span class="side-menu__label">Vacaciones</span>
                     </a>
                  </li>-->

               </ul>
               <div class="slide-right" id="slide-right">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                     width="24" height="24" viewBox="0 0 24 24">
                     <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                  </svg>
               </div>
            </div>
         </div>
         <!--/APP-SIDEBAR-->
      </div>
      <!--app-sidebar-->
