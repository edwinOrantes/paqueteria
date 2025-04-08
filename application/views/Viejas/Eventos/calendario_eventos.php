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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Eventos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detalle eventos</li>
                            </ol>
                        </div>
                        <a href="#modalEvento"id="btnAgregarEvento" data-bs-toggle="modal" class="btn btn-primary"> Agregar evento <i class="fe fe-calendar"></i></a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-dark">Calendario eventos</h3>
                            </div>
                            <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-xl-12">
                                                <div id='eventosCalendar'></div>
                                            </div>
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

<!--modales -->
    <div class="modal fade" id="modalEvento" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Datos del empleado</h5>
                    <button class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
                </div>
                
                <form class="needs-validation" id="form_evento" method="post" action="<?= base_url(); ?>Calendario/agregar_evento" novalidate>
                    <div class="modal-body">
                        <div class="form-row">

                            <div class="col-md-12 mb-3">
                                <label for="tituloEvento">Título</label>
                                <input type="text" class="form-control" id="tituloEvento" name="tituloEvento" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="descripcionEvento">Descripción</label>
                                <textarea id="descripcionEvento" name="descripcionEvento" rows="3" class="form-control"  placeholder="" required></textarea>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="colorEvento">Color</label>
                                <select id="colorEvento" name="colorEvento" class="form-control" required>
                                    <option value="">:.::Seleccionar::.</option>
                                    <option style="color:#197fb0;" value="#197fb0;">&#9724; Azul</option>
                                    <option style="color:#0cb8b6;" value="#0cb8b6">&#9724; Verde</option>
                                    <option style="color:#008000;" value="#008000">&#9724; Green</option>                       
                                    <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                    <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                                    <option style="color:#000;" value="#000">&#9724; Black</option>
                                </select>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="fechaInicio">Fecha inicio</label>
                                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="fechaFin">Fecha fin</label>
                                <input type="date" class="form-control calendario" id="fechaFin" name="fechaFin" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>
                            
                            
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Guardar evento</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEEvento" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Datos del evento</h5>
                    <button class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
                </div>
                
                <form class="needs-validation" id="form_evento_edit" method="post" action="<?= base_url(); ?>Calendario/actualizar_evento" novalidate>
                    <div class="modal-body">
                        <div class="form-row">

                            <div class="col-md-12 mb-3">
                                <label for="tituloEvento">Título</label>
                                <input type="text" class="form-control" id="tituloEventoE" name="tituloEvento" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="descripcionEvento">Descripción</label>
                                <textarea id="descripcionEventoE" name="descripcionEvento" rows="3" class="form-control"  placeholder="" required></textarea>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="colorEvento">Color</label>
                                <select id="colorEventoE" name="colorEvento" class="form-control" required>
                                    <option value="">:.::Seleccionar::.</option>
                                    <option style="color:#197fb0;" value="#197fb0">&#9724; Azul</option>
                                    <option style="color:#0cb8b6;" value="#0cb8b6">&#9724; Verde</option>
                                    <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo </option>
                                </select>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="fechaInicio">Fecha inicio</label>
                                <input type="date" class="form-control" id="fechaInicioE" name="fechaInicio" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="fechaFin">Fecha fin</label>
                                <input type="date" class="form-control calendario" id="fechaFinE" name="fechaFin" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>
                            
                            
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control" id="idEvento" name="idEvento" required>
                        <button class="btn btn-primary">Actualizar evento</button>
                        <a id="enlaceEliminar" class="btn btn-danger">Eliminar evento</a>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--modales -->

<script>
    var eventos  = '<?php echo $eventos; ?>';
    $(document).ready(function() {
        var calendarEl = document.getElementById('eventosCalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            height: 700,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            // defaultDate: moment().format('YYYY-MM-DD'),
            defaultView: 'month',
            businessHours: false, // display business hours
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                $('#create_modal input[name=fechaInicio]').val(start);
                $('#create_modal input[name=fechaFin]').val(end);
                $('#modalEvento').modal('show');
                save();
                $('#eventosCalendar').fullCalendar('unselect');
            },
            eventDrop: function(event, delta, revertFunc) { // si changement de position
                editDropResize(event);
            },
            eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
                editDropResize(event);
            },
            eventClick: function(event, element)
            {
                editarEvento(event);/* 
                detalleEvento(event);
                deleteData(event); */
            },

            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            /* events: [{
                    title: 'Business Lunch',
                    start: '2021-03-03T13:00:00',
                    constraint: 'businessHours'
                }, {
                    title: 'Meeting',
                    start: '2021-03-13T11:00:00',
                    constraint: 'availableForMeeting', // defined below
                    color: '#f35e90'
                }, {
                    title: 'Conference',
                    start: '2021-07-18',
                    end: '2021-07-20',
                    color: '#e67e22'
                }, {
                    title: 'Party',
                    start: '2021-07-29T20:00:00',
                    color: '#22c865'
                },
                // areas where "Meeting" must be dropped
                {
                    id: 'availableForMeeting',
                    start: '2021-03-11T10:00:00',
                    end: '2021-03-11T16:00:00',
                    rendering: 'background',
                    color: '#5e72e4'
                }, {
                    id: 'availableForMeeting',
                    start: '2021-03-13T10:00:00',
                    end: '2021-03-13T16:00:00',
                    rendering: 'background'
                },
                // red areas where no events can be dropped
                {
                    start: '2021-03-24',
                    end: '2021-03-28',
                    overlap: false,
                    rendering: 'background',
                    color: 'rgba(0,0,0,0.1)'
                }, {
                    start: '2021-03-06',
                    end: '2021-03-11',
                    overlap: false,
                    rendering: 'background',
                    color: 'rgba(0,0,0,0.1)'
                }
            ] */
            events: JSON.parse(eventos)
        });

        calendar.render();
    });

    function editarEvento(event){
        
        var vieneDe = event.event.extendedProps.vieneDe;
        if(vieneDe != ""){
            $(".modal-footer").hide();
        }else{
            $(".modal-footer").show();
        }
        $('#fechaInicioE').val(moment(event.event.startStr).format('YYYY-MM-DD'));
        $('#fechaFinE').val(moment(event.event.endStr).format('YYYY-MM-DD'));
        $('#tituloEventoE').val(event.event.title);
        $('#descripcionEventoE').html(event.event.extendedProps.description);
        $('#colorEventoE').val(event.event.backgroundColor);
        $('#idEvento').val(event.event.id);
        $('#enlaceEliminar').attr("href", "<?php echo base_url(); ?>Calendario/eliminar_evento/"+event.event.id);
        $('#modalEEvento').modal('show');
    }

    /* function detalleEvento(event){
        $('#fechaInicioE').val(moment(event.event.startStr).format('YYYY-MM-DD'));
        $('#fechaFinE').val(moment(event.event.endStr).format('YYYY-MM-DD'));
        $('#tituloEventoE').val(event.event.title);
        $('#descripcionEventoE').html(event.event.extendedProps.description);
        $('#colorEventoE').val(event.event.backgroundColor);
        $('#idEvento').val(event.event.id);
        $('#modalEEvento').modal('show');
    }

    function deleteData(event){
        $('#create_modal .delete_calendar').click(function(){
            $.ajax({
                url     : backend_url+'calendar/delete',
                type    : 'POST',
                data    : 'id='+event.id,
                dataType: 'JSON',
                beforeSend: function()
                {
                },
                success: function(data)
                {
                    if(data.status)
                    {   
                        $('#calendarIO').fullCalendar('removeEvents',event._id);
                        $('#create_modal').modal('hide');
                        $('#form_evento')[0].reset();
                        $('#create_modal input[name=calendar_id]').val(0)
                        $('.notification').removeClass('alert-danger').addClass('alert-primary').find('p').html(data.notif);
                    }
                    else
                    {
                        $('#form_evento').find('.alert').css('display', 'block');
                        $('#form_evento').find('.alert').html(data.notif);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $('#form_evento').find('.alert').css('display', 'block');
                    $('#form_evento').find('.alert').html('Wrong server, please save again');
                }         
            });
        })
    } */
</script>