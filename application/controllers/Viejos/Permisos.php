<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
		$this->load->model("Empleados_Model");
		$this->load->model("Permisos_Model");
		$this->load->model("Calendario_Model");
	}

	public function lista_permisos($flag = null){
        $area = $this->Empleados_Model->obtenerArea($flag);
        $data["area"] = $area;
		$data["permisos"] = $this->Permisos_Model->obtenerPermisos($area->idArea);
		// echo json_encode($data["permisos"]);
		$this->load->view('Base/header');
		$this->load->view('Permisos/lista_permisos', $data);
		$this->load->view('Base/footer');
	}

	public function agregar_permiso($flag = null){
        $data["area"] = $this->Empleados_Model->obtenerArea($flag);
        $data["areas"] = $this->Empleados_Model->obtenerAreas();
        $data["empleados"] = $this->Empleados_Model->obtenerEmpleadosXArea($flag);
        $data["motivos"] = $this->Permisos_Model->obtenerMotivos();
		$this->load->view('Base/header');
		$this->load->view('Permisos/agregar_permiso', $data);
		$this->load->view('Base/footer');
	}

	public function guardar_permiso(){
		$datos = $this->input->post();
		$empleado = $this->Empleados_Model->obtenerEmpleado($datos["empleadoPermiso"]);
		// Creacion del evento		
			$evento["title"] = trim("Permiso: ".$empleado->nombreEmpleado);
			$evento["description"] = trim($datos["autorizacionPermiso"]);
			$evento["color"] = "#197fb0";
			$evento["start"] = date_format( date_create($datos["diaPermiso"]." ".$datos["dePermiso"]) ,"Y-m-d H:i:s");
			$evento["end"] 	= date_format( date_create($datos["diaPermiso"]." ".$datos["hastaPermiso"]) ,"Y-m-d H:i:s");
		// Creacion del evento		

		$resp = $this->Permisos_Model->guardarPermiso($datos);
		if ($resp > 0){
			$evento["flagEvento"] = $resp;
			$evento["vieneDe"] = "P";
			$this->Calendario_Model->guardarEvento($evento, 1);
			$this->session->set_flashdata("exito","Datos ingresados con exito");
			redirect(base_url()."Permisos/lista_permisos/".$empleado->areaEmpleado."/");
		}else{
			$this->session->set_flashdata("error","Error al registrar los datos");
			redirect(base_url()."Permisos/lista_permisos/".$empleado->areaEmpleado."/");
		}

		// echo json_encode($datos);
	}

	public function cancelar_permiso(){
		$datos = $this->input->post();
		$resp = $this->Permisos_Model->cancelarPermiso($datos["idPermiso"]);
		if ($resp){
			$this->Permisos_Model->cancelarEvento($datos["idPermiso"], "P");
			$this->session->set_flashdata("exito","Permiso cancelado con exito");
			redirect(base_url()."Permisos/lista_permisos/".$datos["area"]."/");
		}else{
			$this->session->set_flashdata("error","Error al cancelar el permiso");
			redirect(base_url()."Permisos/lista_permisos/".$datos["area"]."/");
		}
	}
}

?>