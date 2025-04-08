<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
		//$this->load->model("Empleados_Model");
		//$this->load->model("Incapacidades_Model");
		//$this->load->model("Permisos_Model");
	}

	public function index(){
		redirect(base_url()."Clientes/");
	}

	/*public function index(){
		$data["empleados"] = $this->Empleados_Model->obtenerEmpleados();
		$data["areas"] = $this->Empleados_Model->obtenerAreas();
		// echo json_encode($data["empleados"]);
		$this->load->view('Base/header');
		$this->load->view('Empleados/lista_empleados', $data);
		$this->load->view('Base/footer');
	}*/
}
