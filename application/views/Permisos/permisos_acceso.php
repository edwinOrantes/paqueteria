<?php if($this->session->flashdata("exito")):?>
  <script type="text/javascript">
    $(document).ready(function(){
      toastr.remove();
      toastr.options.positionClass = "toast-top-center";
      toastr.success('<?php echo $this->session->flashdata("exito")?>', 'Aviso!');
    });
  </script>
<?php endif; ?>

<?php if($this->session->flashdata("error")):?>
  <script type="text/javascript">
    $(document).ready(function(){
      toastr.remove();
      toastr.options.positionClass = "toast-top-center";
      toastr.error('<?php echo $this->session->flashdata("error")?>', 'Aviso!');
    });
  </script>
<?php endif; ?>
<!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- page-header -->
                    <div class="page-header">
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Permisos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Gestión de permisos de usuario</li>
                            </ol>
                        </div>
						<a href="#agregarAcceso" data-bs-toggle="modal" class="btn btn-primary btn-sm validarTamanio"><i class="fa fa-plus"></i> Agregar permiso</a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-dark">Listado de permisos para el acceso <?php echo $nombreAcceso->nombreAcceso; ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <?php
                                        if(sizeof($permisos) > 0){
                                    ?>
                                    <table class="table table-bordered text-nowrap border-bottom basic-datatable" id="">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="border-bottom-0 text-white text-center" scope="col">#</th>
                                                <th class="border-bottom-0 text-white text-center" scope="col">Acceso</th>
                                                <th class="border-bottom-0 text-white text-center" scope="col">Estado</th>
                                                <th class="border-bottom-0 text-white text-center" scope="col">Opción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $index = 0;
                                                foreach ($permisos as $permiso) {
                                                    $index++;
                                                    $id ='"'.$permiso->idPermiso.'"';
                                                    $nombre ='"'.$permiso->nombreMenu.'"';
                                            ?>
												<tr>
                                                    <td scope="row"><?php echo $index; ?></td>
                                                    <td><?php echo $permiso->nombreMenu; ?></td>
                                                    <td>
                                                        <?php
                                                            if($permiso->estadoPermiso == 0){
                                                                echo '<span class="badge badge-outline-danger">Inactivo</span>';
                                                            }else{
                                                                echo '<span class="badge badge-outline-primary">Activo</span>';
                                                            }    
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                        if($permiso->estadoPermiso == 0){
                                                            echo "<a href='#agregarPermiso' onclick='agregarPermiso($id)' data-bs-toggle='modal'><i class='fa fa-plus-square iconoPlus text-primary'></i></a>";
                                                        }else{
                                                            echo "<a href='#quitarPermiso' onclick='quitarPermiso($id)' data-bs-toggle='modal'><i class='fa fa-trash iconoPlus text-danger'></i></a>";
                                                        }
                                                        
                                                        
                                                    ?>
                                                    </td>
                                                </tr>
                                            <?php  }  ?>
                                            
                                        </tbody>
                                    </table>
                                    
                                    <?php
                                        }else{
                                            echo '<div class="alert-danger p-3 text-center">No hay datos que mostrar</div>';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row closed -->
            </div>
            <!-- container closed -->
        </div>
    </div>
<!--app-content closed-->


<!-- Modales -->
    <div class="modal fade" id="agregarAcceso" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos del empleado</h5>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Permisos/guardar_permisos" novalidate>
                        <div class="modal-body">   
                            
                        <div class="table-responsive mt-3">
                                        <table id="tblPermisos" class="table table-bordered text-nowrap border-bottom basic-datatable">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th class="border-bottom-0 text-white text-center" scope="col">#</th>
                                                    <th class="border-bottom-0 text-white text-center" scope="col">Menu</th>
                                                    <th class="border-bottom-0 text-white text-center" scope="col">Agregar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <div>
                                                    <?php
                                                        $index = 0;
                                                            foreach ($menus as $menu) {
                                                                // Recorriendo permisos ya agregados
                                                                $flag = 0;
                                                                foreach ($permisos as $permiso) {
                                                                    if($menu->idMenu == $permiso->idMenu){
                                                                        $flag++;
                                                                    }
                                                                }
                                                                
                                                                if($flag == 0){
                                                                    $index++;
                                                        ?>
                                                                    <tr class="fila_permiso">
                                                                        <td class="text-center" scope="row"><?php echo $index; ?></td>
                                                                        <td class="text-center"><?php echo $menu->nombreMenu; ?></td>
                                                                        <td class="text-center">
                                                                            <label class="ms-switch">
                                                                                <input type="checkbox" name="idPermisos[]" value="<?php echo $menu->idMenu; ?>">
                                                                                <span class="ms-switch-slider ms-switch-primary round"></span>
                                                                            </label>
                                                                        </td>
                                                                    </tr>

                                                    <?php 
                                                            }
                                                        }	
                                                    ?>
                                                </div>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <input type="hidden" value="<?php echo $acceso; ?>" name="idAcceso">

                        </div>
                        <div class="modal-footer">
                            <div class="text-center mt-5">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar acceso</button>
                                <a class="btn btn-light"  data-bs-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Cancelar</a>
                            </div>
                        </div>   
                    </form>
            </div>
        </div>
    </div>
    
    <div class="modal  fade" id="agregarPermiso" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Permisos/activar_permiso" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </a>
                    </div>
                    <div class="modal-body">
                        <p class="h5">¿Estas seguro de activar nuevamente este permiso para este usuario?</p>
					    <input type="hidden" class="form-control" id="idPermisoA" name="idPermiso">
                        <input type="hidden" value="<?php echo $acceso; ?>" name="idAcceso">
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-bs-dismiss="modal">Cancelar</a>
                        <button class="btn btn-primary ">Activar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal  fade" id="quitarPermiso" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Permisos/eliminar_permiso" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </a>
                    </div>
                    <div class="modal-body">
                        <p class="h5">¿Estas seguro de quitar este permiso para este usuario?</p>
					    <input type="hidden" class="form-control" id="idPermisoE" name="idPermiso">
                        <input type="hidden" value="<?php echo $acceso; ?>" name="idAcceso">
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-bs-dismiss="modal">Cancelar</a>
                        <button class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Modales -->


<script>
    function quitarPermiso(id){
		$("#idPermisoE").val(id);
	}

    function agregarPermiso(id){
		$("#idPermisoA").val(id);
	}

</script>

<script>
    $(document).ready(function() {
        var mFilas = $("#tblPermisos .fila_permiso").length;
        if(mFilas == 0){
            $("#contenedorPermisos").hide();
            $("#contenedorNull").show();
        }else{
            $("#contenedorPermisos").show(); 
            $("#contenedorNull").hide();
        }
    });
</script>