<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Envios extends CI_Controller {

    public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
        $this->load->model("Empleado_Model");
        $this->load->model("Envios_Model");
        $this->load->model("Ordenes_Model");
		/* if (!$this->session->has_userdata('valido')){
			$this->session->set_flashdata("error", "Debes iniciar sesión");
			redirect(base_url());
		} */
	}

    public function index(){
		 /* Creando codigo */
			$cod = "";
			$codigo = $this->Envios_Model->obtenerCodigo();
			if($codigo->codigo == 0){
				$cod = 1000;
			}else{
				$cod = $codigo->codigo + 1;
			}
			$data["codigo"] = $cod;
		/* Creando codigo */

        $data["gestores"] = $this->Empleado_Model->empleadosPorCargo(3);
        $data["destinos"] = $this->Ordenes_Model->obtenerDestino();
        $this->load->view('Base/header');
		$this->load->view('Envios/crear_envio', $data);
		$this->load->view('Base/footer');

        // echo json_encode($data);
    }

	public function guardar_envio(){
		echo '<script>
				if (window.history.replaceState) { // verificamos disponibilidad
					window.history.replaceState(null, null, window.location.href);
				}
			</script>';
		$datos = $this->input->post();
		// $datos["codigoEnvio"] = 1006;
		$validacionCodigo = $this->Envios_Model->validarCodigo($datos["codigoEnvio"]);
		$datos["codigoEnvio"] = $validacionCodigo->codigoFinal;

		$resp = $this->Envios_Model->guardarEnvio($datos);
		if ($resp){
			$this->session->set_flashdata("exito","Datos ingresados con exito");
			// redirect(base_url()."Envios/detalle_envio/".urlencode(base64_encode(serialize($resp)))."/");
			redirect(base_url()."Envios/detalle_envio/".$resp."/");
		}else{
			$this->session->set_flashdata("error","Error al registrar los datos");
			redirect(base_url()."Envios/");
		}

		// echo json_encode($datos);

	}

	public function detalle_envio($envio = null){
		// $envio = unserialize(base64_decode(urldecode($envio)));

		$data["detalle_envio"] = $this->Envios_Model->detalleEnvio($envio);
		$data["maletas"] = $this->Envios_Model->cantidaMaleta($envio, 1); //1 Maletas
		$data["manos"] = $this->Envios_Model->cantidaMaleta($envio, 2); //2 Maletas de mano
		$data["filasMaletas"] = $this->Envios_Model->detallesCantidadMaleta($envio, 1); //2 Maletas de mano
		$data["filasManos"] = $this->Envios_Model->detallesCantidadMaleta($envio, 2); //2 Maletas de mano
		$data["envio"] = $envio;

		$this->load->view('Base/header');
		$this->load->view('Envios/detalle_envio', $data);
		$this->load->view('Base/footer');

		// echo json_encode($data);
	}



	public function guardar_maleta(){
		if($this->input->is_ajax_request()){
			$datos = $this->input->post();
			$datos["codigo"] = time();
			$resp = $this->Envios_Model->guardarMaleta($datos);
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

	public function detalle_maleta(){
		if($this->input->is_ajax_request()){
			$datos = $this->input->post();
			
			$detalleMaleta = $this->Envios_Model->detalleMaleta($datos["maleta"]);

			if(count($detalleMaleta ) > 0){
				$respuesta = array('estado' => 1, 'respuesta' => 'Exito', 'mensaje' => 'Bien', 'datos' => $detalleMaleta);
				header("content-type:application/json");
				print json_encode($respuesta);
			}else{
				$respuesta = array('estado' => 0, 'respuesta' => 'Exito', 'mensaje' => 'Mal', 'datos' => null);
				header("content-type:application/json");
				print json_encode($respuesta);
			}
		}
		else{
			$respuesta = array('estado' => 0, 'respuesta' => 'Exito', 'mensaje' => 'Mal', 'datos' => null);
			header("content-type:application/json");
			print json_encode($respuesta);
		}
	}

	public function agregar_orden_a_maleta(){
		if($this->input->is_ajax_request()){
			$datos = $this->input->post();
			$retornar = 0;
			$paqueteEncontrado = '';
			$codigo = $datos["orden"]; // probar aquí
		
			// Separar código
			if (strpos($codigo, '-') !== false) {
				$partes = explode('-', $codigo);
				$codigoD = $partes[0];
				$codigoI = (int)$partes[1];
			} else {
				$codigoD = $codigo;
				$codigoI = 0;
			}
		
			// Obtener detalle
			$detalle = $this->Envios_Model->detalleOrden($codigoD);
			$ordenPaquete = json_decode($detalle->ordenPaquete, true);
		
			if (!is_array($ordenPaquete)) {
				$ordenPaquete = [];
			}
		
			if ($codigoI > 0) {
				$paqueteExiste = false;
				$encontrado = false;
		
				foreach ($ordenPaquete as $item) {
					if (isset($item['paquete']) && $item['paquete'] == $codigoI) {
						$paqueteExiste = true;
		
						if (isset($item['detalle']) && trim($item['detalle']) !== '') {
							$paqueteEncontrado = $item['concepto'];
							$encontrado = true;
							break;
						}
					}
				}
		
				if (!$paqueteExiste) {
					$paqueteEncontrado = "El paquete $codigoI no existe en el envío $codigoD.";
					$retornar = 1;
				} elseif (!$encontrado) {
					$paqueteEncontrado = str_replace(["\r\n", "\n", "\r"], ' ', $detalle->contenidoPaquete);
				}
		
			} else {
				// Código sin guion
				$hayDetalles = false;
				foreach ($ordenPaquete as $item) {
					if (isset($item['detalle']) && trim($item['detalle']) !== '') {
						$hayDetalles = true;
						break;
					}
				}
		
				if ($hayDetalles) {
					$paqueteEncontrado = "Debe especificar qué parte del paquete desea obtener.";
					$retornar = 1;
				} else {
					$paqueteEncontrado = str_replace(["\r\n", "\n", "\r"], ' ', $detalle->contenidoPaquete);
				}
			}
			
			if($retornar == 0){
				$aMaleta["orden"] =  $detalle->idOrden;
				$aMaleta["codigoOrden"] =  $datos["orden"];
				$aMaleta["detalle"] =  $paqueteEncontrado;
				$aMaleta["maleta"] =  $datos["maleta"];
				$resp = $this->Envios_Model->guardarOrdenMaleta($aMaleta);
				if($resp){
					$detalleMaleta = $this->Envios_Model->detalleMaleta($datos["maleta"]);

					$respuesta = array('estado' => 1, 'respuesta' => 'Exito', 'mensaje' => 'Bien', 'datos' => $detalleMaleta);
					header("content-type:application/json");
					print json_encode($respuesta);
				}else{
					$respuesta = array('estado' => 0, 'respuesta' => 'Error', 'mensaje' => 'Mal', 'datos' => null);
					header("content-type:application/json");
					print json_encode($respuesta);
				}
			}else{	
				$respuesta = array('estado' => 0, 'respuesta' => 'Error', 'mensaje' => 'Debes de especificar que parte del paquete deseas agregar', 'datos' => null);
				header("content-type:application/json");
				print json_encode($respuesta);
			}	

			
		}
		else{
			$respuesta = array('estado' => 0, 'respuesta' => 'Error', 'mensaje' => 'Mal', 'datos' => null);
			header("content-type:application/json");
			print json_encode($respuesta);
		}
	}

	public function pruebas(){
		$paqueteEncontrado = '';
		$codigo = "1000-9"; // probar aquí
	
		// Separar código
		if (strpos($codigo, '-') !== false) {
			$partes = explode('-', $codigo);
			$codigoD = $partes[0];
			$codigoI = (int)$partes[1];
		} else {
			$codigoD = $codigo;
			$codigoI = 0;
		}
	
		// Obtener detalle
		$detalle = $this->Envios_Model->detalleOrden($codigoD);
		$ordenPaquete = json_decode($detalle->ordenPaquete, true);
	
		if (!is_array($ordenPaquete)) {
			$ordenPaquete = [];
		}
	
		if ($codigoI > 0) {
			$paqueteExiste = false;
			$encontrado = false;
	
			foreach ($ordenPaquete as $item) {
				if (isset($item['paquete']) && $item['paquete'] == $codigoI) {
					$paqueteExiste = true;
	
					if (isset($item['detalle']) && trim($item['detalle']) !== '') {
						$paqueteEncontrado = $item['concepto'];
						$encontrado = true;
						break;
					}
				}
			}
	
			if (!$paqueteExiste) {
				$paqueteEncontrado = "El paquete $codigoI no existe en el envío $codigoD.";
			} elseif (!$encontrado) {
				$paqueteEncontrado = str_replace(["\r\n", "\n", "\r"], ' ', $detalle->contenidoPaquete);
			}
	
		} else {
			// Código sin guion
			$hayDetalles = false;
			foreach ($ordenPaquete as $item) {
				if (isset($item['detalle']) && trim($item['detalle']) !== '') {
					$hayDetalles = true;
					break;
				}
			}
	
			if ($hayDetalles) {
				$paqueteEncontrado = "Debe especificar qué parte del paquete desea obtener.";
			} else {
				$paqueteEncontrado = str_replace(["\r\n", "\n", "\r"], ' ', $detalle->contenidoPaquete);
			}
		}
	
		// Resultado final
		echo $paqueteEncontrado;
	}
	
	




	public function agregar_a_envio(){
		if($this->input->is_ajax_request()){
			$datos = $this->input->post();
			$url_base = base_url();
			$str = $datos["paquete"];
			$codigo = str_replace($url_base."Ordenes/informacion_orden/", "", $str); // Obteneniendo unicamente el codigo
			$datos["paquete"] = $codigo;

			/* $porciones = explode("-", $codigo);
			echo json_encode($porciones); */
	
			$resp = $this->Envios_Model->agregarAEnvio($datos);
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

    
}
