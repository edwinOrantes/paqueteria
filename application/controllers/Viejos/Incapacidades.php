<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incapacidades extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
		$this->load->model("Empleados_Model");
		$this->load->model("Permisos_Model");
		$this->load->model("Calendario_Model");
		$this->load->model("Incapacidades_Model");
	}

	public function lista_incapacidades($flag = null){
        $area = $this->Empleados_Model->obtenerArea($flag);
        $data["area"] = $area;
		$data["incapacidades"] = $this->Incapacidades_Model->obtenerIncapacidades($area->idArea);
		$this->load->view('Base/header');
		$this->load->view('Incapacidades/lista_incapacidades', $data);
		$this->load->view('Base/footer');
	}

	public function agregar_incapacidad($flag = null){
        $data["area"] = $this->Empleados_Model->obtenerArea($flag);
        $data["areas"] = $this->Empleados_Model->obtenerAreas();
        $data["empleados"] = $this->Empleados_Model->obtenerEmpleadosXArea($flag);
		$this->load->view('Base/header');
		$this->load->view('Incapacidades/agregar_incapacidad', $data);
		$this->load->view('Base/footer');

		// echo json_encode($data);
	}

	public function guardar_incapacidad(){
		$datos = $this->input->post();
		$datos["estado"] = 1;
		$empleado = $this->Empleados_Model->obtenerEmpleado($datos["empleadoIncapacidad"]);
		// Creacion del evento		
			$evento["title"] = trim("Incapacidad: ".$empleado->nombreEmpleado);
			$evento["description"] = trim("Incapacidad por: ".$datos["diagnosticoIncapacidad"]);
			$evento["color"] = "#0cb8b6";
			$evento["start"] = date_format( date_create($datos["inicioIncapacidad"]) ,"Y-m-d H:i:s");
			$evento["end"] 	= date_format( date_create($datos["finIncapacidad"]) ,"Y-m-d 23:59:59");
		// Creacion del evento

		
	
		$resp = $this->Incapacidades_Model->guardarIncapacidad($datos);
		if ($resp > 0){
			$evento["flagEvento"] = $resp;
			$evento["vieneDe"] = "I";
			$this->Calendario_Model->guardarEvento($evento, 1);
			$this->session->set_flashdata("exito","Datos ingresados con exito");
			redirect(base_url()."Incapacidades/lista_incapacidades/".$empleado->areaEmpleado."/");
		}else{
			$this->session->set_flashdata("error","Error al registrar los datos");
			redirect(base_url()."Incapacidades/lista_incapacidades/".$empleado->areaEmpleado."/");
		}
		// echo json_encode($datos);
	}

	public function cancelar_incapacidad(){
		$datos = $this->input->post();
		
		$resp = $this->Incapacidades_Model->cancelarIncapacidad($datos["idIncapacidad"]);
		if ($resp){
			$this->Permisos_Model->cancelarEvento($datos["idPermiso"], 'I');
			$this->session->set_flashdata("exito","Incapacidad cancelada con exito");
			redirect(base_url()."Incapacidades/lista_incapacidades/".$datos["area"]."/");
		}else{
			$this->session->set_flashdata("error","Error al cancelar la incapacidad");
			redirect(base_url()."Incapacidades/lista_incapacidades/".$datos["area"]."/");
		}
		// echo json_encode($datos);
	}
}

?>

