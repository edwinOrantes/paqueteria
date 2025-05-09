<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Entregas extends CI_Controller {

    public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/El_Salvador');
        $this->load->model("Entregas_Model");
		if (!$this->session->has_userdata('valido')){
			$this->session->set_flashdata("error", "Debes iniciar sesión");
			redirect(base_url());
		}
	}

    public function index(){
		$data["ordenes"]  = $this->Entregas_Model->pendientesDeEntrega();

		$this->load->view('Base/header');
		$this->load->view('Entregas/lista_ordenes', $data);
		$this->load->view('Base/footer');

		// echo json_encode($data);
	}

    public function paquete_entregado(){
		$datos = $this->input->post();
		$bool = $this->Entregas_Model->paqueteEntregado($datos);
		if($bool){
			$this->session->set_flashdata("exito","El paquete se marco como entregado!");
			redirect(base_url()."Entregas/");
		}else{
			$this->session->set_flashdata("error","Error efectuar el proceso!");
			redirect(base_url()."Entregas/");
		}
		// echo json_encode($datos);

	}

    
}
