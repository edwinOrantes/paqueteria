<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
		date_default_timezone_set('America/El_Salvador');
		if (!$this->session->has_userdata('valido')){
			$this->session->set_flashdata("error", "Debes iniciar sesión");
			redirect(base_url());
		}
		$this->load->model("Clientes_Model");
	}

	public function index(){
		$data["clientes"] = $this->Clientes_Model->obtenerClientes();
		// echo json_encode($data["empleados"]);
		$this->load->view('Base/header');
		$this->load->view('Clientes/lista_clientes', $data);
		$this->load->view('Base/footer');
	}

	public function agregar_cliente(){
		$data["paises"] = $this->Clientes_Model->obtenerPaises();
		$data["estados"] = $this->Clientes_Model->obtenerEstados();
		$data["municipios"] = $this->Clientes_Model->obtenerMunicipios();
		$cod = "";
		$codigo = $this->Clientes_Model->obtenerCodigo();
		if(is_null($codigo)){
			$cod = 1000;
		}else{
			$cod = $codigo->codigo + 1;
		}
		$data["codigo"] = $cod;

		$this->load->view('Base/header');
		$this->load->view('Clientes/agregar_cliente', $data);
		$this->load->view('Base/footer');
		// echo json_encode($data);
	}

	public function guardar_cliente(){
		$datos = $this->input->post();
		$datos["nombreCliente"] = $datos["nombreCliente"]."-".$datos["apellidosCliente"];
		unset($datos["apellidosCliente"]);
		$resp = $this->Clientes_Model->guardarCliente($datos);
		if ($resp){
			$datos["pivote"] = $resp;
			$this->Clientes_Model->guardarReceptor($datos);
			$this->session->set_flashdata("exito","Datos ingresados con exito");
			redirect(base_url()."Clientes/agregar_cliente/");
		}else{
			$this->session->set_flashdata("error","Error al registrar los datos");
			redirect(base_url()."Clientes/agregar_cliente/");
		}
		
		// echo json_encode($datos);
	
	}



	
	public function detalle_cliente($id = null){
		$data["cliente"] = $this->Clientes_Model->obtenerCliente($id);
		$this->load->view('Base/header');
		$this->load->view('Clientes/detalle_cliente', $data);
		$this->load->view('Base/footer');
		// echo json_encode($data);
	}
	
	public function editar_cliente($id = null){
		$data["cliente"] = $this->Clientes_Model->obtenerCliente($id);
		$data["paises"] = $this->Clientes_Model->obtenerPaises();
		$data["estados"] = $this->Clientes_Model->obtenerEstados();
		$data["municipios"] = $this->Clientes_Model->obtenerMunicipios();
		$this->load->view('Base/header');
		$this->load->view('Clientes/editar_cliente', $data);
		$this->load->view('Base/footer');
		// echo json_encode($data);
	}

	public function actualizar_cliente(){
		$datos = $this->input->post();
		$datos["nombreCliente"] = $datos["nombreCliente"]."-".$datos["apellidosCliente"];
		unset($datos["apellidosCliente"]);
		$return = $datos["idCliente"];
		$resp = $this->Clientes_Model->actualizarCliente($datos);
		if ($resp){
			$this->session->set_flashdata("exito","Datos actualizados con exito");
			redirect(base_url()."Clientes/editar_cliente/$return/");
		}else{
			$this->session->set_flashdata("error","Error al actualizar los datos");
			redirect(base_url()."Clientes/editar_cliente/$return/");
		}
		
		// echo json_encode($datos);
	
	}


	public function eliminar_cliente(){
		$datos = $this->input->post();
		$resp = $this->Clientes_Model->eliminarCliente($datos);
		if ($resp){
			$this->session->set_flashdata("exito","Datos eliminados con exito");
			redirect(base_url()."Clientes/");
		}else{
			$this->session->set_flashdata("error","Error al eliminar los datos");
			redirect(base_url()."Clientes/");
		}

	}

	public function obtener_estados(){
		if($this->input->is_ajax_request()){
			$pais =$this->input->get("id");
			$data = $this->Clientes_Model->obtenerEstadosXPais(trim($pais));
			echo json_encode($data);
		}
		else{
			echo "Error...";
		}
	}

	public function obtener_municipios(){
		if($this->input->is_ajax_request()){
			$depto =$this->input->get("id");
			$data = $this->Clientes_Model->obtenerMunicipiosXDepto(trim($depto));
			echo json_encode($data);
		}
		else{
			echo "Error...";
		}
	}


	public function validar_cliente(){
        if($this->input->is_ajax_request()){
            $datos =$this->input->post();
            $data = $this->Clientes_Model->buscarCliente($datos);
            echo json_encode($data);
        }
        else{
            echo "Error...";
        }
    }




/*


	




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
	*/
}

?>