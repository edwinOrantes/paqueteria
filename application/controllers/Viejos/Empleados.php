<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
		$this->load->model("Empleados_Model");
		$this->load->model("Incapacidades_Model");
		$this->load->model("Permisos_Model");
	}

	public function lista_empleados(){
		$data["empleados"] = $this->Empleados_Model->obtenerEmpleados();
		$data["areas"] = $this->Empleados_Model->obtenerAreas();
		// echo json_encode($data["empleados"]);
		$this->load->view('Base/header');
		$this->load->view('Empleados/lista_empleados', $data);
		$this->load->view('Base/footer');
	}

	public function agregar_empleado(){
		$data["areas"] = $this->Empleados_Model->obtenerAreas();
		$this->load->view('Base/header');
		$this->load->view('Empleados/agregar_empleado', $data);
		$this->load->view('Base/footer');
	}

	public function guardar_empleado(){
		$datos = $this->input->post();
		// echo json_encode($datos);
		$resp = $this->Empleados_Model->guardarEmpleado($datos);
		if ($resp){
			$this->session->set_flashdata("exito","Datos ingresados con exito");
			redirect(base_url()."Empleados/agregar_empleado/");
		}else{
			$this->session->set_flashdata("error","Error al registrar los datos");
			redirect(base_url()."Empleados/agregar_empleado/");
		}

	}

	public function actualizar_empleado(){
		$datos = $this->input->post();
		echo json_encode($datos);
		$resp = $this->Empleados_Model->actualizarEmpleado($datos);
		if ($resp){
			$this->session->set_flashdata("exito","Datos ingresados con exito");
			redirect(base_url()."Empleados/lista_empleados/");
		}else{
			$this->session->set_flashdata("error","Error al registrar los datos");
			redirect(base_url()."Empleados/lista_empleados/");
		}

	}

	public function eliminar_empleado(){
		$datos = $this->input->post();
		$resp = $this->Empleados_Model->eliminarEmpleado($datos);
		if ($resp){
			$this->session->set_flashdata("exito","Datos eliminados con exito");
			redirect(base_url()."Empleados/lista_empleados/");
		}else{
			$this->session->set_flashdata("error","Error al eliminar los datos");
			redirect(base_url()."Empleados/lista_empleados/");
		}

	}

	public function buscar_empleado(){
		if($this->input->is_ajax_request()){
			$empleado =$this->input->post("empleado");
			$data = $this->Empleados_Model->validadEmpleado(trim($empleado));
			echo json_encode($data);
		}
		else{
			echo "Error...";
		}
	}

	public function detalle_empleado($id = null){
		$data["empleado"] = $this->Empleados_Model->obtenerEmpleado($id);
		$data["permisos"] = $this->Permisos_Model->obtenerPermiso($id);
		$data["incapacidades"] = $this->Incapacidades_Model->obtenerIncapacidad($id);
		$this->load->view('Base/header');
		$this->load->view('Empleados/detalle_empleado', $data);
		$this->load->view('Base/footer');
		// echo json_encode($data);
	}


	// Para calendario 
		public function vacaciones(){
			$this->load->view('Base/header');
			$this->load->view('Empleados/calendario_eventos');
			$this->load->view('Base/footer');
		}

		public function obtener_eventos(){
			$eventos = $this->Empleados_Model->obtenerEventos();
			foreach($eventos as $row){
				$data[] = array(
					'id' => $row->idEvento,
					'title' => $row->tituloEvento,
					'start' => $row->inicioEvento,
					'end' => $row->finEvento
				);
			}
			echo json_encode($data);
		}
	// Para calendario 
}

?>