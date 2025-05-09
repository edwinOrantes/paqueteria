<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
		date_default_timezone_set('America/El_Salvador');
		if (!$this->session->has_userdata('valido')){
			$this->session->set_flashdata("error", "Debes iniciar sesión");
			redirect(base_url());
		}
		$this->load->model("Ordenes_Model");
		$this->load->model("Clientes_Model");
		$this->load->model("Empresa_Model");
		$this->load->model("Empleado_Model");
		// Cargar la biblioteca CI QR Code
			$this->load->library('ciqrcode');
		// Cargar la biblioteca CI QR Code
	}

	public function index(){
		$data["ordenes"] = $this->Ordenes_Model->obtenerOrdenes();
		$this->load->view('Base/header');
		$this->load->view('Ordenes/lista_ordenes', $data);
		$this->load->view('Base/footer');
		// echo json_encode($data["ordenes"]);
	}

	public function agregar_orden(){
        /* Creando codigo */
            $cod = "";
            $codigo = $this->Ordenes_Model->obtenerCodigo();
            if(is_null($codigo)){
                $cod = 1000;
            }else{
                $cod = $codigo->codigo + 1;
            }
            $data["codigo"] = $cod;
        /* Creando codigo */
        
		$data["emisores"] = $this->Clientes_Model->obtenerEmisores();
        $data["receptores"] = $this->Clientes_Model->obtenerReceptores();
        $data["destinos"] = $this->Ordenes_Model->obtenerDestino();
        $data["gestores"] = $this->Empleado_Model->empleadosPorCargo(3);

		$this->load->view('Base/header');
		$this->load->view('Ordenes/agregar_orden', $data);
		$this->load->view('Base/footer');
		
		//echo json_encode($data);
	}

	public function guardar_orden(){
		echo '<script>
				if (window.history.replaceState) { // verificamos disponibilidad
					window.history.replaceState(null, null, window.location.href);
				}
			</script>';
		$datos = $this->input->post();
		$c = $datos["codigoOrden"];
		$codigo = $this->Ordenes_Model->validarCodigoOrden($c);
		if($codigo->codigoOrden != 0){
			$ultimoCodigo = $this->Ordenes_Model->obtenerCodigo();
			$uc = $ultimoCodigo->codigo + 1;
			$datos["codigoOrden"] = "$uc";
		}
		$datos["creadaPor"] = $this->session->userdata('empleado_h');
		
		$resp = $this->Ordenes_Model->guardarOrden($datos);
		if ($resp){
			$this->session->set_flashdata("exito","Datos ingresados con exito");
			redirect(base_url()."Ordenes/editar_detalle_orden/".$resp."/");
		}else{
			$this->session->set_flashdata("error","Error al registrar los datos");
			redirect(base_url()."Ordenes/agregar_orden/");
		}

		// echo json_encode($datos);
		
	}
	
    public function agregar_detalle($id = null){
		$data["orden"] = $this->Ordenes_Model->obtenerOrden($id);
		$data["articulos"] = $this->Ordenes_Model->obtenerDetalleOrden($id);
        $data["idOrden"] = $id;
		$this->load->view('Base/header');
		$this->load->view('Ordenes/agregar_detalle_orden', $data);
		$this->load->view('Base/footer');
		
		// echo json_encode($data);
    }

	public function guardar_detalle_orden(){
		$datos = $this->input->post();
		$orden = $datos["idOrden"];
		unset($datos["idOrden"]);

		// Ordenando datos
			if(isset($datos["concepto"])){
				$conceptos = $datos["concepto"];
				$monto = $datos["monto"];
				unset($datos["concepto"]);
				unset($datos["monto"]);
				
				$adicionales = [];
				for ($i = 0; $i < count($conceptos); $i++) {
					$adicionales[] = [
						"concepto" => $conceptos[$i],
						"monto" => $monto[$i]
					];
				}
				
				$datos["adicionales"] = json_encode($adicionales);
			}else{
				$datos["adicionales"] = "";
			}
		// Ordenando datos

		// Ordenando contenido
			// Separar la cadena por salto de línea (\r\n)
			$filas = explode("\r\n", $datos["contenidoPaquete"]);
			// Crear un arreglo donde cada fila se separa en concepto y cantidad
			$resultado = [];
			$index = 1;
			foreach ($filas as $fila) {
				// Separar cada fila por el patrón 'x/y' (donde x e y son números)
				preg_match('/(.*)\s(\d+\/\d+)/', $fila, $matches);
				
				if(count($matches) == 3) {
					// Guardar el concepto y la cantidad
					$resultado[] = [
						'concepto' => $matches[1],
						'detalle' => $matches[2],
						'paquete' => $index
					];
				}
				$index++;
			}
			// Separar la cadena por salto de línea (\r\n)
			$filas = array_filter(explode("\r\n", trim($datos["contenidoPaquete"]))); // Elimina líneas vacías

			$resultado = [];
			$index = 1;

			foreach ($filas as $fila) {
				$fila = trim($fila); // Elimina espacios extra
				
				// Intentar capturar "concepto x/y"
				if (preg_match('/^(.*?)\s*(\d+\/\d+)$/', $fila, $matches)) {
					$concepto = trim($matches[1]);
					$detalle = $matches[2];
				} else {
					// Si no cumple con "x/y", lo toma como concepto sin detalle
					$concepto = $fila;
					$detalle = ""; // Sin cantidad
				}

				// Guardar en el array
				$resultado[] = [
					'concepto' => $concepto,
					'detalle' => $detalle,
					'paquete' => $index
				];

				$index++;
			}

			// Ver resultado


			// Imprimir el resultado en formato JSON
			$datos["ordenPaquetes"] = json_encode($resultado);
		// Ordenando contenido
		
		
		$datos["totalOrden"] = (float)($datos["pesoPaquete"] * $datos["precioPaquete"]);
		$datos["idOrden"] = $orden;

		$orden = $datos["idOrden"];
		$resp = $this->Ordenes_Model->guardarDetalleOrden($datos);
		if ($resp){
			$this->session->set_flashdata("exito","Datos ingresados con exito");
			redirect(base_url()."Ordenes/detalle_orden/".$orden."/");
		}else{
			$this->session->set_flashdata("error","Error al registrar los datos");
			redirect(base_url()."Ordenes/detalle_orden/".$orden."/");
		}

		// echo json_encode($datos);
	}

	public function detalle_orden($id = null){}
	
	public function editar_detalle_orden($id = null){
		$data["orden"] = $this->Ordenes_Model->obtenerOrden($id);
		$data["detalle_articulos"] = $this->Ordenes_Model->obtenerDetalleOrden($id);
        $data["idOrden"] = $id;
		$this->load->view('Base/header');
		$this->load->view('Ordenes/editar_detalle_orden', $data);
		$this->load->view('Base/footer');

		// echo json_encode($data);
	}

	
	public function actualizar_detalle_orden(){
		$datos = $this->input->post();
		$orden = $datos["idOrden"];
		$idDetalleOrden = $datos["idDetalleOrden"];
		unset($datos["idDetalleOrden"]);
		unset($datos["idOrden"]);

		// Ordenando datos
			if(isset($datos["concepto"])){
				$conceptos = $datos["concepto"];
				$monto = $datos["monto"];
				unset($datos["concepto"]);
				unset($datos["monto"]);
				
				$adicionales = [];
				for ($i = 0; $i < count($conceptos); $i++) {
					$adicionales[] = [
						"concepto" => $conceptos[$i],
						"monto" => $monto[$i]
					];
				}
				
				$datos["adicionales"] = json_encode($adicionales);
			}else{
				$datos["adicionales"] ="";
			}
			
		// Ordenando datos
		// Ordenando contenido
			// Separar la cadena por salto de línea (\r\n)
			$filas = explode("\r\n", $datos["contenidoPaquete"]);
			// Crear un arreglo donde cada fila se separa en concepto y cantidad
			$resultado = [];
			$index = 1;
			foreach ($filas as $fila) {
				// Separar cada fila por el patrón 'x/y' (donde x e y son números)
				preg_match('/(.*)\s(\d+\/\d+)/', $fila, $matches);
				
				if(count($matches) == 3) {
					// Guardar el concepto y la cantidad
					$resultado[] = [
						'concepto' => $matches[1],
						'detalle' => $matches[2],
						'paquete' => $index
					];
				}
				$index++;
			}

			// Imprimir el resultado en formato JSON
			$datos["ordenPaquetes"] = json_encode($resultado);
		// Ordenando contenido
		

		
		
		$datos["totalOrden"] = (float)($datos["pesoPaquete"] * $datos["precioPaquete"]);
		$datos["idDetalleOrden"] = $idDetalleOrden;

		$resp = $this->Ordenes_Model->actualizarDetalleOrden($datos);
		if ($resp){
			$this->session->set_flashdata("exito","Datos ingresados con exito");
			redirect(base_url()."Ordenes/ver_hoja_envio/".$orden."/");
		}else{
			$this->session->set_flashdata("error","Error al registrar los datos");
			redirect(base_url()."Ordenes/detalle_orden/".$orden."/");
		}
		
		// echo json_encode($datos);
	}

	public function ver_hoja_envio($orden = null){
		$data["orden"] = $this->Ordenes_Model->obtenerOrden($orden);
		$data["detalle_articulos"] = $this->Ordenes_Model->obtenerDetalleOrden($orden);
		// $data["qr"] = $this->Ordenes_Model->obtenerQr($orden);
		$data["empresa"] = $this->Empresa_Model->obtenerInformacion();

		// Creando PDF 
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
			$mpdf = new \Mpdf\Mpdf([
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_top' => 20,
				'margin_bottom' => 10,
				'margin_header' => 10,
				'margin_footer' => 30
				]);
			//$mpdf->setFooter('');
			//$mpdf->SetProtection(array('print'));
			$mpdf->SetTitle("Encomiendas Campos");
			$mpdf->SetAuthor("Edwin Orantes");
			$mpdf->showWatermarkText = false;
			$mpdf->watermark_font = 'DejaVuSansCondensed';
			$mpdf->watermarkTextAlpha = 0.1;
			$mpdf->SetDisplayMode('fullpage');
			// $mpdf->AddPage('L'); //Voltear Hoja
			$html = $this->load->view('Ordenes/hoja_envio_pdf', $data ,true); // Cargando hoja de estilos
			$mpdf->SetHTMLHeader();
			$mpdf->SetHTMLFooter(' <div class="row clearfix" style="margin-top: 100px; text-align: center; padding-left: 50px">
					<div class="column ">
						<table style="text-align: center; width: 80%">
							<tr>
								<th style="border-bottom: 1px solid #000000"></th>
							</tr>
							<tr>
								<td><strong>Firma del emisor</strong></td>
							</tr>
							<tr>
								<td><strong>Fecha envio:</strong> '.$data["orden"]->fechaEnvio.'</td>
							</tr>
						</table>

					</div>
					<div class="column ">
						
						<table style="text-align: center; width: 80%">
							<tr>
								<th style="border-bottom: 1px solid #000000"></th>
							</tr>
							<tr>
								<td><strong>Recibido por</strong></td>
							</tr>
							<tr>
								<td><strong>Fecha recibido:</strong>____/____/____</td>
							</tr>
						</table>
					</div>
				</div>'
			);
			
			$mpdf->WriteHTML($html);
			$mpdf->Output('orden_envio.pdf', 'I');
		// Fin del PDF 

		// echo json_encode($data);
	}

	public function ver_etiquetas($orden = null){
		$data["orden"] = $this->Ordenes_Model->obtenerOrden($orden);
		$data["detalle_articulos"] = $this->Ordenes_Model->obtenerDetalleOrden($orden);
		$cantidaPartes = $data["detalle_articulos"]->ordenPaquete;
		$codigoBase = $data["orden"]->codigoOrden;
		$data["empresa"] = $this->Empresa_Model->obtenerInformacion();
		$piezas = 0;
		$index = 1;
		$cantidadPartesArray = json_decode($cantidaPartes, true);
		
		if(count($cantidadPartesArray) > 0){
			// Contamos las piezas
			foreach ($cantidadPartesArray as $paquete) {
				if ($paquete['detalle'] == '') {
					$piezas = 1;  // Si el detalle está vacío, se cuenta como 1 pieza
				} else {
					$piezas++;  // Si tiene detalle, se incrementa
				}
				$index++;
			}
			$data["piezas"] = $piezas;
			$data["qrs"] = $this->crear_qr($cantidadPartesArray, $codigoBase, $piezas);
		}else{
			$data["piezas"] = 1;
			$data["qrs"] = $this->crear_qr(1, $codigoBase, 1);
		}

		// echo json_encode($data);

		// Creando PDF 
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
			$mpdf = new \Mpdf\Mpdf([
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_top' => 20,
				'margin_bottom' => 10,
				'margin_header' => 10,
				'margin_footer' => 30
				]);
			//$mpdf->setFooter('');
			//$mpdf->SetProtection(array('print'));
			$mpdf->SetTitle("Encomiendas Campos");
			$mpdf->SetAuthor("Edwin Orantes");
			$mpdf->showWatermarkText = false;
			$mpdf->watermark_font = 'DejaVuSansCondensed';
			$mpdf->watermarkTextAlpha = 0.1;
			$mpdf->SetDisplayMode('fullpage');
			// $mpdf->AddPage('L'); //Voltear Hoja
			$html = $this->load->view('Ordenes/etiquetas_pdf', $data ,true); // Cargando hoja de estilos
			$mpdf->SetHTMLHeader();
			$mpdf->SetHTMLFooter();
			
			$mpdf->WriteHTML($html);
			$mpdf->Output('orden_envio.pdf', 'I');
		// Fin del PDF 

			
	}

	public function generar_qrs() {
		// Limpiar el buffer de salida antes de enviar los headers
		if (ob_get_length()) {
			ob_end_clean();
		}
	
		 // Links para cada QR
		 $links = [
			"Facebook"  => "https://www.facebook.com",
			"Google"    => "https://www.google.com",
			"Instagram" => "https://www.instagram.com",
			"X"         => "https://twitter.com"
		];
	
		
		$html = $this->crear_qr($links);
	
		// Crear PDF con mPDF
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
	
		// Salir el PDF en el navegador
		$mpdf->Output('qrs.pdf', 'I'); // 'I' para mostrar en el navegador
	}
	

	private function crear_qr($cantidadPartesArray = null, $codigo = null, $piezas = null){
		// Inicializar un arreglo para almacenar las imágenes
		$imagenes = [];
		
		
		// Si solo hay una pieza
		if ($piezas == 1) {
			ob_start();
			QRcode::png($codigo, null, QR_ECLEVEL_L, 10);  // Generar QR en memoria
			$imageData = ob_get_contents();
			ob_end_clean();
	
			// Convertir la imagen a base64
			$base64 = base64_encode($imageData);
	
			// Almacenar la imagen en el arreglo
			$imagenes[] = $base64;
		} else {
			// Si hay más de una pieza, generamos un QR para cada una
			$index = 1;
			foreach ($cantidadPartesArray as $paquete) {
				ob_start();
				QRcode::png($codigo . "-" . $index, null, QR_ECLEVEL_L, 10);  // Generar QR en memoria
				$imageData = ob_get_contents();
				ob_end_clean();
	
				// Convertir la imagen a base64
				$base64 = base64_encode($imageData);
	
				// Almacenar la imagen en el arreglo
				$imagenes[] = $base64;
				$index++;
			}
		}
	
		// Retornar el arreglo con las imágenes
		return $imagenes;
	}
	
	
	
	






	
	
	
	public function guardar_articulo(){
		if($this->input->is_ajax_request()){
			$datos = $this->input->post();		
			$resp = $this->Ordenes_Model->guardarDetalleOrden($datos);
			if($resp){
				$respuesta = array('estado' => 1, 'respuesta' => 'Exito');
				header("content-type:application/json");
				print json_encode($respuesta);
			}else{
				$respuesta = array('estado' => 0, 'respuesta' => 'Error');
				header("content-type:application/json");
				print json_encode($respuesta);
			}
		}
		else{
			$respuesta = array('estado' => 0, 'respuesta' => 'Error');
			header("content-type:application/json");
			print json_encode($respuesta);
		}
	}
	
	public function editar_articulo(){
		$datos = $this->input->post();
		$orden = $datos["idOrden"];
		unset($datos["idOrden"]);
		$resp = $this->Ordenes_Model->actualizarDetalleOrden($datos);
		if ($resp){
			$this->session->set_flashdata("exito","Datos actualizados con exito");
			redirect(base_url()."Ordenes/detalle_orden/".$orden."/");
		}else{
			$this->session->set_flashdata("error","Error al actualizar los datos");
			redirect(base_url()."Ordenes/detalle_orden/".$orden."/");
		}
		// echo json_encode($datos);
	}
	
	public function eliminar_articulo(){
		$datos = $this->input->post();
		$orden = $datos["idOrden"];
		unset($datos["idOrden"]);
		$resp = $this->Ordenes_Model->eliminarDetalleOrden($datos);
		if ($resp){
			$this->session->set_flashdata("exito","Datos eliminados con exito");
			redirect(base_url()."Ordenes/detalle_orden/".$orden."/");
		}else{
			$this->session->set_flashdata("error","Error al eliminados los datos");
			redirect(base_url()."Ordenes/detalle_orden/".$orden."/");
		}
		// echo json_encode($datos);
	}
	
	public function etiquetas_articulo(){
		$this->load->library('ciqrcode');
		$datos = $this->input->post();
		$nombre = "";
		$pivote = false;
		/* Ejecutando procesos */
			if($datos["cantidadEtiquetas"] > 1){
				for ($i=1; $i <= $datos["cantidadEtiquetas"]; $i++) { 
					$nombre = $datos["codigoOrden"]."-".$i;
					$params['data'] = base_url().'Ordenes/informacion_orden/'.$nombre;
					$params['level'] = 'H';
					$params['size'] = 10;
					$params['savename'] = FCPATH.'public/images/qrs/'.$nombre.".png";
					$this->ciqrcode->generate($params);

					//Guardando en DB
						$this->Ordenes_Model->guardarQR($datos["idOrden"], $nombre);
					//Guardando en DB

					// Confirmando que se crearon los Qrs
						$pivote = $this->Ordenes_Model->actualizarEstadoQR($datos["idOrden"]);
					// Confirmando que se crearon los Qrs

				}
			}else{
				$params['data'] = base_url().'Ordenes/informacion_orde/'.$datos["codigoOrden"]."/";
				$params['level'] = 'H';
				$params['size'] = 10;
				$params['savename'] = FCPATH.'public/images/qrs/'.$datos["codigoOrden"].".png";
				$this->ciqrcode->generate($params);

				//Guardando en DB
					$this->Ordenes_Model->guardarQR($datos["idOrden"], $datos["codigoOrden"]);
				//Guardando en DB

				// Confirmando que se creo el QR
					$pivote = $this->Ordenes_Model->actualizarEstadoQR($datos["idOrden"]);
				// Confirmando que se creo el QR
			}
		/* Ejecutando procesos */
		// echo json_encode($datos);
		if ($pivote){
			$this->session->set_flashdata("exito","Etiquetas creadas con exito!");
			redirect(base_url()."Ordenes/etiqueta_pdf/".$datos["idOrden"]."/");
		}else{
			$this->session->set_flashdata("error","Error al crear las etiquetas");
			redirect(base_url()."Ordenes/etiqueta_pdf/".$datos["idOrden"]."/");
		}

		/* $config['cacheable']	= true; //boolean, the default is true
		$config['cachedir']		= ''; //string, the default is application/cache/
		$config['errorlog']		= ''; //string, the default is application/logs/
		$config['quality']		= true; //boolean, the default is true
		$config['size']			= ''; //interger, the default is 1024
		$config['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config); */

		/* $params['data'] = 'https://www.youtube.com/watch?v=dLCY8jPN6AY';
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'public/images/qrs/etiqueta.png';
		$this->ciqrcode->generate($params);

		echo '<img src="'.base_url().'public/images/qrs/etiqueta.png" />'; */

		// echo json_encode($datos);
	}

	public function etiqueta_pdf($id = null){
		$data["orden"] = $this->Ordenes_Model->obtenerOrden($id);
		$data["qr"] = $this->Ordenes_Model->obtenerQr($id);
		$data["empresa"] = $this->Empresa_Model->obtenerInformacion();

		// Creando PDF 
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
			$mpdf = new \Mpdf\Mpdf([
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_top' => 10,
				'margin_bottom' => 10,
				'margin_header' => 10,
				'margin_footer' => 10
				]);
			//$mpdf->setFooter('');
			//$mpdf->SetProtection(array('print'));
			$mpdf->SetTitle("Encomiendas Campos");
			$mpdf->SetAuthor("Edwin Orantes");
			$mpdf->showWatermarkText = false;
			$mpdf->watermark_font = 'DejaVuSansCondensed';
			$mpdf->watermarkTextAlpha = 0.1;
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->AddPage('L'); //Voltear Hoja
			$html = $this->load->view('Ordenes/etiqueta_pdf', $data ,true); // Cargando hoja de estilos
			$mpdf->SetHTMLHeader();
			
					
			// FOOTER MALO EN TEORIA
			/* $mpdf->SetHTMLFooter('<div>
				<p style="margin-top: 50px; height: 65px"><strong>AUTORIZACIÓN:</strong></p>
				<div style="width: 100%;">
					<table class="tabla_detalle_paciente" style="margin-top: 25px; border-collapse: separate; border-spacing: 30px 0px;">
						<tr>
							<td style="border-bottom: 1px solid #000"> </td>
							<td style="border-bottom: 1px solid #000"> </td>
							<td style="border-bottom: 1px solid #000"> </td>
						</tr>
						<tr>
							<td style="border:none; width: 150px; text-align: center; font-size: 12px"><strong>Empleado</strong></td>
							<td style="border:none; width: 150px; text-align: center; font-size: 12px"><strong>Jefe inmediato</strong></td>
							<td style="border:none; width: 150px; text-align: center; font-size: 12px"><strong>Gerente general</strong></td>
						</tr>
					</table>
				</div>
			</div>'); */
			$mpdf->WriteHTML($html);
			$mpdf->Output('etiqueta.pdf', 'I');
		// Fin del PDF 
		//echo json_encode($data);


	}

	public function informacion_orden($orden = null){

	}




}

?> 